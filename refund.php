<?php


function request() {
	$id=$_POST['id'];
	$amount=$_POST['amount'];
	$url = "https://test.oppwa.com/v1/payments/".$id."";
	$data = "entityId=8a8294174d0595bb014d05d82e5b01d2" .
                "&paymentType=RV".
                "&currency=EUR".
                "&amount=".$amount."";

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                   'Authorization:Bearer OGE4Mjk0MTc0ZDA1OTViYjAxNGQwNWQ4MjllNzAxZDF8OVRuSlBjMm45aA=='));
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$responseData = curl_exec($ch);
	if(curl_errno($ch)) {
		return curl_error($ch);
	}
	curl_close($ch);
	return $responseData;
}
echo $responseData = request();



?>