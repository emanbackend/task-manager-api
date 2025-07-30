# 📌 Task Manager API

A powerful Task Management API built using Laravel, featuring authentication, user-task relationships, file uploads, email notifications, and full RESTful structure.

---

## 🚀 Features

- ✅ User Registration & Login  
- 🔐 Token-Based API Authentication (using Laravel Sanctum)  
- 👥 Relationships (User ↔️ Tasks - Favorites, etc.)  
- 🧱 Middleware for route protection  
- 📝 CRUD Operations for Tasks  
- 🌟 Mark tasks as favorite  
- 📊 Sort Tasks by Priority (High, Medium, Low)  
- 🖼️ Image Upload for user profile or tasks  
- 🔄 API Resource Formatting using `Http\Resources`  
- ⚠️ Error Handling with try-catch + JSON responses  
- 🧪 Factories & Seeders for test data  
- 📩 Send Email (e.g., on registration or task creation)  
- 🧰 Validation using Form Requests  
- 🌐 Well-structured API using Resource Controllers  

---

## 🧰 Built With

- Laravel 11  
- PHP 8.2.12  
- MySQL  
- Laravel Sanctum  
- Postman (for API Testing)  

---

## 🔧 Installation

```bash
# 1. Clone the repository
git clone https://github.com/eman-khalil-4520/task-manager-api.git
cd task-manager-api

# 2. Install dependencies
composer install

# 3. Create .env file
cp .env.example .env

# 4. Configure .env
# Set DB name, user, and password
# Add mail config if sending email

# 5. Generate app key
php artisan key:generate

# 6. Run migrations & seeders
php artisan migrate --seed

# 7. Serve the app
php artisan serve
## 🔐 Authentication

- **Register:** `/api/register`  
- **Login:** `/api/login`  
- Use **Bearer Token** for protected routes

---

## 📌 Example API Endpoints

| Method | Endpoint                          | Description             |
|--------|-----------------------------------|-------------------------|
| POST   | `/api/register`                   | Register new user       |
| POST   | `/api/login`                      | Login and get token     |
| GET    | `/api/tasks`                      | List all tasks          |
| POST   | `/api/tasks`                      | Create a new task       |
| PUT    | `/api/tasks/{id}`                 | Update task             |
| DELETE | `/api/tasks/{id}`                 | Delete task             |
| POST   | `/api/tasks/{id}/favorite`        | Mark task as favorite   |
| GET    | `/api/tasks?priority=high`        | Filter tasks by priority|

---

## 🖼️ Image Upload

When creating or updating a user or task, you can upload an image using `multipart/form-data` with the `image` field.

---

## 📩 Email Notifications

Sends email on user registration (or other actions – customizable).

---

## 👩‍💻 Author

**Eman Khalil**  
GitHub: [emanbackend](https://github.com/emanbackend)
