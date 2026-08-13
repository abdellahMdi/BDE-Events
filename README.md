# 🎟️ BDE-Events — Campus Event & Ticketing Platform

> A full-stack, containerized web application designed for managing student campus events, ticket reservations, and user authentication. Built with a modern **Laravel 11+ API** backend and a **React + Vite** frontend, fully orchestrable via **Docker Compose**.

---

## 🛠️ Tech Stack

### **Frontend**
* **Framework:** React 18 / Vite
* **Styling:** Tailwind CSS
* **Build Tool:** Vite v8+
* **Web Server (Production/Docker):** Nginx (Alpine)

### **Backend**
* **Framework:** Laravel 11+ (PHP 8.4)
* **Authentication:** Laravel Sanctum (Token-based API authentication)
* **Database:** MySQL 8.0
* **API Architecture:** RESTful JSON API

### **DevOps & Containerization**
* **Orchestration:** Docker & Docker Compose
* **Containers:** PHP-FPM 8.4, Nginx, MySQL 8.0

---

## 📂 Project Structure

```text
BDE-Events/
├── Backend/                 # Laravel 11 API project
│   ├── app/                 # Controllers, Models, Middleware
│   ├── config/              # Application configuration
│   ├── database/            # Migrations, Factories, Seeders
│   ├── routes/              # api.php, web.php
│   ├── .dockerignore        # Docker build exclusion rules
│   └── Dockerfile           # PHP 8.4 FPM container config
│
├── Frontend/                # React + Vite application
│   ├── public/              # Static assets
│   ├── src/                 # React components, pages, hooks, styling
│   ├── dist/                # Pre-built static output (for production Docker)
│   ├── nginx.conf           # Nginx SPA router configuration
│   ├── .dockerignore        # Docker build exclusion rules
│   └── Dockerfile           # Production Nginx container config
│
├── docker-compose.yml       # Root orchestrator for Backend, Frontend, and MySQL
└── README.md                # Project documentation
```

---

## 🚀 Quick Start (Using Docker Compose)

### **Prerequisites**
* [Docker Desktop](https://www.docker.com/products/docker-desktop/) installed and running on your host machine.
* Git installed.

---

### **1. Clone the Repository**
```bash
git clone https://github.com/YOUR_USERNAME/BDE-Events.git
cd BDE-Events
```

---

### **2. Configure Environment Variables**

Create the backend `.env` file by copying the example template:

```bash
cp Backend/.env.example Backend/.env
```

Ensure the database settings in `Backend/.env` match your `docker-compose.yml`:

```env
APP_NAME="BDE Events"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=bde_events
DB_USERNAME=bde_user
DB_PASSWORD=bde_password
```

---

### **3. Build Frontend Dist Folder**

To ensure maximum performance and minimal container memory usage, build the static frontend bundle on your host machine prior to launching Docker:

```bash
cd Frontend
npm install
npm run build
cd ..
```

---

### **4. Launch Containers**

From the project root directory, run:

```bash
docker-compose up -d --build
```

This starts 4 containers:
* **`bde_frontend`**: Nginx serving the React static build (`http://localhost:5173`).
* **`bde_backend`**: PHP 8.4 FPM service processing API requests.
* **`bde_backend_web`**: Nginx web server handling HTTP requests for Laravel (`http://localhost:8000`).
* **`bde_db`**: MySQL 8.0 database container.

---

### **5. Initialize Laravel Application**

Run the required Artisan setup commands inside the running backend container:

```bash
# 1. Generate Application Encryption Key
docker-compose exec backend php artisan key:generate

# 2. Run Database Migrations (and Seeders)
docker-compose exec backend php artisan migrate --seed

# 3. Create Storage Link for Media Uploads
docker-compose exec backend php artisan storage:link
```

---

## 🌐 Application URLs

| Service | Protocol | Local URL | Description |
| :--- | :--- | :--- | :--- |
| **Frontend** | HTTP | `http://localhost:5173` | React User Interface |
| **Backend API** | HTTP | `http://localhost:8000/api` | Laravel REST API Endpoints |
| **Database** | MySQL | `localhost:3306` (or `3307`) | MySQL Database Access |

---

## 💻 Local Development (Without Docker)

If you prefer running the stack natively on your host machine:

### **Backend Setup**
```bash
cd Backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve --port=8000
```

### **Frontend Setup**
```bash
cd Frontend
npm install
npm run dev
```

---

## 🛢️ Useful Docker Commands

```bash
# View container status
docker-compose ps

# View real-time logs for all services
docker-compose logs -f

# View logs for backend only
docker-compose logs -f backend

# Stop all running containers
docker-compose down

# Stop and wipe database volumes (Clean Reset)
docker-compose down -v
```

---

## 📄 License

This project is open-source software licensed under the [MIT License](https://opensource.org/licenses/MIT).
