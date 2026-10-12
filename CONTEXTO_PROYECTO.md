# DentalCare – Contexto del proyecto

Este documento resume qué es el proyecto, qué se decidió, qué ya está hecho y cómo seguir. **Sirve para guiarse, para pasárselo a una IA como contexto y como base de la sustentación.**

## 1. Qué es

DentalCare es una aplicación web para gestionar una **clínica odontológica**: pacientes y citas, con usuarios, roles y permisos dinámicos. El administrador puede crear roles y decidir qué puede hacer cada uno. La recepción registra pacientes y agenda citas; el odontólogo consulta y actualiza las suyas.

Se pensó "real y completa, pero sencilla", ajustada a una materia de 2 horas semanales: **2 CRUD propios (Pacientes y Citas) + usuarios, roles y permisos**.

## 2. Requisitos del profesor (primera entrega)

- Proyecto Laravel con el CRUD de al menos una entidad.
- Base de datos MySQL.
- Front con plantilla Bootstrap.
- Código en GitHub (ramas por persona, Pull Request, repo público durante la calificación). El profesor mide las líneas de código de cada estudiante.
- Sustentación en grupo.

## 3. Stack

Laravel 13 · PHP 8.3 o superior · MySQL (WAMP) · Blade · plantilla Bootstrap Medicio · jQuery y SweetAlert2 locales (`public/libs`).

## 4. Decisiones de diseño

- **Un solo idioma:** el dominio va en español (`pacientes`, `citas`, `fecha`, `motivo`); lo que exige Laravel se queda como es (`users`, `email`, `password`, `id`, `created_at`). Todo lo que ve el usuario va en español.
- **Convenciones de Laravel:** llave primaria `id`; llaves foráneas `<tabla en singular>_id` (`rol_id`, `paciente_id`); tabla `users` con `email` para el inicio de sesión; tabla pivote `permiso_rol` (orden alfabético).
- **El odontólogo no es una tabla aparte:** es un usuario (`users`) con rol Odontólogo. Los pacientes no inician sesión.
- **Fuera del alcance (ampliaciones futuras):** acceso de pacientes al sistema, tratamientos e historia clínica, pagos y facturación.
- **Patrón del profesor:** rutas por módulo, controlador con 6 métodos, `Validator::make` con mensajes en español, `try/catch` con `Log::error`, mensajes con `Session::flash`, alertas con SweetAlert2.

## 5. Base de datos (6 tablas + 1 de Laravel)

| Tabla | Campos principales | Relaciones |
| --- | --- | --- |
| `roles` | id, nombre (único), descripcion | tiene muchos `users` y muchos `permisos` |
| `permisos` | id, codigo (único, ej. `pacientes.ver`), nombre, modulo | pertenece a muchos `roles` |
| `permiso_rol` | rol_id, permiso_id (llave compuesta) | pivote roles ↔ permisos |
| `users` | id, name, apellido, email (único), password, telefono, especialidad, rol_id | pertenece a un `rol`; tiene muchas `citas` (como odontólogo) |
| `pacientes` | id, nombre, apellido, documento (único), telefono, fecha_nacimiento | tiene muchas `citas` |
| `citas` | id, paciente_id, odontologo_id (→ users), fecha, hora, motivo, estado, observaciones | pertenece a un paciente y a un odontólogo |
| `password_reset_tokens` | email, token, created_at | tabla estándar de Laravel |

