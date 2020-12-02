<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="login1.css">
</head>
<body>
<div class="navbar">
	<div id="logo">
  <a class="logo" href="#">FoodTruck</a>
  </div>
  <ul class="nav">
    <li><a href="#">Home</a></li>
    <li><a href="#">login</a></li>
    <li><a href="#">register</a></li>
    <li><a href="#">About</a></li>
  </ul>
</div>
<div class="img">
<img src="../../<?php echo $_SESSION['photo']; ?>">
</div><br>
<div class="sidebar">
<button class="side" id="addsubcat" onclick="location.href = '../addsubcatpage.php';">Add SubCategory</button>
<button class="side" id="addproduct">Add Product</button>
</div><br>


<div class="myform">
<form action="editprofile" method="get">
<input type="text" name="id" id="id" value="<?php echo $_SESSION['id']; ?>" disabled><br>
<input type="text" name="shopname" class="shopdata" id="shopname" value="<?php echo $_SESSION['shopname']; ?>" disabled><br>
	<input type="text" name="foodtrucknamear" class="shopdata" id="foodtrucknamear" value="<?php echo $_SESSION['shopnamear']; ?>" disabled><br>
	<input type="text" name="firstname" class="shopdata" id="firstname" value="<?php echo $_SESSION['firstname']; ?>" disabled><br>
	<input type="text" name="lastname" class="shopdata" id="lastname" value="<?php echo $_SESSION['lastname']; ?>" disabled><br>
	<input type="text" name="phonenumber" class="shopdata" id="phonenumber" value="<?php echo $_SESSION['phonenumber']; ?>" disabled><br>
	<input type="text" name="email" class="shopdata" id="email" value="<?php echo $_SESSION['email']; ?>" disabled><br>
	<input type="text" name="city" class="shopdata" id="city" value="<?php echo $_SESSION['city']; ?>" disabled><br>
	<input type="text" name="active"  id="active" value="<?php echo $_SESSION['active']; ?>" disabled><br>
	<input type="text" name="location" class="shopdata" id="location" value="<?php echo $_SESSION['location']; ?>" disabled ><br>
	<input type="text" name="address" class="shopdata" id="address" value="<?php echo $_SESSION['address']; ?>" disabled><br>
	<input type="time" name="opentime" class="shopdata" id="opentime" value="<?php echo $_SESSION['opentime']; ?>" disabled><br>
	<input type="time" name="closetime" class="shopdata" id="closetime" value="<?php echo $_SESSION['closetime']; ?>" disabled><br>
	<button type="button" class="button" onclick="edit();">edit</button>
	<input type="submit" class="button" action="editprofile" value="submit">

</div>
</form>







<script type="text/javascript">
function edit(){
var elem=document.querySelectorAll(".shopdata");
var i=0;
for(i=0;i<elem.length;i++){
elem[i].removeAttribute("disabled");
}
console.log(elem);
}	
</script>
</body>
</html>