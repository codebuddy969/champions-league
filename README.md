# Insider Champions League Simulation

This project simulates a mini football league consisting of four teams. The league follows standard Premier League rules (3 points for a win, 1 for a draw, goal difference tiebreakers, etc.). Built with **PHP (v8.3)** on the backend and **Vue.js** on the frontend, the simulation includes features such as weekly match results, dynamic league table updates, match editing, and automated full-league simulations.

## 📁 Project Structure

* **Backend**: PHP (Laravel), OOP principles
* **Frontend**: Vue.js (Vite-based)
* **Database**: SQLite
* **Testing**: Laravel built-in test framework
* **Extras**: Match editing, league auto-play, result recalculations, and unit testing

---

## ⚙️ Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/yourusername/insider-champions-league.git
cd insider-champions-league
```

### 2. Create `.env` File

Copy the example environment file and adjust your settings:

```bash
cp .env.example .env
```

Update the following key variables in `.env`:

```dotenv
DB_CONNECTION=sqlite
DB_DATABASE=${PROJECT_PATH}/database/database.sqlite
```

> Replace `${PROJECT_PATH}` with the absolute path to your project directory.

### 3. Create SQLite Database

```bash
touch database/database.sqlite
```

> The SQLite database file must be named `database.sqlite` and placed under the `/database` directory.

### 4. Install PHP Dependencies

Ensure PHP 8.3 is installed, then run:

```bash
composer install
```

> ⚠️ Make sure necessary PHP extensions (e.g., `pdo`, `sqlite3`, `mbstring`, `openssl`) are enabled in your `php.ini` file.

### 5. Run Migrations

```bash
php artisan migrate
```

### 6. Install Node.js Dependencies

Ensure you are using **Node.js v20.18.2**, then:

```bash
npm install
npm run dev
```

---

## 🏃 Running the Project

Start the Laravel server:

```bash
php artisan serve
```

Then open your browser at:

```
http://localhost:8000
```

---

## 🧪 Running Tests

The project includes several unit tests for core simulation logic. Use the following commands to run them:

```bash
php artisan test --filter=LeagueSimulatorTest
php artisan test --filter=MatchResultGeneratorTest
php artisan test --filter=StandingRepositoryTest
```

---

## ✅ Features

* Simulate all league matches manually or automatically
* Real-time league table updates
* Match editing and dynamic standings recalculation
* Vue.js interactive dashboard
* OOP-structured Laravel backend
* Automated test coverage for key logic

---

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).
