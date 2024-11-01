jQuery(window).on('load', function() {
    function _loader() {
     jQuery('.detector-loader').toggle(); 
    }
 
    jQuery('[name="detector-form"]').submit(function() {
        requied_field = false;
        _loader();
        jQuery('#theme_layout').children().remove();
        jQuery('.error-msg').remove();
        var this_ = jQuery(this);
        var form_action = this_.attr('action');
        var form_data = this_.serialize();
        jQuery('input', this).each(function() {
            if (jQuery(this).val() == '') {
                requied_field = true;
                jQuery(this).parent().append('<label class="error-msg">Field is required</label>')
            }
            if (jQuery(this).val() != '') {
                var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
                if (regexp.test(jQuery(this).val()) == false) {
                    requied_field = true;
                    jQuery(this).parent().append('<label class="error-msg">Enter a valid url</label>');
                }
            }
        })
        if (requied_field == false) {
            jQuery.ajax({
                type: "POST",
                url: form_action,
                data:{
                    action: "dtctr_theme_result_",
                    site_url : jQuery('[name="site-url"]').val()
                },
                cache: false,
                success: function(data) {
                    if(jQuery.trim(data))
                        {
                             jQuery('#theme_layout').append(data);
                   
                    jQuery("html, body").animate({
                        scrollTop: jQuery('#theme_layout').offset().top - 80
                    }, 1000);
                        }
                    else
                        {
                             jQuery('[name="site-url"]').parent().append('<label class="error-msg">The site ' + jQuery('[name="site-url"]').val() + ' does not seem to be using WordPress.</label>');
                    jQuery('.error-msg').fadeIn();
                        }
                     _loader();
                  
                },
                error: function() {
                    jQuery('[name="site-url"]').parent().append('<label class="error-msg">The site ' + jQuery('[name="site-url"]').val() + ' does not seem to be using WordPress.</label>');
                    jQuery('.error-msg').fadeIn();
                    _loader();
                }

            })
        } else {
            _loader();
            jQuery('.error-msg').fadeIn();
        }
        return false;
    })
})