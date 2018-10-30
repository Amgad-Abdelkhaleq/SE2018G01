$(document).ready(function() {
	//Add .active to current navbar button
	var page_name = window.location.pathname.split('/').slice(-1)[0].slice(0,-4);
	$('ul.navbar-nav a').filter(function() {
		var str = $(this).text().toLowerCase().replace(' ','');
		if (str == 'home' && (page_name == '' || page_name == 'index')) {
			return true;
		}
		return (str == page_name);
	}).append(' <span class="sr-only">(current)</span>').closest(".nav-item").addClass("active");
});