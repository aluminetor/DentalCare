# 🦷 DentalCare - Sistema de Gestión Odontológica

DentalCare es una aplicación web para la administración básica de una clínica odontológica. Permite gestionar pacientes, odontólogos, citas, tratamientos e historias clínicas mediante un esquema controlado de roles y permisos.

---

## 🛠️ Stack Tecnológico

- **Backend:** Laravel (PHP)
- **Base de Datos:** MySQL
- **Frontend:** Laravel Blade + Plantilla Bootstrap (estilo Medilab)
- **Librerías Locales:** SweetAlert2 y jQuery (`public/libs`)
- **Control de Flujo:** Confirmación de eliminación mediante clase `.btn-delete`, alertas de sesión y manejo de validaciones pasadas con `@json`.

---

## 👥 Matriz de Roles y Permisos

Control de acceso a las funciones del sistema según el rol del usuario:

| Módulo | Función | Anónimo | Administrador | Recepcionista | Odontólogo | Paciente |
| :--- | :--- | :---: | :---: | :---: | :---: | :---: |
| **Cuenta** | Iniciar sesión | ✔ | — | — | — | — |
| | Cerrar sesión | — | ✔ | ✔ | ✔ | ✔ |
| | Cambiar contraseña | — | ✔ | ✔ | ✔ | ✔ |
| | Ver mi perfil | — | ✔ | ✔ | ✔ | ✔ |
| | Actualizar mi perfil | — | ✔ | ✔ | ✔ | ✔ |
| **Usuarios** | Ver usuarios | — | ✔ | — | — | — |
| | Crear usuario | — | ✔ | — | — | — |
| | Editar usuario | — | ✔ | — | — | — |
| | Eliminar usuario | — | ✔ | — | — | — |
| **Pacientes** | Ver pacientes | — | ✔ | ✔ | ✔ | — |
| | Registrar paciente | — | ✔ | ✔ | — | — |
| | Editar paciente | — | ✔ | ✔ | — | — |
| | Ver mis datos | — | — | — | — | ✔ |
| **Citas** | Ver todas las citas | — | ✔ | ✔ | ✔ | — |
| | Crear cita | — | ✔ | ✔ | — | ✔ |
| | Editar cita | — | ✔ | ✔ | — | — |
| | Cancelar cita | — | ✔ | ✔ | — | ✔ |
| | Ver mis citas | — | — | — | — | ✔ |
| **Tratamientos** | Ver tratamientos | — | ✔ | — | ✔ | ✔ |
| | Crear tratamiento | — | ✔ | — | ✔ | — |
| | Actualizar tratamiento | — | ✔ | — | ✔ | — |
| **Roles y Permisos** | Ver roles | — | ✔ | — | — | — |
| | Crear rol | — | ✔ | — | — | — |
| | Asignar permisos | — | ✔ | — | — | — |

---

## 🗄️ Entidades y Tablas de la Base de Datos

### 1. `roles`
*Catálogo de roles del sistema.*
- `id_rol` (PK): Identificador único del rol.
- `nombre_rol` (VARCHAR): Nombre del rol (Administrador, Recepcionista, Odontólogo, Paciente).

### 2. `usuarios`
*Credenciales y datos generales de acceso.*
- `id_usuario` (PK): Identificador único del usuario.
- `nombre` (VARCHAR): Nombre de la persona.
- `apellido` (VARCHAR): Apellido de la persona.
- `correo` (VARCHAR): Correo electrónico (inicio de sesión).
- `password` (VARCHAR): Contraseña encriptada.
- `telefono` (VARCHAR): Número telefónico de contacto.
- `id_rol` (FK → `roles.id_rol`): Rol asignado.

### 3. `pacientes`
*Información clínica y personal de los pacientes.*
- `id_paciente` (PK): Identificador del paciente.
- `id_usuario` (FK → `usuarios.id_usuario`): Relación directa con el usuario del sistema.
- `documento` (VARCHAR): Documento de identidad.
- `fecha_nacimiento` (DATE): Fecha de nacimiento.
- `direccion` (VARCHAR): Dirección de residencia.
- `telefono` (VARCHAR): Teléfono personal o secundario.

### 4. `odontologos`
*Datos profesionales del personal odontológico.*
- `id_odontologo` (PK): Identificador del profesional.
- `id_usuario` (FK → `usuarios.id_usuario`): Relación directa con el usuario del sistema.
- `especialidad` (VARCHAR): Área odontológica (Ortodoncia, Endodoncia, General, etc.).
- `numero_licencia` (VARCHAR): Registro o tarjeta profesional.

### 5. `citas`
*Gestión de agendamiento y turnos.*
- `id_cita` (PK): Identificador de la cita médica.
- `id_paciente` (FK → `pacientes.id_paciente`): Paciente que solicita la cita.
- `id_odontologo` (FK → `odontologos.id_odontologo`): Doctor asignado.
- `fecha` (DATE): Fecha de la consulta.
- `hora` (TIME): Hora programada.
- `motivo` (VARCHAR): Motivo de la atención.
- `estado` (VARCHAR / ENUM): Estado actual (`Pendiente`, `Confirmada`, `Atendida`, `Cancelada`).

### 6. `tratamientos`
*Historial de procedimientos y costos.*
- `id_tratamiento` (PK): Identificador del tratamiento.
- `id_paciente` (FK → `pacientes.id_paciente`): Paciente receptor del tratamiento.
- `id_odontologo` (FK → `odontologos.id_odontologo`): Doctor responsable del tratamiento.
- `nombre_tratamiento` (VARCHAR): Procedimiento (ej. Limpieza profunda, Calza, Ortodoncia).
- `descripcion` (TEXT): Detalles del procedimiento.
- `fecha_inicio` (DATE): Fecha de inicio del tratamiento.
- `estado` (VARCHAR): Progreso o estado del tratamiento.
- `costo` (DECIMAL): Valor económico del tratamiento.

---

## 📐 Diagrama Entidad - Relación (DER)

Estructura de cardinalidades:

```text
       [ ROL ]
          │ 1
          │
          │ N
      [ USUARIO ]
      ┌───┴───┐
   1  │       │  1
      ▼       ▼
 [ PACIENTE ] [ ODONTÓLOGO ]
   │       │       │       │
 1 │     1 │     1 │     1 │
   ▼       └───────┼───────┘
 [ CITA ]          │ N
   (N)             ▼
             [ TRATAMIENTO ]
