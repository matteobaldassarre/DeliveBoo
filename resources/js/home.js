var app = new Vue({

    el: '#root',

    data: {
        restaurants: [],
        restaurantsTypes: [],
        filteredRestaurantsByType: [],
        searchedRestaurant: ''
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
        }
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