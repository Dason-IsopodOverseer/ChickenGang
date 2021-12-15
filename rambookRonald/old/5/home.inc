<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
	<input type="submit" class="removeall">
</form>



<script src="lightbox.js" async></script>
<div class="maincontainer">
	<div class="thumbnail-grid"> 
	<?php showThumbnails("thumbnails/"); ?>
	</div>
</div>


<div class="lightbox-bg" onclick="hideBigImg()"><span class="close" onclick="hideBigImg()">×</span></div>
<div class="bigimage-container">
	<img class= "big-image" src="">
	<div class="profile-info"></div>
	
</div>
<a class="download-image" href="" download>
<div class="download">
	<img src="download.png" class="download-icon">
</div>
</a>


<a href="./downloadall.php">
<div class="download-all">
	Download All<img src="download.png" class="download-icon">
</div>
</a>





