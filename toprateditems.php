<?php
require "connect.php";
$MyJsonData1="";
$topitems="SELECT DISTINCT I".".id,I".".ItemPhoto,I.Price,AVG(F.Rating) as Rating FROM items as I inner join feedback as F on F.ItemId=I.id GROUP by F.ItemId limit 10";
$gettopitems = $conn->query($topitems);
$gettopitems->setFetchMode(PDO::FETCH_ASSOC);
while($row = $gettopitems->fetch()):
$MyJsonData1=$MyJsonData1.",".json_encode($row);
endwhile;
$MyJsonData1 = preg_replace('/,/', '', $MyJsonData1, 1);
echo "[";
echo $MyJsonData1;
echo ']';
?>