El detalle completo está en `docs/DentalCare_Matriz_Permisos_FINAL.xlsx` (hoja "Base de Datos") y el diagrama en `docs/DentalCare_ERD_FINAL.drawio` (se abre en https://app.diagrams.net). **Si el código contradice esos documentos, mandan los documentos.**

## 6. Roles y permisos

Roles guardados: **Administrador, Recepcionista, Odontólogo**. El Anónimo no es un rol guardado: es quien no ha iniciado sesión. 17 permisos con código `modulo.accion`:

| Módulo | Permisos | Quién |
| --- | --- | --- |
| Usuarios | ver, crear, editar, eliminar | Administrador |
| Roles | ver, crear, editar, eliminar, asignar_permisos | Administrador |
| Pacientes | ver, registrar, editar, eliminar | ver: Admin, Recepción y Odontólogo; registrar y editar: Admin y Recepción; eliminar: solo Admin |
| Citas | ver, crear, editar, eliminar | Admin y Recepción; el Odontólogo ve y edita solo las suyas |

Las funciones de Cuenta (iniciar y cerrar sesión, cambiar contraseña, ver y actualizar el perfil, recuperar contraseña) no se guardan como permisos.

## 7. Reglas de negocio importantes

- No se elimina un paciente que tenga citas, ni un usuario con citas, ni un rol con usuarios.
- `email`, `documento`, nombre de rol y código de permiso no se pueden repetir.
- Citas: estados Pendiente → Confirmada → Atendida; Cancelada desde Pendiente o Confirmada. Un odontólogo no puede tener dos citas activas a la misma fecha y hora, y las citas solo se asignan a usuarios con rol Odontólogo.
- La contraseña se guarda cifrada. Toda función se valida en el servidor, no solo ocultando botones.

## 8. Estado actual

| Módulo | Estado |
| --- | --- |
| Base de datos (migraciones, modelos, seeder) | ✅ completa |
| Layout (menú, jQuery, SweetAlert2, mensajes y errores) | ✅ listo |
| **Pacientes** | ✅ CRUD completo (módulo de referencia) |
| Citas | 🟡 solo maqueta de vistas |
| Usuarios | 🟡 solo maqueta de vistas |
| Roles y permisos | 🟡 solo maqueta de vistas |
| Login y permisos por rol | ⏳ cuando el profesor lo explique |

Datos de prueba (`php artisan migrate --seed`), contraseña `password`: `admin@dentalcare.test` (Administrador), `recepcion@dentalcare.test` (Recepcionista), `odontologo@dentalcare.test` (Odontólogo), más 3 pacientes de ejemplo.

## 9. Estructura del código

| Qué | Dónde |
| --- | --- |
| Rutas (un archivo por módulo) | `routes/web/<modulo>.php`, incluidas en `routes/web.php` |
| Controladores | `app/Http/Controllers/<Modulo>Controller.php` |
| Modelos | `app/Models` |
| Migraciones y datos iniciales | `database/migrations`, `database/seeders/DatabaseSeeder.php` |
| Vistas | `resources/views/<modulo>/{index,create,edit}.blade.php` |
| Layout | `resources/views/layouts` |

## 10. Cómo seguir (para cada integrante)

1. Instalar siguiendo `docs/INSTALACION.md` (PHP 8.3+, MySQL con WAMP, Composer, Git). Pasos rápidos: `composer install`, `copy .env.example .env`, `php artisan key:generate`, crear la base `dentalcare` en phpMyAdmin, `php artisan migrate --seed`, `php artisan serve`.
2. `git checkout main`, `git pull`, y crear su rama: `git checkout -b dev-<nombre>`.
3. Hacer **solo su módulo**, copiando el patrón de Pacientes (`docs/NUEVO_MODULO.md`): ruta, controlador de 6 métodos, 3 vistas.
4. Commits pequeños y claros; `git push -u origin dev-<nombre>` y Pull Request hacia `main`.
5. No editar migraciones existentes (si falta una columna, crear una migración nueva) y avisar al grupo antes de tocar archivos compartidos (`layouts`, `routes/web.php`).

## 11. Instrucciones para una IA que ayude con el código

> Estás ayudando con un proyecto Laravel 13 / PHP 8.3 / MySQL llamado DentalCare. Antes de escribir código, lee `README.md`, `docs/NUEVO_MODULO.md` y `app/Http/Controllers/PacientesController.php` (módulo de referencia). Reglas: copia exactamente su estructura (rutas en `routes/web/<modulo>.php` con nombres `<modulo>.index|create|edit|store|update|delete`, controlador con 6 métodos, `Validator::make` con mensajes en español, `try/catch` con `Log::error`, `Session::flash('message', ['content' => ..., 'type' => 'success|error'])`, vistas `index/create/edit` con `@extends('layouts.app')` y `@push('scripts')`). Nombres del dominio en español, convenciones de Laravel para lo demás. Los campos salen de `docs/DentalCare_Matriz_Permisos_FINAL.xlsx` (hoja "Base de Datos") y las reglas de la hoja "Reglas de negocio". No modifiques migraciones existentes, no agregues paquetes ni cambies el layout sin avisar. Explica los cambios en lenguaje simple: quien programa debe poder sustentarlo.

## 12. Guion para la sustentación

1. **Problema y alcance:** clínica odontológica; pacientes, citas, usuarios, roles y permisos. Por qué se recortó el alcance.
2. **Diseño:** ERD y matriz de permisos; decisión de usar convenciones de Laravel; el odontólogo como usuario con rol.
3. **Arquitectura:** patrón rutas → controlador → modelo (Eloquent) → vista (Blade); migraciones y seeders.
4. **Demostración:** crear un paciente, probar validaciones, editar, eliminar con confirmación, y la regla de no borrar pacientes con citas.
5. **Trabajo en equipo:** ramas por persona, Pull Requests, quién hizo qué módulo.
6. **Siguientes pasos:** Citas, Usuarios, Roles, login y permisos por rol, y las ampliaciones futuras.

> Cada integrante debe poder explicar **su propio módulo línea por línea** (qué hace cada método del controlador, qué validan las reglas, de dónde sale cada mensaje). Si se usa IA para generarlo, hay que entender el resultado antes de entregarlo.
