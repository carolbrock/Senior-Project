<!DOCTYPE html>

<html lang="en" dir="ltr">

  <head>

    <meta charset="utf-8">

      <link rel="stylesheet" href="Style.css">

      <script type="text/javascript" src="Script.js" charset="utf-8">  </script>

      <script src="https://kit.fontawesome.com/cf085a3950.js" crossorigin="anonymous"></script>

    <title> Donations</title>

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
	  if(!isset($_SESSION["name"]))
		{
		  header('Location: https://carolinebronson.com/Senior%20Project/Login.php');//redirect the browser to the log in page
		  exit();
	  	}
	  		
	  if(isset($_POST['submit']))
	  {
		  $error="";
		  //echo $_POST['itemname'];
		  //echo $_POST['amount'];
		  //echo $_POST['exp'];
		  //echo $_POST['category'];
		  if($_POST['category']==="Meat")
		  {
			  $meat=1;
			  $driedgods=0;
			  $cannedgoods=0;
			  $toiletries=0;
			  $specialitems=0;
		  }
		  if($_POST['category']==="Dried Goods")
		  {
			  $meat=0;
			  $driedgods=1;
			  $cannedgoods=0;
			  $toiletries=0;
			  $specialitems=0;
		  }
		    if($_POST['category']==="Canned Goods")
		  {
			  $meat=0;
			  $driedgods=0;
			  $cannedgoods=1;
			  $toiletries=0;
			  $specialitems=0;
		  }
		    if($_POST['category']==="Toiletries")
		  {
			  $meat=0;
			  $driedgods=0;
			  $cannedgoods=0;
			  $toiletries=0;
			  $specialitems=0;
		  }
		    if($_POST['category']==="Special Items")
		  {
			  $meat=0;
			  $driedgods=0;
			  $cannedgoods=0;
			  $toiletries=0;
			  $specialitems=1;
		  }
		  if($_POST['category']==="Dairy")
		  {
			 $dairy=1; 
		  }
		  if(isset($_POST['category']))
		  {
			  $error .="No category of item was selected";
		  }
		  
		  $sql = "SELECT `ID`,`Item Name`,`Item Amount` FROM `Item manager`";
		  $result = $link->query($sql);
		  if ($result->num_rows > 0) {
  		  // output data of each row
		  while($row = $result->fetch_assoc()) {
			if ($row["Item Name"]===$_POST['itemname']) 
			{
				$itemid = $row["ID"];
				$itemname = $row["Item Name"];
				$itemamountsystem=$row["Item Amount"];
				$iteminsystem =True;
			}
	  	}
	}
}
	  if(isset($_POST['submit']))
	  {
		  //echo $error;
		  if(isset($error))
		  {
		  	if($iteminsystem)
		  	{
				$itemamountsystem=$itemamountsystem+$_POST["amount"];
				$amountadded=$_POST["amount"];
				$date=$_POST["exp"];
				$name=$_SESSION["name"];
				//echo $name;
				//echo $itemname;
				if(!isset($date))
				{
					$date="0000/00/00";
				}
				$sql = "UPDATE `Item manager` SET `Item Amount`=$itemamountsystem WHERE`ID`= $itemid";
				if(mysqli_query($link, $sql))
				{
    			//echo "Records inserted successfully.";
				} 	
				else
				{
				echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
				}
				//INSERT INTO `Donation manager`(`Item Name`, `Item ID`, `Amount`, `Exp Date`, `Donation logger`) VALUES //("c",2,2,"0000/00/00","a")
				$sql = "INSERT INTO `Donation manager`(`Item Name`, `Item ID`, `Amount`, `Exp Date`, `Donation logger`) VALUES ('$itemname','$itemid','$amountadded','$date','$name')";
				if(mysqli_query($link, $sql))
				{
    			echo "Records inserted successfully.";
				} 	
				else{
				echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
				}
		  	}
		  	else
		  	{
			  //SELECT `ID` FROM `Item manager` WHERE `Item Name` = 
				
				$amountadded=$_POST["amount"];
				$date=$_POST["exp"];
				$name=$_SESSION["name"];
				$itemname=$_POST['itemname'];
				$milk=$_POST['milk'];
				$soy=$_POST['soy'];
				$fish=$_POST['$fish'];
				$nuts=$_POST['nuts'];
				//echo $name;
				//echo $itemname;
				if(!isset($date))
				{
					$date="0000/00/00";
				}
				$sql = "INSERT INTO `Item manager`(`Item Name`, `Item Amount`, `Milk`, `Nuts`, `Soy`, `Fish`, `Dairy`, `Meat`, `Dried Goods`, `Canned Goods`, `Toiletries`, `Special Items`) VALUES ('$itemname','$amountadded','$milk','$nuts','$soy','$fish','$dairy','$meat','$driedgods','$cannedgoods','$toiletries','$specialitems')";
				if(mysqli_query($link, $sql))
				{
    			//echo "Records inserted successfully.";
				} 	
				else{
				echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
				}
				
				
				$sql = "SELECT `ID` FROM `Item manager` WHERE `Item Name` ='$itemname'";
					$result = $link->query($sql);
				if ($result->num_rows > 0) {
  				// output data of each row
				while($row = $result->fetch_assoc()) {
				$itemid=$row['ID'];
			}
		}
				else{
				echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
				}
				
				
				$sql = "INSERT INTO `Donation manager`(`Item Name`, `Item ID`, `Amount`, `Exp Date`, `Donation logger`) VALUES ('$itemname','$itemid','$amountadded','$date','$name')";
				if(mysqli_query($link, $sql))
				{
    			echo "Records inserted successfully.";
				} 	
				else{
				echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
				}
		  	}
		  }
	  }
	  ?>
	  
