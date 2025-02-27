# Wardrobe Management System

Welcome to the Wardrobe Management System! This application helps you organize and manage your wardrobe efficiently. Keep track of your clothes, plan outfits, and much more.

## Features

- Organize your wardrobe by categories
- Plan your outfits for the week
- Track your clothing usage
- View statistics and charts about your wardrobe

## Setup Instructions

### Prerequisites

- [Node.js](https://nodejs.org/) (version 14 or higher)
- [npm](https://www.npmjs.com/) (version 6 or higher)
- [Composer](https://getcomposer.org/)
- [PHP](https://www.php.net/) (version 7.4 or higher)
- [MySQL](https://www.mysql.com/) or [PostgreSQL](https://www.postgresql.org/)

### Installation

1. **Clone the repository:**

    ```sh
    git clone https://github.com/your-username/wardrobe-management.git
    cd wardrobe-management
    ```

2. **Install PHP dependencies:**

    ```sh
    composer install
    ```

3. **Install Node.js dependencies:**

    ```sh
    npm install
    ```

4. **Copy the [.env.example](http://_vscodecontentref_/0) file to [.env](http://_vscodecontentref_/1) and configure your environment variables:**

    ```sh
    cp .env.example .env
    ```

    Update the [.env](http://_vscodecontentref_/2) file with your database credentials and other necessary configurations.

5. **Generate an application key:**

    ```sh
    php artisan key:generate
    ```

6. **Run database migrations:**

    ```sh
    php artisan migrate
    ```

7. **Seed the database (optional):**

    ```sh
    php artisan db:seed
    ```

8. **Build the front-end assets:**

    ```sh
    npm run dev
    ```

### Running the Application

1. **Start the development :server**

    ```sh
    php artisan serve
    ```

2. **Visit the application in your browser:**

    Open your browser and go to `http://localhost:8000`.

### Additional Commands

- **Run tests:**

    ```sh
    php artisan test
    ```

- **Compile assets for production:**

    ```sh
    npm run build
    ```

## Application Overview

The Wardrobe Management System is designed to help you keep track of your wardrobe items, plan your outfits, and monitor your clothing usage. The dashboard provides an overview of your wardrobe with statistics and charts, including:

- **Total Number of Clothes:** Displays the total count of clothing items in your wardrobe.
- **Total Wardrobe Value:** Shows the total value of all clothing items.
- **Unique Categories:** Lists the number of unique categories in your wardrobe.
- **Value Distribution:** A pie chart showing the distribution of the total value across different categories.
- **Quantity per Category:** A bar chart displaying the quantity of items in each category.

## Contributing

Contributions are welcome! Please read the contribution guidelines for more information.

## License

This project is licensed under the MIT License. See the LICENSE file for details.
