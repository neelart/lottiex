jQuery(function() {
    var $ = jQuery.noConflict();
    registerClickHandler();
    
    function registerClickHandler() {
        $(document).on('click', onDismissNotice);
    }
    
    function onDismissNotice() {
        var clickedElement = this;
        hideLottieboxNotice(clickedElement);
        sendCloseNotice();
    }
    
    function hideLottieboxNotice(clickElement) {
        var $lottieboxElement = $(clickElement).closest('.lottiebox-notice');       
        $lottieboxElement.slideUp();
    }
    
    function sendCloseNotice() {
        var ajaxOptions = {
            url: ajaxurl,
            data: {
                action: 'lottiebox_top_notice'
            }
        };
        $.ajax(ajaxOptions);
    }
});
