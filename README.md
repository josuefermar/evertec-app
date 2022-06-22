## Acerca del proyecto

Este proyecto es la solucion a un ejercicio planteado para la prueba tecnica del cargo de
desarrollador PHP Senior para la empresa Evertec.

## Instalaciones necesarias

Es necesario tener instalado los siguientes elementos para ejecutar el proyecto:

- [Composer](https://getcomposer.org/download/)
- [NPM](https://nodejs.org/es/download/)

Ademas de esto es pertinente tener una base de datos MySQL.

## Pasos para la ejecucion


Primero que nada es necesario realizar la configuracion de la base de datos.
Esta configuracion se encuentra en el archivo * *.env* * del proyecto

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=evertec-app
DB_USERNAME=root
DB_PASSWORD=
```

Despues de configurada la base de datos es necesario ejecutar los siguientes comandos.

```bash
npm run production
```

```bash
php artisan migrate
```

```bash
php artisan migrate --seed
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
