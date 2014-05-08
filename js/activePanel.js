function activePanel(panel) {
	document.getElementById(panel).className = ' active';
	document.getElementById(panel).href = "#" ;
	document.getElementById(panel).style.cursor = "default";
}
