<?php
require "connect.php";
echo "[";
if ($_SERVER["REQUEST_METHOD"] == "GET"){
	try{
		$shop=$_GET['shop'];
$subcategories="SELECT DISTINCT I."."subcategory, S."."Name,S."."Photo from items I inner JOIN subcategory S on I".".SubCategory=S".".id where I".".Shop=".$shop."";
$getsubcategories = $conn->query($subcategories);
$getsubcategories->setFetchMode(PDO::FETCH_ASSOC);
$MyJsonData1="";
while($row = $getsubcategories->fetch()):
$MyJsonData1=$MyJsonData1.",".json_encode($row);
endwhile;
$MyJsonData1 = preg_replace('/,/', '', $MyJsonData1, 1);
echo $MyJsonData1;
echo ']';
}catch(Exception $e){

http_response_code(400);
echo "Bad request 400";
}
}else{
http_response_code(400);
echo "Bad request 400";

}

?>