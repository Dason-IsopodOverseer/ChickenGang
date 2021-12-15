var lightboxBG = document.querySelector(".lightbox-bg");
var imageContainer = document.querySelector(".bigimage-container");
var bigImage = document.querySelector(".big-image");
var profileInfo = document.querySelector(".profile-info");
var downloadimage = document.querySelector(".download-image");
var closebutton = document.querySelector(".close");

function showBigImg (file) {
	imageContainer.style.display = "flex";
	lightboxBG.style.display = "block";
	bigImage.src = file;
	downloadimage.style.display = "block";
	downloadimage.href = file;
	closebutton.style.display = "block";
	
	
	let id = (file.split(".")[0]).split("/")[1];
	
	fetch ("http://10.49.31.251/~ronald/rambook/getUserData.php?uid=" + id)
	.then (response => response.json())
	.then(data => updateContents(data))
	.catch(err => console.log("error occurred " + err));
	
}

function hideBigImg () {
	imageContainer.style.display = "none";
	lightboxBG.style.display = "none";
	downloadimage.style.display = "none";
	closebutton.style.display = "none";
	
}

function updateContents(data) {
	let name = data.name;
	let grade = data.grade;
	let connection = data.connection;
	let self = data.self;
	
	profileInfo.innerHTML = "Name: " + name + "<br>";
	
	if(grade != 0) {
		profileInfo.innerHTML += "Grade: " + grade + "<br>";
	}
	profileInfo.innerHTML += "Connection to Mount Doug: " + connection + "<br>About: " + self;
	
	
	
}