<?php
require "connect.php";
if ($_SERVER["REQUEST_METHOD"] == "GET"){
		$subcategory=$_GET['subcategory'];
		$customerid=isset($_GET['customerid'])?$_GET['customerid']:"";
	try{
		if($customerid==""){
$MyJsonData1="";
$itemspersub="SELECT I."."id, I."."Name,I.Description, I.Shop,S.ShopName, I.Photo,I.Photo1,I.Photo2, I.Price, I.TimesSold,avg(F.Rating) as Rating,count(F.Rating) as RatingNumber FROM items I,feedback F,shop S where F.ItemId=I.id and S.id=I.Shop and I.SubCategory=$subcategory GROUP By F.ItemId";
$getitemspersub = $conn->query($itemspersub);
$getitemspersub->setFetchMode(PDO::FETCH_ASSOC);
while($row = $getitemspersub->fetch()):
$MyJsonData1=$MyJsonData1.",".json_encode($row);
endwhile;
$MyJsonData1 = preg_replace('/,/', '', $MyJsonData1, 1);
echo "[";
echo $MyJsonData1;
echo ']';
}elseif ($customerid!="") {
$MyJsonData1="";
$itemspersub="SELECT I."."id, I.Name,MF.CustomerId as IsFavorite,I.Description, I.Shop,S.ShopName, I.Photo,I.Photo1,I.Photo2, I.Price, I.TimesSold,avg(F.Rating) as Rating,count(F.Rating) as RatingNumber FROM items I left join favorites MF on MF.ItemId=I.id,feedback F,shop S where F.ItemId=I.id and S.id=I.Shop and I.SubCategory=$subcategory GROUP By F.ItemId";
$getitemspersub = $conn->query($itemspersub);
$getitemspersub->setFetchMode(PDO::FETCH_ASSOC);
while($row = $getitemspersub->fetch()):
$MyJsonData1=$MyJsonData1.",".json_encode($row);
endwhile;
$MyJsonData1 = preg_replace('/,/', '', $MyJsonData1, 1);
$MyJsonData1 = preg_replace('/(?<="IsFavorite":")(?!'.$customerid.')\d+(?=")/', 'NO', $MyJsonData1, 1);
$MyJsonData1 = preg_replace('/(?<="IsFavorite":")'.$customerid.'(?=")/', 'YES', $MyJsonData1, 1);
echo "[";
echo $MyJsonData1;
echo ']';
}
}catch(Exception $e){
echo "400 bad request";	
}}else{
echo "400 bad request";
}
?>
