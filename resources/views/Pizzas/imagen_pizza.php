<?php
$conn = mysqli_connect("localhost", "root", "", "pizzeria");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$tablas = mysqli_query($conn, "SELECT imagen_pizza FROM pizzeria ORDER BY id DESC");

$response = array();
foreach ($tablas as $tabla) {
    $response['image'] = 'img/' . $tabla["imagen_pizza"];
}

header('Content-Type: application/json');
echo json_encode($response);

mysqli_close($conn);
?>
