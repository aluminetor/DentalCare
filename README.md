# DentalCare · Sistema de gestión odontológica

DentalCare es una aplicación web desarrollada con Laravel para gestionar los pacientes y las citas de una clínica odontológica. El personal de recepción registra pacientes y agenda citas. Los odontólogos consultan las citas que tienen asignadas y registran el resultado de cada atención.

## Funcionalidades del MVP

| Módulo | Funciones disponibles |
| --- | --- |
| Cuenta | Iniciar y cerrar sesión. |
| Pacientes | Consultar el listado, registrar, editar y eliminar pacientes según los permisos del usuario. |
| Citas | Consultar el listado, agendar, editar y eliminar citas según los permisos del usuario. Los odontólogos solo pueden ver y editar las citas que tienen asignadas. Una cita activa impide agendar otra para el mismo odontólogo en la misma fecha y hora. |
| Usuarios | Consultar el listado, crear, editar y eliminar cuentas de usuario. Al gestionar una cuenta se le puede asignar un rol existente. |
| Roles y permisos | Consultar el listado, crear, editar y eliminar roles. Los permisos de cada módulo se asignan en el formulario del rol. Para eliminar un rol, primero hay que retirar o reasignar a sus usuarios. |

La [matriz de permisos](docs/DentalCare_Matriz_Permisos_FINAL.xlsx) reúne las 19 funcionalidades disponibles para la demostración del MVP, los permisos iniciales de cada rol y las reglas de negocio.

## Instalación local

Necesitas **PHP 8.3 o superior**, Composer, MySQL y Git. Si usas Windows con WAMP, consulta la [guía de instalación](docs/INSTALACION.md).

1. En PowerShell, ejecuta estos comandos desde la raíz del proyecto recién clonado.

   ```powershell
   composer install
   Copy-Item .env.example .env
   php artisan key:generate
   ```

2. Crea una base de datos MySQL vacía llamada `dentalcare` y ajusta las variables `DB_*` del archivo `.env` a la configuración de tu instancia local.
3. Configura la base de datos e inicia el servidor con estos comandos.

   ```powershell
   php artisan migrate --seed
   php artisan serve
   ```

4. Abre [localhost:8000](http://localhost:8000) e inicia sesión con una cuenta de prueba.

### Cuentas de prueba

Los datos iniciales incluyen tres roles, 17 permisos, tres usuarios de prueba y tres pacientes de ejemplo. La contraseña inicial de las tres cuentas de prueba es `password`.

| Rol | Correo electrónico | Acceso inicial |
| --- | --- | --- |
| Administrador | `admin@dentalcare.test` | Gestionar usuarios, roles, pacientes y citas. |
| Recepcionista | `reception@dentalcare.test` | Consultar, registrar y editar pacientes. Consultar, agendar, editar y eliminar citas. |
| Odontólogo | `dentist@dentalcare.test` | Consultar pacientes. Ver y editar las citas que tiene asignadas. |

## Validación del MVP

1. Abre la [matriz de permisos](docs/DentalCare_Matriz_Permisos_FINAL.xlsx) y muestra las funciones y los roles que pueden realizarlas.
2. Inicia sesión como recepcionista. Registra un paciente de prueba, actualiza uno de sus datos y agenda una cita. Selecciona al paciente y al odontólogo de prueba en el formulario. Guarda y muestra la cita en el listado.
3. Cierra sesión y entra con la cuenta del odontólogo que seleccionaste. Abre la cita asignada, cambia su estado a `Confirmed` y luego a `Completed`. Guarda una observación de ejemplo. Vuelve a abrir la edición de la cita para mostrar el estado final y la observación en el campo `Notes`.
4. Inicia sesión como administrador. Crea un rol temporal, asígnale el permiso `View patients` y vincúlalo con una cuenta de prueba. Entra con esa cuenta para comprobar que puede abrir el listado de pacientes. Usa registros temporales para demostrar la edición y la eliminación en los módulos de administración.
5. Usa otro paciente y otra cita de prueba para demostrar la eliminación. Elimina primero la cita y luego el paciente desde la cuenta de administrador. Conserva la cita completada para el cierre de la demostración.

## Referencias del proyecto

- **Tecnologías.** Laravel 13, PHP, MySQL, Blade, Bootstrap (Medicio), jQuery y SweetAlert2.
- **Base de datos.** [Diagrama entidad-relación de DentalCare](docs/DentalCare_ERD_FINAL.drawio), que se puede abrir en [diagrams.net](https://app.diagrams.net).
- **Aplicación.** [Rutas](routes), [controladores](app/Http/Controllers), [modelos](app/Models) y [vistas](resources/views).
- **Datos iniciales.** [Migraciones](database/migrations) y [archivos de carga de datos de prueba](database/seeders).
- **Pruebas automatizadas.** Ejecuta `php artisan test`. La suite utiliza SQLite en memoria.
