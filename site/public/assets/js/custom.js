var rootUrl =  document.querySelector('meta[name="url"]').getAttribute('href')
var csrfName = document.getElementById('csrf_security').getAttribute('name')
var csrfHash = document.getElementById('csrf_security').getAttribute('value')
//var token = $("meta[name='csrf-token']").attr("content");


jQuery.fn.extend({

    // check checkboxes
    room_person_list: function() {
        if($(this).length){
            var elm = this;
            var xhr = $.ajax({
                url: rootUrl + '/api/room/personlist',
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    elm.empty()
                    elm.prepend('<option value="0">-- Person auswählen --</option>');
                    $.each(response, function(i, value) {
                        elm.append('<option value="' + value.id +'">' + value.lastname +' ' + value.firstname +'</option>');
                    });

                },
            });
        }
    },
    room_member_list: function() {
        if ( $( this ).length ) {
            var elm = this;
            var xhr = $.ajax({
                url: rootUrl + '/api/room/' + elm.data('room') + '/members',
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    elm.empty()
                    if (parseInt(response.capacity) === response.stock) {
                        $('#room_add_member_button').prop('disabled', true);
                    } else {
                        $('#room_add_member_button').prop('disabled', false);
                    }
                    $.each(response.member, function (i, value) {
                        elm.prepend('<li class="list-group-item d-flex justify-content-between align-items-center">' + value.firstname + ' ' + value.lastname + '<button class="btn btn-danger btn-sm room_person_delete_button" data-uid="' + value.id + '"><i class="fa-solid fa-trash-can"></i></button></li>');
                    });

                },
            });
        }
    }
});

/**
 * Laden der Listen sobald diese auf der Seite gefunden wurden
 */
$( "#room_member_list" ).room_member_list()
$( "#room_add_member" ).room_person_list()


