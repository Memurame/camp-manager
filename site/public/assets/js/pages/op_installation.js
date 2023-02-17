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

/***/ "./public/assets/_js/pages/op_installation.js":
/*!****************************************************!*\
  !*** ./public/assets/_js/pages/op_installation.js ***!
  \****************************************************/
/***/ (function() {

eval("/*\r\n *  Document   : op_installation.js\r\n *  Author     : pixelcave\r\n *  Description: Custom JS code used in Installation Page\r\n */\n// Form Validation, for more examples you can check out https://github.com/jzaefferer/jquery-validation\nclass pageInstallation {\n  /*\r\n   * Init Installation Form Validation\r\n   *\r\n   */\n  static initValidationInstallation() {\n    // Load default options for jQuery Validation plugin\n    One.helpers('jq-validation'); // Init Form Validation\n\n    jQuery('.js-validation-installation').validate({\n      rules: {\n        'install-db-name': {\n          required: true\n        },\n        'install-db-username': {\n          required: true\n        },\n        'install-db-password': {\n          required: true\n        },\n        'install-admin-email': {\n          required: true,\n          emailWithDot: true\n        },\n        'install-admin-password': {\n          required: true,\n          minlength: 5\n        },\n        'install-admin-password-confirm': {\n          required: true,\n          equalTo: '#install-admin-password'\n        }\n      },\n      messages: {\n        'install-db-name': {\n          required: 'Please provide the name of your database'\n        },\n        'install-db-username': {\n          required: 'Please provide the username with access to your database'\n        },\n        'install-db-password': {\n          required: 'Please provide the password of your database user'\n        },\n        'install-admin-email': {\n          required: 'Please enter your email'\n        },\n        'install-admin-password': {\n          required: 'Please provide a password',\n          minlength: 'Your password must be at least 5 characters long'\n        },\n        'install-admin-password-confirm': {\n          required: 'Please provide a password',\n          minlength: 'Your password must be at least 5 characters long',\n          equalTo: 'Please enter the same password as above'\n        }\n      }\n    });\n  }\n  /*\r\n   * Init functionality\r\n   *\r\n   */\n\n\n  static init() {\n    this.initValidationInstallation();\n  }\n\n} // Initialize when page loads\n\n\nOne.onLoad(pageInstallation.init());\n\n//# sourceURL=webpack://oneui/./public/assets/_js/pages/op_installation.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./public/assets/_js/pages/op_installation.js"]();
/******/ 	
/******/ })()
;