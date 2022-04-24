<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="Style.css">
    <style media="screen">
      *
      {
        box-sizing: border-box;
      }

      input[type=text], input[type=password]
      {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: white;
      }

      input[type=text]:focus, input[type=password]:focus
      {
        background-color: gray;
        outline: none;
      }

      hr
      {
        border: 1px solid gray;
        margin-bottom: 25px;
      }

      button
      {
        background-color: #D3D3D3;
        color: black;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
      }

      button:hover
      {
        opacity:1;
      }

      .cancelbtn
      {
        padding: 14px 20px;
        background-color: #696969;
        color: white;
      }

      .cancelbtn, .signupbtn
      {
        float: left;
        width: 50%;
      }

      .container:
      {
        padding: 16px;
      }

      .clearfix:after
      {
        content: "";
        clear: both;
        display: table;
      }

      @media screen and (max-width: 300px)
      {
        .cancelbtn, .signupbtn
        {
          width: 100%;
        }
      }
    </style>
    <script type="text/javascript" src="Script.js">  </script>
    <script src="https://kit.fontawesome.com/cf085a3950.js" crossorigin="anonymous"></script>
    <title> Sign up </title>
  </head>
  <body>

    <!--- PHP for sign up form --->

    <div class="topnav" id="myTopnav">

      <a href="Welcome.php"> <i class="fa fa-fw fa-home"> </i> Home </a>

      <a href="About.php" class="active"> <i class="fa-solid fa-address-card"></i> About </a>

      <a href="News.php"> <i class="fa fa-newspaper"></i> News </a>

      <a href="Search.php"> <i class= "fa fa-fw fa-search"></i> Item Manager </a>
		
	  <a href="Searchdonation.php"> <i class= "fa fa-fw fa-search"></i> Donation Manager </a>	

      <a href="Donate.php"> <i class="fa-solid fa-hand-holding-dollar"></i> Donate </a>

      <a href="Contact.php"> <i class="fa fa-fw fa-envelope"></i> Contact </a>

      <a href="Login.php"> <i class="fa fa-fw fa-user"></i> Log in </a>

      <a href="Signup.php"> <i class="fa-solid fa-user-plus"></i> Sign up </a>

	<a href="logout.php"> <i class="fa-solid fa-user-minus"></i> Log Out </a>

      <a href="javascript:void(0);" class="icon" onclick="hover()">

        <i class="fa fa-bars"> </i>

      </a>

    </div>

    <!--- PHP code for form starts here --->
	<?php 
		  $host_name = 'db5001054903.hosting-data.io';
		  $database = 'dbs909100';
		  $user_name = 'dbu323529';
		  $password = 'YrrFEPgF3vrqQ4!';

		  $link = new mysqli($host_name, $user_name, $password, $database);

		  if ($link->connect_error) {
			die('<p>Failed to connect to MySQL: '. $link->connect_error .'</p>');
		  } else 
		  {
			//echo '<p>Connection to MySQL server successfully established.</p>';
		  }
	  	session_start();
	  	if(isset($_SESSION["name"]))
		{
		  header('Location:https://carolinebronson.com/Senior%20Project/Welcome.php');//redirect the browser to the log in page
		  exit();
	  	}
	  
	?>
<?php

    if(isset($_POST["submit"]))
    { 	
		
		$errors="";
		
		if(!$_POST["psw"]===$_POST["psw-repeat"])
		{
			//if the passwords dont match
			$errors .= "The passwords do not match.<br>";
		}
		
		$sql = "SELECT id, user, pass FROM signin";
		$result = $link->query($sql);
		if ($result->num_rows > 0) {
  		// output data of each row
		while($row = $result->fetch_assoc()) {
			if ($row["user"]===$_POST['username']) 
			{
				$errors .= "The username was used before<br>";
			}
		}
		}
		//echo $errors;
		
	}
	  
 ?>

	  	<?	   
	  if(isset($_POST["submit"]))//submit button was clicked
		{ //echo "form submitted<br>";
		if(strlen($errors) > 0)
		{
			echo $errors;
		}
		else{
			$fname=$_POST["firstname"];
			$lastname=$_POST["lastname"];
			$email=$_POST["email"];
			$name=$_POST["username"];
			$password=$_POST["psw"];
		$sql = "INSERT INTO signin ( Fname, Lname , email , user, pass) VALUES ('$fname','$lastname','$email','$name', '$password')";
	if(mysqli_query($link, $sql)){
    	echo "Records inserted successfully.";
		$_SESSION["password"] = $_POST["psw"];
		$_SESSION["name"] = $_POST["username"];
			} 	
		else{
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
			}
		}
	  }
?>
	  
    <form method="post" style="border:1px solid: white">

      <div class="container">

        <h1> Sign up </h1>
        <p> Please fill in this form to create an account. </p>

        <hr>

        <label for="firstname"> <b> First Name </b> </label>
        <input type="text" placeholder="Enter First Name" name="firstname" required>

        <label for="lastname"> <b> Last Name </b> </label>
        <input type="text" placeholder="Enter Last Name" name="lastname" required>

        <label for="email"> <b> Email </b> </label> 
        <input type="text" placeholder="Enter Email" name="email" required>

        <label for="username"> <b> Username </b> </label> 
        <input type="text" placeholder="Enter Username" name="username" required>

        <label for="psw"> <b> Password </b> </label>
        <input type="password" placeholder="Enter Password" name="psw" required>

        <label for="psw-repeat"> <b> Repeat Password </b> </label>
        <input type="password" placeholder="Repeat Password" name="psw-repeat" required>

        <label>
          <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px">
          Remember me
        </label>

        <p> By creating your account, you agree to our <a href="#" style="color:white"> Terms of Service </a> </p>

      </div>

      <div class="clearfix">

        <button type="button" class="cancelbtn"> Cancel </button>
		<button type="submit"  class="signupbtn" name="submit" formmethod="post"> Sign up </button>
		  

      </div>
	</form>
  </body>
</html>
