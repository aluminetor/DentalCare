# DentalCare – Project Context

This document summarizes what the project is, key design decisions, current progress, and how to continue working on it.

## 1. Overview

DentalCare is a web application for managing a **dental clinic**: patients and appointments, with dynamic users, roles, and permissions. The administrator can create roles and decide what each role is allowed to do. The receptionist registers patients and schedules appointments; the dentist views and updates their own appointments.

## 2. Stack

Laravel 13 · PHP 8.3+ · MySQL (WAMP) · Blade · Bootstrap Medicio template · Local jQuery and SweetAlert2 (`public/libs`).

## 3. Design Decisions

- **Single language (English):** The entire codebase, database schema (`patients`, `appointments`, `users`, `roles`, `permissions`, `permission_role`), models, controllers, routes, views, and validation/error messages are written in English.
- **Laravel conventions:** Primary key `id`; foreign keys `<singular_table>_id` (`role_id`, `patient_id`, `dentist_id`); `users` table with `email` for authentication; alphabetical pivot table `permission_role`.
- **Dentists are users:** A dentist is a record in `users` with the `Dentist` role. Patients do not log in.

## 4. Database Schema

| Table | Main Columns | Relationships |
| --- | --- | --- |
| `roles` | id, name (unique), description | hasMany `users`, belongsToMany `permissions` |
| `permissions` | id, code (unique, e.g. `patients.view`), name, module | belongsToMany `roles` |
| `permission_role` | role_id, permission_id (composite primary key) | pivot roles ↔ permissions |
| `users` | id, name, last_name, email (unique), password, phone, specialty, role_id | belongsTo `role`; hasMany `appointments` (as dentist) |
| `patients` | id, first_name, last_name, document (unique), phone, birth_date | hasMany `appointments` |
| `appointments` | id, patient_id, dentist_id (→ users), date, time, reason, status, notes | belongsTo `patient` and `dentist` |

## 5. Roles and Permissions

Saved roles: **Administrator, Receptionist, Dentist**. 17 permissions with `module.action` codes:

| Module | Permissions | Allowed Roles |
| --- | --- | --- |
| Users | view, create, edit, delete | Administrator |
| Roles | view, create, edit, delete, assign_permissions | Administrator |
| Patients | view, create, edit, delete | view: Admin, Receptionist, Dentist; create & edit: Admin, Receptionist; delete: Admin only |
| Appointments | view, create, edit, delete | Admin & Receptionist; Dentist views and edits only their own |

## 6. Business Rules

- Cannot delete a patient with appointments, a user with appointments, or a role with users.
- `email`, `document`, role `name`, and permission `code` must be unique.
- Appointments: statuses `Pending` → `Confirmed` → `Completed`; `Cancelled` from `Pending` or `Confirmed`. A dentist cannot have two active appointments at the same date and time, and appointments can only be assigned to users with the `Dentist` role.
