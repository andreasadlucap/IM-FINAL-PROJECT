<?php
// update_quantity.php

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "rtw_shop");
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Get the stock ID and quantity from the AJAX request
$stockId = $_POST['stockId'];
$quantity = $_POST['quantity'];

// Retrieve the current quantity for the stock
$sql = "SELECT stock_quantity FROM stocks WHERE stocks_id = $stockId";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentQuantity = $row['stock_quantity'];

    // Calculate the new quantity
    $newQuantity = $currentQuantity + $quantity;

    // Update the quantity in the stocks table
    $updateSql = "UPDATE stocks SET stock_quantity = $newQuantity WHERE stocks_id = $stockId";
    if ($conn->query($updateSql) === true) {
        echo "Quantity updated successfully.";
    } else {
        echo "Error updating quantity: " . $conn->error;
    }
} else {
    echo "Stock not found.";
}

$conn->close();
?>
