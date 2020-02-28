
# Sobre CmsWeb v3.0

En un software inteligente para crear y administrar paginas web dinamicas, utilizando las mejores practicas de la Internet 2.0

La herramienta inscluye paquete de terceros:

- [Laravel Framework v6](#)
- [Voyager Packages v1.3](#)
- [VueJs Framework v2.5](#)

# Installed
### Step #1
Clona el repositorio oficial e install las dependencias
- https://github.com/percy2017/cmsweb3.git
- composer install
- npm install

### Step #2
Configurar el erchivo .env (Variales de Entorno) y permisos
-   cp .env.example .env
-   edit .env (nano)   
-   chmod -R 777 (storage, bootstrap y public)

### Step #3
Realizar la instalcion mediante el comando:
-   php artisan voyager:install

La instalacion el super usuario con el login:
-   admin@admin.com 
-   password
# CmsWeb Sponsors

La empresa detras del Diseño y Creacion del CmsWeb v2020 es:

- ***[LoginWeb - Empresa de Diseño y Desarrollo de Hardwre y Software](https://loginweb.net/)***

### Contributing

Los desarrolladores del CmsWeb son los Ingenieros:
- [Luis Flores](#)


### License

CmsWeb v2020 is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
