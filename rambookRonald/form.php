<?php
	/*
	* The whole form and validations
	*
	*/
	
	include "functions.php";
	include "createthumbnail.php";
	
	$nameErr = "";
	$permsErr = "";
	$connectionErr = "";
	$profileErr = "";
	$gradeErr = "";
	$selfErr = "";
	
	$name = "";
	$perms = "";
	$connection = "";
	$grade = 0;
	$self = "";
	$id = "";
	
	$dataOK = true;
	
	$json = "userprofile.json";
	$jsonString = "";
	$phpArray = array();
	$dataArray;
	
	$target_dir = "profilepic/";
	$target_file = "";
	$uploadOK = true;
	$imageType = "";
	$allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
	
	$thumbnail_dir = "thumbnails/";
	
	
	include "header.inc";
	
	// form validation/requirements
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
				$grade = $_POST["grade"];
			}
			
		} 
		
		if (empty($_POST["self"])) {
			$selfErr = "This is a required field.";
			$dataOK = false;
		} else {
			$self = test_input($_POST["self"]);
		}
		
		if(!file_exists($_FILES['profile']['tmp_name']) || !is_uploaded_file($_FILES['profile']['tmp_name'])) {
			$profileErr = "Upload your profile picture.";
			$dataOK = false;
			
		} else if (!in_array(exif_imagetype($_FILES['profile']['tmp_name']), $allowedTypes)) {
			$profileErr = "Upload images only.";
			$dataOK = false;
		} else if ($_FILES['profile']['size'] >= 4194304) {
			$profileErr = "Image size too large. Image must be under 4 MB.";
			$dataOK = false;
		}
		
		
		//if wrong image type
		
		
		//pre upload
		$imagetype = strtolower(pathinfo($_FILES["profile"]["name"],PATHINFO_EXTENSION));
		
		if (!is_dir($target_dir)) {
			mkdir($target_dir);
			chmod($target_dir, 0777);
		}
		
		if (!is_dir($thumbnail_dir)) {
			mkdir($thumbnail_dir);
			chmod($thumbnail_dir, 0777);
		}
		
		$id = countFiles($target_dir);
		$target_file = $target_dir . $id. "." . $imagetype;
		
		$target_thumbnail = $thumbnail_dir . $id . "." . $imagetype;
		
	}//if
	
	
	//upload
	if ($dataOK && $_SERVER["REQUEST_METHOD"] == "POST") {
		
		
		if (move_uploaded_file($_FILES["profile"]["tmp_name"], $target_file)) {
			chmod($target_file, 0777);
			createThumbnail ($target_file ,$target_thumbnail , 240, 240);
			
		} else {
			$profileErr = "Upload your profile picture.";
			$dataOK = false;
		}
		
	}
	
	//then continue
	if ($dataOK && $_SERVER["REQUEST_METHOD"] == "POST") {
		$dataArray = array(
			"name" => $name,
			"perms" => $perms,
			"connection" => $connection,
			"grade" => $grade,
			"self" => $self,
			"id" => $id,
			"imagetype" => $imagetype
			);
			
		//add to json
		$phpArray = jsonRead($json);
		$phpArray[] = $dataArray;
		$jsonString = json_encode($phpArray, JSON_PRETTY_PRINT);
		file_put_contents($json, $jsonString);
		chmod($json, 0777);
		
		//end of form
		header("Location:submitted.php");
		
	} else if (!$dataOK){
		include "form.inc";
	} else {
		include "form.inc";
	}
	
	include "footer.inc";
?>