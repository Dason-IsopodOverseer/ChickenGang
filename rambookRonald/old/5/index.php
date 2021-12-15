<?php
include "functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (is_file("userprofile.json")) unlink("userprofile.json");
	if (is_dir("profilepic")) rrmdir("profilepic");
	if (is_dir("thumbnails")) rrmdir("thumbnails");
}

include "header.inc";

include "home.inc";

include "footer.inc";
?>