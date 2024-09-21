jQuery(document).ready(function ($) {
    $('#customize-info').append('<div class="repeater-msg wp-filter act-notice"><div class="wp-filter-notice-container act-notice-container"><h4>Activate Recommended Plugin</h4><p>To enable frontpage features and other additional features of webenvo please activate recommended plugins first.<br>This will also load homepage with its demo data.</p> <form method="post" action=""><input type="submit" id="webenvo-activate-companion-repeater" class="button button-primary" style="margin: 0 0 1em 0;" value="Activate Now"></form></div></div>');
    $('form').submit(function (event) {
        event.preventDefault();
        var $activateButton = $('#webenvo-activate-companion-repeater');
        $activateButton.prop('disabled', true);
        $activateButton.val('Please Wait ! Activating...');
        var plugin_slug = 'envo-companion';
        var data = {
            'action': 'action_install_plugin',
            '_ajax_nonce': ajax_var.nonce,
            'slug': plugin_slug
        };
        $.post(ajax_var.url, data, function (response) {
            if (response.success) {
                console.log('Plugin Installed successfully');
                var plugin_path = 'envo-companion/envo-companion.php';
                var dataact = {
                    'action': 'activate_plugin',
                    'actnonce': ajax_var.actnonce,
                    'plugin': plugin_path
                };
                $.post(ajaxurl, dataact, function (responseact) {
                    if (responseact.success) {
                        console.log('Plugin activated successfully');
                        location.reload();
                    } else {
                        console.log(responseact.dataact);
                    }
                });
            } else {
                var msg = JSON.stringify(response.data);
                console.log(msg);
                console.log('Lest us try to activate Plugin');
                var plugin_path = 'envo-companion/envo-companion.php';
                var dataact = {
                    'action': 'activate_plugin',
                    'actnonce': ajax_var.actnonce,
                    'plugin': plugin_path
                };
                $.post(ajaxurl, dataact, function (responseact) {
                    if (responseact.success) {
                        console.log('Plugin activated successfully');
                        location.reload();
                    } else {
                        console.log(responseact.dataact);
                    }
                    $activateButton.prop('disabled', false);
                    $activateButton.val('Activate Now');
                });
            }
            $activateButton.prop('disabled', false);
            $activateButton.val('Activate Now');
        });
    });
});




