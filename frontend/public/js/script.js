// Speed of the automatic slideshow
var slideshowSpeed = 6000;

var photos = [ {
		"title" : "Stairs",
		"image" : "slider-img-01.jpg",
		"firstline" : "Welcome!",
		"secondline" : "This is the website for the Cluster Cloud project for VTC Randolph Senior projects."
	}, {
		"title" : "Office Appartments",
		"image" : "slider-img-02.jpg",
		"firstline" : "Our Goal",
		"secondline" : "Our goal is to make a fully functional front end website with a back end server section to handle VM creation requests from any user who would want a speedy and easy to use cloud system."
	}, {
		"title" : "Mountainbiking",
		"image" : "slider-img-03.jpg",
		"firstline" : "Welcome!",
		"secondline" : "his is the website for the Cluster Cloud project for VTC Randolph Senior projects."
	}, {
		"title" : "Mountains Landscape",
		"image" : "slider-img-04.jpg",
		"firstline" : "Our Goal",
		"secondline" : "Our goal is to make a fully functional front end website with a back end server section to handle VM creation requests from any user who would want a speedy and easy to use cloud system."
	}
];

$(document).ready(function() {	
	$("#back").click(function() {
		stopAnimation();
		navigate("back");
	});
	
	$("#next").click(function() {
		stopAnimation();
		navigate("next");
	});
	var interval;
	$("#control").toggle(function(){
		stopAnimation();
	}, function() {
		$(this).css({ "background-image" : "url(images/btn_pause.png)" });
		navigate("next");
		interval = setInterval(function() {
			navigate("next");
		}, slideshowSpeed);
	});
	var activeContainer = 1;	
	var currentImg = 0;
	var animating = false;
	var navigate = function(direction) {
		if(animating) {
			return;
		}
		if(direction == "next") {
			currentImg++;
			if(currentImg == photos.length + 1) {
				currentImg = 1;
			}
		} else {
			currentImg--;
			if(currentImg == 0) {
				currentImg = photos.length;
			}
		}
		var currentContainer = activeContainer;
		if(activeContainer == 1) {
			activeContainer = 2;
		} else {
			activeContainer = 1;
		}
		showImage(photos[currentImg - 1], currentContainer, activeContainer);
	};
	var currentZindex = -1;
	var showImage = function(photoObject, currentContainer, activeContainer) {
		animating = true;
		currentZindex--;
		
		$("#headerimg" + activeContainer).css({
			"background-image" : "url(images/" + photoObject.image + ")",
			"display" : "block",
			"z-index" : currentZindex
		});
		
		$("#headernav").css({"display" : "none"});
		$("#headertxt").css({"display" : "none"});
		$("#firstline").html(photoObject.firstline);
		$("#secondline")
			.html(photoObject.secondline);
		$("#pictureduri")
			.html(photoObject.title);
		$("#headerimg" + currentContainer).fadeOut(function() {
			setTimeout(function() {
				$("#headertxt").css({"display" : "block"});
				$("#headernav").css({"display" : "block"});
				animating = false;
			}, 500);
		});
	};
	
	var stopAnimation = function() {
		$("#control").css({ "background-image" : "url(images/btn_play.png)" });
		clearInterval(interval);
	};
	
	navigate("next");
	interval = setInterval(function() {
		navigate("next");
	}, slideshowSpeed);
});