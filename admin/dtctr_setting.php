<?php
/*
* detector plugin setting
* @since 1.0.0
*/
function dtctr_setting()
{
    echo '<h1>Theme Detector Setting</h1>
        <div class="setting-head">
        <p>Theme Detector plugin allows you to detect which theme is used by wordpress site. You can customize the output of Theme Detector with this settings page.</p>
        <form action="options.php" method="post" class="post-menu-form">';
        settings_fields("my-plugin-settings-group" );
        do_settings_sections( 'my-plugin-settings-group' );
        echo '<table class="form-table">
        <tr><th scope="row">Disable CSS:</th>
        <td><input type="checkbox" name="disable_css" value="true"';
        if(get_option('disable_css')) echo 'checked' ;
        echo '>Check if you want to use your own css</td></tr>
        <tr><th scope="row">Use Shortcode:</th>
        <td><p>To use Theme Detector Searchform in your pages you can use this shortcode:</p>
        <p><code>[detector_searchform]</code></p>
        <p>To use Theme Detector Searchform manually in your theme template use following PHP code:</p>
		<p><code>&lt;?php echo do_shortcode(\'[detector_searchform]\'); ?&gt;</code></p>
        </br>
        <p>To show Theme Detector detected value in your pages you can use this shortcode:</p>
        <p><code>[detector_layout]</code></p>
        <p>To show Theme Detector detected value manually in your theme template use following PHP code:</p>
		<p><code>&lt;?php echo do_shortcod(\'[detector_layout]\'); ?&gt;</code></p>
        </td></tr>
        <tr><td>';
        echo get_submit_button(); 
        echo  '</td></tr> </table>
        </form>
        </div>';
        echo '<div class="theme-detector">
        <p><strong>Do you love this tool? connect with us on social media</strong> </p>
        <div class="shared-links">
        <a title="" href="https://twitter.com/theme_detector" class="twitter"><i class="fa fa-twitter"></i><span>Twitter</span></a>
        <a title="" href="https://plus.google.com/105762559120252767105" class="google-plus"><i class="fa fa-google-plus"></i><span>Google Plus</span></a>
        <a title="" href="https://www.facebook.com/ThemeDetector/" class="facebook"><i class="fa fa-facebook"></i><span>Facebook</span></a>
        </div>
        </div>';
}
dtctr_setting();
?>