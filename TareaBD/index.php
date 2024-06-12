<!DOCTYPE html>
<html>
<head>
    <title>Inicio - Sistema de Gestión de Consumo</title>
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
        <div class="max-w-lg mx-auto bg-dark p-6 rounded-lg shadow-xl">
            <h1 class="text-3xl font-bold mb-4 text-center text-light">Sistema de Gestión de Consumo</h1>
            <div class="flex flex-col space-y-4">
                <a href="registrar.php" class="w-full bg-blue-500 text-white py-2 rounded-lg text-center hover:bg-blue-600">Registrar Cliente</a>
                <a href="consultar.php" class="w-full bg-green-500 text-white py-2 rounded-lg text-center hover:bg-green-600">Consultar Consumo</a>
            </div>
        </div>
    </div>
</body>
<footer class="bg-dark text-light text-center py-4 fixed bottom-0 w-full">
    <p class="text-sm">4to Semestre de Ingeniería en Sistemas - Daniel Foyain</p>
</footer>
</html>
