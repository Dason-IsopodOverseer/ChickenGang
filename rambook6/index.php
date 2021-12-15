<?php declare(strict_types = 1);

// create an images folder
$target_dir = "profileimages/";

// inserts an HTML header at the start of the code
include "header.inc";

//include dependancies
include "includeThumbnail.php";

$name1 = "big chunguus";
$name2 = "smol jim";
$licenseErr = $radioErr = $nameErr = $sayErr = $fileErr = "";
$radio = $name = $say = $imageType = "";
$license;
$grade;

// determines which page to go to
$randNum = 5;
if (isset($_GET["randNum"]))
{
    // get a number from the query string in the url
    $randNum = $_GET["randNum"];
}

// determines if a delete is required
if (isset($_GET["action"]) && $_GET["action"] == "del")
{
    unlink("userprofiles.json");
    file_put_contents("userprofiles.json", "[]");

    // reset txt file used to count UID
    file_put_contents("identifier.txt", 0);

    // delete images folder and thumbnails folder contents
	for($x = 0; $x < 2; $x++) {
		$dir = "";
		switch ($x) {
			case 0:
				$dir = "profileimages/*";
				break;
			case 1: 
				$dir = "thumbnails/*";
				break;
		}
		$files = glob($dir); // get all file names
		foreach ($files as $file)
		{ // iterate files
			if (is_file($file))
			{
				unlink($file); // delete file
			}
		}
	} 
    echo "<br>The user images and JSON file have been destroyed.";
}

switch ($randNum)
{
    case 0:
        echo "<br><br>";
        name();
    break;
    case 1:
        echo "<br><br>";
        rando();
    break;
    case 2:
        echo "<br><br>";
        sayStuff();
    break;
    case 3:
        echo "<br><br>";
        printRand();
    break;
    case 4:
        echo "<br><br>";
        includeForm();
    break;
    case 5:
        echo "<br>This is the default homepage.<br>";
        saveJSON();
        include "home.inc";
    break;
    default:
        echo "<br>You have submitted a bizarre URL.<br>";

}

function saveJSON()
{
    // read json file into array of strings
    $file = "userprofiles.json";

    // in case there is an error, create a new JSON file
    if (!file_exists($file))
    {
        file_put_contents("userprofiles.json", "[]");
    }

    $jsonstring = file_get_contents($file);

    //decode the string from json to PHP array
    $phparray = json_decode($jsonstring, true);

    // if the user submitted a form, update the JSON file
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // add form submission to data
        $phparray[] = $_POST;

        // encode the php array to formatted json
        $jsoncode = json_encode($phparray, JSON_PRETTY_PRINT);

        // write the json to the file
        file_put_contents($file, $jsoncode);
        echo "<pre>Here is the JSON file after submission: <br>";
        echo $jsoncode;
        echo "<br></pre>";
    }
}

function showForm()
{
    if (dataChecker())
    {
        echo "<br><br> Congrats, your form is valid!";
        include "home.inc";
    }
    else
    {
        echo "<br><br> Your form is not valid";
    }
}

function printRand()
{
    $sum = 0;
    $nums = array();
    // fill array with random nums
    for ($row = 0;$row < 25;$row++)
    {
        for ($col = 0;$col < 25;$col++)
        {
            $nums[$row][$col] = rand(1, 5);
            echo " " . $nums[$row][$col] . " ";
            $sum += $nums[$row][$col];
        }
        echo "<br>";
    }
    echo "THE SUM IS: " . $sum;
}

