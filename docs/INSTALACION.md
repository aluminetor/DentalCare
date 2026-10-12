# Instalación desde cero (Windows)

Para correr el proyecto necesitas 4 cosas: **PHP 8.3 o superior**, **MySQL**, **Composer** y **Git**. Todos los comandos se escriben en **PowerShell**.

## 1. PHP + MySQL (WAMP)

Es lo que se usa en clase. Instala **WAMP** (https://www.wampserver.com), que trae Apache, PHP y MySQL (con phpMyAdmin) en un solo instalador. Cuando termine, abre WAMP y espera a que el icono de la barra de tareas se ponga **verde**.

Verifica la versión de PHP: icono de WAMP → *PHP* → *Versión*; debe ser 8.3 o superior (si no, WAMP permite instalar otra versión desde su sitio).

### Que PowerShell encuentre `php`
Agrega la carpeta de PHP al PATH. Está en algo como `C:\wamp64\bin\php\php8.3.x` (ajusta `x` a tu versión). Búscalo en *Editar las variables de entorno del sistema → Variables de entorno → Path → Editar → Nuevo*. Cierra y abre PowerShell y prueba:

```powershell
php -v
```

### Drivers de MySQL en el PHP de consola
WAMP tiene un `php.ini` para Apache y **otro para la consola** (el de la carpeta de PHP, `php.ini` o `php.ini-development` copiado como `php.ini`). En ese archivo deben estar activas (sin `;` al inicio) estas líneas:

```
extension=pdo_mysql
extension=mbstring
extension=openssl
extension=fileinfo
extension=curl
```

Comprueba con `php -m` que `pdo_mysql` aparece en la lista.

## 2. Composer

Descarga e instala **Composer-Setup.exe** desde https://getcomposer.org/download/ (que use el PHP que acabas de instalar). Prueba:

```powershell
composer -V
```

## 3. Git

Instala Git desde https://git-scm.com/download/win (todo por defecto). Configura tu nombre y correo, los mismos de tu cuenta de GitHub:

```powershell
git config --global user.name "Tu Nombre"
git config --global user.email "tucorreo@ejemplo.com"
```

## 4. Clonar y arrancar el proyecto

```powershell
git clone https://github.com/aluminetor/DentalCare.git
cd DentalCare
composer install
copy .env.example .env
php artisan key:generate
```

## 5. Crear la base de datos

Con WAMP en verde abre http://localhost/phpmyadmin (usuario `root`, contraseña vacía) → **Nueva** → nombre `dentalcare` → cotejamiento `utf8mb4_general_ci` → **Crear**.

Si tu MySQL tiene contraseña para `root`, ponla en el archivo `.env` en `DB_PASSWORD=`.

## 6. Tablas, datos de prueba y servidor

```powershell
php artisan migrate --seed
php artisan serve
```

Abre http://localhost:8000.

## Problemas frecuentes

| Mensaje | Qué hacer |
| --- | --- |
| `php no se reconoce como comando` | PHP no está en el PATH (paso 1). Cierra y abre PowerShell. |
| `could not find driver` | Falta `pdo_mysql` en el `php.ini` de la consola (paso 1). |
| `Access denied for user 'root'` | La contraseña de `.env` no es la de tu MySQL. |
| `Unknown database 'dentalcare'` | No creaste la base de datos (paso 5). |
| `Connection refused` | WAMP no está en verde: inícialo y espera. |
| `Your lock file does not contain a compatible set of packages` | Tu PHP es menor a 8.3. Actualízalo (paso 1). |
| `No application encryption key has been specified` | Falta `php artisan key:generate`. |
| La página sale sin estilos | Entra por `php artisan serve` (http://localhost:8000), no por la carpeta de WAMP. |
