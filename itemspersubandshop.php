<?php
require "connect.php";
if ($_SERVER["REQUEST_METHOD"] == "GET"){
	$subcategory=$_GET['subcategory'];
	$shop=$_GET['shop'];
	$customerid=isset($_GET['customerid'])?$_GET['customerid']:"";
	try{
	if($customerid==""){
$MyJsonData1="";
echo "[";
$items="SELECT I."."id, I.Name,'' as IsFavorite,I.Description, I.Shop,S.ShopName, I.Photo,I.Photo1,I.Photo2, I.Price, I.TimesSold,avg(F.Rating) as Rating,count(F.Rating) as RatingNumber FROM items I,feedback F,shop S where F.ItemId=I.id and S.id=I.Shop and I.SubCategory=$subcategory AND I.Shop=$shop GROUP By F.ItemId";
$getitems = $conn->query($items);
$getitems->setFetchMode(PDO::FETCH_ASSOC);
while($row = $getitems->fetch()):
$MyJsonData1=$MyJsonData1.",".json_encode($row);
endwhile;
$MyJsonData1 = preg_replace('/,/', '', $MyJsonData1, 1);
echo $MyJsonData1;
echo ']';
}elseif($customerid!="") {
$MyJsonData1="";
echo "[";
$items="SELECT I."."id,MF.CustomerId as IsFavorite, I.Name,I.Description,I.Shop, I.Photo,I.Photo1,I.Photo2, I.Price, I.TimesSold,avg(F.Rating) as Rating,count(F.Rating) as RatingNumber FROM items I left join favorites MF on MF.ItemId=I.id join feedback F on F.ItemId=I.id WHERE I.shop=$shop and I.SubCategory=$subcategory GROUP By F.ItemId
";
$getitems = $conn->query($items);
$getitems->setFetchMode(PDO::FETCH_ASSOC);
while($row = $getitems->fetch()):
$MyJsonData1=$MyJsonData1.",".json_encode($row);
endwhile;
$MyJsonData1 = preg_replace('/,/', '', $MyJsonData1, 1);
$MyJsonData1 = preg_replace('/(?<="IsFavorite":")(?!'.$customerid.')\d+(?=")/', 'NO', $MyJsonData1, 1);
$MyJsonData1 = preg_replace('/(?<="IsFavorite":")'.$customerid.'(?=")/', 'YES', $MyJsonData1, 1);
echo $MyJsonData1;
echo ']';
	
}
}catch(Exception $e){
	echo "400 error bad request";
	http_response_code(400);
}
}else{
	echo "400 error bad request";
http_response_code(400);
}

?>