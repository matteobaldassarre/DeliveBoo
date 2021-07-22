/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/home-gsap.js":
/*!***********************************!*\
  !*** ./resources/js/home-gsap.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// const tl = new TimelineLite();
// // const drawer = document.getElementById("drawer");
// // const main = document.getElementById("main");
// // const drawerVeil = document.getElementById("drawer-veil");
// // const header = document.getElementById("header");
// // const toggle = document.getElementById("toggle");
// // const closeDrawerBtn = document.getElementById("close-drawer-btn");
// // // if the drawer is open or not
// // let openDrawer = false;
// // tl
// //   .from(drawer, 0.25, { x: 0, ease: Power1.easeOut })
// //   .from(header, 0.25, { marginRight: 240, ease: Power1.easeOut, force3D: true }, 0)
// //   .from(main, 0.25, { marginRight: 240, ease: Power1.easeOut, force3D: true }, 0)
// //   .from(drawerVeil, 0.15, { autoAlpha: 0.5 }, 0)
// //   .from(main, 0.15, { autoAlpha: 0.5 }, 0)
// //   .reverse();
// // toggle.onclick = () => {
// //   openDrawer = tl.reversed();
// //   tl.reversed( !tl.reversed() );
// //   toggle.style.display = "none";
// // };
// // const reverseDrawerTween = () => {
// //   tl.reverse();
// //   openDrawer = tl.reversed();
// //   toggle.style.removeProperty('display');
// // };
// // drawerVeil.onclick = reverseDrawerTween;
// // closeDrawerBtn.onclick = reverseDrawerTween;
// const drawer = document.getElementById("drawer");
// const main = document.getElementById("main");
// const drawerVeil = document.getElementById("drawer-veil");
// const header = document.getElementById("header");
// const toggle = document.getElementById("toggle");
// const closeDrawerBtn = document.getElementById("close-drawer-btn");
// // if the drawer is open or not
// let openDrawer = false;
// tl
//   .to(drawer, 0.25, { x: 0, ease: Power1.easeOut })
//   .to(header, 0.25, { marginRight: 240, ease: Power1.easeOut, force3D: true }, 0)
//   // .to(main, 0.25, { marginLeft: 240, ease: Power1.easeOut, force3D: true }, 0)
//   .to(drawerVeil, 0.15, { autoAlpha: 0.5 }, 0)
//   .reverse();
// toggle.onclick = () => {
//   openDrawer = tl.reversed();
//   tl.reversed( !tl.reversed() );
//   toggle.style.display = "none";
// };
// const reverseDrawerTween = () => {
//   tl.reverse();
//   openDrawer = tl.reversed();
//   toggle.style.removeProperty('display');
// };
// drawerVeil.onclick = reverseDrawerTween;
// closeDrawerBtn.onclick = reverseDrawerTween;
var tl = new TimelineLite({
  paused: true
});
var drawer = document.getElementById("drawer");
var main = document.getElementById("main");
var drawerVeil = document.getElementById("drawer-veil");
var header = document.getElementById("header");
var toggle = document.getElementById("toggle");
var closeDrawerBtn = document.getElementById("close-drawer-btn"); // if the drawer is open or not

var openDrawer = false;
tl.from(drawer, 0.25, {
  x: 0,
  ease: Power1.easeOut
}).from(header, 0.25, {
  marginLeft: 240,
  ease: Power1.easeOut,
  force3D: true
}, 0).to(main, 0.25, {
  marginLeft: 240,
  ease: Power1.easeOut,
  force3D: true
}, 0).to(drawerVeil, 0.15, {
  autoAlpha: 0.5
}, 0).reverse();

toggle.onclick = function () {
  openDrawer = tl.reversed();
  tl.reversed(!tl.reversed());
  toggle.style.display = "none";
};

var reverseDrawerTween = function reverseDrawerTween() {
  tl.reverse();
  openDrawer = tl.reversed();
  toggle.style.removeProperty('display');
};

drawerVeil.onclick = reverseDrawerTween;
closeDrawerBtn.onclick = reverseDrawerTween;

/***/ }),

/***/ 2:
/*!*****************************************!*\
  !*** multi ./resources/js/home-gsap.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/giovanni/Desktop/DeliveBoo/resources/js/home-gsap.js */"./resources/js/home-gsap.js");


/***/ })

/******/ });