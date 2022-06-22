## Acerca del proyecto
 
Este proyecto es la solución a un ejercicio planteado para la prueba técnica del cargo de Desarrollador PHP Senior para la empresa Evertec.
 
## Instalaciones necesarias
 
Es necesario tener instalado los siguientes elementos para ejecutar el proyecto:
 
- [Composer](https://getcomposer.org/download/) - version 2.3.5 o superior
- [NPM](https://nodejs.org/es/download/) - version 8.12.1 o superior
- PHP 8.0.2 o superior
- Base de Datos MySQL
 
 
## Pasos para la ejecución
 
 
Primero que nada es necesario realizar la configuración de la base de datos.
Esta configuración se encuentra en el archivo *.env* del proyecto
 
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=evertec-app
DB_USERNAME=root
DB_PASSWORD=
```
 
Después de configurada la conexión a la base de datos es necesario ejecutar los siguientes comandos.
Esto con la intención de generar los archivos necesarios para la ejecución del proyecto.
 
```bash
npm install
 
npm run production
```
 
```bash
composer install
 
composer update // En caso de que se solicite un update
```
 
Siguiente a esto generamos las migraciones necesarias de la base de datos para el correcto funcionamiento del proyecto.
 
```bash
php artisan migrate
```
El siguiente comando genera los datos por defecto del proyecto.
 
```bash
php artisan migrate --seed
```
 
Al finalizar con los comandos anteriores se inicia el proyecto con el siguiente comando.
 
```bash
php artisan serve
```
 
## Nota importante
 
En este proyecto no existe sistema de registro e inicio de sesión para los compradores, sólo para los administradores, por ende la url de login no se encuentra accesible por medio de algún botón. Para acceder al dashboard de administrador se utiliza url de login.
[http://localhost:8000/login](http://localhost:8000/login)
 
Después del login se redirecciona al dashboard principal del administrador.
 
Los datos del administrador creado son:
- Correo: admin@admin.com
- Contraseña: Evertec.2022*
 
Las compras se pueden realizar sin registrarse o iniciar sesión, solo con los datos básicos se puede realizar una compra. El rastreo de las órdenes se realiza mediante el botón superior derecho del navbar.
 
## Links de interés dentro del aplicativo
 
- [Login Administrador](http://localhost:8000/login)
- [Dashboard Administrador](http://localhost:8000/admin/dashboard)
- [Listado de ordenes](http://localhost:8000/order/index)
- [Rastreo de ordenes](http://localhost:8000/order/track)
 
 
## License
 
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

