Medical E-Commerce System

A Laravel + Blade + MySQL project simulating a mini medical e-commerce system, with a customer storefront and an admin panel.
This project was built as part of a Full Stack Developer Assessment.

🚀 Tech Stack

Laravel 10

Blade Templates (no SPA frameworks)

MySQL

Laravel Breeze for admin authentication

Eloquent ORM

TailwindCSS (or Bootstrap, depending on styling)

📂 Features
🛒 Customer (Public Area)

Home Page: List medical products with search, sort, filter.

Cart: Add/remove/update items, view total.

Checkout: Place orders without login, collect customer info, validate stock levels.

Order Confirmation: Display summary of successful orders.

👨‍💻 Admin Panel (Authentication Required)

Login with Laravel Breeze.

Product Management: CRUD (name, description, price, image, category).

Product Logs: Auto-track created/updated/deleted with admin ID + changes.