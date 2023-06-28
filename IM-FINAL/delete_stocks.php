<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "rtw_shop");
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if (isset($_POST['stockId'])) {
    $stockId = $_POST['stockId'];

    // Delete the stock from the database
    $sql = "DELETE FROM stocks WHERE stocks_id = $stockId";
    if (mysqli_query($conn, $sql)) {
        echo "Stock deleted successfully.";
    } else {
        echo "Error deleting stock: " . mysqli_error($conn);
    }
} else {
    echo "Invalid stock ID.";
}

// Close the database connection
mysqli_close($conn);
?>
