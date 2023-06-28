<!DOCTYPE html>
<html>
<head>
  <title>Sales System</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
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
  
 

  <div class="content">
    <div>
      <?php include 'transaction.php'; ?>
    </div>
  </div>
</body>
</html>
