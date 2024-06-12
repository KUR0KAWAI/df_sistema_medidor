APLICATIVO WEB REALIZADO CON PHP + MYSQL
Instrucciones para ejecutar el aplicativo web:
Abre XAMPP y activa los servicios de Apache y MySQL para ejecutar el servidor local en tu navegador.

Dirígete a la carpeta htdocs en la instalación de XAMPP (generalmente ubicada en C:\xampp\htdocs) y crea una nueva carpeta con el nombre del proyecto.

Abre Visual Studio Code (o tu editor de código preferido) y abre la carpeta del proyecto recién creada.

Configuración de la base de datos:
Crea la base de datos junto con sus tablas y relaciones utilizando una herramienta como SQLyog.
Descripción de archivos:
database.php:
Este archivo contiene la configuración de la base de datos y define funciones para interactuar con ella. Establece la conexión con la base de datos utilizando PDO (PHP Data Objects) y define funciones como registrarCliente, registrarLectura, consultarConsumoPorMedidor y consultarConsumoPorCedula, que realizan operaciones en la base de datos como registrar nuevos clientes, registrar lecturas de medidores y consultar datos de consumo.

registrar.php:
Este archivo PHP procesa el formulario de registro de clientes. Cuando se envía el formulario, los datos se envían a este archivo a través del método POST. Luego, el archivo registrar.php utiliza las funciones definidas en database.php para insertar los datos del cliente en la base de datos.

index.php:
Este archivo PHP contiene la página principal de la aplicación web. Muestra un menú con dos opciones: "Registrar Cliente" y "Consultar Consumo". Cada opción está vinculada a su respectiva página de PHP (registrar.php y consultar.php).

consultar.php:
Este archivo PHP muestra el formulario de consulta de consumo y procesa la consulta cuando se envía. Similar a registrar.php, utiliza las funciones definidas en database.php para realizar consultas en la base de datos y mostrar los resultados.
