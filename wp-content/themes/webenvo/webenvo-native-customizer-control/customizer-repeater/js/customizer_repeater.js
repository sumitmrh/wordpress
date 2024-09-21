/* global jQuery */
/* global wp */
function media_upload(button_class) {
    'use strict';
    jQuery('body').on('click', button_class, function () {
        var button_id = '#' + jQuery(this).attr('id');
        var display_field = jQuery(this).parent().children('input:text');
        var _custom_media = true;

        wp.media.editor.send.attachment = function (props, attachment) {

            if (_custom_media) {
                if (typeof display_field !== 'undefined') {
                    switch (props.size) {
                        case 'full':
                            display_field.val(attachment.sizes.full.url);
                            display_field.trigger('change');
                            break;
                        case 'medium':
                            display_field.val(attachment.sizes.medium.url);
                            display_field.trigger('change');
                            break;
                        case 'thumbnail':
                            display_field.val(attachment.sizes.thumbnail.url);
                            display_field.trigger('change');
                            break;
                        default:
                            display_field.val(attachment.url);
                            display_field.trigger('change');
                    }
                }
                _custom_media = false;
            } else {
                return wp.media.editor.send.attachment(button_id, [props, attachment]);
            }
        };
        wp.media.editor.open(button_class);
        window.send_to_editor = function (html) {

        };
        return false;
    });
}

/********************************************
 *** Generate unique id ***
 *********************************************/
function customizer_repeater_uniqid(prefix, more_entropy) {
    'use strict';
    if (typeof prefix === 'undefined') {
        prefix = '';
    }

    var retId;
    var php_js;
    var formatSeed = function (seed, reqWidth) {
        seed = parseInt(seed, 10)
            .toString(16); // to hex str
        if (reqWidth < seed.length) { // so long we split
            return seed.slice(seed.length - reqWidth);
        }
        if (reqWidth > seed.length) { // so short we pad
            return new Array(1 + (reqWidth - seed.length))
                .join('0') + seed;
        }
        return seed;
    };

    // BEGIN REDUNDANT
    if (!php_js) {
        php_js = {};
    }
    // END REDUNDANT
    if (!php_js.uniqidSeed) { // init seed with big random int
        php_js.uniqidSeed = Math.floor(Math.random() * 0x75bcd15);
    }
    php_js.uniqidSeed++;

    retId = prefix; // start with prefix, add current milliseconds hex string
    retId += formatSeed(parseInt(new Date()
        .getTime() / 1000, 10), 8);
    retId += formatSeed(php_js.uniqidSeed, 5); // add seed hex string
    if (more_entropy) {
        // for more entropy we add a float lower to 10
        retId += (Math.random() * 10)
            .toFixed(8)
            .toString();
    }

    return retId;
}


/********************************************
 *** General Repeater ***
 *********************************************/
function customizer_repeater_refresh_social_icons(th) {
    'use strict';
    var icons_repeater_values = [];
    th.find('.customizer-repeater-social-repeater-container').each(function () {
        var icon = jQuery(this).find('.icp').val();
        var link = jQuery(this).find('.customizer-repeater-social-repeater-link').val();
        var id = jQuery(this).find('.customizer-repeater-social-repeater-id').val();

        if (!id) {
            id = 'customizer-repeater-social-repeater-' + customizer_repeater_uniqid();
            jQuery(this).find('.customizer-repeater-social-repeater-id').val(id);
        }

        if (icon !== '' && link !== '') {
            icons_repeater_values.push({
                'icon': icon,
                'link': link,
                'id': id
            });
        }
    });

    th.find('.social-repeater-socials-repeater-colector').val(JSON.stringify(icons_repeater_values));
    customizer_repeater_refresh_general_control_values();
}


