<?php
require "connect.php";
require "sql.php";
if ($_SERVER["REQUEST_METHOD"] == "GET"){
		$customerid=isset($_GET['customerid'])?$_GET['customerid']:"";
	try{
		if($customerid==""){

$searchterm="SELECT I".".id, I.itemname,I.itemnamear,'' as isfavorite,I.description,I.descriptionar,I.preparetime,I.timesamples, I.shop,S.shopname,I.subcategory,SU.subcatname, I.photo,I.photo1,I.photo2, I.price, I.timesold,avg(F.rating) as rating,count(F.rating) as ratingnumber FROM items I left join feedback F on I.id=F.itemid left join shop S on I.shop=S.id left join subcategory SU on I.subcategory=SU.id WHERE S.active=1 GROUP By I.id";
$MyJsonData1 =sql_selectdata($searchterm,$conn);
$MyJsonData1 = preg_replace('/,/', '', $MyJsonData1, 1);
$MyJsonData1 = preg_replace('/(?<=":)null(?=\,)/', '""', $MyJsonData1);
$MyJsonData1=preg_replace('/"rating":null/', '"rating":"1"', $MyJsonData1);
$MyJsonData1 = preg_replace('/(?<="isfavorite":).+?(?=,)/', '"NO"', $MyJsonData1);
echo "[";
echo $MyJsonData1;
echo ']';
}elseif ($customerid!="") {
$getfavorites="SELECT * from favorites where customerid=".$customerid."";
$MyJsonData=sql_selectdata($getfavorites,$conn);
preg_match_all('/(?<="itemid":").+?(?=")/', $MyJsonData,$itemid);
// print_r($itemid[0]);
$searchterm="SELECT I."."id, I.itemname,I.itemnamear,MF.customerid as isfavorite,I.description,I.descriptionar,I.preparetime,I.timesamples, I.shop,S.shopname,I.subcategory,SU.subcatname, I.photo,I.photo1,I.photo2, I.price, I.timesold,avg(F.rating) as rating,count(F.rating) as ratingnumber FROM items I left join favorites MF on MF.itemid=I.id left join feedback F on I.id=F.itemid left join shop S on I.shop=S.id left join subcategory SU on I.subcategory=SU.id WHERE S.active=1 GROUP By I.id";
$MyJsonData1 =sql_selectdata($searchterm,$conn);
$MyJsonData1 = preg_replace('/,/', '', $MyJsonData1, 1);
$MyJsonData1=preg_replace('/"rating":null/', '"rating":"1"', $MyJsonData1);
$MyJsonData1 = preg_replace('/(?<=":)null(?=\,)/', '""', $MyJsonData1);
preg_match_all('/(?<="id":").+?(?=",)/', $MyJsonData1,$itemid2);
// print_r($itemid2[0]);
for($i=0;$i<count($itemid2[0]);$i++){
if(in_array($itemid2[0][$i],$itemid[0])){

preg_match('/"id":"'.$itemid2[0][$i].'".+?isfavorite":/', $MyJsonData1,$match);


$MyJsonData1 = preg_replace('/(?<='.$match[0].').+?(?=,)/', '"YES"', $MyJsonData1);
}
else{ 
preg_match('/"id":"'.$itemid2[0][$i].'".+?isfavorite":/', $MyJsonData1,$match);
	$MyJsonData1 = preg_replace('/(?<='.$match[0].').+?(?=,)/', '"NO"', $MyJsonData1);
}
}

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
