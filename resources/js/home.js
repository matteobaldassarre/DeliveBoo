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

        // Controls if the sidebar is opened or not
        sideBarVisible: false,

        // Controls if the burger menu is visible or not
        burgerVisible: false
    },

    // REGULAR METHODS
    methods: {
        // Function that searches the restaurant by its name looping through all restaurants
        // SearchedRestaurant -> The restaurant name wrote in the input by the User
        searchRestaurantByName(searchedRestaurant) {
            this.filteredRestaurantsByType = [];
            this.restaurants.forEach(element => {
                if (element.restaurant_name.toLowerCase().includes(searchedRestaurant.toLowerCase())) {
                    this.filteredRestaurantsByType.push(element);
                }
            });
        },


        // Function that searches the restaurant by its type through an AJAX request to the Laravel API
        // Type -> The type name clicked by the User
        searchRestaurantByType(type) {
            axios.get( '/api/restaurants/' + type ).then(result => {
                this.filteredRestaurantsByType = result.data.restaurants;
            });
        },


        // Function that gets the info of the current restaurant
        // restaurantId -> The id of the current restaurant visited by the User
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
            
            // Setting the restaurant as the current restaurant chosen by the User
            this.restaurantChosen = true;

            // Scrolling page to the top after a menu is selected
            window.scrollTo(0, 0);
        },


        // Function that lets you add plates to your shoppingCart
        // Plate -> The current plate that the User wants to add to his shoppingCart
        addPlateToCart(plate) {
            // Blocking the cart if a product is added to the cart from a specific restaurant till it's empty
            if (this.shoppingCart.length == 0) {
                this.currentRestaurantId = this.currentRestaurantInfo[0].user_id;

                let serializedCurrentRestaurantId = JSON.stringify(this.currentRestaurantId);
                localStorage.setItem('currentRestaurantId', serializedCurrentRestaurantId);
            }
            
            // If the plate is in the urrent restaurant menu or the shoppingCart is empty, the plate will be added to the cart
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
            } else { // If it doesn't an alert message will be thrown and the plate won't be added
                Swal.fire({
                    title: 'Attenzione!',
                    text: 'Stai provando ad ordinare da più ristoranti nello stesso momento! Svuota il tuo carrello oppure procedi all\'ordine per continuare.',
                    icon: 'error',
                    confirmButtonText: 'Okay',
                    confirmButtonColor: '#2A5353'
                }).then(() => {
                    this.sideBarVisible = false;
                })
            }
        },


        // Function that lets you decrease the quantity of a product in the shoppingCart
        // product -> The current product element
        // index -> The index of the current product
        removeQuantity(product, index) {
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

            }  else if (this.totalPrice == 0) {
                localStorage.clear();
                this.shoppingCart = [];
                product.quantity = 1;
            }
        },


        // Function that lets you increase the quantity of a product in the shoppingCart
        // product -> The current product element
        // index -> The index of the current product
        addQuantity(product) {
            if (product.quantity == 0 || product.quantity > 0) {
                product.quantity++;
                this.totalPrice += product.price;
                this.saveShoppingCart(this.shoppingCart, this.totalPrice);
            }
        },


        // Function that saves shoppingCart in localStorage
        // shoppingCart -> array of object where all the shoppingCart data are stored
        // totalPrice -> the total amount of the current order
        saveShoppingCart(shoppingCart, totalPrice) {
            // Serializing shopping cart content
            let serializedShoppingCart = JSON.stringify(shoppingCart);
            // Serializing totalPrice
            let serializedTotalPrice = JSON.stringify(totalPrice);

            // Saving shoppingCart content and totalPrice in two localStorage items
            localStorage.setItem('shoppingCart', serializedShoppingCart);
            localStorage.setItem('totalPrice', serializedTotalPrice);
        },

        // Function that empties the shoppingCart & clears localStorage
        emptyCart() {
            this.restaurantId = 0;
            this.totalPrice = 0;
            this.shoppingCart = [];
            localStorage.clear();
        },

        // SideBar Functions
        // Open & Close the sideBar based on its visibility status
        sideBarVisibility() {
            this.sideBarVisible = !this.sideBarVisible;
        },


        // Closes the sidebar if the totalPrice of the order reaches 0€
        closeSideBar(totalPrice) {
            if (totalPrice == 0) {
                this.sideBarVisible = false;
            }
        },


        // Manage the burger menu visibility
        burgerVisibility() {
            this.burgerVisible = !this.burgerVisible;
        },
    }, 

    // MOUNTED FUNCTIONS
    mounted() {
        let deserializedShoppingCart = JSON.parse(localStorage.getItem('shoppingCart'));
        let deserializedTotalPrice = JSON.parse(localStorage.getItem('totalPrice'));
        let deserializedCurrentRestaurantId = JSON.parse(localStorage.getItem('currentRestaurantId'));

        if (deserializedShoppingCart) {
            deserializedShoppingCart.forEach(element => {
                this.shoppingCart.push(element);
            });
            this.totalPrice = deserializedTotalPrice;
            this.currentRestaurantId = deserializedCurrentRestaurantId;
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