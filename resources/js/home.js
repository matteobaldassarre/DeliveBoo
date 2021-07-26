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
        platesTypes: [
            'Antipasti',
            'Primi',
            'Secondi',
            'Contorni',
            'Dolci'
        ],

        // Checks if the restaurant has been selected from the user or not
        restaurantChosen: false,

        // Cart Object
        shoppingCart: [],

        // Cart products total quantity
        cartTotalQuantity: 0,

        // Order Total Price
        totalPrice: 0,

        sidebareVisible: false,

        burgerVisible: false

    },

    // REGULAR METHODS
    methods: {
        // Searching restaurant by its name
        searchRestaurantByName(searchedRestaurant) {
            this.filteredRestaurantsByType = [];
            this.restaurants.forEach(element => {
                if (element.restaurant_name.toLowerCase().includes(searchedRestaurant.toLowerCase())) {
                    this.filteredRestaurantsByType.push(element);
                }
            });
        },

        // Searching restaurant by type using Laravel Api
        searchRestaurantByType(type) {
            axios.get( '/api/restaurants/' + type ).then(result => {
                this.filteredRestaurantsByType = result.data.restaurants;
            });
        },

        getRestaurantInfo(restaurantId) {
            // Getting the restaurant info filtered by its id
            this.currentRestaurantInfo = [];
            this.restaurants.forEach(element => {
                if (element.user_id == restaurantId) {
                    this.currentRestaurantInfo.push(element);
                }
            });

            // Getting the restaurants plates filtered by the API Controller
            axios.get('/api/restaurants/' + restaurantId + '/plates').then(result => {
                this.currentRestaurantPlates = result.data.plates;
            });
            
            this.restaurantChosen = true;

            // Scrolling page to the top after a menu is selected
            window.scrollTo(0, 0);
        },

        addPlateToCart(plate) {
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

            this.saveShoppingCart(this.shoppingCart, this.totalPrice);
        },

        removeQuantity(product) {
            if (product.quantity > 0) {
                product.quantity--;
                this.totalPrice -= product.price;
                this.saveShoppingCart(this.shoppingCart, this.totalPrice);
            } else if (this.totalPrice == 0) {
                this.shoppingCart = [];
                product.quantity = 1;
                this.saveShoppingCart(this.shoppingCart, this.totalPrice);
            }
        },

        addQuantity(product) {
            if (product.quantity == 0 || product.quantity > 0) {
                product.quantity++;
                this.totalPrice += product.price;
                this.saveShoppingCart(this.shoppingCart, this.totalPrice);
            }
        },


        // SideBar Functions
        sidebareVisibility() {
            this.sidebareVisible = !this.sidebareVisible;
        },

        burgerVisibility() {
            this.burgerVisible = !this.burgerVisible;

        },

        closeSidebare(totalPrice) {
            if (totalPrice == 0) {
                this.sidebareVisible = false;
            }
        },

        // Saves shoppingCart in localStorage
        saveShoppingCart(shoppingCart, totalPrice) {
            // Serializing shopping cart content
            let serializedShoppingCart = JSON.stringify(shoppingCart);
            // Serializing totalPrice
            let serializedTotalPrice = JSON.stringify(totalPrice);

            // Saving shoppingCart content and totalPrice in two localStorage items
            localStorage.setItem('shoppingCart', serializedShoppingCart);
            localStorage.setItem('totalPrice', serializedTotalPrice);
        },

        // Empties the shoppingCart & clears localStorage
        emptyCart() {
            this.totalPrice = 0;
            this.shoppingCart = [];
            localStorage.clear();
        },
    }, 

    // MOUNTED FUNCTIONS
    mounted() {
        let deserializedShoppingCart = JSON.parse(localStorage.getItem('shoppingCart'));
        let deserializedTotalPrice = JSON.parse(localStorage.getItem('totalPrice'));

        if (deserializedShoppingCart) {
            deserializedShoppingCart.forEach(element => {
                this.shoppingCart.push(element);
            });
            this.totalPrice = deserializedTotalPrice;
        }
           
        
        // Getting all restaurants from the restaurants API
        axios.get('/api/restaurants').then(result => {
            this.restaurants = result.data.restaurants;
            this.defaultRestaurants = result.data.restaurants;
        });

        // Populating Restaurant Types Array
        axios.get('/api/restaurants/types').then(result => {
            this.restaurantsTypes = result.data.restaurants_types;
        });
    }
});