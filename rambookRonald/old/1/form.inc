<div class="container" id="maincontainer">
	<div class="container" id="header">
		<h1>Rambook</h1>
	</div>
	<div class="container" id="formcontainer">
			
		<form action="?submitted=1" method="POST" id="form">
			<label for="name">Name:</label>
			<br>
			<input type="text" id="name" name="name" value="">
			<br><div class="spacing"></div>
			<label for="profile">Profile Picture:</label>
			<br>
			<input type="file" id="profile" name="profile">
			<br>
			<input type="checkbox" id="perms" name="perms" value="1">
			<label for="perms">I give RamBook non-exclusive, transferable, sub-licensable, royalty-free, worldwide license to use this photo</label>
			<br><div class="spacing"></div>
			<label for="connection">Connection to Munt Doug:</label>
			<br>
			<input type="radio" id="student" name="connection" value="student">Student</input>
			<select id="grade" name="grade">
				<option id="0" value=0 selected disabled>-Select grade-</option>
				<option value=9>Grade 9</option>
				<option value=10>Grade 10</option>
				<option value=11>Grade 11</option>
				<option value=12>Grade 12</option>
			</select>
			<br>
			<input type="radio" id="alumni" name="connection" value="alumni">Alumni</input>
			<br>
			<input type="radio" id="staff" name="connection" value="staff">Staff</input>
			<br><div class="spacing"></div>
			<label for="self">Say something about yourself:</label>
			<br>
			<textarea id="self" name="self"></textarea>
			<br><div class="spacing"></div>
			<input type="submit" value="Submit">
		</form>
	</div>
</div>