function customizer_repeater_refresh_general_control_values() {
    'use strict';
    jQuery('.customizer-repeater-general-control-repeater').each(function () {
        var values = [];
        var th = jQuery(this);
        th.find('.customizer-repeater-general-control-repeater-container').each(function () {

            var icon_value = jQuery(this).find('.icp').val();
            var text = jQuery(this).find('.customizer-repeater-text-control').val();
            var link = jQuery(this).find('.customizer-repeater-link-control').val();
            var text2 = jQuery(this).find('.customizer-repeater-text2-control').val();
            var link2 = jQuery(this).find('.customizer-repeater-link2-control').val();
            var color = jQuery(this).find('input.customizer-repeater-color-control').val();
            var color2 = jQuery(this).find('input.customizer-repeater-color2-control').val();
            var image_url = jQuery(this).find('.custom-media-url').val();
            var choice = jQuery(this).find('.customizer-repeater-image-choice').val();
            var title = jQuery(this).find('.customizer-repeater-title-control').val();
            var btntitle = jQuery(this).find('.customizer-repeater-btntitle-control').val();
            var subtitle = jQuery(this).find('.customizer-repeater-subtitle-control').val();
            var id = jQuery(this).find('.social-repeater-box-id').val();
            if (!id) {
                id = 'social-repeater-' + customizer_repeater_uniqid();
                jQuery(this).find('.social-repeater-box-id').val(id);
            }
            var social_repeater = jQuery(this).find('.social-repeater-socials-repeater-colector').val();
            var shortcode = jQuery(this).find('.customizer-repeater-shortcode-control').val();

            if (text !== '' || image_url !== '' || title !== '' || btntitle !== '' || subtitle !== '' || icon_value !== '' || link !== '' || choice !== '' || social_repeater !== '' || shortcode !== '' || color !== '') {
                values.push({
                    'icon_value': (choice === 'customizer_repeater_none' ? '' : icon_value),
                    'color': color,
                    'color2': color2,
                    'text': escapeHtml(text),
                    'link': link,
                    'text2': escapeHtml(text2),
                    'link2': link2,
                    'image_url': (choice === 'customizer_repeater_none' ? '' : image_url),
                    'choice': choice,
                    'title': escapeHtml(title),
                    'btntitle': escapeHtml(btntitle),
                    'subtitle': escapeHtml(subtitle),
                    'social_repeater': escapeHtml(social_repeater),
                    'id': id,
                    'shortcode': escapeHtml(shortcode)
                });
            }

        });
        th.find('.customizer-repeater-colector').val(JSON.stringify(values));
        th.find('.customizer-repeater-colector').trigger('change');
    });
}


