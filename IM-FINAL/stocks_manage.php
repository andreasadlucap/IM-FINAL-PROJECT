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
            margin:5px;
        }

        .add-product-button {
            display: block;
            text-align: right;
            margin-bottom: 30px;
            font-size:25px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container">
        <div>
        <?php include 'sidebar.php'; ?>
    </div>
    <div style="margin:10px;">
    <h1>STOCKS MANAGEMENT</h1>
    <a href="new_stocks.php" class="add-product-button"><button>Add Product</button></a>

    <table id="myTable">
        <tr>
            <th>Stock ID</th>
            <th>Stock Name</th>
            <th>Stock Price</th>
            <th>Stock Retail</th>
            <th>Stock Quantity</th>
            <th>StockIn Date</th>
            <th>Action</th>
        </tr>
        <?php
        // Connect to the database
        $conn = mysqli_connect("localhost", "root", "", "rtw_shop");
        if ($conn === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM stocks";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["stocks_id"] . "</td>";
                echo "<td>" . $row["stock_name"] . "</td>";
                echo "<td>" . $row["stock_price"] . "</td>";
                echo "<td>" . $row["stock_retail"] . "</td>";
                echo "<td>" . $row["stock_quantity"] . "</td>";
                echo "<td>" . $row["stock_date"] . "</td>";
                echo '<td>
                <button class="action-button" onclick="deleteStock(' . $row["stocks_id"] . ')">Delete</button>
                <button class="action-button" onclick="addQuantity(' . $row["stocks_id"] . ')">Add Quantity</button></td>';
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>0 results</td></tr>";
        }

        $conn->close();
        ?>
    </table>
    </div>
    </div>
    <script>
        function addQuantity(stockId) {
            var quantity = prompt("Enter the quantity to add:", "");
            if (quantity != null && quantity !== "") {
                $.ajax({
                    url: "update_quantity.php",
                    type: "POST",
                    data: {
                        stockId: stockId,
                        quantity: quantity
                    },
                    success: function(response) {
                        console.log(response);
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        }
        function deleteStock(stockId) {
            if (confirm("Are you sure you want to delete this stock?")) {
                $.ajax({
                    url: "delete_stocks.php",
                    type: "POST",
                    data: {
                        stockId: stockId
                    },
                    success: function(response) {
                        console.log(response);
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        }
    </script>
</body>
</html>
