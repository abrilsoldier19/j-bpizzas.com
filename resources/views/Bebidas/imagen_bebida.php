<?php
$conn = mysqli_connect("localhost", "root", "", "pizzas");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$tablas = mysqli_query($conn, "SELECT bebida_imagen FROM bebidas ORDER BY id DESC");

$response = array();
foreach ($tablas as $tabla) {
    $response['image'] = 'img/' . $tabla["bebida_imagen"];
}

header('Content-Type: application/json');
echo json_encode($response);

mysqli_close($conn);
?>
