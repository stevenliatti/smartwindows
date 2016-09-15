function sliderValue(value) {
	document.getElementById("range").innerHTML = value;
}

function show() {
	document.getElementById("hide").removeAttribute("hidden");
}

function hide() {
	document.getElementById("hide").setAttribute("hidden", true);
}

var slider = new Slider("#slide", {
	tooltip: 'always'
});