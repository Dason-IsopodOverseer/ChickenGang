<a href="./?removeall" class="removeall"></a>

<div class="filter-div">
<input type="radio" class="filter" id="all" name="filter" value="all" onclick="filter('all')" checked>All
<input type="radio" class="filter" id="student" name="filter" value="student" onclick="filter('student')">Student
<input type="radio" class="filter" id="alumni" name="filter" value="alumni" onclick="filter('alumni')">Alumni
<input type="radio" class="filter" id="staff" name="filter" value="staff" onclick="filter('staff')">Staff

<br>
<input type="text" name="search" class="search" id="search" placeholder="Search for profiles">
<input type="submit" value="Search" onclick="search()">


</div>

<script src="lightbox.js" async></script>
<div class="maincontainer">
	<div class="thumbnail-grid"> 
	
	</div>
</div>

<div class="lightbox">
	<div class="lightbox-bg" onclick="hideBigImg()"></div>
	<div class="bigimage-container">
		<img class= "big-image" src="">
		<div class="profile-info"></div>
		
	</div>
	<a class="download-image" href="" download>
	<div class="download">
		<img src="download.png" class="download-icon">
	</div>
	</a>
	<button type="button" id="prev" onclick="prev()"><</button>
	<button type="button" id="next" onclick="next()">></button>
	<button onclick="hideBigImg()" id="close">×</button>
</div>


<a href="./downloadall.php">
<div class="download-all">
	Download All<img src="download.png" class="download-icon">
</div>
</a>





