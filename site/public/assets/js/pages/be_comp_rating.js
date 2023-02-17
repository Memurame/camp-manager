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

/***/ "./public/assets/_js/pages/be_comp_rating.js":
/*!***************************************************!*\
  !*** ./public/assets/_js/pages/be_comp_rating.js ***!
  \***************************************************/
/***/ (function() {

eval("/*\r\n *  Document   : be_comp_rating.js\r\n *  Author     : pixelcave\r\n *  Description: Custom JS code used in Rating Page\r\n */\n// jQuery Raty, for more examples you can check out https://github.com/wbotelhos/raty\nclass pageCompRating {\n  /*\r\n   * Init demo rating functionality\r\n   *\r\n   */\n  static initRating() {\n    // Init Raty on .js-rating class\n    jQuery('.js-rating').each((index, element) => {\n      let el = jQuery(element);\n      el.raty({\n        score: el.data('score') || 0,\n        number: el.data('number') || 5,\n        cancel: el.data('cancel') || false,\n        target: el.data('target') || false,\n        targetScore: el.data('target-score') || false,\n        precision: el.data('precision') || false,\n        cancelOff: el.data('cancel-off') || 'fa fa-fw fa-times-circle text-danger',\n        cancelOn: el.data('cancel-on') || 'fa fa-fw fa-times-circle',\n        starHalf: el.data('star-half') || 'fa fa-fw fa-star-half text-warning',\n        starOff: el.data('star-off') || 'fa fa-fw fa-star text-muted',\n        starOn: el.data('star-on') || 'fa fa-fw fa-star text-warning',\n        starType: 'i',\n        hints: ['Just Bad!', 'Almost There!', 'It’s ok!', 'That’s nice!', 'Incredible!'],\n        click: function (score, evt) {// Here you could add your logic on rating click\n          // console.log('ID: ' + this.id + \"\\nscore: \" + score + \"\\nevent: \" + evt);\n        }\n      });\n    });\n  }\n  /*\r\n   * Init functionality\r\n   *\r\n   */\n\n\n  static init() {\n    this.initRating();\n  }\n\n} // Initialize when page loads\n\n\nOne.onLoad(pageCompRating.init());\n\n//# sourceURL=webpack://oneui/./public/assets/_js/pages/be_comp_rating.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./public/assets/_js/pages/be_comp_rating.js"]();
/******/ 	
/******/ })()
;