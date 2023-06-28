<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the customer details from the form
    $customer_id = $_POST['customer_id'];
    $customer_name = $_POST['customer_name'];
    $customer_email = $_POST['customer_email'];
    $customer_phone = $_POST['customer_phone'];

    // Perform the update operation in the database
    $conn = mysqli_connect("localhost", "root", "", "rtw_shop");
    if ($conn === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    $sql = "UPDATE customer SET customer_name='$customer_name', customer_email='$customer_email', customer_phone='$customer_phone' WHERE customer_id='$customer_id'";

    if (mysqli_query($conn, $sql)) {
        
    } else {
        echo "Error updating customer: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

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
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f5f5f5;
            font-size: 16px;
            color: #333;
        }

        td {
            font-size: 14px;
            color: #555;
        }

        .action-buttons a {
            display: inline-block;
            padding: 9px 10px;
            text-decoration: none;
            background-color: #333;
            color: #fff;
            border-radius: 3px;
            margin-right: 5px;
            margin-top:10px;
        }

        .action-buttons a:hover {
            background-color: #555;
        }

        @media screen and (max-width: 600px) {
            h1 {
                font-size: 20px;
            }

            th, td {
                padding: 8px;
                
            }

            th {
                font-size: 14px;
            }

            td {
                font-size: 12px;
            }

            .action-buttons a {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div>
            <?php include 'sidebar.php'; ?>
        </div>
        <div style="margin:10px;">
            <h1>CUSTOMER MANAGEMENT</h1>
            <a href="new_customer.php"><button>New Customer</button></a>
            <br><br>
            <table id="myTable">
                <tr>
                    <th>Customer ID</th>
                    <th>Customer Name</th>
                    <th>Customer Email</th>
                    <th>Customer Phone</th>
                    <th>Action</th>
                    <th>Add Order</th>
                </tr>
                <?php
                // Connect to database
                $conn = mysqli_connect("localhost", "root", "", "rtw_shop");
                if ($conn === false) {
                    die("ERROR: Could not connect. " . mysqli_connect_error());
                }
                $sql = "SELECT * FROM customer";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["customer_id"] . "</td>";
                        echo "<td>" . $row["customer_name"] . "</td>";
                        echo "<td>" . $row["customer_email"] . "</td>";
                        echo "<td>" . $row["customer_phone"] . "</td>";
                        echo "<td class='action-buttons'>";
                        echo "<a href='deleterec.php?bid=" . $row["customer_id"] . "' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a>";
                        echo "<a href='?bid=" . $row["customer_id"] . "&customer_name=" . $row["customer_name"] . "&customer_email=" . $row["customer_email"] . "&customer_phone=" . $row["customer_phone"] . "'>Edit</a>";
                        echo "</td>";
                        echo "<td class='action-buttons'><a href='new_order.php?bid=" . $row["customer_id"] . "'>Add Order</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>0 results</td></tr>";
                }
                $conn->close();
                ?>
            </table>
            <br><br>
           
    <?php
    // Add this condition to display the edit form only if the form is not submitted
    if (!isset($_POST['customer_id'])) {
        if (isset($_GET['bid'])) {
            $customer_id = $_GET['bid'];
            $customer_name = $_GET['customer_name'];
            $customer_email = $_GET['customer_email'];
            $customer_phone = $_GET['customer_phone'];
            ?>
            <h1>Edit Customer</h1>
            <form action="" method="POST">
                <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
                <label for="customer_name">Name:</label>
                <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                <label for="customer_email">Email:</label>
                <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                <label for="customer_phone">Phone:</label>
                <input type="text" name="customer_phone" value="<?php echo $customer_phone; ?>">
                <input type="submit" value="Save">
            </form>
            <?php
        }
    }
    ?>
        </div>
    </div>
</body>
</html>
