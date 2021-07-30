# DeliveBoo
DeliveBoo is a Web App that lets you order food in the city of Rome.<br>
This Web App includes different functionalities that will be explained step by step in this presentation file.

### Types of Users
There are two different types of users that can visit DeliveBoo. <br>

<b style="color: #aaeca4">The Customer</b> -> a non-registered user that wants to order from a restaurant. <br>

<b style="color: #f56f6f">The Admin/Restaurateur</b> -> a registered user that can add his restaurant on DeliveBoo and get orders from the customers.

### DeliveBoo HomePage
From the HomePage, <b style="color: #aaeca4">customers</b> can view all the affiliated restaurants in DeliveBoo, <br>
while <b style="color: #f56f6f">restaurateurs</b> can register their restaurants by clicking on the register button in the top-right corner.

![homepage](readme-files/homepage.png)

### Filtering Restaurants
You can also filter all the restaurants on DeliveBoo by a selected type as you can see below.

![filter-restaurants](readme-files/filter-type.gif)

### Searching Restaurant by name
If you already know the restaurant name, you can search it by its name using the top searchbar.

![search-restaurants](readme-files/searchbar.gif)

### Restaurant Menu
By clicking on the cards of the affiliated reastaurants you can access the public restaurant menu, <br>
here's an example on how the restaurant menu page looks like.

![menu-page](readme-files/menu-page.png)

### Add To Cart
From the restaurant menu you can add plates to your Shopping Cart. <br>
You can also modify the plate quantity & empty your cart, on the other hand if you're satisfied with your order you can proceed to the checkout by clicking on the yellow button.

![add-plates](readme-files/add-plates.gif)

### Payment Checkout
This is the page where the customer will be redirected to pay his order. <br>
This Checkout page uses Braintree Payment Provider to save & process the transaction. <br>
If the transaction has success the customer will be redirected to the Order Summary.

![payment](readme-files/payment.gif)

## Admin Functionalities
As a Restaurant Owner (Admin) you have different functionalities that you can use. <br>
This is the Admin Dashboard where the all the restaurant informations are displayed. <br>
From the Dashboard you can also view your restaurant menu (to edit your plates), add a plate, and edit your restaurant info.

![dashboard](readme-files/dashboard.png)

### View Menu
![view-menu](readme-files/menu.png)

### Add Plate
![add-plate](readme-files/add-plate.png)

### Edit Restaurant
![edit-restaurant](readme-files/edit-restaurant.png)

### Order Statistics
Every restaurant has a statistics chart in its Dashboard representing the number of orders received in the current year divided by month. <br> 
The chart has been realized using ChartJs library.

![order-statistics](readme-files/stats.png)




