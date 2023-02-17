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

/***/ "./public/assets/_js/pages/be_comp_maps_vector.js":
/*!********************************************************!*\
  !*** ./public/assets/_js/pages/be_comp_maps_vector.js ***!
  \********************************************************/
/***/ (function() {

eval("/*\r\n *  Document   : be_comp_maps_vector.js\r\n *  Author     : pixelcave\r\n *  Description: Custom JS code used in Vector Maps Page\r\n */\n// Set default options for all maps\nlet mapOptions = {\n  map: '',\n  backgroundColor: '#ffffff',\n  regionStyle: {\n    initial: {\n      fill: '#5490d2',\n      'fill-opacity': 1,\n      stroke: 'none',\n      'stroke-width': 0,\n      'stroke-opacity': 1\n    },\n    hover: {\n      'fill-opacity': .8,\n      cursor: 'pointer'\n    }\n  }\n}; // jVectorMap, for more examples you can check out http://jvectormap.com/documentation/\n\nclass pageCompMapsVector {\n  /*\r\n   * Init World Map\r\n   *\r\n   */\n  static initMapWorld() {\n    // Set Active Map\n    mapOptions['map'] = 'world_mill_en'; // Init Map\n\n    jQuery('.js-vector-map-world').vectorMap(mapOptions);\n  }\n  /*\r\n   * Init Europe Map\r\n   *\r\n   */\n\n\n  static initMapEurope() {\n    // Set Active Map\n    mapOptions['map'] = 'europe_mill_en'; // Init Map\n\n    jQuery('.js-vector-map-europe').vectorMap(mapOptions);\n  }\n  /*\r\n   * Init USA Map\r\n   *\r\n   */\n\n\n  static initMapUsa() {\n    // Set Active Map\n    mapOptions['map'] = 'us_aea_en'; // Init Map\n\n    jQuery('.js-vector-map-usa').vectorMap(mapOptions);\n  }\n  /*\r\n   * Init India Map\r\n   *\r\n   */\n\n\n  static initMapIndia() {\n    // Set Active Map\n    mapOptions['map'] = 'in_mill_en'; // Init Map\n\n    jQuery('.js-vector-map-india').vectorMap(mapOptions);\n  }\n  /*\r\n   * Init China Map\r\n   *\r\n   */\n\n\n  static initMapChina() {\n    // Set Active Map\n    mapOptions['map'] = 'cn_mill_en'; // Init Map\n\n    jQuery('.js-vector-map-china').vectorMap(mapOptions);\n  }\n  /*\r\n   * Init Australia Map\r\n   *\r\n   */\n\n\n  static initMapAustralia() {\n    // Set Active Map\n    mapOptions['map'] = 'au_mill_en'; // Init Map\n\n    jQuery('.js-vector-map-australia').vectorMap(mapOptions);\n  }\n  /*\r\n   * Init South Africa Map\r\n   *\r\n   */\n\n\n  static initMapSouthAfrica() {\n    // Set Active Map\n    mapOptions['map'] = 'za_mill_en'; // Init Map\n\n    jQuery('.js-vector-map-south-africa').vectorMap(mapOptions);\n  }\n  /*\r\n   * Init France Map\r\n   *\r\n   */\n\n\n  static initMapFrance() {\n    // Set Active Map\n    mapOptions['map'] = 'fr_mill_en'; // Init Map\n\n    jQuery('.js-vector-map-france').vectorMap(mapOptions);\n  }\n  /*\r\n   * Init Germany Map\r\n   *\r\n   */\n\n\n  static initMapGermany() {\n    // Set Active Map\n    mapOptions['map'] = 'de_mill_en'; // Init Map\n\n    jQuery('.js-vector-map-germany').vectorMap(mapOptions);\n  }\n  /*\r\n   * Init functionality\r\n   *\r\n   */\n\n\n  static init() {\n    this.initMapWorld();\n    this.initMapEurope();\n    this.initMapUsa();\n    this.initMapIndia();\n    this.initMapChina();\n    this.initMapAustralia();\n    this.initMapSouthAfrica();\n    this.initMapFrance();\n    this.initMapGermany();\n  }\n\n} // Initialize when page loads\n\n\nOne.onLoad(pageCompMapsVector.init());\n\n//# sourceURL=webpack://oneui/./public/assets/_js/pages/be_comp_maps_vector.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./public/assets/_js/pages/be_comp_maps_vector.js"]();
/******/ 	
/******/ })()
;