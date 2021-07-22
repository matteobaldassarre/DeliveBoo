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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/home.js":
/*!******************************!*\
  !*** ./resources/js/home.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

var app = new Vue({
  el: '#root',
  data: {
    // Array storing all restaurants
    restaurants: [],
    // The restaurants displayed at the beginning on the HomePage
    defaultRestaurants: [],
    // Array storing all restaurant types to print the buttons in page
    restaurantsTypes: [],
    // Array storing all restaurants by their types
    filteredRestaurantsByType: [],
    // The input of the searched restaurant
    searchedRestaurant: '',
    // Array storing all plates from the selected restaurant
    currentRestaurantPlates: [],
    // Array storing the selected restaurant info
    currentRestaurantInfo: [],
    // Array storing the plates types for the menu page
    platesTypes: ['Antipasti', 'Primi', 'Secondi', 'Contorni', 'Dolci'],
    // Checks if the restaurant has been selected from the user or not
    restaurantChosen: false,
    // Cart Object
    shoppingCart: [],
    // Order Total Price
    totalPrice: 0,
    sidebareVisible: false
  },
  methods: {
    // Searching restaurant by its name
    searchRestaurantByName: function searchRestaurantByName(searchedRestaurant) {
      var _this = this;

      this.filteredRestaurantsByType = [];
      this.restaurants.forEach(function (element) {
        if (element.restaurant_name.toLowerCase().includes(searchedRestaurant.toLowerCase())) {
          _this.filteredRestaurantsByType.push(element);
        }
      });
    },
    // Searching restaurant by type using Laravel Api
    searchRestaurantByType: function searchRestaurantByType(type) {
      var _this2 = this;

      axios.get('/api/restaurants/' + type).then(function (result) {
        _this2.filteredRestaurantsByType = result.data.restaurants;
      });
    },
    getRestaurantInfo: function getRestaurantInfo(restaurantId) {
      var _this3 = this;

      // Getting the restaurant info filtered by its id
      this.currentRestaurantInfo = [];
      this.restaurants.forEach(function (element) {
        if (element.user_id == restaurantId) {
          _this3.currentRestaurantInfo.push(element);
        }
      }); // Getting the restaurants plates filtered by the API Controller

      axios.get('/api/restaurants/' + restaurantId + '/plates').then(function (result) {
        _this3.currentRestaurantPlates = result.data.plates;
      });
      this.restaurantChosen = true;
    },
    addPlateToCart: function addPlateToCart(plate) {
      // Se il piatto appartiene a quel ristorante oppure se il carrello è vuoto
      if (plate.user_id == this.currentRestaurantInfo[0].user_id || this.shoppingCart == 0) {
        if (!this.shoppingCart.includes(plate)) {
          this.shoppingCart.push(plate);
          plate.quantity = 1;
          this.totalPrice += plate.price;
        } else {
          plate.quantity++;
          this.totalPrice += plate.price;
        }
      } else {
        alert('Puoi ordinare da un solo ristorante alla volta!');
      }
    },
    removeQuantity: function removeQuantity(product) {
      if (product.quantity > 0) {
        product.quantity--;
        this.totalPrice -= product.price;
      }

      if (this.totalPrice == 0) {
        this.shoppingCart = [];
        product.quantity = 1;
      }
    },
    addQuantity: function addQuantity(product) {
      if (product.quantity == 0 || product.quantity > 0) {
        product.quantity++;
        this.totalPrice += product.price;
      }
    },
    sidebareVisibility: function sidebareVisibility() {
      this.sidebareVisible = !this.sidebareVisible;
    },
    closeSidebare: function closeSidebare(totalPrice) {
      if (totalPrice == 0) {
        this.sidebareVisible = false;
      }
    }
  },
  mounted: function mounted() {
    var _this4 = this;

    // Getting all restaurants from the restaurants API
    axios.get('/api/restaurants').then(function (result) {
      _this4.restaurants = result.data.restaurants;
      _this4.defaultRestaurants = result.data.restaurants;
    }); // Populating Restaurant Types Array

    axios.get('/api/restaurants/types').then(function (result) {
      _this4.restaurantsTypes = result.data.restaurants_types;
    });
  }
});

/***/ }),

/***/ 1:
/*!************************************!*\
  !*** multi ./resources/js/home.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/giovanni/Desktop/DeliveBoo/resources/js/home.js */"./resources/js/home.js");


/***/ })

/******/ });