var app = new Vue({

    el: '#root',

    data: {
       restaurants: []
    },

    methods: {
        
    },

    mounted() {
        // Getting all restaurants from the restaurants API
        axios.get('/api/restaurants').then(result => {
            this.restaurants = result.data.restaurants;
            console.log(this.restaurants);
            
        });
    }

});