<?php
require "connect.php";
require "sql.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
try{
$post = file_get_contents('php://input');
preg_match('/(?<=firstname":").+?(?=")/',$post,$firstname);
preg_match('/(?<=lastname":").+?(?=")/',$post,$lastname);
preg_match('/(?<=email":").+?(?=")/',$post,$email);
preg_match('/(?<=phonenumber":").+?(?=")/',$post,$phonenumberafter);
preg_match('/(?<=phonenumber":").+?(?=")/',$post,$phonenumberbefore);
preg_match('/(?<=photopath":").+?(?=")/',$post,$photopath);
preg_match('/(?<=photo":").+?(?=")/',$post,$photo);
preg_match('/(?<=city":").+?(?=")/',$post,$city);
$username=$phonenumberafter;
if(!isset($firstname[0])&&!isset($lastname[0])){
preg_match('/(?<=firstname=).+?(?=&|$)/',$post,$firstname);
preg_match('/(?<=lastname=).+?(?=&|$)/',$post,$lastname);
preg_match('/(?<=phonenumber=).+?(?=&|$)/',$post,$phonenumberafter);
preg_match('/(?<=phonenumber=).+?(?=&|$)/',$post,$phonenumberbefore);
preg_match('/(?<=photopath=).+?(?=&|$)/',$post,$photopath);
preg_match('/(?<=photo=).+?(?=&|$)/',$post,$photo);
preg_match('/(?<=city=).+?(?=&|$)/',$post,$city);
}

$getuserinfo="SELECT id FROM customers where phonenumber='$phonenumberafter[0]'";
$MyJsonData1 = sql_selectdata($getuserinfo,$conn);
$MyJsonData1 = preg_replace('/,/', '', $MyJsonData1, 1);
preg_match('/(?<=active":").+?(?=")/',$MyJsonData1,$active);
preg_match('/(?<=id":").+?(?=")/',$MyJsonData1,$id);



if(isset($photopath[0])&&isset($photo)){
if(!isset($photopath[0])||$photopath[0]==""||$photopath[0]=="null"||is_null($photopath[0])){
$photopath[0]="";
$photo[0]="";
}if(!isset($photo[0])||$photo[0]==""||$photo[0]=="null"||is_null($photo[0])){
$photopath[0]="";
$photo[0]="";
}

$usernamechange= 'UPDATE loginandregister SET username="'.$username[0].'" WHERE username="'.$username[0].'"'; 
sql_update($usernamechange,$conn);




$myfile="";
$contents="";

$contents=base64_decode($photo[0]);
switch (true) {
	case stristr($photopath[0],"png"):
		$myfile = "img/profile/customer/".$id[0].".png";		
		break;
		case stristr($photopath[0],"PNG"):
		$myfile = "img/profile/customer/".$id[0].".png";
		break;
	case stristr($photopath[0],"Png"):
		$myfile = "img/profile/customer/".$id[0].".png";
		break;
		case stristr($photopath[0],"jpg"):
		$myfile = "img/profile/customer/".$id[0].".jpg";
		break;
		case stristr($photopath[0],"JPG"):
		$myfile = "img/profile/customer/".$id[0].".jpg";
		break;
	case stristr($photopath[0],"Jpg"):
		$myfile = "img/profile/customer/".$id[0].".jpg";
		
		break;
		case stristr($photopath[0],"jpeg"):
		$myfile = "img/profile/customer/".$id[0].".jpeg";
		break;
		case stristr($photopath[0],"JPEG"):
		$myfile = "img/profile/customer/".$id[0].".jpeg";
		break;
	case stristr($photopath[0],"Jpeg"):
		$myfile = "img/profile/customer/".$id[0].".jpeg";
		
		break;
		case stristr($photopath[0],"gif"):
		$myfile = "img/profile/customer/".$id[0].".gif";
		
		break;
		case stristr($photopath[0],"GIF"):
		$myfile = "img/profile/customer/".$id[0].".gif";
		
		break;
	case stristr($photopath[0],"Gif"):
		$myfile = "img/profile/customer/".$id[0].".gif";
		
		break;
		case stristr($photopath[0],"TIFF"):
		$myfile = "img/profile/customer/".$id[0].".tiff";
		break;
		case stristr($photopath[0],"tiff"):
		$myfile = "img/profile/customer/".$id[0].".tiff";
		
		break;
	case stristr($photopath[0],"Tiff"):
		$myfile = "img/profile/customer/".$id[0].".tiff";
		
		break;
	default:
		echo "file is not an image";
		break;
}

file_put_contents($myfile,$contents);





$customerinfo= 'UPDATE customers SET firstname="'.$firstname[0].'",lastname="'.$lastname[0].'",phonenumber="'.$phonenumberafter[0].'",city="'.$city[0].'",photo="'.$myfile.'" WHERE id="'.$id[0].'"'; 
sql_update($customerinfo,$conn);












}else{
	$usernamechange= 'UPDATE loginandregister SET username="'.$username[0].'" WHERE username="'.$username[0].'"'; 
sql_update($usernamechange,$conn);
$customerinfo= 'UPDATE customers SET firstname="'.$firstname[0].'",lastname="'.$lastname[0].'",phonenumber="'.$phonenumberafter[0].'",city="'.$city[0].'" WHERE id="'.$id[0].'" ';
sql_update($customerinfo,$conn);

}


$getuserinfo="SELECT * FROM customers where id=".$id[0]."";
$MyJsonData1 =sql_selectdata($getuserinfo,$conn);
$MyJsonData1 = preg_replace('/,/', '', $MyJsonData1, 1);

$MyJsonData1 = preg_replace('/(?<=":)null(?=\,)/', '""', $MyJsonData1);




echo "[";
echo $MyJsonData1;
echo "]";


}catch(Exception $e){
	http_response_code(400);
	echo "400 error bad request";
}
}else{
	http_response_code(400);
	echo "400 error bad request";
}
?>