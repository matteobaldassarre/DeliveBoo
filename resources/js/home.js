var app = new Vue({

    el: '#root',

    data: {
        restaurants: [],
        restaurantsTypes: [],
        filteredRestaurantsByType: [],
        searchedRestaurant: '',
        currentRestaurantPlates: [],
        currentRestaurantInfo: [],
        platesTypes: [
            'Antipasti',
            'Primi',
            'Secondi',
            'Contorni',
            'Dolci'
        ],
        restaurantChosen: false
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
    },

    mounted() {
        // Getting all restaurants from the restaurants API
        axios.get('/api/restaurants').then(result => {
            this.restaurants = result.data.restaurants;
        });

        // Populating Restaurant Types Array
        axios.get('/api/restaurants/types').then(result => {
            this.restaurantsTypes = result.data.restaurants_types;
        });
    }
});