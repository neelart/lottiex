(function($) {
	"use strict";

    var WidgetJsonBasedLottiesAnimationHandler = function($scope, $) {
        // Shortcuts a lot of uses of $.data
        var options = $scope.find('.lottieboxs-lotties-animation-wrapper').data();

        // Redacting unnecessary code repetitions and complexity
        var lbx_lotties_animation = bodymovin.loadAnimation({
            container: document.getElementById(options.id),
            animType: options.animRenderer,
            loop: options.loop,
            autoplay: options.playAction === 'autoplay',
			path: options.path
        });

        // Setting up speed in playback
		// if (options.playSpeed <= 1) lbx_lotties_animation.setSpeed(options.playSpeed);
        lbx_lotties_animation.setSpeed(options.playSpeed);

        var start_time = options.lbxStartTime ? options.lbxStartTime : 1;
        var end_time = lbx_lotties_animation.totalFrames;

        var animationStart = function() {
		    lbx_lotties_animation.playSegments([start_time, end_time]);
        };

		switch(options.playAction) {
		    case 'default': lbx_lotties_animation.goToAndStop(0);
                break;
			
            // Turns around the animation on the second click
            case 'reverse_2nd_click':
			    	var directionMenu = 1;
						$(options.id).click(function() {
						  lbx_lotties_animation.setDirection(directionMenu);
						  lbx_lotties_animation.play();
						  directionMenu = -directionMenu;
				   });
				break;

             // Starts automatic playback
            case 'autoplay': lbx_lotties_animation.goToAndPlay(0);
                break;

            case 'hover': 
                lbx_lotties_animation.goToAndStop(start_time, true);
				$(options.id).mouseenter(animationStart);
                break;

            case 'click':
 				lbx_lotties_animation.goToAndStop(start_time, true);
 				$(options.id).click(animationStart);
                break;

            // On mouseover start, and finish in reverse on hover out
            case 'mouseoverout': 
                lbx_lotties_animation.goToAndStop(start_time, true);
                $(options.id).mouseenter(animationStart);
				$(options.id).mouseleave(function() {
					var new_load = lbx_lotties_animation.currentRawFrame;
					lbx_lotties_animation.setDirection(-1);
					lbx_lotties_animation.goToAndPlay(new_load, true);
				});
                break;
		}

        // For each of the next events start a handler
		$(window).on("lotties_load_animation resize scroll", function() {

            // Starts playback if scrolling occured
            if(options.playAction === 'on_scroll') {

				var section_offset = $scope.offset().top;
                var section_duration = options.lbxSectionDuration;
				var offset_top = options.lbxSectionOffset;
                var all_duration = section_duration + section_offset - offset_top;

                // If an animation that starts on scrolling came into view, then start playback from the frame corresponding to the scroll position
                var frame = Math.round(
                    all_duration * $(window).scrollTop() / ($(document).height() - $(window).height())
                );

                lbx_lotties_animation.goToAndStop(frame, true);
            }
        });

        // Start everything
        $(window).trigger("lotties_load_animation");

    };

    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction(
            'frontend/element_ready/lottiebox_lottie_animation.default',
            WidgetJsonBasedLottiesAnimationHandler
        );
    });

})(jQuery);
