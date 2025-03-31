# Primepicks-Ecommerce Website

## Overview
-This is a decent-level ecommerce website built with laravel, mysql and bootstrap. The platform allows users to browse products, add them to the cart, and make payments.


## Features
 - **User Authentication**: User can register and login and manage their profile.
 - **Role based Authorization**: Admin/Seller can manage product, order through seprate dashboard.
 - **Seller Request**: User can send a email to upgrade role to sell their product.
 - **Product Management**: Seller/Admin can perform CRUD operation on products.
 - **Product Browsing**: User can view product and search by name and category.
 - **Shopping Cart**: User can add products to their carts, view and modify the product quantity.
 - **Checkout and Order Management**: User can make payment and view order history.
 - **Rating and Review**: Users can rate products and leave comments.
 - **Responsive Design**: The website is fully responsive and works well on both desktop and mobile devices.


## Technology Used
 - **Backend**: Laravel
 - **Frontend**: HTML, CSS, JavaScript, Bootstrap
 - **Database**: MySql
 - **Payment Gateway**: Paypal
 - **Email Service**: Laravel Mail


## Installation

 ### Prerequisites
 Before setting up the application, ensure that the following software is installed on your system:
    - PHP = 8.3
    - Composer
    - MySQL

 ### Steps
   - **Clone the repository**: git clone https://github.com/HimmatMagar/primepicks 
   - **Navigate to the project folder**: cd primepicks
   - **Install Dependencies using composer**: composer install
   - **Set up Evironment file**:  cp .env.example .env
   - **Generate the application key**: php artisan key:generate
   - **Set up your database credentials in the .env file**
   - **Run Migrations: php artisan migrate**
   - **Serve the application: php artisan serve**

**Visit http://localhost:8000 in your browser to view the application.**


## Contributing
 - **Feel free to fork this repository and submit pull requests. Make sure to follow the coding style used in the project.**#
