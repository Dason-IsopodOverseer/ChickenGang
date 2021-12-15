    <!-- The wrapper and content divs set margins and positioning -->
    <div class="wrapper">
      <div class="content" role="main">
        <!-- This is the start of content for our page -->
        <h1 class="title">Join Rambook!</h1>
        <form id="baseForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?randNum=4" method="POST" enctype="multipart/form-data" >
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" value="<?php echo $name;?>" />
		  <span class="error"><?php echo $nameErr;?></span><br />
          <label for="imageFile">Profile Pic:</label>
		  <span class="error"><?php echo $fileErr;?></span><br />
          <input type="file" id="imageFile" name="fileToUpload"/><br />
          <input type="checkbox" id="checkbox" name="checkbox" <?php if (isset($license)) echo "checked";?> value="check" />
          <label for="checkbox"
            >I give RamBook non-exclusive, transferable, sub-licensable,
            royalty-free, worldwide license to use this photo </label
          ><br />
		  <span class="error"><?php echo $licenseErr;?></span><br /><br />
          <span>Connection to Mount Doug:</span>
		  <span class="error"><?php echo $radioErr;?></span><br />
          <div id="connectionRadio" onclick="checkCheckbox()">
            <input
              type="radio"
              id="current"
              name="connection"
			  <?php if ($radio=="Current Student") echo "checked";?>
              value="Current Student"
            />
            <label for="current">Current Student</label><br />
            <input type="radio" id="alumni" name="connection" <?php if ($radio=="Alumni") echo "checked";?> value="Alumni" />
            <label for="alumni">Alumni</label><br />
            <input type="radio" id="staff" name="connection" <?php if ($radio=="Staff") echo "checked";?> value="Staff" />
            <label for="staff">Staff</label>
          </div>
          <div id="chooseGrade">
            <label for="grade">Current Grade:</label>
            <select name="grade" id="grade">
              <option <?php if ($grade == "9") echo 'selected="selected" '; ?> value=9>9</option>
              <option <?php if ($grade == "10") echo 'selected="selected" '; ?> value=10>10</option>
              <option <?php if ($grade == "11") echo 'selected="selected" '; ?> value=11>11</option>
              <option <?php if ($grade == "12") echo 'selected="selected" '; ?> value=12>12</option>
            </select>
          </div>
          <br />
          <label for="about">Say Something About Yourself!</label>
		  <span class="error"><?php echo $sayErr;?></span><br />
          <textarea id="about" name="about" rows="5" cols="50" /><?php echo $say;?></textarea>
          <input id="submitBut" type="submit" value="Submit" />
        </form>
      </div>
    </div>