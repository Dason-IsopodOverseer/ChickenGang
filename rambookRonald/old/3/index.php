<?php
include "functions.php";

include "header.inc";

include "home.inc";

echo "<pre>";
if(file_exists("userprofile.json")) var_dump(jsonRead("userprofile.json"));
echo "</pre>";

include "footer.inc";
?>