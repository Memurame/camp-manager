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

/***/ "./public/assets/_js/pages/op_coming_soon.js":
/*!***************************************************!*\
  !*** ./public/assets/_js/pages/op_coming_soon.js ***!
  \***************************************************/
/***/ (function() {

eval("/*\r\n *  Document   : op_coming_soon.js\r\n *  Author     : pixelcave\r\n *  Description: Custom JS code used in Coming Soon Page\r\n */\nclass pageComingSoon {\n  /*\r\n   * Init Countdown.js, for more examples you can check out https://github.com/hilios/jQuery.countdown\r\n   *\r\n   */\n  static countdown() {\n    jQuery('.js-countdown').countdown(new Date().getFullYear() + 2 + '/01/15', e => {\n      jQuery(e.currentTarget).html(e.strftime('<div class=\"row items-push py-3 text-center\">' + '<div class=\"col-6 col-md-3\"><div class=\"fs-1 fw-bold text-white\">%-D</div><div class=\"fs-sm fw-bold text-muted\">DAYS</div></div>' + '<div class=\"col-6 col-md-3\"><div class=\"fs-1 fw-bold text-white\">%H</div><div class=\"fs-sm fw-bold text-muted\">HOURS</div></div>' + '<div class=\"col-6 col-md-3\"><div class=\"fs-1 fw-bold text-white\">%M</div><div class=\"fs-sm fw-bold text-muted\">MINUTES</div></div>' + '<div class=\"col-6 col-md-3\"><div class=\"fs-1 fw-bold text-white\">%S</div><div class=\"fs-sm fw-bold text-muted\">SECONDS</div></div>' + '</div>'));\n    });\n  }\n  /*\r\n   * Init functionality\r\n   *\r\n   */\n\n\n  static init() {\n    this.countdown();\n  }\n\n} // Initialize when page loads\n\n\nOne.onLoad(pageComingSoon.init());\n\n//# sourceURL=webpack://oneui/./public/assets/_js/pages/op_coming_soon.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./public/assets/_js/pages/op_coming_soon.js"]();
/******/ 	
/******/ })()
;