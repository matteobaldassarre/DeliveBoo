var app = new Vue({

    el: '#root',

    data: {
       restaurants: [],
       restaurants_type: [
           'Cinese',
           'Giapponese',
           'Pizzeria',
           'Gourmet',
           'Kebab',
           'Messicano',
           'Panini',
           'Indiano',
           'Hamburger'
       ]
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