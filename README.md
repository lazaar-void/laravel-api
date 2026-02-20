# 🚀 Laravel REST API - Customer Data Platform

A robust, production-ready RESTful API built with Laravel 11. This application is designed to securely expose a large customer database, providing advanced querying capabilities while maintaining strict performance and security standards.

## ✨ Key Features

- **Advanced Querying:** Integrated with `spatie/laravel-query-builder` to support complex URL-based filtering, sorting, and pagination without polluting controllers.
- **Standardized Output:** Uses Laravel API Resources to format responses, providing a clean, predictable JSON structure inspired by the **JSON:API** specification.
- **Security & Rate Limiting:** - Endpoints are protected via HTTP Basic Authentication (`auth.basic`).
    - Strict Rate Limiting (Throttle) caps requests at 60 per minute per IP to prevent DDoS attacks.
- **Payload Validation:** Robust `FormRequest` validation ensures URL parameters (like `page[size]`) are strictly bounded to prevent memory exhaustion and server overloads.
- **Headless-Ready:** Fully configured CORS policy to seamlessly integrate with decoupled modern front-ends (e.g., Next.js, React, Vue).
- **Custom Middleware:** Injects custom headers (e.g., `x-api-version: v1`) on all outgoing responses for enhanced traceability.

## 🛠️ Tech Stack

- **Framework:** Laravel 11
- **Language:** PHP 8.2+
- **Database:** MySQL
- **Packages:** `spatie/laravel-query-builder`

---

## 🚀 Getting Started

### 1. Prerequisites
- PHP 8.2 or higher
- Composer
- MySQL Database (populated via the CLI Importer Tool)

### 2. Installation & Setup

Clone the repository and install PHP dependencies:
```bash
git clone [https://github.com/your-username/laravel-customers-api.git](https://github.com/your-username/laravel-customers-api.git)
cd laravel-customers-api
composer install
```

Copy the environment file and generate the application key:
```bash
cp .env.example .env
php artisan key:generate
```

Configure your database connection in the `.env` file to point to the imported database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=csv_import_db
DB_USERNAME=csv_importer
DB_PASSWORD=1234
```

*Note: You must run the default Laravel migrations to create the `users` table required for Basic Authentication.*
```bash
php artisan migrate
```

### 3. Creating an API User
To access the endpoints, you need an authenticated user. You can easily create one using Laravel Tinker:
```bash
php artisan tinker
```
```php
User::create([
    'name' => 'Admin', 
    'email' => 'admin@api.com', 
    'password' => bcrypt('password123')
]);
```

### 4. Running the Server
Start the local development server:
```bash
php artisan serve
```

---

## 📡 API Documentation & Usage

### Base URL
`http://127.0.0.1:8000/api/users`

### Authentication
All requests require **Basic Auth** headers using the credentials created above.

### Request Parameters (Query String)

| Parameter | Type | Example | Description |
| :--- | :--- | :--- | :--- |
| `filter[first_name]` | String | `?filter[first_name]=Eladio` | Exact match or partial search on the first name. |
| `filter[email]` | String | `?filter[email]=example.com` | Exact match or partial search on the email. |
| `sort` | String | `?sort=-email,first_name` | Sort by field. Use `-` for descending order. |
| `page[number]` | Integer | `?page[number]=2` | The specific page to retrieve. |
| `page[size]` | Integer | `?page[size]=15` | Results per page (Max: 100 to prevent overload). |

### Example cURL Request

```bash
curl -i -g -u admin@api.com:password123 "[http://127.0.0.1:8000/api/users?filter](http://127.0.0.1:8000/api/users?filter)[first_name]=Eladio&sort=-email&page[number]=1&page[size]=10"
```

### Example JSON Response (200 OK)

```json
{
    "data": [
        {
            "id": 1,
            "name": "Eladio Schroeder",
            "email": "therese28@example.com"
        }
    ],
    "links": {
        "first": "[http://127.0.0.1:8000/api/users?page%5Bnumber%5D=1](http://127.0.0.1:8000/api/users?page%5Bnumber%5D=1)",
        "last": "[http://127.0.0.1:8000/api/users?page%5Bnumber%5D=1](http://127.0.0.1:8000/api/users?page%5Bnumber%5D=1)",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "[http://127.0.0.1:8000/api/users](http://127.0.0.1:8000/api/users)",
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

---
**Author:** Hamza Lazaar
