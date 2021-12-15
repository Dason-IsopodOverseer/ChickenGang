<?php
	
	include "functions.php";
	
	$id;
	$connection;
	$returnArray = array();
	
	$phpArray = jsonRead("userprofile.json");
	
	//get specific entry
	if(isset($_GET["uid"])) {
		$id = intval($_GET["uid"]);
		
		foreach ($phpArray as $userData) {
			if ($userData["id"] == $id) {
				echo json_encode($userData, JSON_PRETTY_PRINT);
			}
			
		}
		unset($userData);
	}
	
	
	
	//get entry with matching connection
	if (isset($_GET["connection"])) {
		$connection = $_GET["connection"];
		
		if ($connection !== "all") {
			foreach ($phpArray as $userData) {
				if ($userData["connection"] == $connection) {
					array_push($returnArray, $userData);
				}//if
			}//foreach
		} else if ($connection == "all") {
			foreach ($phpArray as $userData) array_push($returnArray, $userData);
		}//if else if
		
		echo json_encode($returnArray, JSON_PRETTY_PRINT);
		unset($userData);
	}//if connection in $_GET
	
	
	if (isset($_GET["search"])) {
		$keyword = trim($_GET["search"]);
		
		foreach ($phpArray as $userData) {
			if (str_contains($userData["name"], $keyword) || str_contains($userData["self"], $keyword)) {
				array_push($returnArray, $userData);
			}
			
		}
		
		echo json_encode($returnArray, JSON_PRETTY_PRINT);
		unset($userData);
	}
	
	
?>