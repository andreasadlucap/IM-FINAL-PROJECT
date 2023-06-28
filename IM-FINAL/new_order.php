<!DOCTYPE html>
<html>
<head>
    <title>Sales Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .container {
            width: 1100px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            display: flex;
            flex-direction:row;
        }

        h1 {
            text-align: center;
            margin-top: 30px;
        }

        table {
            width: 800px;
            margin: 30px auto;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        th, td {
            padding: 15px;
        }

        th {
            font-size: 18px;
            background-color: #f2f2f2;
            text-align: left;
        }

        td {
            font-size: 16px;
        }

        tr:nth-child(even) {
            background-color: #f8f8f8;
        }

        .action-button {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border: none;
            cursor: pointer;
        }

        .add-order-container {
            
        
            width: 600px;
            margin: 0 auto;
            height: 400px;
        }

        .order-form {
            border: 2px solid black;
            width: 400px;
            padding: 20px;
            font-size: 20px;
            margin: 0 auto;
        }

        .order-form h1 {
            text-align: center;
        }

        .order-form label {
            display: block;
            margin-bottom: 10px;
        }

        .order-form input[type="text"],
        .order-form select,
        .order-form input[type="number"],
        .order-form input[type="date"],
        .order-form input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }

        .add-order-button {
            display: block;
            text-align: right;
            margin-bottom: 30px;
            font-size: 25px;
        }
    </style>
</head>
<body>
<div class="container">
    <div>
        <?php include 'sidebar.php'; ?>
    </div>

    <div class="add-order-container">
        <center>
            <h3>Add Order</h3>
            <form method="POST" class="order-form">
               
                <label for="customer_id">Customer ID:</label>
                <input type="text" name="customer_id" id="customer_id" disabled><br>
                <label for="customer_name">Customer Name:</label>
                <input type="text" name="customer_name" id="customer_name" disabled><br>
               
                <label for="product_name">Product Name:</label>
                <select name="product_name" id="product_name">
                    <?php
                    // Connect to the database
                    $conn = mysqli_connect("localhost", "root", "", "rtw_shop");
                    if ($conn === false) {
                        die("ERROR: Could not connect. " . mysqli_connect_error());
                    }

                    // Fetch all stocking products
                    $sql = "SELECT stock_name FROM stocks";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $stock_name = isset($row["stock_name"]) ? $row["stock_name"] : '';
                            echo "<option value='$stock_name'>$stock_name</option>";
                        }
                    }

                    $conn->close();
                    ?>
                </select><br>
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" id="quantity"><br>
                <label for="order_date">Order Date:</label>
                <input type="date" name="order_date" id="order_date"><br>
                <input type="submit" value="Add Order">
            </form>
        </center>
    </div>
</div>

<?php
// Retrieve the customer ID (bid) from the URL parameter
$customer_id = isset($_GET['bid']) ? $_GET['bid'] : '';

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "rtw_shop");
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Fetch the customer information based on the customer ID
$sql = "SELECT customer_id, customer_name FROM customer WHERE customer_id = $customer_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $customer_id = isset($row["customer_id"]) ? $row["customer_id"] : '';
    $customer_name = isset($row["customer_name"]) ? $row["customer_name"] : '';

    // Set the default values for the customer ID and name fields in the form
    echo "<script>";
    echo "document.getElementById('customer_id').value = '$customer_id';";
    echo "document.getElementById('customer_name').value = '$customer_name';";
    echo "</script>";
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the submitted form data
    $order_id = isset($_POST["order_id"]) ? $_POST["order_id"] : '';
    $product_name = isset($_POST["product_name"]) ? $_POST["product_name"] : '';
    $quantity = isset($_POST["quantity"]) ? $_POST["quantity"] : '';
    $order_date = isset($_POST["order_date"]) ? $_POST["order_date"] : '';

    // Check if the order ID already exists in the database
    $check_sql = "SELECT * FROM shoporder WHERE order_id = '$order_id'";
    $check_result = mysqli_query($conn, $check_sql);
    if (mysqli_num_rows($check_result) > 0) {
        echo "Error saving order: Duplicate entry for order ID.";
    } else {
        // Insert the order data into the database
        $insert_sql = "INSERT INTO shoporder (customer_id,customer_name,product_name, quantity, order_date)
                            VALUES ('$customer_id', '$customer_name', '$product_name', '$quantity', '$order_date')";
        if (mysqli_query($conn, $insert_sql)) {
            echo '<script>window.location.href = "order_manage.php";</script>';
            exit();
            
        } else {
            echo "Error saving order: " . mysqli_error($conn);
        }
    }
}

$conn->close();

?>
</body>
</html>
