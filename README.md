
# Proyecto: World Data Dashboard

 ![Vista Previa](/images/2.JPG)

![Static Badge](https://img.shields.io/badge/https%3A%2F%2Fimg.shields.io%2Fbadge%2Fbootstrap-5.3.3-blue)
![Static Badge](https://img.shields.io/badge/https%3A%2F%2Fimg.shields.io%2Fbadge%xampp-3.3.0-pink)
![Static Badge](https://img.shields.io/badge/https%3A%2F%2Fimg.shields.io%2Fbadge%php-8.2.12-yellow)

## Tabla de Contenidos
1. [Descripción del Proyecto](#descripción-del-proyecto)
2. [Objetivo](#objetivo)
3. [Tecnologías Utilizadas](#tecnologías-utilizadas)
4. [Requisitos Previos](#requisitos-previos)
5. [Instalación y Configuración](#instalación-y-configuración)
6. [Uso del Proyecto](#uso-del-proyecto)
7. [Créditos](#créditos)
8. [Licencia](#licencia)

## Descripción del Proyecto
Este proyecto consiste en el desarrollo de un panel de datos (Data Dashboard) que obtiene la información de la base de datos [World](https://dev.mysql.com/doc/index-other.html) en PHPMyAdmin, XAMPP. La aplicación está diseñada como una aplicación web distribuida con un front-end y un back-end. La interfaz es interactiva y está pensada para visualizar datos de manera dinámica y en tiempo real.

### Objetivo
Crear un panel de control interactivo que permita visualizar datos mediante gráficos y otras herramientas visuales.

### Tecnologías Utilizadas
- **Bootstrap** - Utilizado para el diseño y la estructura del front-end, garantizando una interfaz moderna y responsiva para el dashboard.
- **JavaScript y jQuery** - Empleados para la manipulación del DOM y añadir interactividad en el dashboard.
- **Highcharts** - Biblioteca utilizada para crear gráficos interactivos que visualizan los datos de manera intuitiva y dinámica.
- **PHP** - Utilizado en el back-end para manejar las consultas a la base de datos y generar el contenido dinámico del dashboard.
- **XAMPP** - Plataforma que incluye Apache, PHP y MySQL, usada para configurar el servidor local y administrar la base de datos del proyecto.
- **PHPMyAdmin** - Herramienta para la gestión y consulta de la base de datos MySQL, facilitando la creación y administración de tablas y datos necesarios para el dashboard.

## Requisitos Previos
- **XAMPP** - Debes tener instalado XAMPP para configurar el entorno del servidor Apache y la base de datos MySQL localmente.
- **PHPMyAdmin** - Necesario para gestionar la base de datos, realizar consultas y ajustar los datos utilizados por el dashboard.
- **PHP** - Se recomienda la versión 7.4 o superior para compatibilidad con el código.
- **Base de Datos `World`** - Debes importar la base de datos [World](world.sql) en PHPMyAdmin, ya que contiene los datos de países, ciudades y lenguajes necesarios para las visualizaciones del dashboard.

  
## Instalación y Configuración
1. Clona este repositorio en tu servidor o máquina local:
   ```bash
   # Clona este repositorio
   $ git clone https://github.com/MONSELLA/world_data_dashboard.git
   ```
2. Importa la base de datos World en PHPMyAdmin desde el enlace proporcionado en la sección de requisitos previos, asegurándote de que los datos necesarios están disponibles.
3. Configura el acceso a la base de datos en el archivo conexion.php del proyecto, donde debes especificar las credenciales de conexión (nombre de usuario, contraseña, y nombre de la base de datos).
4. Inicia Apache y MySQL desde el panel de control de XAMPP.
 ![Vista Previa](/images/1.JPG)
5. Accede al archivo index.php desde tu navegador usando la URL raíz de tu servidor local para verificar que el proyecto se está ejecutando correctamente.

## Uso del Proyecto
- **Ejecuta** el archivo `index.php` en tu servidor para iniciar el dashboard.
- **Ejemplos de Uso**:
   - Puedes navegar por la aplicación mediante la URL raíz que contenga este archivo (por ejemplo, http://localhost/world_data_dashboard/index.php).
   - Revisa las visualizaciones de datos en tiempo real, que muestran información sobre países, ciudades y lenguajes.
   - Asegúrate de que los enlaces y las rutas en el archivo estén correctamente configurados para tu entorno.

## Créditos
Desarrollado por [Pau Monserrat Llabrés](https://github.com/MONSELLA) y [Marc Navarro Amengual](https://github.com/maarcnavarro9)

## Licencia
>Puedes consultar la licencia completa [aquí](https://github.com/MONSELLA/world_data_dashboard/blob/main/LICENSE.txt)

Este proyecto está licenciado bajo los términos de la licencia **MIT**.
