<?php
require "connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
try{
$post = file_get_contents('php://input');
preg_match('/(?<=username":").+?(?=")/',$post,$username);
preg_match('/(?<=password":").+?(?=")/',$post,$password);
preg_match('/(?<=shopname":").+?(?=")/',$post,$shopname);
preg_match('/(?<=firstname":").+?(?=")/',$post,$firstname);
preg_match('/(?<=lastname":").+?(?=")/',$post,$lastname);
preg_match('/(?<=email":").+?(?=")/',$post,$email);
preg_match('/(?<=phonenumber":").+?(?=")/',$post,$phonenumber);
preg_match('/(?<=photopath":").+?(?=")/',$post,$photopath);
preg_match('/(?<=idphoto1":").+?(?=")/',$post,$idphoto1);
preg_match('/(?<=idphoto2":").+?(?=")/',$post,$idphoto2);
preg_match('/(?<=type":").+?(?=")/',$post,$type);
preg_match('/(?<=location":").+?(?=")/',$post,$location);
preg_match('/(?<=monthlypayment":").+?(?=")/',$post,$monthlypayment);
preg_match('/(?<=size":").+?(?=")/',$post,$size);

if(!isset($username[0])&&!isset($password[0])){
preg_match('/(?<=username=).+?(?=&|$)/',$post,$username);
preg_match('/(?<=password=).+?(?=&|$)/',$post,$password);
preg_match('/(?<=shopname=).+?(?=&|$)/',$post,$shopname);
preg_match('/(?<=firstname=).+?(?=&|$)/',$post,$firstname);
preg_match('/(?<=lastname=).+?(?=&|$)/',$post,$lastname);
preg_match('/(?<=email=).+?(?=&|$)/',$post,$email);
preg_match('/(?<=phonenumber=).+?(?=&|$)/',$post,$phonenumber);
preg_match('/(?<=photopath=).+?(?=&|$)/',$post,$photopath);
preg_match('/(?<=idphoto1=).+?(?=&|$)/',$post,$idphoto1);
preg_match('/(?<=idphoto2=).+?(?=&|$)/',$post,$idphoto2);
preg_match('/(?<=type=).+?(?=&|$)/',$post,$type);
preg_match('/(?<=location=).+?(?=&|$)/',$post,$location);
preg_match('/(?<=monthlypayment=).+?(?=&|$)/',$post,$monthlypayment);
preg_match('/(?<=size=).+?(?=&|$)/',$post,$size);
}
$userinfo= 'INSERT INTO `shop`(`ShopName`, `FirstName`,`LastName`, `Phone`, `Email`, `Type`, `Location`,`MonthlyPayment`,`Size`,`Active`,`IdPhoto1`,`IdPhoto2`) VALUES ("'.$shopname[0].'","'.$firstname[0].'","'.$lastname[0].'","'.$phonenumber[0].'","'.$email[0].'","'.$type[0].'","'.$location[0].'","'.$monthlypayment[0].'","'.$size[0].'",1,"'.$idphoto1[0].'","'.$idphoto2[0].'")';
$stmt= $conn->prepare($userinfo);
$stmt->execute();
$fetchuserinfo='SELECT * FROM shop WHERE Email="'.$email[0].'"';
$getuser = $conn->query($fetchuserinfo);
$getuser->setFetchMode(PDO::FETCH_ASSOC);
echo '[';
$MyJsonData="";	
while($row = $getuser->fetch()):
$MyJsonData=$MyJsonData.",".json_encode($row);
endwhile;
$MyJsonData = preg_replace('/,/', '', $MyJsonData, 1);

preg_match('/(?<=id":").+?(?=")/',$MyJsonData,$id);



if(isset($photopath[0])){
$contents=file_get_contents($photopath[0]);
switch (true) {
	case stristr($photopath[0],"png"):
		$myfile = "img/profile/shop_".$id[0].".png";		
		
		break;
		case stristr($photopath[0],"PNG"):
		$myfile = "img/profile/shop_".$id[0].".png";
		break;
	case stristr($photopath[0],"Png"):
		$myfile = "img/profile/shop_".$id[0].".png";
		break;
		case stristr($photopath[0],"jpg"):
		$myfile = "img/profile/shop_".$id[0].".jpg";
		break;
		case stristr($photopath[0],"JPG"):
		$myfile = "img/profile/shop_".$id[0].".jpg";
		break;
	case stristr($photopath[0],"Jpg"):
		$myfile = "img/profile/shop_".$id[0].".jpg";
		
		break;
		case stristr($photopath[0],"jpeg"):
		$myfile = "img/profile/shop_".$id[0].".jpeg";
		break;
		case stristr($photopath[0],"JPEG"):
		$myfile = "img/profile/shop_".$id[0].".jpeg";
		break;
	case stristr($photopath[0],"Jpeg"):
		$myfile = "img/profile/shop_".$id[0].".jpeg";
		
		break;
		case stristr($photopath[0],"gif"):
		$myfile = "img/profile/shop_".$id[0].".gif";
		
		break;
		case stristr($photopath[0],"GIF"):
		$myfile = "img/profile/shop_".$id[0].".gif";
		
		break;
	case stristr($photopath[0],"Gif"):
		$myfile = "img/profile/shop_".$id[0].".gif";
		
		break;
		case stristr($photopath[0],"TIFF"):
		$myfile = "img/profile/shop_".$id[0].".tiff";
		break;
		case stristr($photopath[0],"tiff"):
		$myfile = "img/profile/shop_".$id[0].".tiff";
		
		break;
	case stristr($photopath[0],"Tiff"):
		$myfile = "img/profile/shop_".$id[0].".tiff";
		
		break;
	default:
		echo "file is not an image";
		break;
}


}


$contents1=file_get_contents($idphoto1[0]);
switch (true) {
	case stristr($idphoto1[0],"png"):
		$myfile1 = "img/legalphotos/shop_id1_".$id[0].".png";		
		break;
		case stristr($idphoto1[0],"PNG"):
		$myfile1 = "img/legalphotos/shop_id1_".$id[0].".png";
		break;
	case stristr($idphoto1[0],"Png"):
		$myfile1 = "img/legalphotos/shop_id1_".$id[0].".png";
		break;
		case stristr($idphoto1[0],"jpg"):
		$myfile1 = "img/legalphotos/shop_id1_".$id[0].".jpg";
		break;
		case stristr($idphoto1[0],"JPG"):
		$myfile1 = "img/legalphotos/shop_id1_".$id[0].".jpg";
		break;
	case stristr($idphoto1[0],"Jpg"):
		$myfile1 = "img/legalphotos/shop_id1_".$id[0].".jpg";
		
		break;
		case stristr($idphoto1[0],"gif"):
		$myfile1 = "img/legalphotos/shop_id1_".$id[0].".gif";
		
		break;
		case stristr($idphoto1[0],"GIF"):
		$myfile1 = "img/legalphotos/shop_id1_".$id[0].".gif";
		
		break;
	case stristr($idphoto1[0],"Gif"):
		$myfile1 = "img/legalphotos/shop_id1_".$id[0].".gif";
		
		break;
		case stristr($idphoto1[0],"TIFF"):
		$myfile1 = "img/legalphotos/shop_id1_".$id[0].".tiff";
		break;
		case stristr($idphoto1[0],"tiff"):
		$myfile1 = "img/legalphotos/shop_id1_".$id[0].".tiff";
		
		break;
	case stristr($idphoto1[0],"Tiff"):
		$myfile1 = "img/legalphotos/shop_id1_".$id[0].".tiff";
		
		break;
	default:
		echo "file is not an image";
		break;
}



$contents2=file_get_contents($idphoto2[0]);
switch (true) {
	case stristr($idphoto2[0],"png"):
		$myfile2 = "img/legalphotos/shop_id2_".$id[0].".png";		
		break;
		case stristr($idphoto2[0],"PNG"):
		$myfile2 = "img/legalphotos/shop_id2_".$id[0].".png";
		break;
	case stristr($idphoto2[0],"Png"):
		$myfile2 = "img/legalphotos/shop_id2_".$id[0].".png";
		break;
		case stristr($idphoto2[0],"jpg"):
		$myfile2 = "img/legalphotos/shop_id2_".$id[0].".jpg";
		break;
		case stristr($idphoto2[0],"JPG"):
		$myfile2 = "img/legalphotos/shop_id2_".$id[0].".jpg";
		break;
	case stristr($idphoto2[0],"Jpg"):
		$myfile2 = "img/legalphotos/shop_id2_".$id[0].".jpg";
		
		break;
		case stristr($idphoto2[0],"gif"):
		$myfile2 = "img/legalphotos/shop_id2_".$id[0].".gif";
		
		break;
		case stristr($idphoto2[0],"GIF"):
		$myfile2 = "img/legalphotos/shop_id2_".$id[0].".gif";
		
		break;
	case stristr($idphoto2[0],"Gif"):
		$myfile2 = "img/legalphotos/shop_id2_".$id[0].".gif";
		
		break;
		case stristr($idphoto2[0],"TIFF"):
		$myfile2 = "img/legalphotos/shop_id2_".$id[0].".tiff";
		break;
		case stristr($idphoto2[0],"tiff"):
		$myfile2 = "img/legalphotos/shop_id2_".$id[0].".tiff";
		
		break;
	case stristr($idphoto2[0],"Tiff"):
		$myfile2 = "img/legalphotos/shop_id2_".$id[0].".tiff";
		
		break;
	default:
		echo "file is not an image";
		break;
}


$MyJsonData = preg_replace('/"Photo":".+?"/', '"Photo":"'.$myfile.'"', $MyJsonData, 1);
$MyJsonData = preg_replace('/"IdPhoto1":".+?"/', '"IdPhoto1":"'.$myfile1.'"', $MyJsonData, 1);
$MyJsonData = preg_replace('/"IdPhoto2":".+?"/', '"IdPhoto2":"'.$myfile2.'"', $MyJsonData, 1);




$shopphoto= 'UPDATE shop set Photo="'.$myfile.'", IdPhoto1="'.$myfile1.'", IdPhoto2="'.$myfile2.'" where Email="'.$email[0].'"'; 
$photoupdate= $conn->prepare($shopphoto);
$photoupdate->execute();

file_put_contents($myfile,$contents);
file_put_contents($myfile1,$contents1);
file_put_contents($myfile2,$contents2);
echo $MyJsonData;
echo ']';

$userlogin="INSERT INTO `loginandregister`(`ShopId`, `UserName`, `PassWord`, `UserType`) VALUES ('$id[0]','$username[0]','$password[0]','SHOP')";
$stmt1= $conn->prepare($userlogin);
$stmt1->execute();


}catch(Exception $e){
	echo "400 error bad request";
}
}else{
	echo "400 error bad request";
}
?>