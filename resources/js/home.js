var app = new Vue({

    el: '#root',

    data: {
        restaurants: [],
        restaurants_types: [],
        filtered_restaurants: []
    },

    methods: {
        searchRestaurant(type) {
            axios.get( '/api/restaurants/' + type ).then(result => {
                this.filtered_restaurants = result.data.restaurants;
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
            this.restaurants_types = result.data.restaurants_types;
        });
    }

});