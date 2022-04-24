<!DOCTYPE html>

<html lang="en" dir="ltr">

  <head>

    <meta charset="utf-8">

      <link rel="stylesheet" href="Style.css">

      <script type="text/javascript" src="Script.js" charset="utf-8">  </script>

      <script src="https://kit.fontawesome.com/cf085a3950.js" crossorigin="anonymous"></script>

    <title> Log In </title>

  </head>

  <body>

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
	  
if(isset($_POST['submit']))
{
		$sql = "SELECT id, user, pass FROM signin";
		$result = $link->query($sql);
		if ($result->num_rows > 0) {
  		// output data of each row
		while($row = $result->fetch_assoc()) {
			if ($row["user"]===$_POST['name'] and $row["pass"]===$_POST['password']) 
			{
				$_SESSION["password"] = $row["pass"];
				$_SESSION["name"] = $row["user"];
				echo "Log in complete";
			}
}
}
}
	?>

    <h1> Log in here </h1>

    <br>

   	  <form method="post">


      <div class="imgcontainer">

        <img src="Avatar.png" alt="Avatar" class="avatar">

      </div>

      <div class="container">
		   
        <label for="uname"> <b> Username </b> </label>
        <input type="text" placeholder="Enter Username" name="name" required>

        <label for="psw"> <b> Password </b> </label>
        <input type="password" placeholder="Enter Password" name="password" required>

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <button type="submit" name="submit" formmethod="post"> Log in </button>
		  
        <label>
          <input type="checkbox" checked="checked" name="remember"> Remember me
        </label>
      </div>

      <div class="container" style="background-color: gray;">

        <button type="button" class="cancelbtn"> Cancel </button>

        <span class="psw"> <a href=""> Forgot password? </a> </span>
		  

      </div>

    </form>

  </body>

</html>
