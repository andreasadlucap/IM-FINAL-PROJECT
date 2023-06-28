<!DOCTYPE html>
<html>
<head>
  <title>Sales Management System</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <style>
    body {
      margin: 0;
      padding: 0;
      display: flex;
    }

    .sidebar {
      width: 200px;
      min-height: 100vh;
      background: #333;
      color: #fff;
      padding: 20px;
    }

    .sidebar h2 {
      margin-bottom: 20px;
    }

    .sidebar ul {
      list-style: none;
      padding: 0;
    }

    .sidebar li {
      margin-bottom: 10px;
      font-size:30px
    }

    .sidebar a {
      color: #fff;
      text-decoration: none;
    }

    .content {
      padding: 20px;
      flex: 1;
    }

    @media (max-width: 768px) {
      .sidebar {
        width: 100%;
      }

      .content {
        padding: 10px;
      }
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <h2>Sales Management System</h2>
    <ul>
      <li><a href="index.php"><i class="fa fa-cubes"></i> Dashboard</a></li>
      <li><a href="product_manage.php"><i class="fa fa-cubes"></i> Customer</a></li>
      <li><a href="order_manage.php"><i class="fa fa-shopping-cart"></i> Orders</a></li>
      <li><a href="stocks_manage.php"><i class="fa fa-users"></i> Product</a></li>
    </ul>
  </div>

  <div class="content">
    
  </div>
</body>
</html>
