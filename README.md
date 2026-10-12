# DentalCare – Sistema de Gestión Odontológica

Aplicación web para gestionar **pacientes y citas** de una clínica odontológica, con usuarios, roles y permisos dinámicos.
Proyecto grupal de la materia de PHP (Laravel + MySQL + Bootstrap).

> Los documentos de diseño están en [`docs/`](docs): la **matriz de permisos** (`.xlsx`, con la base de datos y las reglas de negocio) y el **diagrama ERD** (`.drawio`, se abre en https://app.diagrams.net). **Si algo del código contradice esos documentos, mandan los documentos.**

## Stack

Laravel 13 · PHP 8.3 o superior · MySQL · Blade · plantilla Bootstrap (Medicio) · jQuery y SweetAlert2 locales (`public/libs`).

## Instalación (la primera vez)

Necesitas PHP 8.3+, Composer, MySQL y Git. Guía completa para Windows, paso a paso: [`docs/INSTALACION.md`](docs/INSTALACION.md).

Con todo instalado, en PowerShell, dentro de la carpeta del proyecto:

```powershell
composer install
copy .env.example .env
php artisan key:generate
# crea una base de datos vacía llamada "dentalcare" en MySQL (phpMyAdmin o consola)
php artisan migrate --seed
php artisan serve
```

Abre http://localhost:8000 y entra a **Pacientes** en el menú.

`php artisan migrate --seed` crea las tablas y carga: los 3 roles, los 17 permisos (según la matriz), 3 usuarios de prueba y 3 pacientes de ejemplo. Los usuarios (contraseña `password`):

| Rol | Correo |
| --- | --- |
| Administrador | admin@dentalcare.test |
| Recepcionista | recepcion@dentalcare.test |
| Odontólogo | odontologo@dentalcare.test |

Para volver a empezar de cero la base de datos: `php artisan migrate:fresh --seed`.

## Estado de los módulos

| Módulo | Estado | Responsable |
| --- | --- | --- |
| Pacientes | ✅ CRUD completo (módulo de referencia) | — |
| Citas | 🟡 solo maqueta de vistas | |
| Usuarios | 🟡 solo maqueta de vistas | |
| Roles y permisos | 🟡 solo maqueta de vistas | |
| Login / permisos por rol | ⏳ se hace cuando el profe lo explique | |

La base de datos (migraciones y modelos) **ya está completa** para todos los módulos: nadie tiene que crear tablas, solo el controlador, las rutas y las vistas.

## Cómo está organizado

| Qué | Dónde |
| --- | --- |
| Rutas, un archivo por módulo | `routes/web/<modulo>.php` (se incluyen en `routes/web.php`) |
| Controladores | `app/Http/Controllers/<Modulo>Controller.php` |
| Modelos | `app/Models` |
| Migraciones y datos iniciales | `database/migrations`, `database/seeders/DatabaseSeeder.php` |
| Vistas | `resources/views/<modulo>/{index,create,edit}.blade.php` |
| Layout (menú, scripts, mensajes) | `resources/views/layouts` |

Nombres: el dominio va en español (`pacientes`, `citas`, `fecha`, `motivo`) y lo que exige Laravel se queda como es (`users`, `email`, `id`, `created_at`). Las llaves foráneas son `<tabla en singular>_id` (`rol_id`, `paciente_id`). Todo lo que ve el usuario va en español.

## Cómo hacer un módulo nuevo

Copia el patrón de **Pacientes**. Pasos en [`docs/NUEVO_MODULO.md`](docs/NUEVO_MODULO.md).

## Flujo de trabajo con Git

1. `git checkout main` y `git pull` (siempre antes de empezar).
2. Crea tu rama: `git checkout -b dev-tunombre`.
3. Trabaja **solo en tu módulo** y haz commits pequeños con mensajes claros.
4. `git push -u origin dev-tunombre` y abre un Pull Request hacia `main`.
5. Alguien lo revisa y se hace el merge. Después, todos hacen `git pull` en `main`.

Si tocas archivos compartidos (`layouts`, `routes/web.php`, migraciones existentes), avisa al grupo antes. Las migraciones ya creadas no se editan: si falta una columna, se crea una migración nueva.
