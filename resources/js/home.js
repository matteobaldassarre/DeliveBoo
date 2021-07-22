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

        // Order Total Price
        totalPrice: 0,
    },

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
        },

        removeQuantity(product) {
            if (product.quantity > 0) {
                product.quantity--;
                this.totalPrice -= product.price;
            }

            if (this.totalPrice == 0) {
                this.shoppingCart = [];
                product.quantity = 1;
            }
        },

        addQuantity(product) {
            if (product.quantity == 0 || product.quantity > 0) {
                product.quantity++;
                this.totalPrice += product.price;
            }
        },
    },

    mounted() {
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