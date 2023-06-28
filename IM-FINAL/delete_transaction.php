<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "rtw_shop");
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Check if the order_id parameter is present in the URL
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Delete the transaction with the specified order_id
    $sql = "DELETE FROM transaction1 WHERE order_id = '$order_id'";
    if (mysqli_query($conn, $sql)) {
        echo "Transaction deleted successfully.";
    } else {
        echo "Error deleting transaction: " . mysqli_error($conn);
    }
}
header("Location: index.php");
mysqli_close($conn);
?>
