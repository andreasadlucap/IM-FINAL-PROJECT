<!DOCTYPE html>
<html>
 
<head>
    <title>Insert Page</title>
</head>
 
<body>
    <center>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rtw_shop";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form inputs
  
    $customer_name = $_POST["customer_name"];
    $customer_email = $_POST["customer_email"];
    $customer_phone = $_POST["customer_phone"];



    // Insert data into Table 1 (customer)
    $sql_customer = "INSERT INTO `customer` ( customer_name, customer_email, customer_phone)
                   VALUES ('$customer_name', '$customer_email', '$customer_phone')";
    if ($conn->query($sql_customer) === TRUE) {
        echo "Data saved in customer successfully<br>";
    } else {
        echo "Error saving data in customer: " . $conn->error . "<br>";
    }

}


  // Close connection
  mysqli_close($conn);
        
  header("Location: product_manage.php");
  die();
  ?>
 
</body>
</html>
