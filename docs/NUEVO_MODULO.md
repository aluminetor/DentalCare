# Cómo hacer un módulo nuevo (ejemplo: Citas)

Se copia la estructura de **Pacientes**. Cambia `Paciente/pacientes/paciente` por el nombre de tu módulo.

## 1. Modelo y migración
Ya existen (`app/Models/Cita.php` y su migración). Revisa que los campos coincidan con la hoja "Base de Datos" de la matriz. Si falta una columna, crea una migración nueva (`php artisan make:migration add_xxx_to_citas_table`); no edites las existentes.

## 2. Rutas
Copia `routes/web/pacientes.php` a `routes/web/citas.php`, cambia el controlador y los nombres (`citas.index`, `citas.create`, `citas.edit`, `citas.store`, `citas.update`, `citas.delete`) e inclúyelo en `routes/web.php`:

```php
include('web/citas.php');
```

Apenas exista la ruta `citas.index`, el menú del header enlaza solo.

## 3. Controlador
Copia `PacientesController.php` a `CitasController.php`. Tiene 6 métodos:

| Método | Qué hace |
| --- | --- |
| `index` | lista los registros |
| `create` | muestra el formulario vacío |
| `edit($id)` | muestra el formulario con los datos |
| `store` | valida y guarda uno nuevo |
| `update` | valida y guarda los cambios |
| `delete($id)` | elimina |

Cambia las reglas de validación y sus mensajes según los campos del documento. Mantén el `try/catch`, `Log::error` y los `Session::flash('message', ...)`: la ventana de éxito o error sale sola del layout.

## 4. Vistas
Copia la carpeta `resources/views/pacientes` a `resources/views/citas` y ajusta los campos. En el formulario de edición el id viaja en un `<input type="hidden" name="cita_id">`.

Para las listas desplegables (paciente, odontólogo) pasa los datos desde el controlador (`Paciente::all()`, `User::where('rol_id', ...)`) y recórrelos con `@foreach` dentro de un `<select>`.

## 5. Prueba
`php artisan serve`, abre el módulo y prueba: crear, crear con datos inválidos, editar, eliminar. Revisa `storage/logs/laravel.log` si algo falla.

## Reglas de negocio de Citas (hoja "Reglas de negocio")
- Estados: Pendiente → Confirmada → Atendida; Cancelada desde Pendiente o Confirmada.
- Un odontólogo no puede tener dos citas activas (no canceladas) a la misma fecha y hora.
- Solo se asignan citas a usuarios con rol Odontólogo.
