function extrasAjaxRequest(pluginSlug, action, button) {
    // Disable the button and show a processing indicator
    button.disabled = true;
    button.innerText = 'Processing...';

    var data = {
        action: action,
        slug: pluginSlug,
        extnonce: webenvoExtrasAjax.extnonce
    };

    jQuery.post(webenvoExtrasAjax.ajaxUrl, data, function(response) {
        console.log(response);
        alert('Process completed successfully.');

        // Reload the location after success
        location.reload();
    }).fail(function(errorThrown) {
        console.log(errorThrown);
        alert('An error occurred during the process.Please Refresh and try again.');
    }).always(function() {
        // Re-enable the button and remove the processing indicator
        button.disabled = false;
        button.innerText = 'Done';
        //location.reload();
    });
}
