
# Proyecto: World Data Dashboard

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
- **Bootstrap** - Para el diseño y estructura del front-end, asegurando una interfaz moderna y responsiva.
- **JavaScript y jQuery** - Para la manipulación del DOM y añadir interactividad.
- **Fetch API o jQuery Ajax** - Para la obtención de datos de forma asíncrona desde el servidor.
- **Highcharts** - Para la creación de visualizaciones gráficas interactivas.
- **XAMPP y PHP** - Para la configuración del servidor web y la gestión de consultas a la base de datos.

## Requisitos Previos
- **XAMPP** - Para configurar el entorno de servidor Apache y base de datos MySQL.
- **PHPMyAdmin** - Para la gestión y consulta de la base de datos.
- **PHP** - Versión 7.4 o superior.
- **Base de Datos** - Configuración de la base de datos [World](https://dev.mysql.com/doc/index-other.html) en PHPMyAdmin con datos relevantes.
  
## Instalación y Configuración
1. Clona este repositorio en tu servidor o máquina local:
   ```bash
   # Clona este repositorio
   $ git clone https://github.com/MONSELLA/world_data_dashboard.git
   ```
2. Configura el acceso de la base de datos en el archivo de configuración correspondiente.
3. Accede al archivo `index.php` a través de tu servidor para verificar que se esté ejecutando correctamente.

## Uso del Proyecto
- **Ejecuta** el archivo `index.php` en tu servidor para iniciar la aplicación.
- **Ejemplos de Uso**:
   - Puedes navegar por la aplicación mediante la URL raíz que contenga este archivo.
   - Asegúrate de que los enlaces y las rutas en el archivo estén correctamente configurados para tu entorno.

## Créditos
Desarrollado por [Pau Monserrat Llabrés](https://github.com/MONSELLA) y [Marc Navarro Amengual](https://github.com/maarcnavarro9)

## License
>Puedes consultar la licencia completa [aquí](https://github.com/MONSELLA/world_data_dashboard/blob/main/LICENSE.txt)

Este proyecto está licenciado bajo los términos de la licencia **MIT**.
