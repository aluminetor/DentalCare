# How to Create a New Module (Example: Appointments)

Follow the structure of the **Patients** reference module (`PatientsController`).

## 1. Model and Migration
Verify that the model (`app/Models/Appointment.php`) and its migration match the database specification.

## 2. Routes
Create `routes/web/appointments.php` with route names `appointments.index`, `appointments.create`, `appointments.edit`, `appointments.store`, `appointments.update`, and `appointments.delete`, and require it in `routes/web.php`.

## 3. Controller
Create `AppointmentsController.php` with standard CRUD methods (`index`, `create`, `edit`, `store`, `update`, `delete`/`destroy`), English validation rules and messages, and flash notifications.

## 4. Views
Create `resources/views/appointments/{index,create,edit}.blade.php` extending `layouts.app`.

## 5. Business Rules for Appointments
- Statuses: `Pending` → `Confirmed` → `Completed`; `Cancelled` from `Pending` or `Confirmed`.
- A dentist cannot have two active (non-cancelled) appointments on the same date and time.
- Appointments can only be assigned to users with the `Dentist` role.
