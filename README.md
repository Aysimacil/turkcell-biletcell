# 🎫 BiletCell - Event & Ticketing Platform

BiletCell is a modern event and ticketing platform where users can discover events, select seats, purchase tickets, and enter events using QR codes.

This project is a full-stack web implementation developed as part of the Turkcell CodeNight 2026 case study.

---

## 🚀 Features

### 👤 Authentication & User System
- GSM-based registration and OTP verification (simulation: `1234`)
- Role-based access control:
  - Admin
  - Organizer
  - User
- Custom token-based authentication system

---

### 🎟️ Event & Ticketing System
- Browse and view event details
- Category-based event structure
- Interactive seat selection system
- Maximum **4 seats per purchase**
- Seat states:
  - Available
  - Selected
  - Sold

---

### 💳 Payment Simulation
- Paycell payment simulation
- Test payment:
  - ✅ `42.42` → successful payment
- After successful payment:
  - Unique **QR code generated per ticket**

---

### 📲 My Tickets
- Users can view all purchased tickets
- QR-based digital ticket system

---

## 🧑‍💼 Admin Dashboard
- View all users
- Assign **Organizer role** to users
- View total revenue
- Create events
- List all events

---

## 🎤 Organizer Dashboard
- View own events
- Create new events
- Archive events
- Track earnings (revenue)

---

## 🧱 Tech Stack

| Layer       | Technology |
|------------|-----------|
| Backend     | Laravel 11 |
| Frontend    | Blade + TailwindCSS |
| Database    | MySQL |
| DevOps      | Docker & Docker Compose |
| API Testing | Thunder Client |

---

## 🐳 Installation (Docker)

```bash
git clone https://github.com/your-username/biletcell.git
cd biletcell

cp .env.example .env

docker-compose up -d --build

docker exec -it app bash
php artisan migrate
php artisan db:seed
