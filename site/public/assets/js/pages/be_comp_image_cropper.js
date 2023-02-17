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

/***/ "./public/assets/_js/pages/be_comp_image_cropper.js":
/*!**********************************************************!*\
  !*** ./public/assets/_js/pages/be_comp_image_cropper.js ***!
  \**********************************************************/
/***/ (function() {

eval("/*\r\n *  Document   : be_comp_image_cropper.js\r\n *  Author     : pixelcave\r\n *  Description: Custom JS code used in Image Cropper Page\r\n */\n// Image Cropper, for more examples you can check out https://fengyuanchen.github.io/cropperjs/\nclass pageCompImageCropper {\n  /*\r\n   * Init image cropper demo functionality\r\n   *\r\n   */\n  static initImageCropper() {\n    // Get Image Container\n    let image = document.getElementById('js-img-cropper'); // Set Options\n\n    Cropper.setDefaults({\n      aspectRatio: 4 / 3,\n      preview: '.js-img-cropper-preview'\n    }); // Init Image Cropper\n\n    let cropper = new Cropper(image, {\n      crop: function (e) {// e.detail contains all data required to crop the image server side\n        // You will have to send it to your custom server side script and crop the image there\n        // Since this event is fired each time you set the crop section, you could also use getData()\n        // method on demand. Please check out https://fengyuanchen.github.io/cropperjs/ for more info\n        // console.log(e.detail);\n      }\n    }); // Mini Cropper API\n\n    document.querySelectorAll('[data-toggle=\"cropper\"]').forEach(btn => {\n      btn.addEventListener('click', e => {\n        let method = btn.dataset.method || false;\n        let option = btn.dataset.option || false; // Method selection with object literals\n\n        let cropperAPI = {\n          zoom: () => {\n            cropper.zoom(option);\n          },\n          setDragMode: () => {\n            cropper.setDragMode(option);\n          },\n          rotate: () => {\n            cropper.rotate(option);\n          },\n          scaleX: () => {\n            cropper.scaleX(option);\n            btn.dataset.option = -option;\n          },\n          scaleY: () => {\n            cropper.scaleY(option);\n            btn.dataset.option = -option;\n          },\n          setAspectRatio: () => {\n            cropper.setAspectRatio(option);\n          },\n          crop: () => {\n            cropper.crop();\n          },\n          clear: () => {\n            cropper.clear();\n          }\n        }; // If method exists, execute it\n\n        if (cropperAPI[method]) {\n          cropperAPI[method]();\n        }\n      });\n    });\n  }\n  /*\r\n   * Init functionality\r\n   *\r\n   */\n\n\n  static init() {\n    this.initImageCropper();\n  }\n\n} // Initialize when page loads\n\n\nOne.onLoad(pageCompImageCropper.init());\n\n//# sourceURL=webpack://oneui/./public/assets/_js/pages/be_comp_image_cropper.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./public/assets/_js/pages/be_comp_image_cropper.js"]();
/******/ 	
/******/ })()
;