
<?php

if (isset($_POST['uname'])) { 
if (empty($_POST['uname']) || empty($_POST['psw'])) { 
echo "Username or Password is invalid"; 
} 
else{ 
// Define $username and $password 
$username = $_POST['uname']; 
$password = $_POST['psw']; 
// mysqli_connect() function opens a new connection to the MySQL server. 
$conn = mysqli_connect("localhost", "yamini", "kerala32", "user"); 
// SQL query to fetch information of registerd users and finds user match. 
$query = "SELECT uname, psw from user_reg where uname=? AND psw=? LIMIT 1"; 
// To protect MySQL injection for Security purpose 
$stmt = $conn->prepare($query); 
$stmt->bind_param("ss", $username, $password); 
$stmt->execute(); 
$stmt->bind_result($username, $password); 
$stmt->store_result(); 
if($stmt->fetch())
{ //fetching the contents of the row 
echo "You have successfully logged in. Click here to go to ";
?>
<!DOCTYPE html>
<html>
<head>
  <title>Redirecting..</title>
</head>
<body>
<a href="home1.html">Home page</a>
</body>
</html>
<?php
} 
else{
  echo "invalid username or password.click here to go to ";
  ?>
<!DOCTYPE html>
<html>
<head>
  <title>Redirecting..</title>
</head>
<body>
<a href="login2.html">Login page</a>
</body>
</html>
<?php
} 
mysqli_close($conn); // Closing Connection 
} 
}
?>