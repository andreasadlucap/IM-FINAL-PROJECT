<?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the submitted form data
        $customer_id = $_POST["customer_id"];
        $customer_name = $_POST["customer_name"];
        $order_id = $_POST["order_id"];
        $product_name = $_POST["product_name"];
        $quantity = $_POST["quantity"];
        $order_date = $_POST["order_date"];

        // Connect to the database
        $conn = mysqli_connect("localhost", "root", "", "rtw_shop");
        if ($conn === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }

        // Insert the order data into the database
        $sql = "INSERT INTO shoporder (customer_id, order_id, product_name, quantity, order_date)
                VALUES ('$customer_id', '$order_id', '$product_name', '$quantity', '$order_date')";
        if (mysqli_query($conn, $sql)) {
            echo "Order saved successfully.";
        } else {
            echo "Error saving order: " . mysqli_error($conn);
        }

        $conn->close();
    } else {
        echo "Invalid request.";
    }
?>
