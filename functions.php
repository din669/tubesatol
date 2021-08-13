<?php
function encodeImages($images){
	$encoded_images = array();
	foreach($images as $image){
		$encoded_images[] = base64_encode(file_get_contents($image));
	}
	return $encoded_images;
}
function identifyPlants($file_names){
	$encoded_images = encodeImages($file_names);
	$api_key = "6VWHoYZFq2AjG0Voo6ytPRc2oBUNMMtcKWe7Rc9LplSdVCqSDk";
	$params = array(
		"api_key" => $api_key,
		"images" => $encoded_images,
		"plant_details" => array("common_names",
							"name_authority",
							"wiki_description")
		);
	$params = json_encode($params);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://api.plant.id/v2/identify");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json"));
	$result = curl_exec($ch);
	curl_close($ch);
	return json_decode($result,true);
}

function terjemah($text){	
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://translator50.p.rapidapi.com/api/translator/translate",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => "q=$text&from=en&to=id",
	CURLOPT_HTTPHEADER => [
		"content-type: application/x-www-form-urlencoded",
		"x-rapidapi-host: translator50.p.rapidapi.com",
		"x-rapidapi-key: 5c8bce524dmsh633d1c2cfd4c8fcp12e4cejsnc843a745094d"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	return json_decode($response,true);
}
}
?>
