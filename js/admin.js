/* 
 Created on : 04-Apr-2016, 11:37:37
 Author     : Matt
 */
jQuery(document).ready(function ($) {
    $.urlParam = function (name) {
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
	if (typeof results != 'undefined' && results) {
		return results[1] || 0;
	}
	return 0;
    }
    
    $(".chosen").chosen();
    
    $('#rl_media_select').click(function (e) {
        e.preventDefault();
        var image = wp.media({
            title: 'Select Login Logo',
            multiple: false
        }).open().on('select', function (e) {
            // This will return the selected image from the Media Uploader, the result is an object
            var uploaded_image = image.state().get('selection').first();
            //console.log(uploaded_image);
            $('#rl_cust_logo').val(uploaded_image.toJSON().url);
            $('#rl_cust_logo_width').val(uploaded_image.toJSON().width);
            $('#rl_cust_logo_height').val(uploaded_image.toJSON().height);
        });
    });


    /**
     * Enable/Disable login page customisation
     * @returns {undefined}
     */
    function endis_customise() {
        if ($('input#rl_cust_log_form').prop('checked')) {
            $("input[name=rl_cust_logo_radio], input#rl_cust_log_disable_pw_reset, input#rl_cust_log_disable_link").prop('disabled', false).closest('tr').show();
            endis_logo_type();
        } else {
            $("input[id^='rl_cust'][type=text], input[name=rl_cust_logo_radio], input#rl_cust_log_disable_pw_reset, input#rl_cust_log_disable_link").prop('disabled', true).closest('tr').hide();
        }
    }
    
    /**
     * Enable/Disable custom image logo selection
     * @returns {undefined}
     */    
    function endis_logo_type() {
        var logo_type = $('input[name=rl_cust_logo_radio]:checked').val();
        if (logo_type == 'custom') {
            $("input[id^='rl_cust'][type=text]").prop('disabled', false).closest('tr').show();
        } else {
            $("input[id^='rl_cust'][type=text]").prop('disabled', true).closest('tr').hide();
        }        
    }

    /**
     * Enable/Disable redirect
     * @returns {undefined}
     */
    function endis_redirect() {
        if ($('input#rl_red_aft_log').prop('checked')) {
            $('input#rl_red_aft_log_url').prop('disabled', false).closest('tr').show();
        } else {
            $('input#rl_red_aft_log_url').prop('disabled', true).closest('tr').hide();
        }
    }
    
    /**
     * Enable/Disable admin bar roles
     * @returns {undefined}
     */
    function endis_adminbar() {
        if ($('input#rl_disable_admin_bar').prop('checked')) {
            $('input#rl_prevent_admin_access, select#rl_disable_admin_bar_roles').prop('disabled', false).closest('tr').show();
        } else {
            $('input#rl_prevent_admin_access, select#rl_disable_admin_bar_roles').prop('disabled', true).closest('tr').hide();
        }
    }    

    if ($.urlParam('page') == 'rl_options') {
        endis_customise();
        endis_redirect();
        endis_adminbar();
        endis_logo_type()
    }

    $('input#rl_cust_log_form').change(function () {
        endis_customise();
    });

    $('input[name=rl_cust_logo_radio]').change(function () {
        endis_logo_type()
    });

    $('input#rl_red_aft_log').change(function () {
        endis_redirect();
    });
    
    $('input#rl_disable_admin_bar').change(function () {
        endis_adminbar();
    });    
});