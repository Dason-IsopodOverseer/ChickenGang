<?php
include "header.inc";

$sentence = "YOU GOT ZERO<br>";

$number = -1;
if (isset($_GET["number"])) {
	$number = $_GET["number"];
}


echo "<pre>";
var_dump($_GET);
echo "</pre>";

echo "Your number is: $number<br>";

if ($number == 0) {
	echo $sentence;
}

if ($number == 1) {
	echo "Hello world!";
}

if($number == 2) {
	for ($i = 1; $i<=1000; $i++) {
		$x = rand(1,100);
		echo "$x<br>";
	}
}

if ($number == 3) {
	echo "<img src='images/horse.jpg' alt='horse in elevator' width='675' height='422'>";
}

if ($number == 4) {
	include "form.inc";
}



include "footer.inc";
?>