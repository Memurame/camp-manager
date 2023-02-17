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

/***/ "./public/assets/_js/pages/be_forms_validation.js":
/*!********************************************************!*\
  !*** ./public/assets/_js/pages/be_forms_validation.js ***!
  \********************************************************/
/***/ (function() {

eval("/*\r\n *  Document   : be_forms_validation.js\r\n *  Author     : pixelcave\r\n *  Description: Custom JS code used in Forms Validation Page\r\n */\n// Form Validation, for more examples you can check out https://github.com/jzaefferer/jquery-validation\nclass pageFormsValidation {\n  /*\r\n   * Init Validation functionality\r\n   *\r\n   */\n  static initValidation() {\n    // Load default options for jQuery Validation plugin\n    One.helpers('jq-validation'); // Init Form Validation\n\n    jQuery('.js-validation').validate({\n      ignore: [],\n      rules: {\n        'val-username': {\n          required: true,\n          minlength: 3\n        },\n        'val-email': {\n          required: true,\n          emailWithDot: true\n        },\n        'val-password': {\n          required: true,\n          minlength: 5\n        },\n        'val-confirm-password': {\n          required: true,\n          equalTo: '#val-password'\n        },\n        'val-suggestions': {\n          required: true,\n          minlength: 5\n        },\n        'val-skill': {\n          required: true\n        },\n        'val-currency': {\n          required: true,\n          currency: ['$', true]\n        },\n        'val-website': {\n          required: true,\n          url: true\n        },\n        'val-phoneus': {\n          required: true,\n          phoneUS: true\n        },\n        'val-digits': {\n          required: true,\n          digits: true\n        },\n        'val-number': {\n          required: true,\n          number: true\n        },\n        'val-range': {\n          required: true,\n          range: [1, 5]\n        },\n        'val-terms': {\n          required: true\n        },\n        'val-select2': {\n          required: true\n        },\n        'val-select2-multiple': {\n          required: true,\n          minlength: 2\n        }\n      },\n      messages: {\n        'val-username': {\n          required: 'Please enter a username',\n          minlength: 'Your username must consist of at least 3 characters'\n        },\n        'val-email': 'Please enter a valid email address',\n        'val-password': {\n          required: 'Please provide a password',\n          minlength: 'Your password must be at least 5 characters long'\n        },\n        'val-confirm-password': {\n          required: 'Please provide a password',\n          minlength: 'Your password must be at least 5 characters long',\n          equalTo: 'Please enter the same password as above'\n        },\n        'val-select2': 'Please select a value!',\n        'val-select2-multiple': 'Please select at least 2 values!',\n        'val-suggestions': 'What can we do to become better?',\n        'val-skill': 'Please select a skill!',\n        'val-currency': 'Please enter a price!',\n        'val-website': 'Please enter your website!',\n        'val-phoneus': 'Please enter a US phone!',\n        'val-digits': 'Please enter only digits!',\n        'val-number': 'Please enter a number!',\n        'val-range': 'Please enter a number between 1 and 5!',\n        'val-terms': 'You must agree to the service terms!'\n      }\n    }); // Init Validation on Select2 change\n\n    jQuery('.js-select2').on('change', e => {\n      jQuery(e.currentTarget).valid();\n    });\n  }\n  /*\r\n   * Init functionality\r\n   *\r\n   */\n\n\n  static init() {\n    this.initValidation();\n  }\n\n} // Initialize when page loads\n\n\nOne.onLoad(pageFormsValidation.init());\n\n//# sourceURL=webpack://oneui/./public/assets/_js/pages/be_forms_validation.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./public/assets/_js/pages/be_forms_validation.js"]();
/******/ 	
/******/ })()
;