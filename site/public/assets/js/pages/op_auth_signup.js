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

/***/ "./public/assets/_js/pages/op_auth_signup.js":
/*!***************************************************!*\
  !*** ./public/assets/_js/pages/op_auth_signup.js ***!
  \***************************************************/
/***/ (function() {

eval("/*\r\n *  Document   : op_auth_signup.js\r\n *  Author     : pixelcave\r\n *  Description: Custom JS code used in Sign Up Page\r\n */\nclass pageAuthSignUp {\n  /*\r\n   * Init Sign Up Form Validation, for more examples you can check out https://github.com/jzaefferer/jquery-validation\r\n   *\r\n   */\n  static initValidation() {\n    // Load default options for jQuery Validation plugin\n    One.helpers('jq-validation'); // Init Form Validation\n\n    jQuery('.js-validation-signup').validate({\n      rules: {\n        'signup-username': {\n          required: true,\n          minlength: 3\n        },\n        'signup-email': {\n          required: true,\n          emailWithDot: true\n        },\n        'signup-password': {\n          required: true,\n          minlength: 5\n        },\n        'signup-password-confirm': {\n          required: true,\n          equalTo: '#signup-password'\n        },\n        'signup-terms': {\n          required: true\n        }\n      },\n      messages: {\n        'signup-username': {\n          required: 'Please enter a username',\n          minlength: 'Your username must consist of at least 3 characters'\n        },\n        'signup-email': 'Please enter a valid email address',\n        'signup-password': {\n          required: 'Please provide a password',\n          minlength: 'Your password must be at least 5 characters long'\n        },\n        'signup-password-confirm': {\n          required: 'Please provide a password',\n          minlength: 'Your password must be at least 5 characters long',\n          equalTo: 'Please enter the same password as above'\n        },\n        'signup-terms': 'You must agree to the service terms!'\n      }\n    });\n  }\n  /*\r\n   * Init functionality\r\n   *\r\n   */\n\n\n  static init() {\n    this.initValidation();\n  }\n\n} // Initialize when page loads\n\n\nOne.onLoad(pageAuthSignUp.init());\n\n//# sourceURL=webpack://oneui/./public/assets/_js/pages/op_auth_signup.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./public/assets/_js/pages/op_auth_signup.js"]();
/******/ 	
/******/ })()
;