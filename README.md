# Complaints & Service Tickets REST API

A RESTful API built with Laravel 12 for handling customer complaints and service ticketing system at PDAM.

## Features

- **Create Complaint Ticket:** Auto-generates unique ticket numbers (`TCK-XXXXX`).
- **View All Tickets:** Fetch all submitted complaints ordered by latest.
- **View Ticket Details:** Retrieve specific ticket information by ID.
- **Update Ticket Status:** Manage ticket lifecycle (`pending` -> `diproses` -> `selesai` / `ditolak`).
- **Delete Ticket:** Remove ticket record.

## Tech Stack

- **Framework:** Laravel 12 (PHP 8.2+)
- **Database:** MySQL
- **Testing:** Postman / Thunder Client

## Database & Installation Setup

1. Clone this repository.
2. Run `composer install`.
3. Copy `.env.example` to `.env` and configure your database settings.
4. Run `php artisan key:generate`.
5. **Database Import (Choose one):**
   - **Option A (Fresh Migration):** Run `php artisan migrate`
   - **Option B (Import Sample Data):** Import the provided SQL dump file located at `database/complaints_api_db.sql` directly into phpMyAdmin or MySQL server.
6. Run `php artisan serve` to start the API.

## Database Schema (`tickets`)

| Column                      | Type      | Description                                                   |
| :-------------------------- | :-------- | :------------------------------------------------------------ |
| `id`                        | BigInt    | Primary Key                                                   |
| `ticket_number`             | String    | Unique ticket code (e.g., `TCK-BZP0B`)                        |
| `customer_name`             | String    | Customer's full name                                          |
| `phone_number`              | String    | Contact number                                                |
| `category`                  | Enum      | `kebocoran`, `air_mati`, `tagihan`, `kualitas_air`, `lainnya` |
| `description`               | Text      | Detail of the complaint                                       |
| `status`                    | Enum      | `pending`, `diproses`, `selesai`, `ditolak`                   |
| `created_at` / `updated_at` | Timestamp | Standard Laravel timestamps                                   |

## API Endpoints Overview

| Method   | Endpoint            | Description          |
| :------- | :------------------ | :------------------- |
| `GET`    | `/api/tickets`      | Get all tickets      |
| `POST`   | `/api/tickets`      | Create a new ticket  |
| `GET`    | `/api/tickets/{id}` | Get ticket detail    |
| `PUT`    | `/api/tickets/{id}` | Update ticket status |
| `DELETE` | `/api/tickets/{id}` | Delete ticket        |

## Sample Request Body (`POST /api/tickets`)

```json
{
  "customer_name": "Salsabil Riani",
  "phone_number": "081289324782",
  "category": "air_mati",
  "description": "Air tidak mengalir sama sekali sejak kemarin sore di Blok C No. 12."
}
```
