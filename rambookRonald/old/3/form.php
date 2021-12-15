<?php
	include "functions.php";

	$nameErr = "";
	$permsErr = "";
	$connectionErr = "";
	$gradeErr = "";
	$selfErr = "";
	
	$name = "";
	$perms = "";
	$pic = "";
	$connection = "";
	$grade = "";
	$self = "";
	
	$dataOK = true;
	
	$json = "userprofile.json";
	$jsonString = "";
	$phpArray = array();
	$dataArray;
	
	
	include "header.inc";
	
	
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
			if (empty($_POST["name"])) {
				$nameErr = "Enter your name.";
				$dataOK = false;
			} else {
				$name = test_input($_POST["name"]);
			}
			if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
				$nameErr = "Only letters and spaces are allowed";
				$dataOK = false;
			}
			
			if (empty($_POST["perms"])) {
				$permsErr = "We require your permission to use your picture.";
				$dataOK = false;
			} else {
				$perms = test_input($_POST["perms"]);
			}
			
			if (empty($_POST["connection"])) {
				$connectionErr = "Select your connection to the school.";
				$dataOK = false;
			} else {
				$connection = test_input($_POST["connection"]);
			}
			
			if (isset($_POST["connection"]) && $_POST["connection"] == "student") {
				if(!isset($_POST["grade"]) || $_POST["grade"] == 0) {
					$gradeErr = "Select a grade.";
					$dataOK = false;
				} else { 
					$grade = test_input($_POST["grade"]);
				}
				
			} 
			
			if (empty($_POST["self"])) {
				$selfErr = "This is a required field.";
				$dataOK = false;
			} else {
				$self = test_input($_POST["self"]);
			}
			
			
	}//if
	
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST" && $dataOK) {
		$dataArray = array(
			"name" => $name,
			"pic" => $pic, 
			"perms" => $perms,
			"connection" => $connection,
			"grade" => $grade,
			"self" => $self);
			
		$phpArray = jsonRead($json);
		$phpArray[] = $dataArray;
		$jsonString = json_encode($phpArray, JSON_PRETTY_PRINT);
		file_put_contents($json, $jsonString);
		chmod($json, 0777);
		
		header("Location:submitted.php");
		
	} else if (!$dataOK){
		include "form.inc";
	} else {
		include "form.inc";
	}
	
	include "footer.inc";
?>