<?php
include('database.php');

$query = "SELECT * from pedidos";
$result = mysqli_query($connection, $query);

if (!$result) {
    die('Query error' . mysqli_error($connection));
}

$reportContent = "PEDIDOS\n\n";
while ($row = $result->fetch_assoc()) {
    $reportContent .= "ID pedido: " . $row["id"] . ", Cantidad: " . $row["cantidad"] . ", Fecha y hora: " . $row["fecha_hora"] . ", Descripcion: " . $row["descripcion"] . "\n\n\n";
}

if (mysqli_num_rows($result) > 0) {
    $response = array(
        "success" => true,
        "data" => $reportContent
    );
} else {
    $response = array(
        "success" => false,
        "message" => "No se encontraron registros de pedidos"
    );
}

header('Content-Type: application/json');
echo json_encode($response);
?>