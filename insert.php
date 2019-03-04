<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$tel = "";
$gender = "";
$state = "";
$reg = "";
$password_1 = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'yamini', 'kerala32', 'user');
if ($db->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


// REGISTER USER
if (isset($_POST['email'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['uname']);
  $tel = mysqli_real_escape_string($db, $_POST['tel']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $gender = mysqli_real_escape_string($db, $_POST['gender']);
  $state = mysqli_real_escape_string($db, $_POST['stateslist']);
  $reg = mysqli_real_escape_string($db, $_POST['reg']);
  $password_1 = mysqli_real_escape_string($db, $_POST['psw']);
$password_2=mysqli_real_escape_string($db, $_POST['rpsw']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
    if($password_1!=$password_2)
  {
  	array_push($errors,"passwords doesnot match");
  }

  

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM user_reg WHERE uname='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['uname'] == $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] == $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO user_reg (reg, uname, psw, tel, email, gender, state) 
  			  VALUES('$reg', '$username', '$password', '$tel', '$email', '$gender', '$state')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	echo "you are logged in. click here to go to ";
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
  	}
  	?>
  	