<form method="post" style="border:1px solid: white">

      <div class="container">

        <h1> Donation Page </h1>
        <p> Please fill in this form to input a donation into the system. </p>

        <hr>

        <label for="itemname"> <b> Item Name: </b> </label>
        <input type="text" placeholder="Enter the item's name" name="itemname" required>

        <label for="amount"> <b> Item Amount: </b> </label> <br>
        <input type="number" placeholder="Enter the amount" name="amount" required > 
		<br>
		<br>
        <label for="exp"> <b> Expiration Date: </b> </label> <br>
        <input type="date" placeholder="Enter the expiration date for the product" name="exp">
		<br>
		<br>
		<input type="hidden" name="category" value="Special Items" id="hidden">
		<label for="hidden">What is the Category of your item?</label>
		<br>
		<input type="radio" id="Meat" name="category" value="Meat" checked>
  		<label for="Meat">Meat</label>
		<br>
		 
		<input type="radio" id="Dairy" name="category" value="Dairy">
  		<label for="Dairy">Dairy</label>
		<br>  
		  
  		<input type="radio" id="Dried Goods" name="category" value="Dried Goods">
  		<label for="Dried Goods">Dried Goods</label>
		<br>
 		<input type="radio" id="Canned Goods" name="category" value="Canned Goods">
 		<label for="Canned Goods">Canned Goods</label>
		<br>
		<input type="radio" id="Toiletries" name="category" value="Toiletries">
  		<label for="Toiletries">Toiletries</label>
		<br>
		<input type="radio" id="Special Items" name="category" value="Special Items">
  		<label for="Special Items">Special Items</label>
		<br>
		<br>
		<p>What does this item contain?</p>
		<input type="checkbox" id="nuts" name="nuts" value="1">
  		<label for="nuts">This item contains nuts</label>
		<br>
  		<input type="checkbox" id="milk" name="milk" value="1">
  		<label for="milk">This item contains milk</label>
		<br>
  		<input type="checkbox" id="fish" name="fish" value="1">
  		<label for="fish">This item contains fish</label>
		<br>
  		<input type="checkbox" id="soy" name="soy" value="1">
  		<label for="soy">This item contains soy</label>
		  
      </div>

      <div class="clearfix">
		<button type="submit"  class="signupbtn" name="submit" formmethod="post">Submit</button>
		  </div>
	</form>
  </body>
</html>
