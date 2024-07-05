<?php
// delete_order.php

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $conn = mysqli_connect("localhost", "root", "", "pizzas");

    // Perform the deletion based on the order ID
    $deleteQuery = "DELETE FROM pedidos WHERE id_comprador = $id";
    $result = mysqli_query($conn, $deleteQuery);

    if ($result) {
        echo "Order deleted successfully";
    } else {
        echo "Error deleting order: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Invalid request";
}
?>
