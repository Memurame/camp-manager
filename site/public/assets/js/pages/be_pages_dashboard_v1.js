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

/***/ "./public/assets/_js/pages/be_pages_dashboard_v1.js":
/*!**********************************************************!*\
  !*** ./public/assets/_js/pages/be_pages_dashboard_v1.js ***!
  \**********************************************************/
/***/ (function() {

eval("/*\r\n *  Document   : be_pages_dashboard_v1.js\r\n *  Author     : pixelcave\r\n *  Description: Custom JS code used in Dashboard v1 Page\r\n */\n// Chart.js Charts, for more examples you can check out http://www.chartjs.org/docs\nclass pageDashboardv1 {\n  /*\r\n   * Init Charts\r\n   *\r\n   */\n  static initCharts() {\n    // Set Global Chart.js configuration\n    Chart.defaults.color = '#818d96';\n    Chart.defaults.scale.display = false;\n    Chart.defaults.scale.beginAtZero = true;\n    Chart.defaults.elements.point.radius = 0;\n    Chart.defaults.elements.point.hoverRadius = 0;\n    Chart.defaults.plugins.tooltip.radius = 3;\n    Chart.defaults.plugins.legend.labels.boxWidth = 12; // Get Chart Containers\n\n    let chartEarningsCon = document.getElementById('js-chartjs-dashboard-earnings');\n    let chartSalesCon = document.getElementById('js-chartjs-dashboard-sales'); // Set Chart Variables\n\n    let chartEarnings, chartEarningsOptions, chartEarningsData, chartSales, chartSalesOptions, chartSalesData; // Earnigns Chart Options\n\n    chartEarningsOptions = {\n      maintainAspectRatio: false,\n      tension: .4,\n      scales: {\n        y: {\n          suggestedMin: 0,\n          suggestedMax: 3000\n        }\n      },\n      interaction: {\n        intersect: false\n      },\n      plugins: {\n        tooltip: {\n          callbacks: {\n            label: function (context) {\n              return ' $' + context.parsed.y;\n            }\n          }\n        }\n      }\n    }; // Earnigns Chart Options\n\n    chartSalesOptions = {\n      maintainAspectRatio: false,\n      tension: .4,\n      scales: {\n        y: {\n          suggestedMin: 0,\n          suggestedMax: 260\n        }\n      },\n      interaction: {\n        intersect: false\n      },\n      plugins: {\n        tooltip: {\n          callbacks: {\n            label: function (context) {\n              return context.parsed.y + ' Sales';\n            }\n          }\n        }\n      }\n    }; // Earnings Chart Data\n\n    chartEarningsData = {\n      labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],\n      datasets: [{\n        label: 'This Year',\n        fill: true,\n        backgroundColor: 'rgba(132, 94, 247, .3)',\n        borderColor: 'transparent',\n        pointBackgroundColor: 'rgba(132, 94, 247, 1)',\n        pointBorderColor: '#fff',\n        pointHoverBackgroundColor: '#fff',\n        pointHoverBorderColor: 'rgba(132, 94, 247, 1)',\n        data: [2150, 1350, 1560, 980, 1260, 1720, 1115, 1690, 1870, 2420, 2100, 2730]\n      }, {\n        label: 'Last Year',\n        fill: true,\n        backgroundColor: 'rgba(33, 37, 41, .15)',\n        borderColor: 'transparent',\n        pointBackgroundColor: 'rgba(33, 37, 41, .3)',\n        pointBorderColor: '#fff',\n        pointHoverBackgroundColor: '#fff',\n        pointHoverBorderColor: 'rgba(33, 37, 41, .3)',\n        data: [2200, 1700, 1100, 1900, 1680, 2560, 1340, 1450, 2000, 2500, 1550, 1880]\n      }]\n    }; // Sales Chart Data\n\n    chartSalesData = {\n      labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],\n      datasets: [{\n        label: 'This Year',\n        fill: true,\n        backgroundColor: 'rgba(34, 184, 207, .3)',\n        borderColor: 'transparent',\n        pointBackgroundColor: 'rgba(34, 184, 207, 1)',\n        pointBorderColor: '#fff',\n        pointHoverBackgroundColor: '#fff',\n        pointHoverBorderColor: 'rgba(34, 184, 207, 1)',\n        data: [175, 120, 169, 82, 135, 169, 132, 130, 192, 230, 215, 260]\n      }, {\n        label: 'Last Year',\n        fill: true,\n        backgroundColor: 'rgba(33, 37, 41, .15)',\n        borderColor: 'transparent',\n        pointBackgroundColor: 'rgba(33, 37, 41, .3)',\n        pointBorderColor: '#fff',\n        pointHoverBackgroundColor: '#fff',\n        pointHoverBorderColor: 'rgba(33, 37, 41, .3)',\n        data: [220, 170, 110, 215, 168, 227, 154, 135, 210, 240, 145, 178]\n      }]\n    }; // Init Earnings Chart\n\n    if (chartEarningsCon !== null) {\n      chartEarnings = new Chart(chartEarningsCon, {\n        type: 'line',\n        data: chartEarningsData,\n        options: chartEarningsOptions\n      });\n    } // Init Sales Chart\n\n\n    if (chartSalesCon !== null) {\n      chartSales = new Chart(chartSalesCon, {\n        type: 'line',\n        data: chartSalesData,\n        options: chartSalesOptions\n      });\n    }\n  }\n  /*\r\n   * Init functionality\r\n   *\r\n   */\n\n\n  static init() {\n    this.initCharts();\n  }\n\n} // Initialize when page loads\n\n\nOne.onLoad(pageDashboardv1.init());\n\n//# sourceURL=webpack://oneui/./public/assets/_js/pages/be_pages_dashboard_v1.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./public/assets/_js/pages/be_pages_dashboard_v1.js"]();
/******/ 	
/******/ })()
;