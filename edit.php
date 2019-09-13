<?php
// including the database connection file
include_once("config.php");

if(isset($_POST['update']))
{	
	$ID = $_POST['id'];
	
	$Product=$_POST['productname'];
	$Description=$_POST['lproductdescription'];
	$Price=$_POST['productprice'];
	$Quantity=$_POST['productquantity'];	
	
	// checking empty fields
	if(empty($ID) || empty($Product) || empty($Description) || empty($Price) || empty($Quantity)) {	
			
		if(empty($ID)) {
			echo "<font color='red'>id field is empty.</font><br/>";
		}
		
		if(empty($Product)) {
			echo "<font color='red'>productname field is empty.</font><br/>";
		}
		
		if(empty($Description)) {
			echo "<font color='red'>productdescription field is empty.</font><br/>";
		
		if(empty($Price)) {
				echo "<font color='red'>productprice field is empty.</font><br/>";
			}		
		
		if(empty($Quantity)) {
				echo "<font color='red'>productquantity field is empty.</font><br/>";
			}		
		}		
	} else {	
		//updating the table
		$sql = "UPDATE users SET Product=:agproductname, Description=:productdescription, Price=:productprice, Quantity=:productquantity WHERE Id=:id";
		$query = $dbConn->prepare($sql);
				
		$query->bindparam(':id', $Id);
		$query->bindparam(':productname', $Product);
		$query->bindparam(':productdescription', $Description);
		$query->bindparam(':productprice', $Price);
		$query->bindparam(':productquantity', $Quantity);
		$query->execute();
		
		// Alternative to above bindparam and execute
		// $query->execute(array(':id' => $id, ':name' => $name, ':email' => $email, ':age' => $age));
				
		//redirectig to the display page. In our case, it is index.php
		header("Location: index.php");
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$sql = "SELECT * FROM users WHERE id=:id";
$query = $dbConn->prepare($sql);
$query->execute(array(':id' => $id));

while($row = $query->fetch(PDO::FETCH_ASSOC))
{
	$ID = $row['id'];
	$Product = $row['productname'];
	$Description = $row['productdescription'];
	$Price = $row['productprice'];
	$Quantity = $row['productquantity'];
}
?>
<html>
<head>	
	<title>Edit Data</title>
</head>

<body>
	<a href="index.php">Home</a>
	<br/><br/>
	
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td>ID</td>
				<td><input type="text" name="id" value="<?php echo $ID;?>"></td>
			</tr>
			<tr> 
				<td>Product</td>
				<td><input type="text" name="productname" value="<?php echo $Product;?>"></td>
			</tr>
			<tr> 
				<td>Descrition</td>
				<td><input type="text" name="productdescription" value="<?php echo $Description;?>"></td>
			</tr>
			<tr> 
				<td>Price</td>
				<td><input type="text" name="productprice" value="<?php echo $Price;?>"></td>
			</tr>
			<tr> 
				<td>Quantity</td>
				<td><input type="text" name="productquantity" value="<?php echo $Quantity;?>"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>