$(document).ready(function() {
    /**
     * Datatable und Masonry
     */
    if($('#masonry-cards').length) {
        $('#masonry-cards').masonry({
            percentPosition: true
        });
    }

    /**
     * API Kommunikation für die Benutzerverwaltung
     */
    // Löschen eines Benutzer
    $(".user_delete_button" ).click(function() {

        var row = $(this).closest('tr');
        Swal.fire({
            title: 'Löschen',
            text: "Möchtest du diesen Benutzer wirklich löschen?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Abbrechen',
            confirmButtonText: 'Löschen'
        }).then((result) => {
            if (result.isConfirmed) {
                var xhr = $.ajax({
                    url: rootUrl + '/api/user/delete/' + $(this).data('uid'),
                    type: 'DELETE',
                    dataType: 'json',
                    data: JSON.stringify({
                        [csrfName]: csrfHash
                    }),
                    success: function (response) {
                        if(response.success == 1) {
                            $('#csrf_security').val(response.token);
                            csrfHash = response.token;
                            row.remove();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                text: response.error,
                            })
                        }

                    },
                });
            }
        })
    });
    // Zurücksetzen des Passwortes eines Benutzer
    $(".user_reset_button" ).click(function() {

        var row = $(this).closest('tr');
        Swal.fire({
            title: 'Neues Password',
            text: "Hiermit wird dem Benutzer ein neues Passwort generiert und dies per E-Mail versendet.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Abbrechen',
            confirmButtonText: 'Reset'
        }).then((result) => {
            if (result.isConfirmed) {
                var xhr = $.ajax({
                    url: rootUrl + '/api/user/reset/' + $(this).data('uid'),
                    type: 'PUT',
                    dataType: 'json',
                    data: JSON.stringify({
                        [csrfName]: csrfHash
                    }),
                    success: function (response) {
                        console.log(response);
                        if(response.success == 1) {
                            $('#csrf_security').val(response.token);
                            csrfHash = response.token;
                            Swal.fire({
                                icon: 'success',
                                text: 'Passwort wurde geändert und eine E-Mail an den Benutzer verschickt.',
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                text: response.error,
                            })
                        }

                    }
                });
            }
        })
    });

    /**
     * API Kommunikation für die Teilnehmerübersicht
     */
    // Löschen eines Teilnehmer
    $(".person_delete_button" ).click(function() {

        var row = $(this).closest('tr');
        Swal.fire({
            title: 'Löschen',
            text: "Möchtest du diesen Teilnehmer wirklich löschen?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Abbrechen',
            confirmButtonText: 'Löschen'
        }).then((result) => {
            if (result.isConfirmed) {
                var xhr = $.ajax({
                    url: rootUrl + '/api/person/delete/' + $(this).data('uid'),
                    type: 'DELETE',
                    dataType: 'json',
                    data: JSON.stringify({
                        [csrfName]: csrfHash
                    }),
                    success: function (response) {
                        if(response.success == 1) {
                            $('#csrf_security').val(response.token);
                            csrfHash = response.token;
                            row.remove();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                text: response.error,
                            })
                        }

                    },
                });
            }
        })
    });

    /**
     * API Kommunikation für die ENtwurf
     */

    $(".entwurf_delete_button" ).click(function(e) {
        e.preventDefault();

        var row = $(this).closest('tr');
        Swal.fire({
            title: 'Löschen',
            text: "Möchtest du diesen Entwurf wirklich löschen?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Abbrechen',
            confirmButtonText: 'Löschen'
        }).then((result) => {
            if (result.isConfirmed) {
                var xhr = $.ajax({
                    url: rootUrl + '/api/mail/delete/' + $(this).data('time'),
                    type: 'DELETE',
                    dataType: 'json',
                    data: JSON.stringify({
                        [csrfName]: csrfHash
                    }),
                    success: function (response) {
                        if(response.success == 1) {
                            $(location).prop('href', rootUrl + '/mail/gespeichert')
                        } else {
                            Swal.fire({
                                icon: 'error',
                                text: response.error,
                            })
                        }

                    },
                });
            }
        })
    });

    /**
     * API Kommunikation für die Zimmer
     */
    // entfernen einer Person aus einem Zimmer
    $("body").on("click", ".room_person_delete_button", function(e){

        var xhr = $.ajax({
            url: rootUrl + '/api/room/' + $(this).data('uid') + '/member/delete',
            type: 'DELETE',
            dataType: 'json',
            data: JSON.stringify({
                [csrfName]: csrfHash
            }),
            success: function (response) {
                if(response.success == 1) {
                    $('#csrf_security').val(response.token);
                    csrfHash = response.token;
                    if(parseInt(response.room.capacity) === response.room.stock){
                        $('#room_add_member_button').prop('disabled', true);
                    } else {
                        $('#room_add_member_button').prop('disabled', false);
                    }
                    $( "#room_add_member" ).room_person_list()
                    $( "#room_member_list" ).room_member_list()
                } else {
                    Swal.fire({
                        icon: 'error',
                        text: response.error,
                    })
                }

            },
        });
    });

    // Hinzufügen einer Person zu einem Zimmer
    $("#room_add_member_button" ).click(function(e) {
        var xhr = $.ajax({
            url: rootUrl + '/api/room/member/add',
            type: 'POST',
            dataType: 'json',
            data: JSON.stringify({
                [csrfName]: csrfHash,
                'room_id': $(this).data('room'),
                'person_id': $( "#room_add_member" ).val()
            }),
            success: function (response) {
                csrfHash = response.token;
                if(response.success == 1) {
                    $( "#room_add_member" ).room_person_list()
                    $("#room_member_list" ).room_member_list();
                } else {
                    Swal.fire({
                        icon: 'error',
                        text: response.error,
                    })
                }

            },
        });
    });

    // Löschen eines ganzen Zimmers
    $(".room_delete_button" ).click(function() {

        var row = $(this).closest('.room');
        Swal.fire({
            title: 'Löschen',
            text: "Möchtest du dieses Zimmer wirklich löschen?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Abbrechen',
            confirmButtonText: 'Löschen'
        }).then((result) => {
            if (result.isConfirmed) {
                var xhr = $.ajax({
                    url: rootUrl + '/api/room/' + $(this).data("id") + '/delete/',
                    type: 'DELETE',
                    dataType: 'json',
                    data: JSON.stringify({
                        [csrfName]: csrfHash
                    }),
                    success: function (response) {
                        if(response.success == 1) {
                            $('#csrf_security').val(response.token);
                            csrfHash = response.token;
                            row.remove();
                            $('#masonry-cards').masonry({
                                percentPosition: true
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                text: response.error,
                            })
                        }

                    },
                });
            }
        })
    });

    /**
     * API Kommunikation für die Materialliste
     */
    $(".material-status" ).change(function() {
        var button = $(this);
        var row = $(this).closest('tr');
        var xhr = $.ajax({

            url: rootUrl + '/api/material/' + row.data('id') + '/status',
            type: 'PUT',
            dataType: 'json',
            data: JSON.stringify({
                [csrfName]: csrfHash,
                'status': $(this).val()
            }),
            success: function (response) {
                console.log(response);
                $('#csrf_security').val(response.token);
                csrfHash = response.token;
                if(response.success == 1) {
                    One.helpers('jq-notify', {
                        type: 'success',
                        icon: 'fa fa-check me-1',
                        message: response.msg});
                } else {
                    Swal.fire({
                        icon: 'error',
                        text: response.error,
                    })
                }

            },
        });

    });

    $(".material-assign" ).click(function() {
        var button = $(this);
        var row = $(this).closest('.mat-row');
        var col = $(this).closest('td');
        var xhr = $.ajax({

            url: rootUrl + '/api/material/' + row.data('id') + '/assign',
            type: 'PUT',
            dataType: 'json',
            data: JSON.stringify({
                [csrfName]: csrfHash,
                'uid': button.data('uid')
            }),
            success: function (response) {
                console.log(response);
                $('#csrf_security').val(response.token);
                csrfHash = response.token;
                if(response.success == 1) {
                    col.append(response.name).find('button').remove()
                    One.helpers('jq-notify', {
                        type: 'success',
                        icon: 'fa fa-check me-1',
                        message: response.msg});
                } else {
                    Swal.fire({
                        icon: 'error',
                        text: response.error,
                    })
                }

            },
        });

    });

    // Löschen eines ganzen Zimmers
    $(".material_delete_button" ).click(function() {

        var row = $(this).closest('tr');
        Swal.fire({
            title: 'Löschen',
            text: "Möchtest du dieses Material wirklich löschen?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Abbrechen',
            confirmButtonText: 'Löschen'
        }).then((result) => {
            if (result.isConfirmed) {
                var xhr = $.ajax({
                    url: rootUrl + '/api/material/' + $(this).data("id") + '/delete/',
                    type: 'DELETE',
                    dataType: 'json',
                    data: JSON.stringify({
                        [csrfName]: csrfHash
                    }),
                    success: function (response) {
                        $('#csrf_security').val(response.token);
                        csrfHash = response.token;
                        if(response.success == 1) {
                            row.remove();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                text: response.error,
                            })
                        }

                    },
                });
            }
        })
    });


    $(".group_delete_button" ).click(function() {

        var row = $(this).closest('tr');
        Swal.fire({
            title: 'Löschen',
            text: "Möchtest du diese Gruppe wirklich löschen?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Abbrechen',
            confirmButtonText: 'Löschen'
        }).then((result) => {
            if (result.isConfirmed) {
                var xhr = $.ajax({
                    url: rootUrl + '/api/usergroup/' + $(this).data("id") + '/delete/',
                    type: 'DELETE',
                    dataType: 'json',
                    data: JSON.stringify({
                        [csrfName]: csrfHash
                    }),
                    success: function (response) {
                        $('#csrf_security').val(response.token);
                        csrfHash = response.token;
                        if(response.success == 1) {
                            row.remove();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                text: response.error,
                            })
                        }

                    },
                });
            }
        })
    });

    /**
     * Datatables
     */



} );