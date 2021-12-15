// stores image configuration
var imgArray = [];
var currentImage;
var specialSearch = false;

window.onload = function() {
  if (document.getElementById("current") != null) {
    checkCheckbox();
  }
  getData("./readjson.php", true);
};

function checkCheckbox() {
  if (document.getElementById("current").checked) {
    console.log("CHECKED!");
    document.getElementById("chooseGrade").style.visibility = "visible";
  } else {
    console.log("NOTCHECKED!");
    document.getElementById("chooseGrade").style.visibility = "hidden";
  }
}

// change the visibility of ID
function changeVisibility(divID) {
  var element = document.getElementById(divID);

  // if element exists, it is considered true
  if (element) {
    element.className = element.className == "hidden" ? "unhidden" : "hidden";
  } // if
} // changeVisibility

// show or hide ID
function changeDisplay(divID) {
  var element = document.getElementById(divID);

  // if element exists, it is considered true
  if (element) {
	  if (element.style.display == "none") {
		   element.style.display = "block";
	  } else {
		  element.style.display = "none";
	  }
  } // if
} // changeVisibility

function displayLightBox(requestedUid) {
	 fetch ("http://142.31.53.220/~dason/rambook6/getData.php?uid=" + requestedUid)
		.then(response => response.json())
		.then(data => showLightBox(data))
		.catch(err => console.log("error occurred " + err));
}

// display lightbox with big image in it
 function showLightBox(data) {
	let boundaryImageDiv = document.getElementById("boundaryBigImage");
    let textDiv = document.getElementById("text");   
    let image = new Image();
    let bigImage = document.getElementById("bigImage");
	
	console.log("USER CLICKED ON IMAGE #" + data.UID);
	currentImage = data.UID;
	
	image.src = "profileimages/" + data.UID + "." + data.fileType;
	image.alt = "imageNumber" + data.UID;
	
	console.log(image.src);
	
	  // force big image to preload so we can have access 
	  // to it's width so it will be centered in the page
	  image.onload = function () { 
		   var width = Math.min(image.width, (screen.width - 300));
		   boundaryImageDiv.style.width = width + "px";
		   resize();
	  };
	  
	  function resize() {
		  if (image.width > (screen.width - 300)) {
		   console.log("Image is too large. It will be resized.");
		   bigImage.style.width = (screen.width - 300) + "px";
		  } else {
			   console.log("setting width to auto");
			   bigImage.style.width = "auto";
		  }
	  }
	 
	  bigImage.src = image.src;  // put big image in page
	  
	  // alter textbox to show user data
	  textDiv.innerHTML = "<h4>" + "NAME: " + data.name + "<br>" + "GRADE: " + data.grade + "<br>" + "ABOUT: " + data.about + "<br>" + "</h4>";
	  
	  //change download link destination
	  document.getElementById("singleDownload").href = image.src;
	  
	  // show light box with big image
	  flipSwitch();
 }
 
 function flipSwitch() {
	changeVisibility("lightbox");
	changeVisibility("positionBigImage");
 }
 
 function sortImages(number) {
	 if (specialSearch) {
		getData("./readjson.php", true);
		specialSearch = false;
	 }
	 
	 switch(number) {
		 case 0:
		 identity = "?access=Current Student";
		 break;
		 case 1:
		 identity = "?access=Alumni";
		 break;
		 case 2:
		 identity = "?access=Staff";
		 break;
		 case 3:
		 identity = "";
		 specialSearch = true;
		 break;
	 }
	 
	 var url = "./readjson.php" + identity;
	 if (identity != "") {
		 var operation;
	 
		 var target = document.getElementById("but" + number);
		 if (target.style.backgroundColor == "indianred") {
			 target.style.backgroundColor = "forestgreen";
			 console.log("User is adding tag: " + identity);
			 operation = true;
		 } else {
			 target.style.backgroundColor = "indianred";
			 console.log("User is removing tag: " + identity);
			 operation = false;
		 }
		 
		 getData(url, operation);
	 } else {
		 let input = document.getElementById('searchImages').value;
		 specialGet(url, input);
	 }
 }
 
 function getData(url, operation) {
	fetch(url).
    then(function(resp){ 
      return resp.json();
    })
    .then(function(data){
		if (url == "./readjson.php") {
			imgArray[0] = "NOT USED";
			for (var i = 1; i <= data.length; i++) {
				imgArray[i] = operation;
			}
			
		} else {
			for (var i = 0; i < data.length; i++) {
				imgArray[data[i].UID] = operation;
			}
			refreshImages();
		}
	});
 }
 
  function specialGet(url, parameter) {
	fetch(url).
    then(function(resp){ 
      return resp.json();
    })
    .then(function(data){
		var detected = 0;
		for (var i = 0; i < data.length; i++) {
			if (data[i].name.includes(parameter) || data[i].about.includes(parameter)) {
				console.log(i + " " + data[i].name + " " + data[i].about);
				detected++;
				imgArray[data[i].UID] = true;
			} else {
				imgArray[data[i].UID] = false;
				
			}
		}
		if (detected == 0) {
			document.getElementById('searchImages').value = "No Users Found!";
		} else if (detected == data.length) {
			document.getElementById('searchImages').value = "All Users Found!";
		}
		
		refreshImages();
	});
 }
 
 
 function test() {
	 console.log(imgArray);
 }
 
 function refreshImages() {
	 for (var i = 1; i < imgArray.length; i++) {
		 var target = document.getElementById(("img" + i));
		 if (target.className == "hidden" && imgArray[i] == true) {
			 changeVisibility(("img" + i));
		 } else if (target.className == "unhidden" && imgArray[i] == false) {
			 changeVisibility(("img" + i));
		 }
	 }
 }
 
 function navigateImg(direction) {
	var length = imgArray.length - 1;
	do {
		if (direction == 0) {
		if (currentImage - 1 < 1) {
			currentImage = length;
		} else {
			currentImage--;
		}
		} else if (direction == 1){
			if (currentImage + 1 > length) {
				currentImage = 1;
			} else {
				currentImage++;
			}
		}
		
		function check() {
			if (imgArray[currentImage] == false) {
				return false;
			}
			return true;
		}
		
		if (check()) {
			break;
		}
	} while(true);
	
	// close current lightbox
	flipSwitch();
	//show new image
	displayLightBox(currentImage);  
 }