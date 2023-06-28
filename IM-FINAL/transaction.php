

<!DOCTYPE html>
<html>
<head>
    <title>Transaction History</title>
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
    <h1>Transaction History</h1>
    <div class="search-container">
        <form method="POST" action="">
            <input type="text" name="search" placeholder="Search by Product Name or Customer Name">
            <input type="submit" value="Search" class="action-button">
        </form>
    </div>
    <table border="2">
        <tr>
            <th>Order ID</th>
            <th>Product Name</th>
            <th>Stock Price</th>
            <th>Retail</th>
            <th>Quantity</th>
         
            <th>Order By</th>
            <th>Profit</th>
        </tr>
        <?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "rtw_shop");
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Initialize total profit variable
$totalProfit = 0;

// Check if a search query is submitted
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    // Fetch data from the transaction1 table matching the search query
    $sql = "SELECT * FROM transaction1 WHERE product_name LIKE '%$search%' OR customer_name LIKE '%$search%'";
    $result = $conn->query($sql);
} else {
    // Fetch all data from the transaction1 table
    $sql = "SELECT * FROM transaction1";
    $result = $conn->query($sql);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['order_id'] . "</td>";
        echo "<td>" . $row['product_name'] . "</td>";
        echo "<td>" . $row['stock_price'] . "</td>";
        echo "<td>" . $row['retail'] . "</td>";
        echo "<td>" . $row['quantity'] . "</td>";
        echo "<td>" . $row['customer_name'] . "</td>";
        echo "<td>" . $row['profit'] . "</td>";
        echo "<td><a href='delete_transaction.php?order_id=" . $row['order_id'] . "'>Delete</a></td>"; // Delete button with link

        echo "</tr>";

        // Add profit to the total
        $totalProfit += $row['profit'];
    }
} else {
    echo "<tr><td colspan='6'>No transactions found</td></tr>";
}

$conn->close();
?>

<!-- Display the overall total profit -->
<tr>
    <td colspan="6" style="text-align: right;"><strong>Total Profit:</strong></td>
    <td><?php echo $totalProfit; ?></td>
</tr>


        
    </table>
</body>
</html>
