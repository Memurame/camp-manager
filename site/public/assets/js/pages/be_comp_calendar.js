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

/***/ "./public/assets/_js/pages/be_comp_calendar.js":
/*!*****************************************************!*\
  !*** ./public/assets/_js/pages/be_comp_calendar.js ***!
  \*****************************************************/
/***/ (function() {

eval("/*\r\n *  Document   : be_comp_calendar.js\r\n *  Author     : pixelcave\r\n *  Description: Custom JS code used in Calendar Page\r\n */\n// Full Calendar, for more examples you can check out http://fullcalendar.io/\nclass pageCompCalendar {\n  /*\r\n   * Add event to the events list\r\n   *\r\n   */\n  static addEvent() {\n    let eventInput = document.querySelector('.js-add-event');\n    let eventInputVal = ''; // When the add event form is submitted\n\n    document.querySelector('.js-form-add-event').addEventListener('submit', e => {\n      e.preventDefault(); // Get input value\n\n      eventInputVal = eventInput.value; // Check if the user entered something\n\n      if (eventInputVal) {\n        let eventList = document.getElementById('js-events');\n        let newEvent = document.createElement('li');\n        let newEventDiv = document.createElement('div'); // Prepare new event div\n\n        newEventDiv.classList.add('js-event');\n        newEventDiv.classList.add('p-2');\n        newEventDiv.classList.add('fs-sm');\n        newEventDiv.classList.add('fw-medium');\n        newEventDiv.classList.add('rounded');\n        newEventDiv.classList.add('bg-info-light');\n        newEventDiv.classList.add('text-info');\n        newEventDiv.textContent = eventInputVal; // Prepare new event li\n\n        newEvent.appendChild(newEventDiv); // Add it to the events list\n\n        eventList.insertBefore(newEvent, eventList.firstChild); // Clear input field\n\n        eventInput.value = '';\n      }\n    });\n  }\n  /*\r\n   * Init drag and drop event functionality\r\n   *\r\n   */\n\n\n  static initEvents() {\n    new FullCalendar.Draggable(document.getElementById('js-events'), {\n      itemSelector: '.js-event',\n      eventData: function (eventEl) {\n        return {\n          title: eventEl.textContent,\n          backgroundColor: getComputedStyle(eventEl).color,\n          borderColor: getComputedStyle(eventEl).color\n        };\n      }\n    });\n  }\n  /*\r\n   * Init calendar demo functionality\r\n   *\r\n   */\n\n\n  static initCalendar() {\n    let date = new Date();\n    let d = date.getDate();\n    let m = date.getMonth();\n    let y = date.getFullYear();\n    let calendar = new FullCalendar.Calendar(document.getElementById('js-calendar'), {\n      themeSystem: 'standard',\n      firstDay: 1,\n      editable: true,\n      droppable: true,\n      headerToolbar: {\n        left: 'title',\n        right: 'prev,next today dayGridMonth,timeGridWeek,timeGridDay,listWeek'\n      },\n      drop: function (info) {\n        info.draggedEl.parentNode.remove();\n      },\n      events: [{\n        title: 'Gaming Day',\n        start: new Date(y, m, 1),\n        allDay: true\n      }, {\n        title: 'Skype Meeting',\n        start: new Date(y, m, 3)\n      }, {\n        title: 'Project X',\n        start: new Date(y, m, 9),\n        end: new Date(y, m, 12),\n        allDay: true,\n        color: '#e04f1a'\n      }, {\n        title: 'Work',\n        start: new Date(y, m, 17),\n        end: new Date(y, m, 19),\n        allDay: true,\n        color: '#82b54b'\n      }, {\n        id: 999,\n        title: 'Hiking (repeated)',\n        start: new Date(y, m, d - 1, 15, 0)\n      }, {\n        id: 999,\n        title: 'Hiking (repeated)',\n        start: new Date(y, m, d + 3, 15, 0)\n      }, {\n        title: 'Landing Template',\n        start: new Date(y, m, d - 3),\n        end: new Date(y, m, d - 3),\n        allDay: true,\n        color: '#ffb119'\n      }, {\n        title: 'Lunch',\n        start: new Date(y, m, d + 7, 15, 0),\n        color: '#82b54b'\n      }, {\n        title: 'Coding',\n        start: new Date(y, m, d, 8, 0),\n        end: new Date(y, m, d, 14, 0)\n      }, {\n        title: 'Trip',\n        start: new Date(y, m, 25),\n        end: new Date(y, m, 27),\n        allDay: true,\n        color: '#ffb119'\n      }, {\n        title: 'Reading',\n        start: new Date(y, m, d + 8, 20, 0),\n        end: new Date(y, m, d + 8, 22, 0)\n      }, {\n        title: 'Follow us on Twitter',\n        start: new Date(y, m, 22),\n        allDay: true,\n        url: 'http://twitter.com/pixelcave',\n        color: '#3c90df'\n      }]\n    });\n    calendar.render();\n  }\n  /*\r\n   * Init functionality\r\n   *\r\n   */\n\n\n  static init() {\n    this.addEvent();\n    this.initEvents();\n    this.initCalendar();\n  }\n\n} // Initialize when page loads\n\n\nOne.onLoad(pageCompCalendar.init());\n\n//# sourceURL=webpack://oneui/./public/assets/_js/pages/be_comp_calendar.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./public/assets/_js/pages/be_comp_calendar.js"]();
/******/ 	
/******/ })()
;