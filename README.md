## Descripción

**CRUD_Alojamientos** es una aplicación web que permite gestionar alojamientos. Los usuarios pueden crear una cuenta, iniciar sesión, agregar alojamientos a su cuenta y eliminar los que ya no deseen. Además, el proyecto incluye un usuario administrador con privilegios especiales para agregar nuevos alojamientos a la base de datos, pero no puede eliminarlos.

## Funcionalidades

1. **Landing Page de Alojamientos**: La página principal muestra los alojamientos disponibles, los cuales son precargados desde la base de datos y presentados de manera atractiva.

2. **Crear una Cuenta e Iniciar Sesión**: Los usuarios pueden crear cuentas y luego iniciar sesión utilizando sus credenciales. La autenticación es gestionada mediante sesiones.

3. **Vista de Cuenta de Usuario**: Una vez que el usuario inicie sesión, es redirigido a su cuenta, donde puede seleccionar y gestionar alojamientos.

4. **Función de Eliminar Alojamientos**: Los usuarios pueden eliminar los alojamientos que han seleccionado previamente de su cuenta.

5. **Usuario Administrador**: El usuario administrador tiene privilegios especiales para agregar nuevos alojamientos a la base de datos, pero no puede eliminarlos.

## Credenciales

- **Usuario final**:
    - **Usuario**: `estefanyq`
    - **Contraseña**: `12345`
  
- **Administrador**:
    - **Usuario**: `admin`
    - **Contraseña**: `admi`

- **Nombre de la base de datos**:
    -**alojamientos_bd**


## Estructura del Proyecto

- **index.php**: Página principal donde nos saldra información de la landing page y mostrara los alojamientos disponibles y aparecera el inicio de sesión.
- **user_account.php**: Página donde el usuario puede gestionar alojamientos.
- **logout.php**: Permite al usuario cerrar sesión.
- **class/Connection.php**: Conexión a la base de datos.
- **admin_dashboard.php**: página donde el administrador podrá agregar nuevos alojamientos

