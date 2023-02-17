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

/***/ "./public/assets/_js/pages/be_ui_progress.js":
/*!***************************************************!*\
  !*** ./public/assets/_js/pages/be_ui_progress.js ***!
  \***************************************************/
/***/ (function() {

eval("/*\r\n *  Document   : be_ui_progress.js\r\n *  Author     : pixelcave\r\n *  Description: Custom JS code used in Progress Page\r\n */\nclass pageProgress {\n  /*\r\n   * Bars randomize functionality\r\n   *\r\n   */\n  static barsRandomize() {\n    document.querySelectorAll('.js-bar-randomize').forEach(item => {\n      item.addEventListener('click', e => {\n        item.closest('.block').querySelectorAll('.progress-bar').forEach(bar => {\n          let random = Math.floor(Math.random() * 91 + 10);\n          let content = bar.querySelector('span'); // Update progress width\n\n          bar.style.width = random + '%'; // Update progress label\n\n          if (content) {\n            content.textContent = random + '%';\n          }\n        });\n      });\n    });\n  }\n  /*\r\n   * Init functionality\r\n   *\r\n   */\n\n\n  static init() {\n    this.barsRandomize();\n  }\n\n} // Initialize when page loads\n\n\nOne.onLoad(pageProgress.init());\n\n//# sourceURL=webpack://oneui/./public/assets/_js/pages/be_ui_progress.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./public/assets/_js/pages/be_ui_progress.js"]();
/******/ 	
/******/ })()
;