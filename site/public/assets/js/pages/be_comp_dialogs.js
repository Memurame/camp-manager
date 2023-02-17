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

/***/ "./public/assets/_js/pages/be_comp_dialogs.js":
/*!****************************************************!*\
  !*** ./public/assets/_js/pages/be_comp_dialogs.js ***!
  \****************************************************/
/***/ (function() {

eval("/*\r\n *  Document   : be_comp_dialogs.js\r\n *  Author     : pixelcave\r\n *  Description: Custom JS code used in Dialogs Page\r\n */\n// SweetAlert2, for more examples you can check out https://github.com/sweetalert2/sweetalert2\nclass pageDialogs {\n  /*\r\n   * SweetAlert2 demo functionality\r\n   *\r\n   */\n  static sweetAlert2() {\n    // Set default properties\n    let toast = Swal.mixin({\n      buttonsStyling: false,\n      target: '#page-container',\n      customClass: {\n        confirmButton: 'btn btn-success m-1',\n        cancelButton: 'btn btn-danger m-1',\n        input: 'form-control'\n      }\n    }); // Init a simple dialog on button click\n\n    document.querySelector('.js-swal-simple').addEventListener('click', e => {\n      toast.fire('Hi, this is just a simple message!');\n    }); // Init an success dialog on button click\n\n    document.querySelector('.js-swal-success').addEventListener('click', e => {\n      toast.fire('Success', 'Everything was updated perfectly!', 'success');\n    }); // Init an info dialog on button click\n\n    document.querySelector('.js-swal-info').addEventListener('click', e => {\n      toast.fire('Info', 'Just an informational message!', 'info');\n    }); // Init an warning dialog on button click\n\n    document.querySelector('.js-swal-warning').addEventListener('click', e => {\n      toast.fire('Warning', 'Something needs your attention!', 'warning');\n    }); // Init an error dialog on button click\n\n    document.querySelector('.js-swal-error').addEventListener('click', e => {\n      toast.fire('Oops...', 'Something went wrong!', 'error');\n    }); // Init an question dialog on button click\n\n    document.querySelector('.js-swal-question').addEventListener('click', e => {\n      toast.fire('Question', 'Are you sure about that?', 'question');\n    }); // Init an example confirm dialog on button click\n\n    document.querySelector('.js-swal-confirm').addEventListener('click', e => {\n      toast.fire({\n        title: 'Are you sure?',\n        text: 'You will not be able to recover this imaginary file!',\n        icon: 'warning',\n        showCancelButton: true,\n        customClass: {\n          confirmButton: 'btn btn-danger m-1',\n          cancelButton: 'btn btn-secondary m-1'\n        },\n        confirmButtonText: 'Yes, delete it!',\n        html: false,\n        preConfirm: e => {\n          return new Promise(resolve => {\n            setTimeout(() => {\n              resolve();\n            }, 50);\n          });\n        }\n      }).then(result => {\n        if (result.value) {\n          toast.fire('Deleted!', 'Your imaginary file has been deleted.', 'success'); // result.dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'\n        } else if (result.dismiss === 'cancel') {\n          toast.fire('Cancelled', 'Your imaginary file is safe :)', 'error');\n        }\n      });\n    }); // Init an example confirm alert on button click\n\n    document.querySelector('.js-swal-custom-position').addEventListener('click', e => {\n      toast.fire({\n        position: 'top-end',\n        title: 'Perfect!',\n        text: 'Nice Position!',\n        icon: 'success'\n      });\n    });\n  }\n  /*\r\n   * Init functionality\r\n   *\r\n   */\n\n\n  static init() {\n    this.sweetAlert2();\n  }\n\n} // Initialize when page loads\n\n\nOne.onLoad(pageDialogs.init());\n\n//# sourceURL=webpack://oneui/./public/assets/_js/pages/be_comp_dialogs.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./public/assets/_js/pages/be_comp_dialogs.js"]();
/******/ 	
/******/ })()
;