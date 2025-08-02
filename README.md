# 🛒 Laravel E-Commerce Platform

A scalable and extensible eCommerce web application built with **Laravel**. This project includes a complete **admin dashboard** and **frontend store** with essential features like cart, favorites, role-based access, and more.

---

## 🚀 Features

### ✅ Admin Dashboard
- Add / Edit / Delete:
  - Products
  - Categories
  - Tags
  - Attributes
  - Product Images
- Role-based access control (Admins with custom privileges)

### 🛍️ Frontend
- Add products to **Favorites**
- Add products to **Cart**
- Browse categories and product listings
- Product details page

---

## 🧰 Tech Stack

- **Backend**: Laravel (PHP Framework)
- **Frontend**: Blade templating engine
- **Database**: MySQL
- **Authentication&Authorization**: Laravel Gates & Middleware

---

## 📂 Installation

1. Clone the repository:

```bash
git clone https://github.com/amar21112/ecommerce.git
cd ecommerce
```
2. Install dependence
```bash
cp .env.example .env
php artisan key:generate
```
3. Setup environment
```bash
cp .env.example .env
php artisan key:generate
```
4.Configure your .env file

5.Run migration and seeds
```bash
php artisan migrate --seed
```
6. Serve the app
   ```bash
   php artisan serve
   ```
