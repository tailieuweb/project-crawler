// JavaScript Document

$(document).ready(function() {
    $('nav').affix({
        offset: {
            top: $('#topnav').height()
        }
    });

    $('#sidebar').affix({
        offset: {
            top: 200
        }
    });
	$('.responsive-slider').responsiveSlider({
		autoplay: true,
		interval: 5000,
		transitionTime: 300
	  });
});