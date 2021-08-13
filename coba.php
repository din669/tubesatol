<?php 
include_once ("functions.php");



$kata = "white";
$terjemahkan = terjemah($kata);
echo "<pre>";
print_r($terjemahkan);
echo "</pre>";
//echo $terjemahkan["translatedText"];
?>