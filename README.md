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
Bonus: 
 ●  Image upload for products 
 ●  Search/filter products in admin view 
 ●  Deployment is not optional — project must be deployed 
 ●  Deployment on free hosting (e.g., Render, Laravel Forge, or shared host)

 👩‍⚕️ Admin Credentials

Email: admin@example.com

Password: password
📂 Project Structure

app/Models → Eloquent models (Product, Order, OrderItem, ProductLog)

app/Http/Controllers → Controllers for customer & admin

resources/views → Blade templates (cart, checkout, admin)

database/migrations → DB schema migrations

database/seeders → Test data seeding

🔑 Key Features

Customer side: Product browsing, Cart, Checkout, Order Confirmation

Admin side: Breeze authentication, Product CRUD, Order management, Product logs

Stock check at checkout

Clean Blade views with responsive design

🛠 Developer Notes

Extendable via Observers (product logs already included).

To add new product attributes:

Update migration.

Add field to $fillable in Product.php.

Update views/forms accordingly.
