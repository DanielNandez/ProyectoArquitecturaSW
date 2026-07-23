# Proyecto Laravel con Docker

Este repositorio contiene una aplicación Laravel configurada para ejecutarse en Docker usando el servidor incorporado de Laravel (`php artisan serve`) en lugar de un servidor web externo.

## Qué se hizo

1. Se creó un `Dockerfile` para el servicio Laravel:
   - Base: `php:8.4-cli`
   - Instalación de dependencias del sistema (`git`, `unzip`, `libzip-dev`, `libpng-dev`, `libonig-dev`)
   - Instalación de extensiones PHP: `pdo`, `pdo_mysql`, `zip`
   - Instalación de Composer
   - Copia del código del proyecto
   - Creación de `.env` desde `.env.example` si no existe
   - Ejecución de `composer install`
   - Exposición del puerto `8000`
   - Comando de arranque: `php artisan serve --host=0.0.0.0 --port=8000`

2. Se actualizó `docker-compose.yml` para incluir tres servicios:
   - `app`: contenedor Laravel construido desde el `Dockerfile`
   - `mysql`: servidor MySQL estándar
   - `phpmyadmin`: interfaz web para administrar MySQL

3. Se ajustó la configuración de base de datos en `.env`:
   - `DB_HOST=mysql`
   - `DB_DATABASE=apiPrueba`
   - `DB_USERNAME=root`
   - `DB_PASSWORD=1234`

4. Se creó la base de datos `apiPrueba` en MySQL y se aplicaron las migraciones.

## Servicios disponibles

- Aplicación Laravel: `http://localhost:8000`
- phpMyAdmin: `http://localhost:8080`

## Comandos principales

Construir y arrancar el stack:

```bash
docker compose up --build -d
```

Verificar el estado de los servicios:

```bash
docker compose ps
```

Ver logs de la aplicación:

```bash
docker compose logs --tail 20 app
```

Ver el estado de las migraciones:

```bash
docker compose exec app php artisan migrate:status
```

Ejecutar migraciones:

```bash
docker compose exec app php artisan migrate --force
```

## Resultado final

- El contenedor Laravel se construyó y arrancó correctamente.
- La aplicación Laravel está sirviendo en `http://localhost:8000`.
- La migración `2026_07_23_010731_create_usuario_table` se aplicó correctamente.
- MySQL y phpMyAdmin están disponibles y configurados para la aplicación.

## Notas

- El contenedor MySQL crea la base de datos `apiPrueba` automáticamente.
- El contenedor Laravel usa el servidor embebido de Laravel en lugar de `nginx` o `apache`.
