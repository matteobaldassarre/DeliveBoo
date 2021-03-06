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
    // The current restaurant id that locks the cart from adding products from other restaurants
    currentRestaurantId: 0,
    // Array storing the plates types for the menu page
    platesTypes: ['Antipasti', 'Primi', 'Secondi', 'Contorni', 'Dolci'],
    // Checks if the restaurant has been selected from the user or not
    restaurantChosen: false,
    // Cart Object
    shoppingCart: [],
    // Cart products total quantity
    cartTotalQuantity: 0,
    // Order Total Price
    totalPrice: 0,
    // Controls if the sidebar is opened or not
    sideBarVisible: false,
    // Controls if the burger menu is visible or not
    burgerVisible: false
  },
  // REGULAR METHODS
  methods: {
    // Function that searches the restaurant by its name looping through all restaurants
    // SearchedRestaurant -> The restaurant name wrote in the input by the User
    searchRestaurantByName: function searchRestaurantByName(searchedRestaurant) {
      var _this = this;

      this.filteredRestaurantsByType = [];
      this.restaurants.forEach(function (element) {
        if (element.restaurant_name.toLowerCase().includes(searchedRestaurant.toLowerCase())) {
          _this.filteredRestaurantsByType.push(element);
        }
      });
    },
    // Function that searches the restaurant by its type through an AJAX request to the Laravel API
    // Type -> The type name clicked by the User
    searchRestaurantByType: function searchRestaurantByType(type) {
      var _this2 = this;

      axios.get('/api/restaurants/' + type).then(function (result) {
        _this2.filteredRestaurantsByType = result.data.restaurants;
      });
    },
    // Function that gets the info of the current restaurant
    // restaurantId -> The id of the current restaurant visited by the User
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
      }); // Setting the restaurant as the current restaurant chosen by the User

      this.restaurantChosen = true; // Scrolling page to the top after a menu is selected

      window.scrollTo(0, 0);
    },
    // Function that lets you add plates to your shoppingCart
    // Plate -> The current plate that the User wants to add to his shoppingCart
    addPlateToCart: function addPlateToCart(plate) {
      var _this4 = this;

      // Blocking the cart if a product is added to the cart from a specific restaurant till it's empty
      if (this.shoppingCart.length == 0) {
        this.currentRestaurantId = this.currentRestaurantInfo[0].user_id;
        var serializedCurrentRestaurantId = JSON.stringify(this.currentRestaurantId);
        localStorage.setItem('currentRestaurantId', serializedCurrentRestaurantId);
      } // If the plate is in the urrent restaurant menu or the shoppingCart is empty, the plate will be added to the cart


      if (plate.user_id == this.currentRestaurantId || this.shoppingCart.length == 0) {
        if (!this.shoppingCart.includes(plate)) {
          this.shoppingCart.push(plate);
          plate.quantity = 1;
          this.totalPrice += plate.price;
        } else {
          plate.quantity++;
          this.totalPrice += plate.price;
        }

        this.saveShoppingCart(this.shoppingCart, this.totalPrice);
      } else {
        // If it doesn't an alert message will be thrown and the plate won't be added
        Swal.fire({
          title: 'Attenzione!',
          text: 'Stai provando ad ordinare da pi?? ristoranti nello stesso momento! Svuota il tuo carrello oppure procedi all\'ordine per continuare.',
          icon: 'error',
          confirmButtonText: 'Okay',
          confirmButtonColor: '#2A5353'
        }).then(function () {
          _this4.sideBarVisible = false;
        });
      }
    },
    // Function that lets you decrease the quantity of a product in the shoppingCart
    // product -> The current product element
    // index -> The index of the current product
    removeQuantity: function removeQuantity(product, index) {
      if (product.quantity > 0) {
        product.quantity--;
        this.totalPrice -= product.price;
        this.saveShoppingCart(this.shoppingCart, this.totalPrice);

        if (product.quantity == 0) {
          this.shoppingCart.splice(index, 1);
          this.saveShoppingCart(this.shoppingCart, this.totalPrice);
        } else if (product.quantity == 0 && this.totalPrice == 0) {
          localStorage.clear();
        }
      } else if (this.totalPrice == 0) {
        localStorage.clear();
        this.shoppingCart = [];
        product.quantity = 1;
      }
    },
    // Function that lets you increase the quantity of a product in the shoppingCart
    // product -> The current product element
    // index -> The index of the current product
    addQuantity: function addQuantity(product) {
      if (product.quantity == 0 || product.quantity > 0) {
        product.quantity++;
        this.totalPrice += product.price;
        this.saveShoppingCart(this.shoppingCart, this.totalPrice);
      }
    },
    // Function that saves shoppingCart in localStorage
    // shoppingCart -> array of object where all the shoppingCart data are stored
    // totalPrice -> the total amount of the current order
    saveShoppingCart: function saveShoppingCart(shoppingCart, totalPrice) {
      // Serializing shopping cart content
      var serializedShoppingCart = JSON.stringify(shoppingCart); // Serializing totalPrice

      var serializedTotalPrice = JSON.stringify(totalPrice); // Saving shoppingCart content and totalPrice in two localStorage items

      localStorage.setItem('shoppingCart', serializedShoppingCart);
      localStorage.setItem('totalPrice', serializedTotalPrice);
    },
    // Function that empties the shoppingCart & clears localStorage
    emptyCart: function emptyCart() {
      this.restaurantId = 0;
      this.totalPrice = 0;
      this.shoppingCart = [];
      localStorage.clear();
    },
    // SideBar Functions
    // Open & Close the sideBar based on its visibility status
    sideBarVisibility: function sideBarVisibility() {
      this.sideBarVisible = !this.sideBarVisible;
    },
    // Closes the sidebar if the totalPrice of the order reaches 0???
    closeSideBar: function closeSideBar(totalPrice) {
      if (totalPrice == 0) {
        this.sideBarVisible = false;
      }
    },
    // Manage the burger menu visibility
    burgerVisibility: function burgerVisibility() {
      this.burgerVisible = !this.burgerVisible;
    }
  },
  // MOUNTED FUNCTIONS
  mounted: function mounted() {
    var _this5 = this;

    var deserializedShoppingCart = JSON.parse(localStorage.getItem('shoppingCart'));
    var deserializedTotalPrice = JSON.parse(localStorage.getItem('totalPrice'));
    var deserializedCurrentRestaurantId = JSON.parse(localStorage.getItem('currentRestaurantId'));

    if (deserializedShoppingCart) {
      deserializedShoppingCart.forEach(function (element) {
        _this5.shoppingCart.push(element);
      });
      this.totalPrice = deserializedTotalPrice;
      this.currentRestaurantId = deserializedCurrentRestaurantId;
    } // Getting all restaurants from the restaurants API


    axios.get('/api/restaurants').then(function (result) {
      _this5.restaurants = result.data.restaurants;
      _this5.defaultRestaurants = result.data.restaurants;
    }); // Populating Restaurant Types Array

    axios.get('/api/restaurants/types').then(function (result) {
      _this5.restaurantsTypes = result.data.restaurants_types;
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

module.exports = __webpack_require__(/*! /Users/matteobaldassarre/Desktop/Boolean/Progetto Finale/DeliveBoo/resources/js/home.js */"./resources/js/home.js");


/***/ })

/******/ });