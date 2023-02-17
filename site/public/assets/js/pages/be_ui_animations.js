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

/***/ "./public/assets/_js/pages/be_ui_animations.js":
/*!*****************************************************!*\
  !*** ./public/assets/_js/pages/be_ui_animations.js ***!
  \*****************************************************/
/***/ (function() {

eval("/*\r\n *  Document   : be_ui_animations.js\r\n *  Author     : pixelcave\r\n *  Description: Custom JS code used in Animations Page\r\n */\nclass pageAnimations {\n  /*\r\n   * Animation toggle functionality\r\n   *\r\n   */\n  static animationsToggle() {\n    let animationClass, animationButton, currentSection; // On button click\n\n    document.querySelectorAll('.js-animation-section button').forEach(btn => {\n      btn.addEventListener('click', e => {\n        animationClass = btn.dataset.animationClass;\n        currentSection = btn.closest('.js-animation-section'); // Update class preview\n\n        currentSection.querySelector('.js-animation-preview').textContent = animationClass; // Update animation object classes\n\n        let animationObject = currentSection.querySelector('.js-animation-object');\n        animationObject.classList = '';\n        animationObject.classList.add('js-animation-object');\n        animationObject.classList.add('animated');\n        animationObject.classList.add(animationClass);\n      });\n    });\n  }\n  /*\r\n   * Init functionality\r\n   *\r\n   */\n\n\n  static init() {\n    this.animationsToggle();\n  }\n\n} // Initialize when page loads\n\n\nOne.onLoad(pageAnimations.init());\n\n//# sourceURL=webpack://oneui/./public/assets/_js/pages/be_ui_animations.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./public/assets/_js/pages/be_ui_animations.js"]();
/******/ 	
/******/ })()
;