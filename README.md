# Prueba conocimiento MVC

## Backend Control de acceso ROOM 911

### Configuración de proyecto en local

# Requisitos previos

-   Asegurese de tener PHP instalado en su equipo
-   Asegurese de tener Laravel en su equipo
-   Asegurese de tener un servidor apache o de base de datos para gestionar la misma.
-   Asegurese de tener la extensión soap habilitada en su archivo php.ini

# Siguientes pasos

-   git clone https://github.com/jairzea/room-911.git
-   cd /carpeta-proyecto
-   Cree una base de datos en su servidor

# Configuración de variables de entonro

-   Especifique los datos de conexión de la base de datos creada en el archivo .env.example

```HTML
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

-   Guarde el archivo .env.example como .env

-   ejecute en la terminal los siguientes comandos

## `composer install`

## `php artisan key:generate`

## `php artisan migrate`

_php artisan migrate reconstruirá toda la base de datos con algunos datos de prueba en la tablas: de departments y roles._

_Si existe algún inconveniente al migrar la base de datos, puede tomar el archivo room-911.sql en el directorio /database eh importarlo_

## `php artisan passport:install`

_Cada vez que realice una migración debera ejecutar el comando anterior_

## `php artisan serve` Para ejecutar la aplicación

-   El comando anterior correra la aplicación en el dominio local: http://127.0.0.1:8000

-   Recuerde actualizar el dominio principal en las variables de entorno de la aplicación frontend: room-911-front: https://github.com/jairzea/room-911-front

## Demo de la aplicacion

http://test.asstiseguridadsocial.com/

## Documentación de la api

-   El proyecto utiliza swagger para documentar la API, en el siguiente enlace puede acceder a esta documentación para su revisión.

https://servicios.asstiseguridadsocial.com/api/documentation#/
