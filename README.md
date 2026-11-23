# DentalCare – Dental Clinic Management System

DentalCare is a Laravel web application for managing patients and dental appointments. It gives receptionists and dentists a shared workflow: reception registers patients and schedules appointments, while dentists view their assigned appointments and record the outcome of each visit.

## Current MVP

| Module | Available in the application |
| --- | --- |
| Account | Sign in and sign out. |
| Patients | List, register, edit, and delete patient records according to the user's permissions. |
| Appointments | List, schedule, edit, and delete appointments according to the user's permissions. Dentists see and edit only appointments assigned to them. An active appointment blocks another booking for the same dentist, date, and time. |
| Users | List, create, edit, and delete user accounts. Assign an existing role when managing an account. |
| Roles and permissions | List, create, edit, and delete roles. Assign module permissions in the role form. A role with assigned users cannot be deleted. |

The [permission matrix](docs/DentalCare_Matriz_Permisos_FINAL.xlsx) lists the 19 functions available for the MVP demonstration, their initial role assignments, and the supporting business rules.

## Run locally

Requirements: **PHP 8.3+**, Composer, MySQL, and Git. For a Windows setup with WAMP, see the [installation guide](docs/INSTALACION.md).

1. Run the following commands in PowerShell from a fresh checkout:

   ```powershell
   composer install
   Copy-Item .env.example .env
   php artisan key:generate
   ```

2. Create an empty MySQL database named `dentalcare` and update the `DB_*` settings in `.env` to match your local MySQL instance.
3. Set up the database and start the server:

   ```powershell
   php artisan migrate --seed
   php artisan serve
   ```

4. Open [localhost:8000](http://localhost:8000) and sign in with a demo account.

### Demo accounts

The seeders create three roles, 17 permissions, three demo users, and three sample patients. The password for each seeded demo account is `password`.

| Role | Email | Initial access |
| --- | --- | --- |
| Administrator | `admin@dentalcare.test` | Manage users, roles, patients, and appointments. |
| Receptionist | `reception@dentalcare.test` | List, register, and edit patients. List, schedule, edit, and delete appointments. |
| Dentist | `dentist@dentalcare.test` | View patients. List and edit assigned appointments. |

## Validate the MVP

1. Open the [permission matrix](docs/DentalCare_Matriz_Permisos_FINAL.xlsx) and show the functions and the roles assigned to them.
2. Sign in as the receptionist. Register a test patient, update a patient detail, and schedule an appointment for the demo dentist. Show the saved appointment in the list.
3. Sign out and sign in as the dentist. Open the assigned appointment, change its status to `Confirmed` and then `Completed`, and save a sample note. Reopen the appointment to show the final status and note.
4. Sign in as the administrator. Create a temporary role, assign it the `View patients` permission, and associate it with a test account. Show that the account can open the patient list. Use temporary records to demonstrate editing and deletion in the admin modules.
5. Use a separate test appointment and patient to demonstrate deletion. Delete the appointment first, then delete the test patient as the administrator. Keep the completed appointment for the final walkthrough.

## Project reference

- **Stack** — Laravel 13, PHP, MySQL, Blade, Bootstrap (Medicio), jQuery, and SweetAlert2.
- **Database diagram** — [DentalCare ERD](docs/DentalCare_ERD_FINAL.drawio), viewable in [diagrams.net](https://app.diagrams.net).
- **Application files** — [Routes](routes), [controllers](app/Http/Controllers), [models](app/Models), and [views](resources/views).
- **Database files** — [Migrations](database/migrations) and [seeders](database/seeders).
- **Automated tests** — Run `php artisan test`. The test suite uses in-memory SQLite.
