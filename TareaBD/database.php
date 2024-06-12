<?php
// Configuración de la base de datos
$host = 'localhost';   
$dbname = 'sistema_medidores'; 
$username = 'root';  
$password = ''; 

try {
    // Crear una nueva conexión PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Configurar el modo de error de PDO para que lance excepciones
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexión exitosa a la base de datos"; // Comentado para no imprimir en pantalla
} catch (PDOException $e) {
    // En caso de error, mostrar un mensaje
    echo "Error de conexión: " . $e->getMessage();
}

// Función para registrar un cliente
function registrarCliente($pdo, $cedula, $nombre, $apellido, $direccion, $telefono, $email, $fecha_registro) {
    $sql = "INSERT INTO Clientes (cedula, nombre, apellido, direccion, telefono, email, fecha_registro) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cedula, $nombre, $apellido, $direccion, $telefono, $email, $fecha_registro]);
    echo "Cliente registrado correctamente.";
}

// Función para registrar una lectura de medidor
function registrarLectura($pdo, $numero_medidor, $ubicacion, $lectura_anterior, $lectura_actual, $fecha_lectura) {
    // Obtener el cliente asociado al medidor
    $cliente_id = obtenerClienteIdPorNumeroMedidor($pdo, $numero_medidor);
    if ($cliente_id !== false) {
        $sql = "INSERT INTO Lecturas (medidor_id, fecha_lectura, lectura_anterior, lectura_actual) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$cliente_id, $fecha_lectura, $lectura_anterior, $lectura_actual]);
        echo "Lectura registrada correctamente.";
    } else {
        echo "No se pudo encontrar el cliente asociado al medidor.";
    }
}

// Función para obtener el ID del cliente asociado a un número de medidor
function obtenerClienteIdPorNumeroMedidor($pdo, $numero_medidor) {
    $sql = "SELECT cliente_id FROM Medidores WHERE numero_medidor = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$numero_medidor]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['cliente_id'] : false;
}

// Función para consultar el consumo por número de medidor
function consultarConsumoPorMedidor($pdo, $numero_medidor) {
    $sql = "SELECT L.fecha_lectura, L.lectura_anterior, L.lectura_actual, L.consumo 
            FROM Lecturas L 
            JOIN Medidores M ON L.medidor_id = M.medidor_id 
            WHERE M.numero_medidor = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$numero_medidor]);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resultados;
}

// Función para consultar el consumo por cédula de cliente
function consultarConsumoPorCedula($pdo, $cedula_cliente) {
    $sql = "SELECT L.fecha_lectura, L.lectura_anterior, L.lectura_actual, L.consumo 
            FROM Lecturas L 
            JOIN Medidores M ON L.medidor_id = M.medidor_id 
            JOIN Clientes C ON M.cliente_id = C.cliente_id 
            WHERE C.cedula = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cedula_cliente]);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resultados;
}
?>

