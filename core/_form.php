<?php

/*
* form for theme detecting url
* @since 1.0.0
*/

function dtctr_form_html()
{
    $html= '<form class="site-detect-form" name="detector-form" method="post" action="'.admin_url('admin-ajax.php').'" >
       <div class="from-group">
       <input type="text" name="site-url" placeholder="Site url of WP site" class="site-url-input">
       <button type="submit" name="submit" class="detect-btn">Click and DETECT <i class="detector-loader dropdown icon" style="display:none"></i></button>
       </div>
       </form>';
    return $html;
}
echo dtctr_form_html();
?>