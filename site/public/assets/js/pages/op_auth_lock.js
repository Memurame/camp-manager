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

/***/ "./public/assets/_js/pages/op_auth_lock.js":
/*!*************************************************!*\
  !*** ./public/assets/_js/pages/op_auth_lock.js ***!
  \*************************************************/
/***/ (function() {

eval("/*\r\n *  Document   : op_auth_lock.js\r\n *  Author     : pixelcave\r\n *  Description: Custom JS code used in Lock Page\r\n */\nclass pageAuthLock {\n  /*\r\n   * Init Lock Form Validation, for more examples you can check out https://github.com/jzaefferer/jquery-validation\r\n   *\r\n   */\n  static initValidation() {\n    // Load default options for jQuery Validation plugin\n    One.helpers('jq-validation'); // Init Form Validation\n\n    jQuery('.js-validation-lock').validate({\n      rules: {\n        'lock-password': {\n          required: true,\n          minlength: 3\n        }\n      },\n      messages: {\n        'lock-password': {\n          required: 'Please enter your valid password'\n        }\n      }\n    });\n  }\n  /*\r\n   * Init functionality\r\n   *\r\n   */\n\n\n  static init() {\n    this.initValidation();\n  }\n\n} // Initialize when page loads\n\n\nOne.onLoad(pageAuthLock.init());\n\n//# sourceURL=webpack://oneui/./public/assets/_js/pages/op_auth_lock.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./public/assets/_js/pages/op_auth_lock.js"]();
/******/ 	
/******/ })()
;