// loads the page with the form
function includeForm()
{
    global $license, $radio, $name, $say, $grade, $imageType;
    global $licenseErr, $radioErr, $nameErr, $sayErr, $fileErr;
    global $target_dir;
    $isValid = true;
    //$imageValid = true;
    // if user has submitted a form
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {

        // Error checking for image comes first
        // if there if no image folder, create one
        if (!is_dir($target_dir))
        {
            mkdir($target_dir);
            echo $target_dir . " has been created! Well done! <br>";
        }

        // check if user uploaded an image or not
        if (!file_exists($_FILES["fileToUpload"]["tmp_name"]))
        {
            $fileErr = "*You must upload an image!";
            $isValid = false;
            //$imageValid = false;
            
        }

        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // check if file already exists
        if (file_exists($target_file) && $isValid == true)
        {
            $fileErr = "*Error: this file already exists.";
            $isValid = false;
            //$imageValid = false;
            
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 4000000 && $isValid == true)
        {
            $fileErr = "You infidel, your file is larger than 4 MB.";
            $isValid = false;
            //$imageValid = false;
            
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $isValid == true)
        {
            $fileErr = "*Sorry, only JPG, JPEG, and PNG files are allowed.";
            $isValid = false;
            //$imageValid = false;
            
        }

        // error checking for rest of the form
        // check that the user filled out the form!
        if (empty($_POST["checkbox"]))
        {
            $licenseErr = "*Please give your consent!";
            $isValid = false;
        }
        else
        {
            $license = $_POST["checkbox"];
        }
        if (empty($_POST["connection"]))
        {
            $radioErr = "*State your connection to Mount Doug!";
            $isValid = false;
        }
        else
        {
            $radio = $_POST["connection"];

            if ($radio == "Current Student")
            {
                $grade = $_POST["grade"];
            }
            else
            {
                $_POST["grade"] = "Not a current student.";
            }
        }
        if (empty($name = test_input($_POST["name"])))
        {
            $nameErr = "*Your name is required!";
            $isValid = false;
        }
        else
        {
            // text input requires additional processing
            $name = test_input($_POST["name"]);
        }
        if (empty(test_input($_POST["about"])))
        {
            $sayErr = "*This section is required!";
            $isValid = false;
        }
        else
        {
            // text input requires additional processing
            $say = test_input($_POST["about"]);
        }

        /*
        // special case when user uploads a good image, but doesn't fill up the rest of the form
        // save image to temporary image folder
        if ($imageValid && !$isValid) {
        // move image file to folder
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars(basename($_FILES["fileToUpload"]["name"])). " has been preserved.";
        // rename the file in the folder
        rename($target_dir . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])), $target_dir . "tempSave" . "." . $imageFileType);
        }
        }
        */

        if ($isValid)
        {

            // save file type as a value in the POST array
            $_POST["fileType"] = $imageFileType;

            // move image file to folder
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
            {
                echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
                echo "<pre>";
                var_dump($_FILES);
                echo "</pre>";

                // retrieve the UID counter
                $UID = file_get_contents("identifier.txt");

                // increment the UID counter
                $UID++;

                // save UID as a value in the POST array
                $_POST["UID"] = $UID;

                // rename the file in the folder
                rename($target_dir . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) , $target_dir . $UID . "." . $imageFileType);
				
				// create thumbnail folder, if it doesn't exist
				if (!is_dir("thumbnails/"))
				{
					mkdir("thumbnails/");
					echo "A thumbnails folder has been created! Well done! <br>";
				}
				
				// create thumbnail
				createThumbnail($target_dir . $UID . "." . $imageFileType, "thumbnails/". $UID . "." . $imageFileType, 240, 240);
				

                file_put_contents("identifier.txt", $UID);
            }
            else
            {
                echo "There was an error uploading your file.";
            }

            // save and process the JSON
            saveJSON();
            include "home.inc";
        }
        else
        {
            include "form.inc";
        }
    }
    else
    {
        include "form.inc";
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function showImages()
{
    $target_dir = "thumbnails/";
    $count = 0;
	
	// read json file into array of strings
    $file = "userprofiles.json";

    // in case there is an error, create a new JSON file
    if (!file_exists($file))
    {
        file_put_contents("userprofiles.json", "[]");
    }

    $jsonstring = file_get_contents($file);

    //decode the string from json to PHP array
    $phparray = json_decode($jsonstring, true);

    $dir = $target_dir . "*";
    $files = glob($dir); // get all file names
    foreach ($files as $file)
    { // iterate files
        if (is_file($file))
        {
			$type = $phparray[$count]["fileType"];
            $count++;
            // show image
            $location = '<img  src="' . $target_dir . $count . "." . $type . '"' . 'onclick="displayLightBox(' . $count . ')"' . ">";
            echo '<pre class="unhidden" id="img' . $count . '">' . $location . "</pre>";
        }
    }
}

function name()
{
    global $name1, $name2;
    echo "Hello there, $name1 and $name2. ";
    echo isOdd(3);
}

function rando()
{
    echo "Here are 100 random numbas! <br>";
    for ($x = 0;$x <= 100;$x++)
    {
        echo "The number is: " . rand(1, 1000) . "<br>";
    }
}

function sayStuff()
{
    switch (rand(1, 10))
    {
        case 1:
            echo "1: smol jerry tomboy pancake";
        break;
        case 2:
            echo "2: meidum-size mcdonald burger beef-boy";
        break;
        case 3:
            echo "3: relatively large chunky boi";
        break;
        case 4:
            echo "4: slightly swole doge dingus";
        break;
        case 5:
            echo "5: thicc swole doggy thug king";
        break;
        case 6:
            echo "6: Chungy-thicc master pimp lord";
        break;
        case 7:
            echo "7: Giant mistress-slappa chain-smoking gansta";
        break;
        case 8:
            echo "8: tremendously-thicc papa";
        break;
        case 9:
            echo "9: daddy-thicc super swole uberman";
        break;
        default:
            echo "10: Chunguus supreme";
    }
}

function isOdd(int $num)
{
    return $num % 2 == 0 ? false : true;
}

// inserts an HTML footer at the end of the code
include "footer.inc";
?>
