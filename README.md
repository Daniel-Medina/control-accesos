# Sistema de control de accesos

El sistema es una aplicación sencilla de control de acceso usando laravel 10, livewire y TailwindCSS.

#### Instalación del proyecto
Para la instalacion del proyecto primero se debe de descargar las dependencias de composer para ello se debe de usar el siguiente comando en la carpeta base del proyecto luego de ser clonado.

> Composer update

Con ello se descargara las librerias y dependencias que el proyecto.

A continuación se debe de crear una copia del archivo .env.example y cambiarle el nombre a
> .env

Seguidamente se debe de crear la llave de la app y las migraciones, para ello se usa:

> php artisan key:generate 

y 

> php artisan migrate

Es importante ya haber creado la base de datos y conectarla al env
igualmente se puede usar el comando siguiente para generar datos dummy

> php artisan migrate - -seed


Finalmente para que los archivos se vean correctamente se usa npm para generar los css y js compilados

> npm install && npm run dev
