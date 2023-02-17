/*
 *  Document   : be_tables_datatables.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in DataTables Page
 */

// DataTables, for more examples you can check out https://www.datatables.net/
class pageTablesDatatables {
  /*
   * Init DataTables functionality
   *
   */
  static initDataTables() {
    // Override a few default classes
    jQuery.extend(jQuery.fn.DataTable.ext.classes, {
      sWrapper: "dataTables_wrapper dt-bootstrap5",
      sFilterInput: "form-control form-control-sm",
      sLengthSelect: "form-select form-select-sm"
    });

    // Override a few defaults
    jQuery.extend(true, jQuery.fn.DataTable.defaults, {
      pageLength: 20,
      lengthMenu: [[20, 50, 100, -1], [20, 50, 100, 'All']],
      language: {
        lengthMenu: "_MENU_",
        search: "_INPUT_",
        searchPlaceholder: "Search..",
        info: "Page <strong>_PAGE_</strong> of <strong>_PAGES_</strong>",
        paginate: {
          first: '<i class="fa fa-angle-double-left"></i>',
          previous: '<i class="fa fa-angle-left"></i>',
          next: '<i class="fa fa-angle-right"></i>',
          last: '<i class="fa fa-angle-double-right"></i>'
        }
      }
    });

    // Override buttons default classes
    jQuery.extend(true, jQuery.fn.DataTable.Buttons.defaults, {
      dom: {
        button: {
          className: 'btn btn-sm btn-primary'
        },
      }
    });

    // Init full DataTable
    jQuery('.js-dataTable-full').DataTable({
      autoWidth: false
    });

    // Init full extra DataTable
    jQuery('.js-dataTable-full-pagination').DataTable({
      pagingType: "full_numbers",
      autoWidth: false
    });

    // Init simple DataTable
    jQuery('.js-dataTable-simple').DataTable({
      pageLength: 20,
      lengthMenu: false,
      searching: false,
      autoWidth: false,
      dom: "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-6'i><'col-sm-6'p>>"
    });

    // Init DataTable with Buttons
    jQuery('.js-dataTable-buttons').DataTable({
      autoWidth: false,
      buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
      dom: "<'row'<'col-sm-12'<'text-center bg-body-light py-2 mb-2'B>>>" +
        "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
    });

    // Init responsive DataTable
    jQuery('.js-dataTable-responsive').DataTable({
      pagingType: "full_numbers",
      autoWidth: false,
      responsive: true
    });


    /*
     * Eigene Databable Instanzen
     */

    jQuery('#anmeldungen').DataTable({
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/de-DE.json'
      },
      pageLength: -1,
      paging: false,
      autoWidth: false,
      responsive: true,
      order: [[ 1, "asc" ]],
      stateSave: true,
      columns: [
        { orderable: false, className: 'text-nowrap'  },
        { orderable: true, className: 'text-nowrap' },
        { orderable: true },
        { orderable: true },
        { orderable: true },
        { orderable: true },
        { orderable: false }
      ]
    });

    jQuery('#datatable-log').DataTable({
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/de-DE.json'
      },
      order: [[ 0, "desc" ]],
      responsive: true,
      stateSave: true,
      autoWidth: false,
      columns: [
        { orderable: true },
        { orderable: false },
        { orderable: true },
        { orderable: true },
        { orderable: false }
      ]
    });

    jQuery('#datatable-groups').DataTable({
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/de-DE.json'
      },
      order: [[ 0, "asc" ]],
      responsive: true,
      stateSave: true,
      autoWidth: false,
      columns: [
        { orderable: true },
        { orderable: false },
        { orderable: false },
      ]
    });



    jQuery.fn.dataTable.ext.search.push(
        function( settings, searchData, index, rowData, counter ) {
          var kat = $('input:checkbox[name="kat"]:checked').map(function() {
            return this.value;
          }).get();

          if (kat.length === 0) {
            return true;
          }

          if (kat.indexOf(searchData[2]) !== -1) {
            return true;
          }

          return false;
        }
    );

    var mat_table = jQuery('#datatable-mat').DataTable({
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/de-DE.json'
      },
      order: [[ 0, "asc" ]],
      stateSave: true,
      scrollX: true,
      columns: [
        { orderable: true , width: "200px"},
        { orderable: true },
        { orderable: true },
        { orderable: true },
        { orderable: false, width: "150px"},
        { orderable: false }
      ]
    });

    jQuery('input:checkbox').on('change', function () {
      mat_table.draw();
    });




  }

  /*
   * Init functionality
   *
   */
  static init() {
    this.initDataTables();
  }
}

// Initialize when page loads
One.onLoad(pageTablesDatatables.init());
