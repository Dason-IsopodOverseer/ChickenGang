<?php
include "functions.php";

if (isset($_GET["removeall"])) {
	if (is_file("userprofile.json")) unlink("userprofile.json");
	if (is_dir("profilepic")) rrmdir("profilepic");
	if (is_dir("thumbnails")) rrmdir("thumbnails");
	header("Location:./");
}

include "header.inc";

include "home.inc";

include "footer.inc";
?>