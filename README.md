# Challenge en Laravel para Andreani Hop

## Requisitos del servicio

Aplicación basada en laravel ^9.19, Apache 2.4, PHP 8.0.2, MySQL 8, Composer 2.2.6.

## Virtualhost

Para este ejemplo el virtualhost creado es http://localhost:8000

## Configuración

### Requerimientos

1. PHP
2. MySQL database
3. Composer

## Instalación:

1. Clonar el repositorio:

```bash
git clone git@github.com:ncolman94/challengeHop.git
```

2. Una vez clonado el repositorio, crear una base de datos Mysql con el nombre `challengeHop`.

3. copiar el contenido del archivo .env.example en el archivo .env y editar el archivo de configuración, particularmente la configuración de Mysql.

```bash
cp .env.example .env
```

4. Ejecutar el siguiente comando.

```bash
composer install
```

### Migrar la base de datos:

5. Correr las migraciones para crear las tablas de `vehicles` y `starship`.

```bash
php artisan migrate
```

### Sembrar la base de datos:

6. Para rellenar las tablas con los datos de la APi debemos correr los siguientes comandos:

```bash
php artisan db:seed --class=VehiclesSeeder
php artisan db:seed --class=StarshipsSeeder
```

### Crear la llave de encriptación:

6. Para poder consumir la API debemos generar la key:

```bash
php artisan key:generate
```

Listo. Ya se puede consumir la API con Postman.

```code
GET http://localhost:8000/api/vehicles
GET http://localhost:8000/api/vehicles/{id}/inventory
POST http://localhost:8000/api/vehicles/{id}/inventory
PUT http://localhost:8000/api/vehicles/{id}/inventory
PUT http://localhost:8000/api/vehicles/{id}/inventory/increment
PUT http://localhost:8000/api/vehicles/{id}/inventory/decrement

GET http://localhost:8000/api/starships
GET http://localhost:8000/api/starships/{id}/inventory
POST http://localhost:8000/api/starships/{id}/inventory
PUT http://localhost:8000/api/starships/{id}/inventory
PUT http://localhost:8000/api/starships/{id}/inventory/increment
PUT http://localhost:8000/api/starships/{id}/inventory/decrement
```

El modelo de respuesta al correr por ejemplo "http://localhost:8000/api/vehicles" será:

```javascript
{
    {
        "data": {
        "count": 39,
            "next": "https://swapi.dev/api/vehicles/?page=2",
            "previous": null,
            "results": [...
                "count" : 2
            ]
        }
    }
}
```
#
