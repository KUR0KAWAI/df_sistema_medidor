<?php
require 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $fecha_registro = $_POST['fecha_registro'];

    registrarCliente($pdo, $cedula, $nombre, $apellido, $direccion, $telefono, $email, $fecha_registro);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1E1E1E;
            color: #D1D5DB;
        }
        .bg-dark {
            background-color: #2D2D2D;
        }
        .text-light {
            color: #D1D5DB;
        }
        .hover-dark:hover {
            background-color: #373737;
        }
    </style>
</head>
<body>
    <!-- Menú Superior -->
    <nav class="bg-dark p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-light text-lg font-bold">
                UTB - Ingeniería en sistemas
            </div>
            <a href="index.php" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">
                Inicio
            </a>
        </div>
    </nav>

    <div class="container mx-auto mt-10">
        <div class="max-w-md mx-auto bg-dark p-6 rounded-lg shadow-xl">
            <h1 class="text-2xl font-bold mb-4 text-center text-light">Registrar Cliente</h1>
            <form method="post" action="registrar.php">
                <div class="mb-4">
                    <label class="block text-light">Cédula:</label>
                    <input type="text" name="cedula" class="w-full px-3 py-2 border rounded-lg bg-gray-700 text-white" required>
                </div>
                <div class="mb-4">
                    <label class="block text-light">Nombre:</label>
                    <input type="text" name="nombre" class="w-full px-3 py-2 border rounded-lg bg-gray-700 text-white" required>
                </div>
                <div class="mb-4">
                    <label class="block text-light">Apellido:</label>
                    <input type="text" name="apellido" class="w-full px-3 py-2 border rounded-lg bg-gray-700 text-white" required>
                </div>
                <div class="mb-4">
                    <label class="block text-light">Dirección:</label>
                    <input type="text" name="direccion" class="w-full px-3 py-2 border rounded-lg bg-gray-700 text-white" required>
                </div>
                <div class="mb-4">
                    <label class="block text-light">Teléfono:</label>
                    <input type="text" name="telefono" class="w-full px-3 py-2 border rounded-lg bg-gray-700 text-white" required>
                </div>
                <div class="mb-4">
                    <label class="block text-light">Email:</label>
                    <input type="email" name="email" class="w-full px-3 py-2 border rounded-lg bg-gray-700 text-white" required>
                </div>
                <div class="mb-4">
                    <label class="block text-light">Fecha de Registro:</label>
                    <input type="date" name="fecha_registro" class="w-full px-3 py-2 border rounded-lg bg-gray-700 text-white" required>
                </div>
                <div class="mb-4">
                    <input type="submit" value="Registrar" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">
                </div>
            </form>
        </div>
    </div>
   
</body>
 <!-- Footer -->
<footer class="bg-dark text-light text-center py-4 fixed bottom-0 w-full">
    <p class="text-sm">4to Semestre de Ingeniería en Sistemas - Daniel Foyain</p>
</footer>
</html>