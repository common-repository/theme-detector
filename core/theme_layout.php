<?php

/*
* detector's fatched values
* @since 1.0.0
*/

    function dtctr_result()
    {
        $layout='';
        /* required url field condition 
        * @since 1.0.0
        */
        if(isset($_POST['site_url'])) 
        {
            $targetSite = esc_url($_POST['site_url']); // put your wordpress url here
            $src = file_get_contents($targetSite); //get target url data
                

            /*
            * get css file from target url
            * @since 1.0.0
            */
            preg_match_all("/<link rel='stylesheet' media='*'.*href='(.*?style\.css.*?)'.*\>/i",$src,$matches);
            
            if(!empty($matches))
            {
                for($i=0; $i<sizeof($matches[1]);$i++)
                {
                    if(!preg_match("/plugins/", $matches[1][$i])) 
                    {
                        $styleHref = trim( $matches[1][$i]);
                        $styleSrc = file_get_contents($styleHref);
                        if(preg_match("/Theme Name:(.*?)\n/i",$styleSrc,$theme_name))
                        {
                            preg_match("/Theme Name:(.*?)\n/i",$styleSrc,$theme_name);
                            preg_match("/Theme URI:(.*?)\n/i",$styleSrc,$theme_uri);
                            preg_match("/Author:(.*?)\n/i",$styleSrc,$author);
                            preg_match("/Author URI:(.*?)\n/i",$styleSrc,$author_uri);
                            preg_match("/Description:(.*?)\n/i",$styleSrc,$description);
                            preg_match("/Version:(.*?)\n/i",$styleSrc,$version);
                            preg_match("/License:(.*?)\n/i",$styleSrc,$licennse);
                            preg_match("/License URI:(.*?)\n/i",$styleSrc,$licennse_uri);
                            preg_match("/Text Domain:(.*?)\n/i",$styleSrc,$text_domain);
                            preg_match("/Tags:(.*?)\n/i",$styleSrc,$tag);
                            $domain_name = parse_url($targetSite);
                            
                            
                            /*
                            * if prag metch 
                            * condition is true
                            * @since 1.0.0
                            */
                            if(!empty($theme_name))
                            {
                                $layout .= ' <div class="detector-container">
                                <h2>'. esc_html($domain_name['host']).' is using "<span class="span-blue-color">';
                                
                                $layout.= (empty($theme_name)) ? '' :  esc_html($theme_name[1]) ; 
                                $layout.= '</span>" theme</h2>
                                <div class="detector-row">
                                <div class="detector-col-md-5">
                                <div class="detector-theme-img-area">
                                <img src="'.esc_html(substr($styleHref, 0, strrpos($styleHref, "/"))).'/screenshot.png"     alt="theme_images">
                                </div>
                                </div>
                                <div class="detector-col-md-7">
                                <div class="theme-details-content">
                                <ul>
                                <li>
                                <p><span class="theme-details-title">Theme Name</span>: ';
                                $layout.= (empty($theme_name)) ? '' :  esc_html($theme_name[1]) ; 
                                
                                $layout.= '</p>
                                <p><span class="theme-details-title">Theme URI</span>:';
                                $layout.= (empty($theme_uri)) ? '' : esc_html($theme_uri[1]) ;
                                
                                $layout.= '</p>
                                </li>
                                <li>
                                <p><span class="theme-details-title">Author</span>:';
                                $layout.= (empty($author)) ? '' : esc_html($author[1]) ; 
                                
                                $layout.= '</p>
                                <p><span class="theme-details-title">Author URI</span>:';
                                $layout.= (empty($author_uri)) ? '' : esc_html($author_uri[1]) ; 
                                
                                $layout.= '</p>
                                </li>
                                <li>
                                <p><span class="theme-details-title">Description</span>:';
                                $layout.= (empty($description)) ? '' :  esc_html($description[1]) ; 
                                
                                $layout.= '</p>
                                </li>
                                <li>
                                <p><span class="theme-details-title">Version</span>:';
                                $layout.= (empty($version)) ? '' :  esc_html($version[1]); 
                                
                                $layout.= '</p>
                                </li>
                                <li>
                                <p><span class="theme-details-title">License</span>:';
                                $layout.= (empty($licennse)) ? '' :  esc_html($licennse[1]) ; 
                                
                                $layout.= '</p>
                                <p><span class="theme-details-title">License URI</span>:';
                                $layout.= (empty($licennse_uri)) ? '' : esc_html($licennse_uri[1]) ; 
                                
                                $layout.= '</p>
                                </li>
                                </ul>
                                </div> 
                                </div>
                                </div>
                                </div>';
                            }
                        }
                    }
                }
            }
        }
        echo $layout;
        wp_die();
    }
    dtctr_result();
    
?>