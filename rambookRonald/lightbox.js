var lightbox = document.querySelector(".lightbox");
var bigImage = document.querySelector(".big-image");
var profileInfo = document.querySelector(".profile-info");
var downloadimage = document.querySelector(".download-image");

var currentImages = new Array();

window.onload = function () { filter("all") };

function showBigImg (file) {
	lightbox.style.display = "inline-block";
	
	bigImage.src = file;
	downloadimage.href = file;
	
	let id = (file.split(".")[0]).split("/")[1];
	
	fetch ("./getUserData.php?uid=" + id)
	.then (response => response.json())
	.then(data => updateContents(data))
	.catch(err => console.log("error occurred " + err));
	
}

function hideBigImg () {
	
	lightbox.style.display = "none";
	
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

function filter (connection) {
	
	fetch ("./getUserData.php?connection=" + connection)
	.then (response => response.json())
	.then (data => display(data))
	.catch(err => console.log("error occurred " + err));
	
}

function search () {
	let keyword = document.getElementById("search").value;
	
	fetch ("./getUserData.php?search=" + keyword)
	.then(resp => resp.json())
	.then(data => display(data))
	.catch(err => console.log("error occurred " + err));
	
}


function next() {
	let current = bigImage.src.split("profilepic/")[1];
	let index = currentImages.indexOf(current);
	let nextIndex = index+1;
	if (nextIndex >= currentImages.length) nextIndex = 0;
	
	showBigImg(("profilepic/"+currentImages[nextIndex]));
	
}

function prev() {
	let current = bigImage.src.split("profilepic/")[1];
	let index = currentImages.indexOf(current);
	let nextIndex = index-1;
	if (nextIndex < 0) nextIndex = currentImages.length-1;
	
	showBigImg(("profilepic/"+currentImages[nextIndex]));
	
	
}




function display (data) {
	let grid = document.querySelector(".thumbnail-grid");
	while (grid.firstChild) {
        grid.removeChild(grid.firstChild);
	}
	currentImages = [];
	
	let i;
	
	for (i in data) {
		let file = data[i].id + "." + data[i].imagetype;
		
		let img = new Image();
		img.src = "thumbnails/" + file;
		img.setAttribute("onclick", ("showBigImg('" + ("profilepic/" + file) + "')"));
		img.setAttribute("class", "thumbnail");
		
		currentImages[i] = file;
		
		grid.appendChild(img);
	}
	
	
		
}

