
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
    <div>
    <?php include 'sidebar.php'; ?>
</div>
    
    <div style="border:solid 2px black;padding:20px;width:600px;margin:40px;height:400px">
    <center><h1>Save New Customer</h1>
        <form method="POST" action="insert_table.php">
            <div style="border:solid 2px black;width:400px;padding:20px;font-size:25px;">
                <label for="customer_name">Customer Name:</label>
                <input type="text" name="customer_name" id="customer_name"><br>
                <label for="customer_email">Email:</label>
                <input type="text" name="customer_email" id="customer_email"><br>
                <label for="customer_phone">Phone:</label>
                <input type="text" name="customer_phone" id="customer_phone"><br>
                <input type="submit" value="Save new Customer">
            </div>
            </center>
</div> 
</body>
</html>
