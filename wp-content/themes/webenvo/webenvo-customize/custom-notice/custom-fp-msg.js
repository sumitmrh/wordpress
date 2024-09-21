wp.customize.bind('ready', function () {
    var panel = wp.customize.panel('webenvo-fpsections-panel');
    if (panel) {
        var message = '<div class="webenvo-fp-msg"><div class="webenvo-upgrade-pro-message simple-notice-custom-control"><h4> Section Reorder Drag/Drop - Pro Feature <p> To enable section reoder feature and other additional features of webenvo please <a href="https://webenvo.com/premium-themes/webenvo-pro/"> Upgrade to Pro </a></p></h4></div></div>';
        panel.expanded.bind(function (isExpanded) {
            if (isExpanded) {
                panel.contentContainer.find('.panel-meta').after(message);
            } else {
                panel.contentContainer.find('.webenvo-fp-msg').remove();
            }
        });
    }
});