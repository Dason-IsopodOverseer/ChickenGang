<a href="index.php?action=del">Reset Thy Gallery file</a>
<br>
<br>
 <a class="downloadButton" href="downloadall.php" download>DOWNLOAD ALL IMAGES!</a>
<br>
<br>
<button type="button" class="smallBut" id="but0" onclick="sortImages(0)">Students</button>
<button type="button" class="smallBut" id="but1" onclick="sortImages(1)">Alumni</button>
<button type="button" class="smallBut" id="but2" onclick="sortImages(2)">Staff</button>
<input type="text" id="searchImages" placeholder="Search..."><span id="go" onclick="sortImages(3)">GO!</span>
<div id="imageGrid">
<?php 
showImages();
?>
</div>
<div id="lightbox" class="hidden"></div>
<div id="positionBigImage" class="hidden">
<span class="pointers" id="left" onclick="navigateImg(0)"><-</span>
<span class="pointers" id="right" onclick="navigateImg(1)">-></span>
  <div id="boundaryBigImage">
	 <img id="x" src="images/x.png" alt="close" onclick="flipSwitch()">
	 <img id="bigImage" src="profileimages/1.jpg" alt="">
	 <p id="text"></p>
	 <a class="downloadButton"id="singleDownload" href="/profileimages/1.jpg" download>DOWNLOAD THIS IMAGE!</a>
  </div>	  
</div>