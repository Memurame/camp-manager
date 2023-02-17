/*!
 * oneui - v5.2.0
 * @author pixelcave - https://pixelcave.com
 * Copyright (c) 2022
 */
/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (function() { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./public/assets/_js/pages/be_tables_datatables.js":
/*!*********************************************************!*\
  !*** ./public/assets/_js/pages/be_tables_datatables.js ***!
  \*********************************************************/
/***/ (function() {

eval("/*\r\n *  Document   : be_tables_datatables.js\r\n *  Author     : pixelcave\r\n *  Description: Custom JS code used in DataTables Page\r\n */\n// DataTables, for more examples you can check out https://www.datatables.net/\nclass pageTablesDatatables {\n  /*\r\n   * Init DataTables functionality\r\n   *\r\n   */\n  static initDataTables() {\n    // Override a few default classes\n    jQuery.extend(jQuery.fn.DataTable.ext.classes, {\n      sWrapper: \"dataTables_wrapper dt-bootstrap5\",\n      sFilterInput: \"form-control form-control-sm\",\n      sLengthSelect: \"form-select form-select-sm\"\n    }); // Override a few defaults\n\n    jQuery.extend(true, jQuery.fn.DataTable.defaults, {\n      pageLength: 20,\n      lengthMenu: [[20, 50, 100, -1], [20, 50, 100, 'All']],\n      language: {\n        lengthMenu: \"_MENU_\",\n        search: \"_INPUT_\",\n        searchPlaceholder: \"Search..\",\n        info: \"Page <strong>_PAGE_</strong> of <strong>_PAGES_</strong>\",\n        paginate: {\n          first: '<i class=\"fa fa-angle-double-left\"></i>',\n          previous: '<i class=\"fa fa-angle-left\"></i>',\n          next: '<i class=\"fa fa-angle-right\"></i>',\n          last: '<i class=\"fa fa-angle-double-right\"></i>'\n        }\n      }\n    }); // Override buttons default classes\n\n    jQuery.extend(true, jQuery.fn.DataTable.Buttons.defaults, {\n      dom: {\n        button: {\n          className: 'btn btn-sm btn-primary'\n        }\n      }\n    }); // Init full DataTable\n\n    jQuery('.js-dataTable-full').DataTable({\n      autoWidth: false\n    }); // Init full extra DataTable\n\n    jQuery('.js-dataTable-full-pagination').DataTable({\n      pagingType: \"full_numbers\",\n      autoWidth: false\n    }); // Init simple DataTable\n\n    jQuery('.js-dataTable-simple').DataTable({\n      pageLength: 20,\n      lengthMenu: false,\n      searching: false,\n      autoWidth: false,\n      dom: \"<'row'<'col-sm-12'tr>>\" + \"<'row'<'col-sm-6'i><'col-sm-6'p>>\"\n    }); // Init DataTable with Buttons\n\n    jQuery('.js-dataTable-buttons').DataTable({\n      autoWidth: false,\n      buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],\n      dom: \"<'row'<'col-sm-12'<'text-center bg-body-light py-2 mb-2'B>>>\" + \"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>\"\n    }); // Init responsive DataTable\n\n    jQuery('.js-dataTable-responsive').DataTable({\n      pagingType: \"full_numbers\",\n      autoWidth: false,\n      responsive: true\n    });\n    /*\r\n     * Eigene Databable Instanzen\r\n     */\n\n    jQuery('#anmeldungen').DataTable({\n      language: {\n        url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/de-DE.json'\n      },\n      pageLength: -1,\n      paging: false,\n      autoWidth: false,\n      responsive: true,\n      order: [[1, \"asc\"]],\n      stateSave: true,\n      columns: [{\n        orderable: false,\n        className: 'text-nowrap'\n      }, {\n        orderable: true,\n        className: 'text-nowrap'\n      }, {\n        orderable: true\n      }, {\n        orderable: true\n      }, {\n        orderable: true\n      }, {\n        orderable: true\n      }, {\n        orderable: false\n      }]\n    });\n    jQuery('#datatable-log').DataTable({\n      language: {\n        url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/de-DE.json'\n      },\n      order: [[0, \"desc\"]],\n      responsive: true,\n      stateSave: true,\n      autoWidth: false,\n      columns: [{\n        orderable: true\n      }, {\n        orderable: false\n      }, {\n        orderable: true\n      }, {\n        orderable: true\n      }, {\n        orderable: false\n      }]\n    });\n    jQuery('#datatable-groups').DataTable({\n      language: {\n        url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/de-DE.json'\n      },\n      order: [[0, \"asc\"]],\n      responsive: true,\n      stateSave: true,\n      autoWidth: false,\n      columns: [{\n        orderable: true\n      }, {\n        orderable: false\n      }, {\n        orderable: false\n      }]\n    });\n    jQuery.fn.dataTable.ext.search.push(function (settings, searchData, index, rowData, counter) {\n      var kat = $('input:checkbox[name=\"kat\"]:checked').map(function () {\n        return this.value;\n      }).get();\n\n      if (kat.length === 0) {\n        return true;\n      }\n\n      if (kat.indexOf(searchData[2]) !== -1) {\n        return true;\n      }\n\n      return false;\n    });\n    var mat_table = jQuery('#datatable-mat').DataTable({\n      language: {\n        url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/de-DE.json'\n      },\n      order: [[0, \"asc\"]],\n      stateSave: true,\n      scrollX: true,\n      columns: [{\n        orderable: true,\n        width: \"200px\"\n      }, {\n        orderable: true\n      }, {\n        orderable: true\n      }, {\n        orderable: true\n      }, {\n        orderable: false,\n        width: \"150px\"\n      }, {\n        orderable: false\n      }]\n    });\n    jQuery('input:checkbox').on('change', function () {\n      mat_table.draw();\n    });\n  }\n  /*\r\n   * Init functionality\r\n   *\r\n   */\n\n\n  static init() {\n    this.initDataTables();\n  }\n\n} // Initialize when page loads\n\n\nOne.onLoad(pageTablesDatatables.init());\n\n//# sourceURL=webpack://oneui/./public/assets/_js/pages/be_tables_datatables.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./public/assets/_js/pages/be_tables_datatables.js"]();
/******/ 	
/******/ })()
;