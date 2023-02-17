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

/***/ "./public/assets/_js/pages/be_comp_charts.js":
/*!***************************************************!*\
  !*** ./public/assets/_js/pages/be_comp_charts.js ***!
  \***************************************************/
/***/ (function() {

eval("/*\r\n *  Document   : be_comp_charts.js\r\n *  Author     : pixelcave\r\n *  Description: Custom JS code used in Charts Page\r\n */\n// Chart.js Charts, for more examples you can check out http://www.chartjs.org/docs\nclass pageCompCharts {\n  /*\r\n   * Init Charts\r\n   *\r\n   */\n  static initChartsChartJS() {\n    // Set Global Chart.js configuration\n    Chart.defaults.color = '#818d96';\n    Chart.defaults.font.weight = '600';\n    Chart.defaults.scale.grid.color = \"rgba(0, 0, 0, .05)\";\n    Chart.defaults.scale.grid.zeroLineColor = \"rgba(0, 0, 0, .1)\";\n    Chart.defaults.scale.beginAtZero = true;\n    Chart.defaults.elements.line.borderWidth = 2;\n    Chart.defaults.elements.point.radius = 4;\n    Chart.defaults.elements.point.hoverRadius = 6;\n    Chart.defaults.plugins.tooltip.radius = 3;\n    Chart.defaults.plugins.legend.labels.boxWidth = 15; // Get Chart Containers\n\n    let chartLinesCon = document.getElementById('js-chartjs-lines');\n    let chartBarsCon = document.getElementById('js-chartjs-bars');\n    let chartRadarCon = document.getElementById('js-chartjs-radar');\n    let chartPolarCon = document.getElementById('js-chartjs-polar');\n    let chartPieCon = document.getElementById('js-chartjs-pie');\n    let chartDonutCon = document.getElementById('js-chartjs-donut'); // Set Chart and Chart Data variables\n\n    let chartLines, chartBars, chartRadar, chartPolar, chartPie, chartDonut;\n    let chartLinesBarsRadarData, chartPolarPieDonutData; // Lines/Bar/Radar Chart Data\n\n    chartLinesBarsRadarData = {\n      labels: ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'],\n      datasets: [{\n        label: 'Last Week',\n        fill: true,\n        backgroundColor: 'rgba(171, 227, 125, .5)',\n        borderColor: 'rgba(171, 227, 125, 1)',\n        pointBackgroundColor: 'rgba(171, 227, 125, 1)',\n        pointBorderColor: '#fff',\n        pointHoverBackgroundColor: '#fff',\n        pointHoverBorderColor: 'rgba(171, 227, 125, 1)',\n        data: [15, 16, 20, 25, 23, 25, 32]\n      }, {\n        label: 'This Week',\n        fill: true,\n        backgroundColor: 'rgba(0, 0, 0, .1)',\n        borderColor: 'rgba(0, 0, 0, .3)',\n        pointBackgroundColor: 'rgba(0, 0, 0, .3)',\n        pointBorderColor: '#fff',\n        pointHoverBackgroundColor: '#fff',\n        pointHoverBorderColor: 'rgba(0, 0, 0, .3)',\n        data: [30, 32, 40, 45, 43, 38, 55]\n      }]\n    }; // Polar/Pie/Donut Data\n\n    chartPolarPieDonutData = {\n      labels: ['Earnings', 'Sales', 'Tickets'],\n      datasets: [{\n        data: [48, 26, 26],\n        backgroundColor: ['rgba(171, 227, 125, 1)', 'rgba(250, 219, 125, 1)', 'rgba(117, 176, 235, 1)'],\n        hoverBackgroundColor: ['rgba(171, 227, 125, .75)', 'rgba(250, 219, 125, .75)', 'rgba(117, 176, 235, .75)']\n      }]\n    }; // Init Charts\n\n    if (chartLinesCon !== null) {\n      chartLines = new Chart(chartLinesCon, {\n        type: 'line',\n        data: chartLinesBarsRadarData,\n        options: {\n          tension: .4\n        }\n      });\n    }\n\n    if (chartBarsCon !== null) {\n      chartBars = new Chart(chartBarsCon, {\n        type: 'bar',\n        data: chartLinesBarsRadarData\n      });\n    }\n\n    if (chartRadarCon !== null) {\n      chartRadar = new Chart(chartRadarCon, {\n        type: 'radar',\n        data: chartLinesBarsRadarData\n      });\n    }\n\n    if (chartPolarCon !== null) {\n      chartPolar = new Chart(chartPolarCon, {\n        type: 'polarArea',\n        data: chartPolarPieDonutData\n      });\n    }\n\n    if (chartPieCon !== null) {\n      chartPie = new Chart(chartPieCon, {\n        type: 'pie',\n        data: chartPolarPieDonutData\n      });\n    }\n\n    if (chartDonutCon !== null) {\n      chartDonut = new Chart(chartDonutCon, {\n        type: 'doughnut',\n        data: chartPolarPieDonutData\n      });\n    }\n  }\n  /*\r\n  * Randomize Easy Pie Chart values\r\n  *\r\n  */\n\n\n  static initRandomEasyPieChart() {\n    document.querySelectorAll('.js-pie-randomize').forEach(btn => {\n      btn.addEventListener('click', e => {\n        btn.closest('.block').querySelectorAll('.pie-chart').forEach(chart => {\n          jQuery(chart).data('easyPieChart').update(Math.floor(Math.random() * 100 + 1));\n        });\n      });\n    });\n  }\n  /*\r\n  * Init functionality\r\n  *\r\n  */\n\n\n  static init() {\n    this.initChartsChartJS();\n    this.initRandomEasyPieChart();\n  }\n\n} // Initialize when page loads\n\n\nOne.onLoad(pageCompCharts.init());\n\n//# sourceURL=webpack://oneui/./public/assets/_js/pages/be_comp_charts.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./public/assets/_js/pages/be_comp_charts.js"]();
/******/ 	
/******/ })()
;