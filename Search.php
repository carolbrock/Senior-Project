<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="Style.css">
    <script type="text/javascript" src="Script.js" charset="utf-8">  </script>
    <script src="https://kit.fontawesome.com/cf085a3950.js" crossorigin="anonymous"></script>
	  <script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("mySearch");
  filter = input.value.toUpperCase();
  table = document.getElementById("manager");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
	<style>
		button{
			width: 33%;
			align-content: center;
			align="middle";
		}
		input[type=number]
		{
			width: 100%;
			align-items: center;
			padding: 8px;
			text-align:center;
			align="middle";
		}
#manager {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#manager td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#manager tr:nth-child(even){background-color:  #696969;}

#manager tr:hover {background-color: #ddd; color: black;}

#manager th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
    <title> Search </title>
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
	  
	?>
	  <?
	  if(isset($_POST['add']))
	  {
		 $sql = "SELECT `ID`,`Item Name` ,`Item Amount` FROM `Item manager`";
		 $result = $link->query($sql);
		 if ($result->num_rows > 0) {
  		  // output data of each row
		  while($row = $result->fetch_assoc()) {
			if ($row["ID"]===$_POST['id']) 
			{
				$idprestent=TRUE;
				$itemamount=$row['Item Amount'];
			}
		}
	   }
		  $amount = $_POST['amount'];
		  $id = $_POST['id'];
		  
		  if($idprestent)
		  {
			  if($amount<0)
			  {
				  $amount=$amount*-1;
			  }
			  $itemamount=$itemamount+$amount;
			  $sql = "UPDATE `Item manager` SET `Item Amount`= '$itemamount' WHERE `ID` =  '$id'";
			 		if(mysqli_query($link, $sql))
					{
    		 		//echo "Records inserted successfully.";
			 		} 	
			 		else
			 		{
					echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
					} 
			  $sql = "SELECT `Donation ID`, `Item Name`, `Item ID`, `Amount` FROM `Donation manager` ";
		 	  $result = $link->query($sql);
		      if ($result->num_rows > 0) {
  		      // output data of each row
		      while($row = $result->fetch_assoc()) {
			  if ($row["Item ID"]===$_POST['id']) 
			  {
				$donationid=$row['Donation ID'];
				$itemamount=$row['Amount'];
			  }
			}
	       }
			   $itemamount= $itemamount + $amount ;
			   $sql = "UPDATE `Donation manager` SET `Amount`= '$itemamount' WHERE `Donation ID` =  '$donationid'";
			 		if(mysqli_query($link, $sql))
					{
    		 		echo "Records inserted successfully.";
			 		} 	
			 		else
			 		{
					echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
					} 
			  
			  
		  }
		  else
		  {
			  echo "ID for item was not in the system";
		  }
	  }
	  
	   if(isset($_POST['remove']))
	  {
		 $sql = "SELECT `ID`,`Item Name` ,`Item Amount` FROM `Item manager`";
		 $result = $link->query($sql);
		 if ($result->num_rows > 0) {
  		  // output data of each row
		  while($row = $result->fetch_assoc()) {
			if ($row["ID"]===$_POST['id']) 
			{
				$idprestent=TRUE;
				$currentamount=$row['Item Amount'];
				}
			}
		 }
		  $amount = $_POST['amount'];
		  $id = $_POST['id'];
		  if($idprestent)
		  {
			 if($amount<0)
			 {
				 $amount=$amount*-1;
			 }
			$currentamount=$currentamount-$amount;
			if($currentamount<0)
			{
				$currentamount=0;
				$sql = "UPDATE `Item manager` SET `Item Amount`= '$currentamount' WHERE`ID` = '$id'";
				if(mysqli_query($link, $sql))
				{
    			//echo "Records inserted successfully.";
				} 
				$sql = "DELETE FROM `Donation manager` WHERE `Item ID` =  $id";
			 	if(mysqli_query($link, $sql))
			 	{
    		 	//echo "Records inserted successfully.";
			 	} 	
			 	else
			 	{
			 	echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
			 	}
			}
			else
			{
			$sql = "UPDATE `Item manager` SET `Item Amount`= '$currentamount' WHERE`ID` = '$id'";
			if(mysqli_query($link, $sql))
			{
    		echo "Records inserted successfully.";
			} 
			 $sql = "SELECT `Donation ID`,`Item ID`,`Item Name`,`Amount` FROM `Donation manager`";
		 	 $result = $link->query($sql);
		 	 if ($result->num_rows > 0) {
			 // output data of each row
			 while($row = $result->fetch_assoc()) {
			 if ($row["Item ID"]===$id) 
			 {
				 $currentamount=$row['Amount'];
				 $donationid=$row['Donation ID'];
				 if($currentamount-$amount<0)
				 {
					$amount=$amount-$currentamount;
					$sql = "DELETE FROM `Donation manager` WHERE `Donation ID` =  '$donationid'";
			 		if(mysqli_query($link, $sql))
					{
    		 		//echo "Records inserted successfully.";
			 		} 	
			 		else
			 		{
					echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
					}
				  }
				 else
				 {
					$currentamount=$currentamount-$amount;
					//UPDATE `Donation manager` SET `Amount`=[value-4] WHERE `Donation ID`=[value-1]
					$sql = "UPDATE `Donation manager` SET `Amount`= '$currentamount' WHERE `Donation ID` =  '$donationid'";
			 		if(mysqli_query($link, $sql))
					{
    		 		//echo "Records inserted successfully.";
			 		} 	
			 		else
			 		{
					echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
					}
					$amount=0;
				 }
				}
			}
		 }
			}
			
			  
		  }
		  else
		  {
			  echo "ID for item was not in the system";
		  }
	  }
		 
	   if(isset($_POST['delete']))
	  {
		 $sql = "SELECT `ID`,`Item Name` ,`Item Amount` FROM `Item manager`";
		 $result = $link->query($sql);
		 if ($result->num_rows > 0) {
  		  // output data of each row
		  while($row = $result->fetch_assoc()) {
			if ($row["ID"]===$_POST['id']) 
			{
				$idprestent=TRUE;
			}
		}
	   }
		  $amount = $_POST['amount'];
		  $id = $_POST['id'];
		   
	  	  if($idprestent)
		  {
			  //DELETE FROM `Item manager` WHERE `ID` = $id 
			 $sql = "DELETE FROM `Item manager` WHERE `ID` = $id";
			 if(mysqli_query($link, $sql))
			 {
    		 //echo "Records inserted successfully.";
			 } 	
			 else
			 {
			 echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
			 }
			 
			 $sql = "DELETE FROM `Donation manager` WHERE `Item ID` =  $id";
			 if(mysqli_query($link, $sql))
			 {
    		 echo "Records inserted successfully.";
			 } 	
			 else
			 {
			 echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
			 }
		  }
		  else
		  {
			  echo "ID for item was not in the system";
		  }
	  }
	  
	  ?>
	  <form method="post">
		  <br>
	  <input type="number" placeholder ="Enter the id of the item you want changed" name="id" required >
	  <input type="number" placeholder ="Enter the amount you want changed" name="amount" required>
	  <br>
	  <button type="submit" name="add" formmethod="post" value="add" align="middle"> Add </button>
	  <td><button type="submit" name="remove" formmethod="post" value="remove" align="middle"> Remove </button>
	  <td><button type="submit" name="delete" formmethod="post" value="delete" align="middle"> Delete </button>
	  </form>
	  <br>
	   <h3> Having trouble finding an Item? Search its name here. </h3>

    <!--- Search menu --->
       <input type="text" id="mySearch" onkeyup="myFunction()" placeholder="Search..." title="Type in a category">
		<br>
	  
	  <table id="manager">
    <thead>
		<tr>
			<th>Item ID</th>
			<th>Item Name</th>
			<th>Item Amount</th>
        </tr>
		  </thead>
		  <tbody>
	  <?
	$counter;		  
	$sql = "SELECT  `ID`,`Item Name` ,`Item Amount`,`Dairy`,`Meat`,`Dried Goods`,`Canned Goods`,`Toiletries`,`Special Items` FROM `Item manager`";
	$result = $link->query($sql);
	if ($result->num_rows > 0) {
  	// output data of each row
		while($row = $result->fetch_assoc()) {
    
	?>		
        <tr>
			<td><? echo $row["ID"]?></td>
			<td><? echo $row["Item Name"]?></td>
			<td><? echo $row["Item Amount"]?></td>
        </tr>
			  	<?
  		}
	}
?>
			  
    </tbody>
</table>
  </body>
</html>
