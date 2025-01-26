# Proyecto de Gestión de Usuarios

> Este proyecto es una prueba tecnica para la empresa UNBC.

Aplicación de gestión de usuarios construida con Laravel. Proporciona funcionalidades para registrar, iniciar sesión y gestionar un CRUD completo de usuarios.

## Requisitos previos

Antes de comenzar, asegúrate de tener instalados los siguientes programas en tu máquina:

- [Composer](https://getcomposer.org/): Administrador de dependencias para PHP.
- [Node.js y npm](https://nodejs.org/): Necesarios para construir los activos frontend.
- [MySQL](https://www.mysql.com/): Base de datos relacional para almacenar los datos.
- PHP 8.1 o superior.
- Laravel CLI (opcional, pero recomendado).

## Instrucciones de instalación

Sigue estos pasos para configurar el proyecto localmente:

1. **Clonar el repositorio:**

   ```bash
   git clone <URL_DEL_REPOSITORIO>
   cd <NOMBRE_DEL_PROYECTO>
   ```

2. **Instalar dependencias de PHP:**
   Ejecuta el siguiente comando para instalar todas las dependencias necesarias del backend.

   ```bash
   composer install
   ```

3. **Instalar dependencias de Node.js:**
   Ejecuta el siguiente comando para instalar las dependencias del frontend.

   ```bash
   npm install
   ```

4. **Compilar los activos frontend:**
   Construye los activos frontend utilizando:

   ```bash
   npm run build
   ```

5. **Configurar el archivo ************************`.env`************************:**

   - Copia el archivo de ejemplo `.env.example` y renómbralo como `.env`.

   ```bash
   cp .env.example .env
   ```

   - Configura los detalles de conexión a la base de datos y otras configuraciones en el archivo `.env`.
   - Es importante antes del siguiente paso tener configurado MySQL como motor de base de datos, ejecutandose.

6. **Migrar la base de datos:**
   Ejecuta las migraciones para crear las tablas necesarias en tu base de datos.

   ```bash
   php artisan migrate
   ```
    - Se te pedirá si deseas crear la base de datos, indicale que sí a menos que la crees manualmente.
7. **Ejecutar el servidor de desarrollo:**
   Inicia el servidor de desarrollo, las colas y otras tareas con el siguiente comando:

   ```bash
   composer run dev
   ```

   Esto ejecutará todo lo necesario para que el proyecto funcione correctamente.

8. **Acceder a la aplicación:**
   Abre tu navegador y ve a la URL proporcionada por el servidor de Laravel, generalmente:

   ```
   http://:127.0.0.18000
   ```

## Notas adicionales

- Si necesitas restablecer la base de datos, puedes ejecutar:

  ```bash
  php artisan migrate:fresh
  ```

  Esto eliminará todas las tablas existentes y las recreará desde cero.

- Si experimentas problemas con permisos, asegúrate de que el directorio `storage` y `bootstrap/cache` sean escribibles:

  ```bash
  chmod -R 775 storage bootstrap/cache
  ```

- Para compilar de nuevo los activos mientras desarrollas:

  ```bash
  npm run dev
  ```
- Si al ejecutar por primera vez te aparece el error de `No application encryption key has been specified`, debes parar la ejecución y utilizar este comando:
  ```bash
   php artisan key:generate
  ```
- Al iniciar, es necesario que te registres primero ya que no hay registros existentes en la base de datos.

  
## Imagenes del proyecto
### Home
![Captura de Pantalla 2025-01-26 a la(s) 6 04 04 p m](https://github.com/user-attachments/assets/9194d58b-efce-4a52-a7ef-6ec452fc5f0c)
### Despues del Login, Listado de usuarios
![Captura de Pantalla 2025-01-26 a la(s) 6 04 34 p m](https://github.com/user-attachments/assets/bf741121-88d1-4423-ad44-9f9df8e96937)


