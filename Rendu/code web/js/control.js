function show() {
	document.getElementById("hide").removeAttribute("hidden");
}

function hide() {
	document.getElementById("hide").setAttribute("hidden", true);
}

// fonction manipulant le slider
var slider = new Slider("#slide", {
	tooltip: 'always'
});