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

/***/ "./public/assets/_js/pages/be_pages_ecom_dashboard.js":
/*!************************************************************!*\
  !*** ./public/assets/_js/pages/be_pages_ecom_dashboard.js ***!
  \************************************************************/
/***/ (function() {

eval("/*\r\n *  Document   : be_pages_ecom_dashboard.js\r\n *  Author     : pixelcave\r\n *  Description: Custom JS code used in eCommerce Dashboard Page\r\n */\n// Chart.js Charts, for more examples you can check out http://www.chartjs.org/docs\nclass pageEcomDashboard {\n  /*\r\n   * Init Charts\r\n   *\r\n   */\n  static initOverviewChart() {\n    // Set Global Chart.js configuration\n    Chart.defaults.color = '#818d96';\n    Chart.defaults.scale.grid.lineWidth = 0;\n    Chart.defaults.scale.beginAtZero = true;\n    Chart.defaults.elements.point.radius = 0;\n    Chart.defaults.elements.point.hoverRadius = 0;\n    Chart.defaults.plugins.tooltip.radius = 3;\n    Chart.defaults.plugins.legend.labels.boxWidth = 12; // Get Chart Container\n\n    let chartOverviewCon = document.getElementById('js-chartjs-overview'); // Set Chart Variables\n\n    let chartOverview, chartOverviewOptions, chartOverviewData; // Overview Chart Options\n\n    chartOverviewOptions = {\n      maintainAspectRatio: false,\n      tension: .4,\n      scales: {\n        x: {\n          grid: {\n            drawBorder: false\n          }\n        },\n        y: {\n          grid: {\n            drawBorder: false\n          },\n          suggestedMin: 0,\n          suggestedMax: 500\n        }\n      },\n      interaction: {\n        intersect: false\n      },\n      plugins: {\n        tooltip: {\n          callbacks: {\n            label: function (context) {\n              return ' $' + context.parsed.y;\n            }\n          }\n        }\n      }\n    }; // Overview Chart Data\n\n    chartOverviewData = {\n      labels: ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'],\n      datasets: [{\n        label: 'This Week',\n        fill: true,\n        backgroundColor: 'rgba(132, 94, 247, .3)',\n        borderColor: 'transparent',\n        pointBackgroundColor: 'rgba(132, 94, 247, 1)',\n        pointBorderColor: '#fff',\n        pointHoverBackgroundColor: '#fff',\n        pointHoverBorderColor: 'rgba(132, 94, 247, 1)',\n        data: [390, 290, 410, 290, 450, 180, 360]\n      }, {\n        label: 'Last Week',\n        fill: true,\n        backgroundColor: 'rgba(0, 0, 0, .15)',\n        borderColor: 'transparent',\n        pointBackgroundColor: 'rgba(0, 0, 0, .3)',\n        pointBorderColor: '#fff',\n        pointHoverBackgroundColor: '#fff',\n        pointHoverBorderColor: 'rgba(0, 0, 0, .3)',\n        data: [180, 360, 236, 320, 210, 295, 260]\n      }]\n    }; // Init Overview Chart\n\n    if (chartOverviewCon !== null) {\n      chartOverview = new Chart(chartOverviewCon, {\n        type: 'line',\n        data: chartOverviewData,\n        options: chartOverviewOptions\n      });\n    }\n  }\n  /*\r\n   * Init functionality\r\n   *\r\n   */\n\n\n  static init() {\n    this.initOverviewChart();\n  }\n\n} // Initialize when page loads\n\n\nOne.onLoad(pageEcomDashboard.init());\n\n//# sourceURL=webpack://oneui/./public/assets/_js/pages/be_pages_ecom_dashboard.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./public/assets/_js/pages/be_pages_ecom_dashboard.js"]();
/******/ 	
/******/ })()
;