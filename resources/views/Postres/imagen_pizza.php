<?php
$conn = mysqli_connect("localhost", "root", "", "pizzas");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$tablas = mysqli_query($conn, "SELECT postre_imagen FROM postres ORDER BY id DESC");

$response = array();
foreach ($tablas as $tabla) {
    $response['image'] = 'img/' . $tabla["postre_imagen"];
}

header('Content-Type: application/json');
echo json_encode($response);

mysqli_close($conn);
?>
