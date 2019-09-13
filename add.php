<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php
//including the database connection file
include_once("config.php");

if(isset($_POST['Submit'])) {	
	$Product = $_POST['productname'];
	$ID = $_POST['id'];
	$Description = $_POST['productdescription'];
	$Price = $_POST['productprice'];
	$Quantity = $_POST['productquantity'];
		
	// checking empty fields
	if(empty($ID) || empty($Product) || empty($Description)|| empty($Price) || empty($Quantity)) {
		
		if(empty($ID)) {
			echo "<font color='red'>id field is empty.</font><br/>";
		}

		if(empty($Product)) {
			echo "<font color='red'>productname field is empty.</font><br/>";
		}
		
		
		if(empty($Description)) {
			echo "<font color='red'>productdescrition field is empty.</font><br/>";
		}
		
		if(empty($Price)) {
			echo "<font color='red'>productprice field is empty.</font><br/>";
		}
		if(empty($Quantity)) {
			echo "<font color='red'>productquantity field is empty.</font><br/>";
		}
		
		
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// if all the fields are filled (not empty) 
			
		//insert data to database		
		$sql = "INSERT INTO users(ID, Product, Description, Price, Quantity,) VALUES(:productname, :id, :productdescription, :productprice, :productquantity:)";
		$query = $dbConn->prepare($sql);
				
		$query->bindparam(':id', $ID);
		$query->bindparam(':productname', $Product);
		$query->bindparam(':productdescrition', $Description);
		$query->bindparam(':productprice', $Price);
		$query->bindparam(':productquantity', $Quantity);
		$query->execute();
		
		// Alternative to above bindparam and execute
		// $query->execute(array(':name' => $name, ':email' => $email, ':age' => $age));
		
		//display success message
		echo "<font color='green'>Data added successfully.";
		echo "<br/><a href='index.php'>View Result</a>";
	}
}
?>
</body>
</html>
