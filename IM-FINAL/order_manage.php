
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

        .add-product-button {
            display: block;
            text-align: right;
            margin-bottom: 30px;
            font-size:25px;
        }
    </style>
</head>
<body>
    <div class="container">
    <?php include 'sidebar.php'; ?>
        <div style="margin: 10px;">
            <h1>ORDER MANAGEMENT</h1>
            <br><br>
            <table id="myTable" border="2">
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Order Date</th>
                    <th>Order By:</th>
                    <th>Action</th>
                </tr>
                <?php
                // Connect to the database
                $conn = mysqli_connect("localhost", "root", "", "rtw_shop");
                if ($conn === false) {
                    die("ERROR: Could not connect. " . mysqli_connect_error());
                }

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Delete order
                    $order_id = $_POST['order_id'];

                    // Retrieve the order details
                    $sql = "SELECT product_name, quantity, customer_name FROM shoporder WHERE order_id = '$order_id'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $order = $result->fetch_assoc();
                        $product_name = $order['product_name'];
                        $quantity = $order['quantity'];
                        $customer_name = $order['customer_name'];

                        // Retrieve the stock price and retail values
                        $stock_sql = "SELECT stock_price, stock_retail FROM stocks WHERE stock_name = '$product_name'";
                        $stock_result = $conn->query($stock_sql);

                        if ($stock_result->num_rows > 0) {
                            $stock_row = $stock_result->fetch_assoc();
                            $stock_price = $stock_row['stock_price'];
                            $stock_retail = $stock_row['stock_retail'];

                            // Calculate profit
                            $profit = ($stock_retail - $stock_price) * $quantity;

                            // Insert into transaction1 table
                            $insert_sql = "INSERT INTO transaction1 (order_id, product_name, stock_price, retail, quantity, profit, customer_name) 
                                           VALUES ('$order_id', '$product_name', '$stock_price', '$stock_retail', '$quantity', '$profit', '$customer_name')";
                            $conn->query($insert_sql);
                        }

                        // Update the stock quantity
                        $update_sql = "UPDATE stocks SET stock_quantity = stock_quantity - $quantity WHERE stock_name = '$product_name'";
                        $conn->query($update_sql);
                    }

                    // Delete the order
                    $delete_sql = "DELETE FROM shoporder WHERE order_id = '$order_id'";
                    $conn->query($delete_sql);
                }

                $sql = "SELECT * FROM shoporder";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $order_id = $row["order_id"];
                        $product_name = $row["product_name"];
                        $quantity = $row["quantity"];
                        $customer_name = $row["customer_name"];

                        // Check if the quantity is available in stocks
                        $check_sql = "SELECT stock_quantity FROM stocks WHERE stock_name = '$product_name'";
                        $check_result = $conn->query($check_sql);
                        if ($check_result->num_rows > 0) {
                            $stock_row = $check_result->fetch_assoc();
                            $stock_quantity = $stock_row["stock_quantity"];

                            $is_stock_available = $quantity <= $stock_quantity;
                            $row_class = $is_stock_available ? "" : "insufficient-stock";
                            $button_class = $is_stock_available ? "" : "disabled-button";
                            $button_title = $is_stock_available ? "Edit" : "Not enough stock";

                            echo "<tr class='$row_class'>";
                            echo "<td>" . $order_id . "</td>";
                            echo "<td>" . $product_name . "</td>";
                            echo "<td>" . $quantity . "</td>";
                            echo "<td>" . $row["order_date"] . "</td>";
                            echo "<td>" . $customer_name . "</td>";
                            echo "<td>";
                            echo "<form method='POST' style='display:inline;'>";
                            echo "<input type='hidden' name='order_id' value='" . $order_id . "'>";
                            echo "<input type='submit' value='StockOut' onclick='return confirm(\"Are you sure you want to Stock Out this order?\")' class='button $button_class'>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        } else {
                            echo "<tr><td colspan='6'>Stock not found</td></tr>";
                        }
                    }
                } else {
                    echo "<tr><td colspan='6'>0 results</td></tr>";
                }
                $conn->close();
                ?>
            </table>
            <br><br>
        </div>
    </div>
</body>
</html>
