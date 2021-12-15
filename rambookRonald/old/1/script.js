var form = document.querySelector("#form");
form.student.addEventListener("click",show);
form.staff.addEventListener("click",hide);
form.alumni.addEventListener("click",hide);

function show() {
	
		grade.style.display = "inline";
	
}

function hide() {
	grade.style.display = "none";
	grade.value = "0";
}