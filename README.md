# Backend Test - Greg Altuve

¡Bienvenido! Este repositorio contiene una API de backend desarrollada como parte de una prueba técnica. A continuación, encontrarás las instrucciones para poner el proyecto en marcha en tu entorno local.

## Instalación y configuración

Siga los pasos a continuación para instalar este proyecto localmente.

1. **Clonar este repositorio**
   ```bash
   git clone <repository-url>
   cd <repository-folder>
   ```
2. **Instalar dependencias**
   ```bash
   composer install
   ```
3. **Migrar la base de datos + cargar datos de prueba**
   ```bash
   php artisan migrate --seed
   ```
4. **Publicar archivo de configuración de la documentación**
   ```bash
   php artisan vendor:publish --tag=scribe-config
   ```
5. **Desplegar la documentación**
   ```bash
   php artisan scribe:generate
   ```

   ## Documentación de la API
   
   Una vez instalado el proyecto y configurado puede acceder a la documentación a través de 
   
   http://localhost/docs