jQuery(document).ready(function () {
    'use strict';
    var theme_conrols = jQuery('#customize-theme-controls');
    theme_conrols.on('click', '.customizer-repeater-customize-control-title', function () {
        jQuery(this).next().slideToggle('medium', function () {
            if (jQuery(this).is(':visible')){
                jQuery(this).prev().addClass('repeater-expanded');
                jQuery(this).css('display', 'block');
            } else {
                jQuery(this).prev().removeClass('repeater-expanded');
            }
        });
    });

    theme_conrols.on('change', '.icp',function(){
        customizer_repeater_refresh_general_control_values();
        return false;
    });

    theme_conrols.on('change', '.customizer-repeater-image-choice', function () {
        if (jQuery(this).val() === 'customizer_repeater_image') {
            jQuery(this).parent().parent().find('.social-repeater-general-control-icon').hide();
            jQuery(this).parent().parent().find('.customizer-repeater-image-control').show();
            jQuery(this).parent().parent().find('.customizer-repeater-color-control').prev().prev().hide();
            jQuery(this).parent().parent().find('.customizer-repeater-color-control').hide();

        }
        if (jQuery(this).val() === 'customizer_repeater_icon') {
            jQuery(this).parent().parent().find('.social-repeater-general-control-icon').show();
            jQuery(this).parent().parent().find('.customizer-repeater-image-control').hide();
            jQuery(this).parent().parent().find('.customizer-repeater-color-control').prev().prev().show();
            jQuery(this).parent().parent().find('.customizer-repeater-color-control').show();
        }
        if (jQuery(this).val() === 'customizer_repeater_none') {
            jQuery(this).parent().parent().find('.social-repeater-general-control-icon').hide();
            jQuery(this).parent().parent().find('.customizer-repeater-image-control').hide();
            jQuery(this).parent().parent().find('.customizer-repeater-color-control').prev().prev().hide();
            jQuery(this).parent().parent().find('.customizer-repeater-color-control').hide();
        }

        customizer_repeater_refresh_general_control_values();
        return false;
    });
    media_upload('.customizer-repeater-custom-media-button');
    jQuery('.custom-media-url').on('change', function () {
        customizer_repeater_refresh_general_control_values();
        return false;
    });

    var color_options = {
        change: function(event, ui){
            customizer_repeater_refresh_general_control_values();
        }
    };

    
    jQuery(document).ready(function() {
        // #ev-alu-ate# styling.
        jQuery("#sub-accordion-section-webenvo-styling-section button.wp-color-result").click(function() {
            jQuery( "#customize-control-webenvo-styling-upgrade-control .webenvo-upgrade-pro-message").fadeOut();
            var stparentid = '';
            stparentid = jQuery(this).parent().parent().attr("id");
            console.log(stparentid);
            if (stparentid !== 'customize-control-webenvo-styling-primary-color-control') {
                console.log('#'+stparentid+' .wp-picker-input-wrap');
                jQuery( '#'+stparentid+' .wp-picker-input-wrap').hide();
                jQuery( '#'+stparentid+'  .wp-picker-holder').hide();
                jQuery( "#customize-control-webenvo-styling-upgrade-control .webenvo-upgrade-pro-message").fadeIn();
            }
        });

        // #ev-alu-ate# slider.
        jQuery("#sub-accordion-section-webenvo-slider-section .wp-color-result").click(function() {
            jQuery( "#customize-control-webenvo-slider-color-upgrade-control .webenvo-upgrade-pro-message").fadeOut();
            var slparentid = jQuery(this).parent().parent().attr("id");
            console.log(slparentid);
            if (slparentid != 'customize-control-webenvo_slider_overlay_color_control') {
                jQuery( '#'+slparentid+' .wp-picker-input-wrap').hide();
                jQuery( '#'+slparentid+'  .wp-picker-holder').hide();
                // Show the element with a transition effect
                jQuery( "#customize-control-webenvo-slider-color-upgrade-control .webenvo-upgrade-pro-message").fadeIn();
            }
        });

        // #ev-alu-ate# service.
        // colors.
        jQuery("#sub-accordion-section-webenvo-services-section .wp-color-result").click(function() {
            jQuery( "#customize-control-webenvo-services-color-upgrade-control .webenvo-upgrade-pro-message").fadeOut();
            var svparentid = jQuery(this).parent().parent().attr("id");
            //console.log(pparentid);
            if (svparentid != '') {
                jQuery( '#'+svparentid+' .wp-picker-input-wrap').hide();
                jQuery( '#'+svparentid+'  .wp-picker-holder').hide();
                jQuery( "#customize-control-webenvo-services-color-upgrade-control .webenvo-upgrade-pro-message").fadeIn();
            }
        });
        // Serv Grid.
        jQuery("#customize-control-webenvo-services-grid-control input[name='webenvo-services-grid-control']").prop("disabled", true);
        var gridimage = jQuery("#customize-control-webenvo-services-grid-control .radio-button-label").find('img');
        gridimage.click(function() {
            jQuery( "#customize-control-webenvo-services-grid-upgrade-control .webenvo-upgrade-pro-message").fadeOut();
            //console.log('Image clicked');
            jQuery( "#customize-control-webenvo-services-grid-upgrade-control .webenvo-upgrade-pro-message").fadeIn();
        });

        // #ev-alu-ate# portfolio.
        jQuery("#sub-accordion-section-webenvo-portfolio-section .wp-color-result").click(function() {
            jQuery( "#customize-control-webenvo-portfolio-colors-upgrade-control .webenvo-upgrade-pro-message").fadeOut();
            var pfparentid = jQuery(this).parent().parent().attr("id");
            //console.log(pfparentid);
            if (pfparentid != '') {
                jQuery( '#'+pfparentid+' .wp-picker-input-wrap').hide();
                jQuery( '#'+pfparentid+'  .wp-picker-holder').hide();
                jQuery( "#customize-control-webenvo-portfolio-colors-upgrade-control .webenvo-upgrade-pro-message").fadeIn();
            }
        });
        // #ev-alu-ate# Callout.
        jQuery("#sub-accordion-section-webenvo-callout-section .wp-color-result").click(function() {
            jQuery( "#customize-control-webenvo-callout-colors-upgrade-control .webenvo-upgrade-pro-message").fadeOut();
            var cutparentid = jQuery(this).parent().parent().attr("id");
            //console.log(cutparentid);
            if (cutparentid != '') {
                jQuery( '#'+cutparentid+' .wp-picker-input-wrap').hide();
                jQuery( '#'+cutparentid+'  .wp-picker-holder').hide();
                jQuery( "#customize-control-webenvo-callout-colors-upgrade-control .webenvo-upgrade-pro-message").fadeIn();
            }
        });
        // #ev-alu-ate# team.
        jQuery("#sub-accordion-section-webenvo-team-section .wp-color-result").click(function() {
            jQuery( "#customize-control-webenvo-team-colors-upgrade-control .webenvo-upgrade-pro-message").fadeOut();
            var tmparentid = jQuery(this).parent().parent().attr("id");
            //console.log(tmparentid);
            if (tmparentid != '') {
                jQuery( '#'+tmparentid+' .wp-picker-input-wrap').hide();
                jQuery( '#'+tmparentid+'  .wp-picker-holder').hide();
                jQuery( "#customize-control-webenvo-team-colors-upgrade-control .webenvo-upgrade-pro-message").fadeIn();
            }
        });
        // #ev-alu-ate# testimonial.
        // Testimonial Colors
        jQuery("#sub-accordion-section-webenvo-testimonial-section .wp-color-result").click(function() {
            jQuery( "#customize-control-webenvo-testimonial-colors-upgrade-control .webenvo-upgrade-pro-message").fadeOut();
            var tesmparentid = jQuery(this).parent().parent().attr("id");
            //console.log(tesmparentid);
            if (tesmparentid != '') {
                jQuery( '#'+tesmparentid+' .wp-picker-input-wrap').hide();
                jQuery( '#'+tesmparentid+'  .wp-picker-holder').hide();
                jQuery( "#customize-control-webenvo-testimonial-colors-upgrade-control .webenvo-upgrade-pro-message").fadeIn();
            }
        });
        // #ev-alu-ate# funfact.
        // funfact Grid.
        jQuery("#customize-control-webenvo-funfact-grid-control input[name='webenvo-funfact-grid-control']").prop("disabled", true);
        var gridimage = jQuery("#customize-control-webenvo-funfact-grid-control .radio-button-label").find('img');
        gridimage.click(function() {
            jQuery( "#customize-control-webenvo-funfact-grid-upgrade-control .webenvo-upgrade-pro-message").fadeOut();
            //console.log('Image clicked');
            jQuery( "#customize-control-webenvo-funfact-grid-upgrade-control .webenvo-upgrade-pro-message").fadeIn();
        });


        });

    /**
     * This adds a new box to repeater
     *
     */
    theme_conrols.on('click', '.customizer-repeater-new-field', function () {
        // Free Theme repeater Boundation.
		var parentid = jQuery(this).parent().attr("id"); 

		if(parentid == 'customize-control-webenvo-slider-repeater-control')
        {   
            jQuery( "#customize-control-webenvo-slider-upgrade-control .webenvo-upgrade-pro-message" ).fadeOut();
			var numItems = jQuery("#customize-control-webenvo-slider-repeater-control .customizer-repeater-general-control-repeater-container").length 
			if(numItems >= 3){
			  jQuery( "#customize-control-webenvo-slider-upgrade-control .webenvo-upgrade-pro-message" ).fadeIn();
			  return false;
			}
		}
		if(parentid == 'customize-control-webenvo-services-repeater-control')
		{   
            jQuery( "#customize-control-webenvo-services-upgrade-control .webenvo-upgrade-pro-message" ).fadeOut();
			var numItems = jQuery("#customize-control-webenvo-services-repeater-control .customizer-repeater-general-control-repeater-container").length 
			if(numItems >= 3){
			  jQuery( "#customize-control-webenvo-services-upgrade-control .webenvo-upgrade-pro-message" ).fadeIn();
			  return false;
			}
		}
		if(parentid == 'customize-control-webenvo-portfolio-repeater-control')
		{   
            jQuery( "#customize-control-webenvo-portfolio-upgrade-control .webenvo-upgrade-pro-message" ).fadeOut();
			var numItems = jQuery("#customize-control-webenvo-portfolio-repeater-control .customizer-repeater-general-control-repeater-container").length 
			if(numItems >= 3){
			  jQuery( "#customize-control-webenvo-portfolio-upgrade-control .webenvo-upgrade-pro-message" ).fadeIn();
			  return false;
			}
		}
		if(parentid == 'customize-control-webenvo-team-repeater-control')
		{   
            jQuery( "#customize-control-webenvo-team-upgrade-control .webenvo-upgrade-pro-message" ).fadeOut();
			var numItems = jQuery("#customize-control-webenvo-team-repeater-control .customizer-repeater-general-control-repeater-container").length 
			if(numItems >= 4){
			  jQuery( "#customize-control-webenvo-team-upgrade-control .webenvo-upgrade-pro-message" ).fadeIn();
			  return false;
			}
		}
		if(parentid == 'customize-control-webenvo-testimonial-repeater-control')
		{   
            jQuery( "#customize-control-webenvo-testimonial-upgrade-control .webenvo-upgrade-pro-message" ).fadeOut();
			var numItems = jQuery("#customize-control-webenvo-testimonial-repeater-control .customizer-repeater-general-control-repeater-container").length 
			if(numItems >= 3){
			  jQuery( "#customize-control-webenvo-testimonial-upgrade-control .webenvo-upgrade-pro-message" ).fadeIn();
			  return false;
			}
		}
		if(parentid == 'customize-control-webenvo-funfact-repeater-control')
		{   
            jQuery( "#customize-control-webenvo-funfact-upgrade-control .webenvo-upgrade-pro-message" ).fadeOut();
			var numItems = jQuery("#customize-control-webenvo-funfact-repeater-control .customizer-repeater-general-control-repeater-container").length 
			if(numItems >= 4){
			  jQuery( "#customize-control-webenvo-funfact-upgrade-control .webenvo-upgrade-pro-message" ).fadeIn();
			  return false;
			}
		}
		if(parentid == 'customize-control-webenvo-sponsors-repeater-control')
		{   
            jQuery( "#customize-control-webenvo-sponsors-upgrade-control .webenvo-upgrade-pro-message" ).fadeOut();
			var numItems = jQuery("#customize-control-webenvo-sponsors-repeater-control .customizer-repeater-general-control-repeater-container").length 
			if(numItems >= 3){
			  jQuery( "#customize-control-webenvo-sponsors-upgrade-control .webenvo-upgrade-pro-message" ).fadeIn();
			  return false;
			}
		}
        var th = jQuery(this).parent();
        var id = 'customizer-repeater-' + customizer_repeater_uniqid();
        if (typeof th !== 'undefined') {
            /* Clone the first box*/
            var field = th.find('.customizer-repeater-general-control-repeater-container:first').clone( true, true );

            if (typeof field !== 'undefined') {
                /*Set the default value for choice between image and icon to icon*/
                field.find('.customizer-repeater-image-choice').val('customizer_repeater_icon');

                /*Show icon selector*/
                field.find('.social-repeater-general-control-icon').show();

                /*Hide image selector*/
                if (field.find('.social-repeater-general-control-icon').length > 0) {
                    field.find('.customizer-repeater-image-control').hide();
                }

                /*Show delete box button because it's not the first box*/
                field.find('.social-repeater-general-control-remove-field').show();

                /* Empty control for icon */
                field.find('.input-group-addon').find('.fa').attr('class', 'fa');


                /*Remove all repeater fields except first one*/

                field.find('.customizer-repeater-social-repeater').find('.customizer-repeater-social-repeater-container').not(':first').remove();
                field.find('.customizer-repeater-social-repeater-link').val('');
                field.find('.social-repeater-socials-repeater-colector').val('');

                /*Remove value from icon field*/
                field.find('.icp').val('');

                /*Remove value from text field*/
                field.find('.customizer-repeater-text-control').val('');

                /*Remove value from link field*/
                field.find('.customizer-repeater-link-control').val('');

                /*Remove value from text field*/
                field.find('.customizer-repeater-text2-control').val('');

                /*Remove value from link field*/
                field.find('.customizer-repeater-link2-control').val('');

                /*Set box id*/
                field.find('.social-repeater-box-id').val(id);

                /*Remove value from media field*/
                field.find('.custom-media-url').val('');

                /*Remove value from title field*/
                field.find('.customizer-repeater-title-control').val('');

                /*Remove value from btntitle field*/
                field.find('.customizer-repeater-btntitle-control').val('');


                /*Remove value from color field*/
                field.find('div.customizer-repeater-color-control .wp-picker-container').replaceWith('<input type="text" class="customizer-repeater-color-control ' + id + '">');
                field.find('input.customizer-repeater-color-control').wpColorPicker(color_options);


                field.find('div.customizer-repeater-color2-control .wp-picker-container').replaceWith('<input type="text" class="customizer-repeater-color2-control ' + id + '">');
                field.find('input.customizer-repeater-color2-control').wpColorPicker(color_options);

                // field.find('.customize-control-notifications-container').remove();


                /*Remove value from subtitle field*/
                field.find('.customizer-repeater-subtitle-control').val('');

                /*Remove value from shortcode field*/
                field.find('.customizer-repeater-shortcode-control').val('');

                /*Append new box*/
                th.find('.customizer-repeater-general-control-repeater-container:first').parent().append(field);

                /*Refresh values*/
                customizer_repeater_refresh_general_control_values();
            }

        }
        return false;
    });


    theme_conrols.on('click', '.social-repeater-general-control-remove-field', function () {
        if (typeof    jQuery(this).parent() !== 'undefined') {
            jQuery(this).parent().hide(500, function(){
                // Free repeater Bound.

				var main_slider_items = jQuery("#customize-control-webenvo-slider-repeater-control .customizer-repeater-general-control-repeater-container").length 
				if(main_slider_items <= 3){
				  jQuery( "#customize-control-webenvo-slider-upgrade-control .webenvo-upgrade-pro-message" ).hide();
				}	
				var main_service_items = jQuery("#customize-control-webenvo-services-repeater-control .customizer-repeater-general-control-repeater-container").length 
				if(main_service_items <= 3){
				  jQuery( "#customize-control-webenvo-services-upgrade-control .webenvo-upgrade-pro-message" ).hide();
				}	
				var main_portfolio_items = jQuery("#customize-control-webenvo-portfolio-repeater-control .customizer-repeater-general-control-repeater-container").length 
				if(main_portfolio_items <= 3){
				  jQuery( "#customize-control-webenvo-portfolio-upgrade-control .webenvo-upgrade-pro-message" ).hide();
				}	
				var main_team_items = jQuery("#customize-control-webenvo-team-repeater-control .customizer-repeater-general-control-repeater-container").length 
				if(main_team_items <= 4){
				  jQuery( "#customize-control-webenvo-team-upgrade-control .webenvo-upgrade-pro-message" ).hide();
				}	
				var main_testimonial_items = jQuery("#customize-control-webenvo-testimonial-repeater-control .customizer-repeater-general-control-repeater-container").length 
				if(main_testimonial_items <= 3){
				  jQuery( "#customize-control-webenvo-testimonial-upgrade-control .webenvo-upgrade-pro-message" ).hide();
				}	
				var main_funfact_items = jQuery("#customize-control-webenvo-funfact-repeater-control .customizer-repeater-general-control-repeater-container").length 
				if(main_funfact_items <= 4){
				  jQuery( "#customize-control-webenvo-funfact-upgrade-control .webenvo-upgrade-pro-message" ).hide();
				}	
				var main_sponsors_items = jQuery("#customize-control-sponsors-repeater-control .customizer-repeater-general-control-repeater-container").length 
				if(main_sponsors_items <= 3){
				  jQuery( "#customize-control-webenvo-sponsors-upgrade-control .webenvo-upgrade-pro-message" ).hide();
				}	
                jQuery(this).parent().remove();
                customizer_repeater_refresh_general_control_values();

            });
        }
        return false;
    });


    theme_conrols.on('keyup', '.customizer-repeater-title-control', function () {
        customizer_repeater_refresh_general_control_values();
    });
    
    theme_conrols.on('keyup', '.customizer-repeater-btntitle-control', function () {
        customizer_repeater_refresh_general_control_values();
    });

    jQuery('input.customizer-repeater-color-control').wpColorPicker(color_options);
    jQuery('input.customizer-repeater-color2-control').wpColorPicker(color_options);

    theme_conrols.on('keyup', '.customizer-repeater-subtitle-control', function () {
        customizer_repeater_refresh_general_control_values();
    });

    theme_conrols.on('keyup', '.customizer-repeater-shortcode-control', function () {
        customizer_repeater_refresh_general_control_values();
    });

    theme_conrols.on('keyup', '.customizer-repeater-text-control', function () {
        customizer_repeater_refresh_general_control_values();
    });

    theme_conrols.on('keyup', '.customizer-repeater-link-control', function () {
        customizer_repeater_refresh_general_control_values();
    });

    theme_conrols.on('keyup', '.customizer-repeater-text2-control', function () {
        customizer_repeater_refresh_general_control_values();
    });

    theme_conrols.on('keyup', '.customizer-repeater-link2-control', function () {
        customizer_repeater_refresh_general_control_values();
    });

    /*Drag and drop to change icons order*/

    jQuery('.customizer-repeater-general-control-droppable').sortable({
        axis: 'y',
        update: function () {
            customizer_repeater_refresh_general_control_values();
        }
    });


    /*----------------- Socials Repeater ---------------------*/
    theme_conrols.on('click', '.social-repeater-add-social-item', function (event) {
        event.preventDefault();
        // #Eva-lu-ate repeater.
        var sparentid = jQuery(this).parent().parent().parent().parent().attr("id");
		if(sparentid == 'customize-control-webenvo-topbar-social-repeater-control')
		{
			var snumItems = jQuery("#customize-control-webenvo-topbar-social-repeater-control .customizer-repeater-social-repeater-container").length 
			if(snumItems >= 3){
			  jQuery( "#customize-control-webenvo-topbar-upgrade-control .webenvo-upgrade-pro-message" ).show();
			  return false;
			}
		}
        var th = jQuery(this).parent();
        var id = 'customizer-repeater-social-repeater-' + customizer_repeater_uniqid();
        if (typeof th !== 'undefined') {
            var field = th.find('.customizer-repeater-social-repeater-container:first').clone( true, true );
            if (typeof field !== 'undefined') {
                field.find( '.icp' ).val('');
                field.find( '.input-group-addon' ).find('.fa').attr('class','fa');
                field.find('.social-repeater-remove-social-item').show();
                field.find('.customizer-repeater-social-repeater-link').val('');
                field.find('.customizer-repeater-social-repeater-id').val(id);
                th.find('.customizer-repeater-social-repeater-container:first').parent().append(field);
            }
        }
        return false;
    });

    theme_conrols.on('click', '.social-repeater-remove-social-item', function (event) {
        event.preventDefault();
        // Usable in free theme.
        var main_slider_items = jQuery("#customize-control-webenvo-topbar-social-repeater-control .customizer-repeater-social-repeater-container").length 
				if(main_slider_items <= 3){
				  jQuery( "#customize-control-webenvo-topbar-upgrade-control .webenvo-upgrade-pro-message" ).hide();
				}	
        var th = jQuery(this).parent();
        var repeater = jQuery(this).parent().parent();
        th.remove();
        customizer_repeater_refresh_social_icons(repeater);
        return false;
    });

    theme_conrols.on('keyup', '.customizer-repeater-social-repeater-link', function (event) {
        event.preventDefault();
        var repeater = jQuery(this).parent().parent();
        customizer_repeater_refresh_social_icons(repeater);
        return false;
    });

    theme_conrols.on('change', '.customizer-repeater-social-repeater-container .icp', function (event) {
        event.preventDefault();
        var repeater = jQuery(this).parent().parent().parent();
        customizer_repeater_refresh_social_icons(repeater);
        return false;
    });

});

var entityMap = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    '\'': '&#39;',
    '/': '&#x2F;'
};

function escapeHtml(string) {
    'use strict';
    //noinspection JSUnresolvedFunction
    string = String(string).replace(new RegExp('\r?\n', 'g'), '<br />');
    string = String(string).replace(/\\/g, '&#92;');
    return String(string).replace(/[&<>"'\/]/g, function (s) {
        return entityMap[s];
    });

}