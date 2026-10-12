# 🦷 DentalCare - Systema Gestionis Odontologicae

Systema interretiale ad administrationem clinicam odontologicam directum, constructum cum **Laravel**, **MySQL**, et interficie **Bootstrap** (exemplar Medilab).

Propositum est centralizare curationem aegrotorum (pacientes), medicorum odontologorum, dispositionem constitutionum (citas) et curationum (tratamientos), disponens securitatem secundum rationem partium et licentiarum (roles y permisos).

---

## 🛠️ Architectura Technica

- **Backend:** Laravel (PHP)
- **Database:** MySQL
- **Frontend:** Blade Templates + Bootstrap
- **Bibliothecae Iudiciales:** SweetAlert2 & jQuery (`public/libs`)
- **Securitas & Formae:** Conformatio deletionis cum `.btn-delete` et fenestris monitionis SweetAlert2 per `@json` datas.

---

## 👥 Matrice de Permisos (Partium et Actionum)

| Modulus | Actio / Functio | Anonymus | Administrator | Notarius (Recepcionista) | Medicus (Odontólogo) | Aegrotus (Paciente) |
| :--- | :--- | :---: | :---: | :---: | :---: | :---: |
| **Ratio (Cuenta)** | Coniunctio / Ingressus (Login) | ✔ | — | — | — | — |
| | Egressus (Logout) | — | ✔ | ✔ | ✔ | ✔ |
| | Tessera mutare | — | ✔ | ✔ | ✔ | ✔ |
| | Videre profile | — | ✔ | ✔ | ✔ | ✔ |
| | Renovare profile | — | ✔ | ✔ | ✔ | ✔ |
| **Usores (Usuarios)** | Omnes videre | — | ✔ | — | — | — |
| | Creare usorem | — | ✔ | — | — | — |
| | Emendare usorem | — | ✔ | — | — | — |
| | Delere usorem | — | ✔ | — | — | — |
| **Aegroti (Pacientes)**| Omnes videre | — | ✔ | ✔ | ✔ | — |
| | Registrare | — | ✔ | ✔ | — | — |
| | Emendare | — | ✔ | ✔ | — | — |
| | Videre propria acta | — | — | — | — | ✔ |
| **Constitutiones (Citas)**| Omnes inspicere | — | ✔ | ✔ | ✔ | — |
| | Constituere novam | — | ✔ | ✔ | — | ✔ |
| | Emendare | — | ✔ | ✔ | — | — |
| | Rescindere / Abrogare| — | ✔ | ✔ | — | — |
| | Videre proprias | — | — | — | — | ✔ |
| **Curationes (Tratamientos)**| Videre curationes | — | ✔ | — | ✔ | ✔ |
| | Creare curationem | — | ✔ | — | ✔ | — |
| | Renovare statum | — | ✔ | — | ✔ | — |
| **Partes (Roles/Permisos)**| Videre partes | — | ✔ | — | — | — |
| | Creare partem | — | ✔ | — | — | — |
| | Tribuere licentias | — | ✔ | — | — | — |

---

## 🗄️ Datorum Tabulae et Entitates (Database Schema)

### 1. `roles`
*Catalogus partium aditum administrans.*
- `id_rol` (PK, INT / BIGINT)
- `nombre_rol` (VARCHAR)

### 2. `usuarios`
*Usores ad systema accessuri.*
- `id_usuario` (PK, INT / BIGINT)
- `nombre` (VARCHAR)
- `apellido` (VARCHAR)
- `correo` (VARCHAR, UNIQUE)
- `password` (VARCHAR)
- `telefono` (VARCHAR)
- `id_rol` (FK → `roles.id_rol`)

### 3. `pacientes`
*Informatio propria de aegrotis.*
- `id_paciente` (PK, INT / BIGINT)
- `id_usuario` (FK → `usuarios.id_usuario`, Relatio 1:1)
- `documento` (VARCHAR, UNIQUE)
- `fecha_nacimiento` (DATE)
- `direccion` (VARCHAR)
- `telefono` (VARCHAR)

### 4. `odontologos`
*Notitia de medicis odontologicis.*
- `id_odontologo` (PK, INT / BIGINT)
- `id_usuario` (FK → `usuarios.id_usuario`, Relatio 1:1)
- `especialidad` (VARCHAR)
- `numero_licencia` (VARCHAR)

### 5. `citas`
*Agenda constitutionum clinicarium.*
- `id_cita` (PK, INT / BIGINT)
- `id_paciente` (FK → `pacientes.id_paciente`)
- `id_odontologo` (FK → `odontologos.id_odontologo`)
- `fecha` (DATE)
- `hora` (TIME)
- `motivo` (VARCHAR)
- `estado` (ENUM: `Pendiente`, `Confirmada`, `Atendida`, `Cancelada`)

### 6. `tratamientos`
*Acta curationum clinicarium.*
- `id_tratamiento` (PK, INT / BIGINT)
- `id_paciente` (FK → `pacientes.id_paciente`)
- `id_odontologo` (FK → `odontologos.id_odontologo`)
- `nombre_tratamiento` (VARCHAR)
- `descripcion` (TEXT)
- `fecha_inicio` (DATE)
- `estado` (VARCHAR)
- `costo` (DECIMAL(10,2))

---

## 📐 Schema Connexionum (Diagramma ER)

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
