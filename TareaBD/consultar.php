<?php
require 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['numero_medidor'])) {
        $numero_medidor = $_GET['numero_medidor'];
        $consumo = consultarConsumoPorMedidor($pdo, $numero_medidor);
    } elseif (isset($_GET['cedula_cliente'])) {
        $cedula_cliente = $_GET['cedula_cliente'];
        $consumo = consultarConsumoPorCedula($pdo, $cedula_cliente);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Consultar Consumo</title>
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
            <h1 class="text-2xl font-bold mb-4 text-center text-light">Consultar Consumo</h1>
            <form method="get" action="consultar.php">
                <div class="mb-4">
                    <label class="block text-light">Número de Medidor:</label>
                    <input type="text" name="numero_medidor" class="w-full px-3 py-2 border rounded-lg bg-gray-700 text-white">
                </div>
                <div class="mb-4">
                    <label class="block text-light">Cédula del Cliente:</label>
                    <input type="text" name="cedula_cliente" class="w-full px-3 py-2 border rounded-lg bg-gray-700 text-white">
                </div>
                <div class="mb-4">
                    <input type="submit" value="Consultar" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">
                </div>
            </form>
            <?php
            if (!empty($consumo)) {
                echo "<h2 class='text-xl font-bold mt-6 text-center text-light'>Resultados:</h2>";
                echo "<div class='bg-gray-700 p-4 rounded-lg mt-4'>";
                echo "<table class='w-full'>";
                echo "<tr class='text-light font-bold'>";
                echo "<td class='px-4 py-2'>Fecha de Lectura</td>";
                echo "<td class='px-4 py-2'>Lectura Anterior</td>";
                echo "<td class='px-4 py-2'>Lectura Actual</td>";
                echo "<td class='px-4 py-2'>Consumo</td>";
                echo "</tr>";
                foreach ($consumo as $lectura) {
                    echo "<tr class='text-light'>";
                    echo "<td class='px-4 py-2'>{$lectura['fecha_lectura']}</td>";
                    echo "<td class='px-4 py-2'>{$lectura['lectura_anterior']}</td>";
                    echo "<td class='px-4 py-2'>{$lectura['lectura_actual']}</td>";
                    echo "<td class='px-4 py-2'>{$lectura['consumo']}</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
    <footer class="bg-dark text-light text-center py-4 fixed bottom-0 w-full">
    <p class="text-sm">4to Semestre de Ingeniería en Sistemas - Daniel Foyain</p>
</footer>

</body>
</html>
