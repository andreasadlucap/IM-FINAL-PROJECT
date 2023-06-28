<!DOCTYPE html>
<html>
<head>
    <title>Stocks Management</title>
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
        <center>
        <div style="border:solid 2px black;padding:20px;width:600px;margin:30px;height:330px">
      
        <h3>Add New Product</h3> 
        <form method="POST">
                
                <div style="border:solid 2px black;width:500px;padding:20px;font-size:25px;margin:30px">
                    <label for="stock_name">Product Name:</label>
                    <input type="text" name="stock_name" id="stock_name" required><br>
                    <label for="stock_price">Product Price:</label>
                    <input type="number" name="stock_price" id="stock_price" required><br>
                    <label for="stock_retail">Product Retail Price:</label>
                    <input type="number" name="stock_retail" id="stock_retail" required><br>
                    <label for="stock_quantity">Product Quantity:</label>
                    <input type="number" name="stock_quantity" id="stock_quantity" required><br>
                    <label for="stock_date">StockIn Date:</label>
                    <input type="date" name="stock_date" id="stock_date" required><br>
                    <input type="submit" value="Add Product" name="submit">
                </div>
            </form>
        </div> 
 
    </div>
    </center>
    <?php
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve the submitted form data
            $stock_name = isset($_POST["stock_name"]) ? $_POST["stock_name"] : '';
            $stock_price = isset($_POST["stock_price"]) ? $_POST["stock_price"] : '';
            $stock_retail = isset($_POST["stock_retail"]) ? $_POST["stock_retail"] : '';
            $stock_quantity = isset($_POST["stock_quantity"]) ? $_POST["stock_quantity"] : '';
            $stock_date = isset($_POST["stock_date"]) ? $_POST["stock_date"] : '';

            // Connect to the database
            $conn = mysqli_connect("localhost", "root", "", "rtw_shop");
            if ($conn === false) {
                die("ERROR: Could not connect. " . mysqli_connect_error());
            }

            // Insert the product data into the database
            $insert_sql = "INSERT INTO stocks (stock_name, stock_price, stock_retail, stock_quantity, stock_date)
                           VALUES ('$stock_name', '$stock_price', '$stock_retail', '$stock_quantity', '$stock_date')";
            if (mysqli_query($conn, $insert_sql)) {
                echo '<script>window.location.href = "stocks_manage.php";</script>';
            exit();
            } else {
                echo "Error adding product: " . mysqli_error($conn);
            }

            $conn->close();
        }
    ?>
</body>
</html>
