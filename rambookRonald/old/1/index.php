<?php
include "header.inc";

error_reporting(E_ERROR | E_PARSE);

if ($_GET["submitted"] != 1) {
		include "form.inc";
} else {
		var_dump($_POST);
}

include "footer.inc";
?>