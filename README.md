# 🎬 Major Cineplex Datacenter

ระบบจัดการ Datacenter และอุปกรณ์โรงภาพยนตร์
รองรับการจัดการ:

* Branches
* Theatres
* Projectors
* Sound Systems
* DCP Servers / IMS
* Network IP Management

พัฒนาด้วย Laravel + MySQL + Docker

---

# 📦 Tech Stack

| Technology     | Version |
| -------------- | ------- |
| Laravel        | 12      |
| PHP            | 8.3     |
| MySQL          | 8       |
| Docker Compose | Latest  |
| phpMyAdmin     | Latest  |
| Node.js        | LTS     |
| TailwindCSS    | Latest  |
| Vite           | Latest  |

---

# 📁 Project Structure

```text
major-cineplex-datacenter/
│
├── app/
├── bootstrap/
├── config/
├── database/
├── docker/
├── public/
├── resources/
├── routes/
├── storage/
├── vendor/
├── .env
├── artisan
├── composer.json
├── docker-compose.yml
└── package.json
```

---

# 🚀 Features

## Branch Management

* จัดการสาขาโรงภาพยนตร์
* Location Management
* Theatre Count

## Theatre Management

* Theatre Information
* Screen Size
* Throw Distance
* Seat Count
* Lamp Type

## Equipment Management

* DCP Server / IMS
* Projector
* Sound Processor
* Serial Number Tracking
* IP Address Tracking

## Monitoring

* Device IP Monitoring
* Datacenter Dashboard
* Equipment Status

## Database

* MySQL 8
* phpMyAdmin Support
* Migration Ready
* Seeder Ready

---

# 🖥️ Requirements

## Windows

ติดตั้งก่อนใช้งาน:

### 1. Docker Desktop

https://www.docker.com/products/docker-desktop/

### 2. Git

https://git-scm.com/downloads

### 3. Node.js (LTS)

https://nodejs.org/

### 4. Composer

https://getcomposer.org/

### 5. VS Code

https://code.visualstudio.com/

---

# 📦 Installation

# 1. Extract Project

แตกไฟล์ ZIP ไปไว้ที่:

```text
C:\laragon\www\major-cineplex-datacenter
```

---

# 2. Open Project

เปิด VS Code แล้วรัน:

```powershell
cd C:\laragon\www\major-cineplex-datacenter
```

---

# 3. Start Docker Desktop

ตรวจสอบ Docker:

```powershell
docker --version
```

และ:

```powershell
docker compose version
```

---

# 4. Configure Environment

ตรวจสอบ `.env`

```env
APP_NAME="Major Cineplex Datacenter"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=major_cinema_web
DB_USERNAME=root
DB_PASSWORD=root
```

สำคัญ:

```env
DB_HOST=db
```

ต้องตรงกับ service ใน Docker

---

# 5. Build Docker Containers

```powershell
docker compose up -d --build
```

---

# 6. Verify Containers

```powershell
docker ps
```

ต้องเห็น:

```text
major_app
major_db
major_pma
```

---

# 7. Install Composer Dependencies

```powershell
docker compose exec app composer install
```

---

# 8. Generate Laravel APP_KEY

```powershell
docker compose exec app php artisan key:generate
```

---

# 9. Database Setup

## Create Database

เข้า phpMyAdmin:

```text
http://localhost:8080
```

Login:

```text
Username: root
Password: root
```

สร้าง Database:

```text
major_cinema_web
```

Collation:

```text
utf8mb4_unicode_ci
```

---

# 10. Import SQL

เลือก:

```text
major_cinema_web
```

จากนั้น:

```text
Import → เลือกไฟล์ SQL → Import
```

---

# 11. Run Laravel Migration

```powershell
docker compose exec app php artisan migrate
```

---

# 12. Install Frontend Packages

```powershell
npm install
```

---

# 13. Run Frontend Dev Server

```powershell
npm run dev
```

---

# 🌐 Access URLs

## Laravel Application

```text
http://localhost:8000
```

## phpMyAdmin

```text
http://localhost:8080
```

---

# 🗄️ Database Configuration

## Default Credentials

| Setting  | Value            |
| -------- | ---------------- |
| Host     | db               |
| Port     | 3306             |
| Database | major_cinema_web |
| Username | root             |
| Password | root             |

---

# 🎬 Theatre IP Convention

ระบบใช้รูปแบบ IP Address ตามหมายเลขโรง

| Theatre | Server      | Projector   | Sound       |
| ------- | ----------- | ----------- | ----------- |
| 1       | 10.131.3.10 | 10.131.3.11 | 10.131.3.14 |
| 2       | 10.131.3.20 | 10.131.3.21 | 10.131.3.24 |
| 3       | 10.131.3.30 | 10.131.3.31 | 10.131.3.34 |
| 4       | 10.131.3.40 | 10.131.3.41 | 10.131.3.44 |

## Convention Rules

| Device           | Last Octet |
| ---------------- | ---------- |
| DCP Server / IMS | .10        |
| Projector        | .11        |
| Sound Processor  | .14        |

---

# 📦 Common Commands

## Start Containers

```powershell
docker compose up -d
```

---

## Stop Containers

```powershell
docker compose down
```

---

## Rebuild Containers

```powershell
docker compose up -d --build
```

---

## Remove Everything

```powershell
docker compose down -v
```

---

## View Logs

```powershell
docker compose logs -f
```

---

## Enter Laravel Container

```powershell
docker compose exec app bash
```

---

## Enter MySQL Container

```powershell
docker compose exec db mysql -u root -p
```

Password:

```text
root
```

---

# ⚡ Laravel Commands

## Clear Cache

```powershell
docker compose exec app php artisan optimize:clear
```

---

## Storage Link

```powershell
docker compose exec app php artisan storage:link
```

---

## Route Cache

```powershell
docker compose exec app php artisan route:cache
```

---

## Config Cache

```powershell
docker compose exec app php artisan config:cache
```

---

# 🛠️ Troubleshooting

## Docker Not Running

ตรวจสอบว่า Docker Desktop เปิดอยู่

```powershell
docker ps
```

---

## Database Connection Error

ตรวจสอบ `.env`

```env
DB_HOST=db
DB_PORT=3306
DB_DATABASE=major_cinema_web
DB_USERNAME=root
DB_PASSWORD=root
```

---

## Permission Error

```powershell
docker compose exec app chmod -R 777 storage bootstrap/cache
```

---

## Port Already In Use

แก้ใน `docker-compose.yml`

ตัวอย่าง:

```yml
ports:
  - "8001:80"
```

---

# 📋 Development Notes

* ใช้ `client_ip` สำหรับ DCP Server IP
* หลีกเลี่ยง hardcode ข้อมูลที่ไม่ใช่ของจริง
* ใช้ NULL สำหรับข้อมูลที่ยังไม่มี
* ระบบรองรับ Docker และ Local Development
* Database รองรับ Migration และ Seeder

---

# 🔐 Production Notes

ก่อน Deploy จริง:

* เปลี่ยน `APP_ENV=production`
* ปิด `APP_DEBUG`
* เปลี่ยน MySQL Password
* ใช้ HTTPS
* Backup Database สม่ำเสมอ

---

# 📜 License

Internal Use Only
Major Cineplex Datacenter System

---

# 👨‍💻 Developer

Developed for Datacenter & Cinema Equipment Management

---
