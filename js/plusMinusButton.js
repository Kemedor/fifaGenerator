
function minusButton(inputID) {
	var counter = document.getElementById("counter" + inputID);
	if (counter.value > 1) {
		counter.value--;
	}  
}

function plusButton(inputID) {
	var counter = document.getElementById("counter" + inputID);
	counter.value++;
}

function plusButton2(inputID) {
	var counter = document.getElementById("counter" + inputID);
	if (counter.value < 2) {
		counter.value++;
	}  
}

