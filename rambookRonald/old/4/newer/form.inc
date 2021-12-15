<script src="formscript.js" async></script>
<div class="maincontainer">
	
	<div class="formcontainer">
			
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" id="form" enctype="multipart/form-data">
			<!-- Name -->
			<label for="name">Name:</label>
			<span class="error">* <?php echo $nameErr;?></span>
			<br>
			<input type="text" id="name" name="name" value="<?php echo $name;?>" autocomplete="off">
			<br><div class="spacing"></div>
			
			<!-- Profile Picture -->
			<label for="profile">Profile Picture:</label>
			<span class="error">* <?php echo $profileErr;?></span>
			<br>
			<input type="file" id="profile" name="profile" accept="image/*">
			<br>
			<!-- Permission -->
			<input type="checkbox" id="perms" name="perms" value="t" 
				<?php if (isset($perms) && $perms == "t") echo "checked";?>
			>
			<label for="perms">I give RamBook non-exclusive, transferable, sub-licensable, royalty-free, worldwide license to use this photo</label>
			<span class="error">* <?php echo $permsErr;?></span>
			<br><div class="spacing"></div>
			
			<!-- Connection -->
			<label for="student">Connection to Mount Doug:</label>
			<span class="error">* <?php echo $connectionErr;?></span>
			<br>
			
			<input type="radio" id="student" name="connection" value="student"
				<?php if (isset($connection) && $connection == "student") echo "checked";?>>
			Student
			<!-- Grade -->
			<div class="gradeselect" id="gradeselect">
				<select id="grade" name="grade">
					<option id="0" value=0 <?php if (!isset($grade) || $grade < 9) echo "selected";?> disabled>-Select grade-</option>
					<option value=9 <?php if (isset($grade) && $grade == 9) echo "selected";?>>Grade 9</option>
					<option value=10 <?php if (isset($grade) && $grade == 10) echo "selected";?>>Grade 10</option>
					<option value=11 <?php if (isset($grade) && $grade == 11) echo "selected";?>>Grade 11</option>
					<option value=12 <?php if (isset($grade) && $grade == 12) echo "selected";?>>Grade 12</option>
				</select>
				<span class="error">* <?php echo $gradeErr;?></span>
			</div>
			<br>
			
			<input type="radio" id="alumni" name="connection" value="alumni" 
				<?php if (isset($connection) && $connection == "alumni") echo "checked";?>>
			Alumni
			<br>
			<input type="radio" id="staff" name="connection" value="staff"
				<?php if (isset($connection) && $connection == "staff") echo "checked";?>>
			Staff
			<br><div class="spacing"></div>
			
			<!-- Something About Yourself -->
			<label for="self">Say something about yourself:</label>
			<span class="error">* <?php echo $selfErr;?></span>
			<br>
			<textarea id="self" name="self" autocomplete="off"><?php echo $self;?></textarea>
			<br><div class="spacing"></div>
			
			<input type="submit" value="Submit">
		</form>
	</div>
</div>