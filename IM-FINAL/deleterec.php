<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "rtw_shop");
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Check if the customer ID parameter is provided
if (isset($_GET["bid"])) {
    $customerId = $_GET["bid"];

    // Delete associated shoporder records first
    $deleteShopOrders = "DELETE FROM shoporder WHERE customer_id = $customerId";
    if (mysqli_query($conn, $deleteShopOrders)) {
        // Now delete the customer record
        $deleteCustomer = "DELETE FROM customer WHERE customer_id = $customerId";
        if (mysqli_query($conn, $deleteCustomer)) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting customer record: " . mysqli_error($conn);
        }
    } else {
        echo "Error deleting associated shoporder records: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
header("Location: product_manage.php");
// Close the database connection
mysqli_close($conn);
?>
