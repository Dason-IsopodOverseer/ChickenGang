var form = document.querySelector("#form");
form.student.addEventListener("click",show);
form.staff.addEventListener("click",hide);
form.alumni.addEventListener("click",hide);

window.onload = function() {
	
	if (!form.student.checked) {
		gradeselect.style.display = "none";
		
	}
	
}

function show() {
	
	gradeselect.style.display = "inline";
	
}

function hide() {
	gradeselect.style.display = "none";
	grade.value = "0";
}