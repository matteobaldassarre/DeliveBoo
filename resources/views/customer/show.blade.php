<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $restaurant->restaurant_name }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- CDNs --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <div class="restaurant-menu-page-show">
        {{-- Restaurant Jumbtron --}}
        <div class="menu-jumbotron" style="background-image: url('https://just-eat-prod-eu-res.cloudinary.com/image/upload/c_fill,f_auto,q_auto,w_1600,h_350,d_it:cuisines:hamburger-8.jpg/v1/it/restaurants/233148.jpg')">
            <div class="container-flex">
                {{-- DeliveBoo Logo --}}
                <div class="deliveboo-logo">
                    <svg xmlns="http://www.w3.org/2000/svg" width="102" height="38.833" viewBox="0 0 102 38.833">
                        <g id="Raggruppa_3" data-name="Raggruppa 3" transform="translate(-127 -74.167)">
                            <text id="DeliveBoo" transform="translate(127 106)" fill="#fff" font-size="25" font-family="PTSans-BoldItalic, PT Sans" font-weight="700" font-style="italic"><tspan x="0" y="0">DeliveBoo</tspan></text>
                            <path id="hamburger-solid" d="M17.219,39.917H1.781a1.7,1.7,0,1,0,0,3.393H17.219a1.7,1.7,0,1,0,0-3.393Zm.594,4.524H1.188a.58.58,0,0,0-.594.565v.565a2.321,2.321,0,0,0,2.375,2.262H16.031a2.321,2.321,0,0,0,2.375-2.262v-.565A.58.58,0,0,0,17.813,44.44ZM2.176,38.786H16.824A1.712,1.712,0,0,0,18.116,36.1C16.625,33.81,13.343,32,9.5,32S2.375,33.81.884,36.1A1.712,1.712,0,0,0,2.176,38.786ZM14.25,34.827a.566.566,0,1,1-.594.565A.58.58,0,0,1,14.25,34.827ZM9.5,33.7a.566.566,0,1,1-.594.565A.58.58,0,0,1,9.5,33.7ZM4.75,34.827a.566.566,0,1,1-.594.565A.58.58,0,0,1,4.75,34.827Z" transform="translate(210 42.167)" fill="#fff"/>
                        </g>
                    </svg>
                </div>

                {{-- DeliveBoo Cart --}}
                <div class="cart">
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>

            <div class="menu-info-card">
                <h4>{{ $restaurant->restaurant_name }}</h4>
                <h5>Hamburger - Pizzeria</h5>
                <span>{{ $restaurant->address }}</span>
            </div>
        </div>
        {{-- End Restaurant Jumbotron --}}

        {{-- Menu Sections NavBar --}}
        <nav>
            <ul class="menu-sections-navbar">
                <li>
                    <a href="#">Antipasti</a>
                </li>
                <li>
                    <a href="#">Primi</a>
                </li>
                <li>
                    <a href="#">Secondi</a>
                </li>
                <li>
                    <a href="#">Contorni</a>
                </li>
                <li>
                    <a href="#">Dolci</a>
                </li>
            </ul>
        </nav>
        {{-- End Menu Sections NavBar --}}


        <div class="menu-sections">
            <div class="antipasti">
                <h2>Antipasti</h2>
                <div class="container-flex">
                    <div class="food-card">
                        <div class="food-card-image">
                            <img src="https://www.lospicchiodaglio.it/img/ricette/crocchettepatate.jpg" alt="food-image">
                        </div>

                        <div class="food-card-info">
                            <h4 class="food-card-title">Crocchetta di Patate</h4>
                            <p class="food-card-ingredients">Ingredienti: patate, fagioli, peperoni, pollo...</p>

                            <div class="food-card-price-button">
                                <span class="food-card-price">1,60€</span>
                                <button class="food-card-button">Add to cart</button>
                            </div>
                        </div>
                    </div>

                    <div class="food-card">
                        <div class="food-card-image">
                            <img src="https://www.lospicchiodaglio.it/img/ricette/crocchettepatate.jpg" alt="food-image">
                        </div>

                        <div class="food-card-info">
                            <h4 class="food-card-title">Crocchetta di Patate</h4>
                            <p class="food-card-ingredients">Ingredienti: patate, fagioli, peperoni, pollo...</p>

                            <div class="food-card-price-button">
                                <span class="food-card-price">1,60€</span>
                                <button class="food-card-button">Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="primi">
                <h2>Primi</h2>
                <div class="container-flex">
                    <div class="food-card">
                        <div class="food-card-image">
                            <img src="https://www.lospicchiodaglio.it/img/ricette/crocchettepatate.jpg" alt="food-image">
                        </div>

                        <div class="food-card-info">
                            <h4 class="food-card-title">Crocchetta di Patate</h4>
                            <p class="food-card-ingredients">Ingredienti: patate, fagioli, peperoni, pollo...</p>

                            <div class="food-card-price-button">
                                <span class="food-card-price">1,60€</span>
                                <button class="food-card-button">Add to cart</button>
                            </div>
                        </div>
                    </div>

                    <div class="food-card">
                        <div class="food-card-image">
                            <img src="https://www.lospicchiodaglio.it/img/ricette/crocchettepatate.jpg" alt="food-image">
                        </div>

                        <div class="food-card-info">
                            <h4 class="food-card-title">Crocchetta di Patate</h4>
                            <p class="food-card-ingredients">Ingredienti: patate, fagioli, peperoni, pollo...</p>

                            <div class="food-card-price-button">
                                <span class="food-card-price">1,60€</span>
                                <button class="food-card-button">Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="secondi">
                <h2>Secondi</h2>
                <div class="container-flex">
                    <div class="food-card">
                        <div class="food-card-image">
                            <img src="https://www.lospicchiodaglio.it/img/ricette/crocchettepatate.jpg" alt="food-image">
                        </div>

                        <div class="food-card-info">
                            <h4 class="food-card-title">Crocchetta di Patate</h4>
                            <p class="food-card-ingredients">Ingredienti: patate, fagioli, peperoni, pollo...</p>

                            <div class="food-card-price-button">
                                <span class="food-card-price">1,60€</span>
                                <button class="food-card-button">Add to cart</button>
                            </div>
                        </div>
                    </div>

                    <div class="food-card">
                        <div class="food-card-image">
                            <img src="https://www.lospicchiodaglio.it/img/ricette/crocchettepatate.jpg" alt="food-image">
                        </div>

                        <div class="food-card-info">
                            <h4 class="food-card-title">Crocchetta di Patate</h4>
                            <p class="food-card-ingredients">Ingredienti: patate, fagioli, peperoni, pollo...</p>

                            <div class="food-card-price-button">
                                <span class="food-card-price">1,60€</span>
                                <button class="food-card-button">Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contorni">
                <h2>Contorni</h2>
                <div class="container-flex">
                    <div class="food-card">
                        <div class="food-card-image">
                            <img src="https://www.lospicchiodaglio.it/img/ricette/crocchettepatate.jpg" alt="food-image">
                        </div>

                        <div class="food-card-info">
                            <h4 class="food-card-title">Crocchetta di Patate</h4>
                            <p class="food-card-ingredients">Ingredienti: patate, fagioli, peperoni, pollo...</p>

                            <div class="food-card-price-button">
                                <span class="food-card-price">1,60€</span>
                                <button class="food-card-button">Add to cart</button>
                            </div>
                        </div>
                    </div>

                    <div class="food-card">
                        <div class="food-card-image">
                            <img src="https://www.lospicchiodaglio.it/img/ricette/crocchettepatate.jpg" alt="food-image">
                        </div>

                        <div class="food-card-info">
                            <h4 class="food-card-title">Crocchetta di Patate</h4>
                            <p class="food-card-ingredients">Ingredienti: patate, fagioli, peperoni, pollo...</p>

                            <div class="food-card-price-button">
                                <span class="food-card-price">1,60€</span>
                                <button class="food-card-button">Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dolci">
                <h2>Dolci</h2>
                <div class="container-flex">
                    <div class="food-card">
                        <div class="food-card-image">
                            <img src="https://www.lospicchiodaglio.it/img/ricette/crocchettepatate.jpg" alt="food-image">
                        </div>

                        <div class="food-card-info">
                            <h4 class="food-card-title">Crocchetta di Patate</h4>
                            <p class="food-card-ingredients">Ingredienti: patate, fagioli, peperoni, pollo...</p>

                            <div class="food-card-price-button">
                                <span class="food-card-price">1,60€</span>
                                <button class="food-card-button">Add to cart</button>
                            </div>
                        </div>
                    </div>

                    <div class="food-card">
                        <div class="food-card-image">
                            <img src="https://www.lospicchiodaglio.it/img/ricette/crocchettepatate.jpg" alt="food-image">
                        </div>

                        <div class="food-card-info">
                            <h4 class="food-card-title">Crocchetta di Patate</h4>
                            <p class="food-card-ingredients">Ingredienti: patate, fagioli, peperoni, pollo...</p>

                            <div class="food-card-price-button">
                                <span class="food-card-price">1,60€</span>
                                <button class="food-card-button">Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>