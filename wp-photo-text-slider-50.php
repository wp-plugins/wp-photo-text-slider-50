<?php

/*
Plugin Name: Wp photo text slider 50
Plugin URI: http://www.gopipulse.com/work/2011/06/02/wordpress-plugin-wp-photo-slider-50/
Description:  Wordpress plugin Wp photo text slider 50 create a photo (photo + heading + description) slider on the wordpress website.
Author: Gopi.R
Version: 5.0
Author URI: http://www.gopipulse.com/work/
Donate link: http://www.gopipulse.com/work/2011/06/02/wordpress-plugin-wp-photo-slider-50/
Tags: wordpress, plugin, photo, slider
*/

global $wpdb, $wp_version;
define("WP_PHOTO_50_TABLE", $wpdb->prefix . "wp_photo_50");

function wp_50_slider() 
{
	global $wpdb;
	
	$wp_50_direction = stripslashes(get_option('wp_50_direction'));
	$wp_50_speed = stripslashes(get_option('wp_50_speed'));
	$wp_50_timeout = stripslashes(get_option('wp_50_timeout'));
	$wp_50_type = stripslashes(get_option('wp_50_type'));
		
	
	?>
    <!-- begin wp_50_photo -->
    <div id="wp_50_photo">
    <?php
	$sSql = "select * from ".WP_PHOTO_50_TABLE." where wp_50_status='YES' and wp_50_type='$wp_50_type'";
	//echo $sSql;
	if(@$wp_50_random == "YES")
	{
		$sSql  = $sSql . " ORDER BY rand()";
	}
	else
	{
		$sSql  = $sSql . " ORDER BY wp_50_order";
	}
	
	$data = $wpdb->get_results($sSql);

	if ( ! empty($data) ) 
	{
		$ivrss_count = 0;
		foreach ( $data as $data ) 
		{
			$wp_50_path = $data->wp_50_path;
			$wp_50_link = $data->wp_50_link;
			$wp_50_target = $data->wp_50_target;
			$wp_50_title = $data->wp_50_title;
			?>
			<div class="post">
				<div class="thumb">
                <?php if($wp_50_link <> "") { ?><a target="<?php echo $wp_50_target; ?>" href="<?php echo $wp_50_link; ?>"><?php } ?>
                <img style="border: 0px; margin: 0px;" src="<?php echo $wp_50_path; ?>" alt="wp photo slider" />
                <?php if($wp_50_link <> "") { ?></a><?php } ?>
                </div>
                <?php if($wp_50_title <> "") { ?><p><?php echo $wp_50_title; ?></p><?php } ?>
			</div>
			<?php
		}
	}
	?>
    </div>
    <script type="text/javascript">
        $(function() {
        $('#wp_50_photo').cycle({
            fx: '<?php echo @$wp_50_direction; ?>',
            speed: <?php echo @$wp_50_speed; ?>,
            timeout: <?php echo @$wp_50_timeout; ?>
        });
        });
        </script> 
    <!-- end wp_50_photo -->
    <?php
}



# Plugin installation default value
function wp_50_install() 
{
	add_option('wp_50_title', "Photo Slider");
	add_option('wp_50_direction', "scrollLeft");
	add_option('wp_50_speed', "700");
	add_option('wp_50_timeout', "5000");
	add_option('wp_50_type', "gallery1");
	
	global $wpdb;
	
	if($wpdb->get_var("show tables like '". WP_PHOTO_50_TABLE . "'") != WP_PHOTO_50_TABLE) 
	{
		$sSql = "CREATE TABLE IF NOT EXISTS `". WP_PHOTO_50_TABLE . "` (";
		$sSql = $sSql . "`wp_50_id` INT NOT NULL AUTO_INCREMENT ,";
		$sSql = $sSql . "`wp_50_path` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,";
		$sSql = $sSql . "`wp_50_link` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,";
		$sSql = $sSql . "`wp_50_target` VARCHAR( 50 ) NOT NULL ,";
		$sSql = $sSql . "`wp_50_title` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,";
		$sSql = $sSql . "`wp_50_order` INT NOT NULL ,";
		$sSql = $sSql . "`wp_50_status` VARCHAR( 10 ) NOT NULL ,";
		$sSql = $sSql . "`wp_50_type` VARCHAR( 100 ) NOT NULL ,";
		$sSql = $sSql . "`wp_50_extra1` VARCHAR( 100 ) NOT NULL ,";
		$sSql = $sSql . "`wp_50_extra2` VARCHAR( 100 ) NOT NULL ,";
		$sSql = $sSql . "`wp_50_date` datetime NOT NULL default '0000-00-00 00:00:00' ,";
		$sSql = $sSql . "PRIMARY KEY ( `wp_50_id` )";
		$sSql = $sSql . ")";
		$wpdb->query($sSql);
		
		$IsSql = "INSERT INTO `". WP_PHOTO_50_TABLE . "` (`wp_50_path`, `wp_50_link`, `wp_50_target` , `wp_50_title` , `wp_50_order` , `wp_50_status` , `wp_50_type` , `wp_50_extra1` , `wp_50_date`)"; 
		$title = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";
		$i = 1;
		for($i=1; $i<6; $i++)
		{
			$sSql = $IsSql . " VALUES ('".get_option('siteurl')."/wp-content/plugins/wp-photo-text-slider-50/images/sing_$i.jpg', '#', '_parent', '$title', '$i', 'YES', 'gallery1', 'Wp photo slider $i', '0000-00-00 00:00:00');";
			$wpdb->query($sSql);
			$sSql = "";
		}
	}
}

# Admin update option for default value
function wp_50_admin_options() 
{
	echo "<div class='wrap'>";
	echo "<h2>"; 
	echo "Wp photo text slider 50";
	echo "</h2>";
	
	$wp_50_title = get_option('wp_50_title');
	$wp_50_direction = get_option('wp_50_direction');
	$wp_50_speed = get_option('wp_50_speed');
	$wp_50_timeout = get_option('wp_50_timeout');
	$wp_50_type = get_option('wp_50_type');

	if (@$_POST['wp_50_submit']) 
	{
		$wp_50_title = stripslashes($_POST['wp_50_title']);
		$wp_50_direction = stripslashes($_POST['wp_50_direction']);
		$wp_50_speed = stripslashes($_POST['wp_50_speed']);
		$wp_50_timeout = stripslashes($_POST['wp_50_timeout']);
		$wp_50_type = stripslashes($_POST['wp_50_type']);
		
		update_option('wp_50_title', $wp_50_title );
		update_option('wp_50_direction', $wp_50_direction );
		update_option('wp_50_speed', $wp_50_speed );
		update_option('wp_50_timeout', $wp_50_timeout );
		update_option('wp_50_type', $wp_50_type );
	}
	
	echo '<form name="wp_50_form" method="post" action="">';

	echo '<p>Widget title:<br><input  style="width: 150px;" maxlength="150" type="text" value="';
	echo $wp_50_title . '" name="wp_50_title" id="wp_50_title" /></p>';
	
	echo '<p>Slider direction:<br><input  style="width: 150px;" maxlength="15" type="text" value="';
	echo $wp_50_direction . '" name="wp_50_direction" id="wp_50_direction" /> (scrollLeft/scrollRight/scrollUp/scrollDown)</p>';

	echo '<p>Slider speed:<br><input  style="width: 150px;" maxlength="3" type="text" value="';
	echo $wp_50_speed . '" name="wp_50_speed" id="wp_50_speed" /> (Only number)</p>';

	echo '<p>Slider timeout:<br><input  style="width: 150px;" maxlength="3" type="text" value="';
	echo $wp_50_timeout . '" name="wp_50_timeout" id="wp_50_timeout" /> (Only number)</p>';

	echo '<p>Slider image group:<br><input  style="width: 150px;" maxlength="100" type="text" value="';
	echo $wp_50_type . '" name="wp_50_type" id="wp_50_type" /> (Enter image group)</p>';

	echo '<input name="wp_50_submit" id="wp_50_submit" class="button-primary" value="Submit" type="submit" />';
	echo '</form>';
	echo '</div>';
	?>
<div style="float:right;">
  <input name="text_management" lang="text_management" class="button-primary" onClick="location.href='options-general.php?page=wp-photo-text-slider-50/image-management.php'" value="Go to - Image Management" type="button" />
  <input name="setting_management" lang="setting_management" class="button-primary" onClick="location.href='options-general.php?page=wp-photo-text-slider-50/wp-photo-text-slider-50.php'" value="Go to - Gallery Setting" type="button" />
</div>
<?php include("help.php"); ?>
<?php
}

add_filter('the_content','wp_50_show_filter');

function wp_50_show_filter($content)
{
	return 	preg_replace_callback('/\[WP-PHOTO-SLIDER(.*?)\]/sim','wp_50_show_filter_callback',$content);
}

function wp_50_show_filter_callback($matches) 
{
	global $wpdb;
	
	$scode = $matches[1];
	
	//echo $scode."=1<br>";
	$wp_50 = "";
	
	list($wp_50_type_main) = split("[:.-]", $scode);
	//[WP-PHOTO-SLIDER:TYPE=gallery1]
	
	//echo $wp_50_type_main."=2<br>";
	
	list($wp_50_type_cap, $wp_50_type) = split('[=.-]', $scode);
	
	//echo $wp_50_type."=3<br>";
	
	$wp_50_direction = stripslashes(get_option('wp_50_direction'));
	$wp_50_speed = stripslashes(get_option('wp_50_speed'));
	$wp_50_timeout = stripslashes(get_option('wp_50_timeout'));
	
	$wp_50_pluginurl = get_option('siteurl') . "/wp-content/plugins/wp-photo-text-slider-50";
    
    $wp_50 = $wp_50 .'<div id="wp_50_photo1">';

	$sSql = "select * from ".WP_PHOTO_50_TABLE." where wp_50_status='YES' and wp_50_type='$wp_50_type'";

	if(@$wp_50_random == "YES")
	{
		$sSql  = $sSql . " ORDER BY rand()";
	}
	else
	{
		$sSql  = $sSql . " ORDER BY wp_50_order";
	}
	//echo $sSql;
	$data = $wpdb->get_results($sSql);

	if ( ! empty($data) ) 
	{
		$wp_50_count = 0;
		foreach ( $data as $data ) 
		{
			$wp_50_path = stripslashes($data->wp_50_path);
			$wp_50_link = stripslashes($data->wp_50_link);
			$wp_50_target = stripslashes($data->wp_50_target);
			$wp_50_title = stripslashes($data->wp_50_title);
			$wp_50_extra1 = stripslashes($data->wp_50_extra1);
			
			$wp_50 = $wp_50 .'<div class="post">';
				
				if($wp_50_extra1 <> "") 
				{ 
					$wp_50 = $wp_50."<h2>".$wp_50_extra1."</h2>"; 
				}
				
				$wp_50 = $wp_50 .'<div class="thumb">';
                
				if($wp_50_link <> "") 
				{
                	$wp_50 = $wp_50 .'<a target="'.$wp_50_target.'" href="'.$wp_50_link.'">';
				}
                
				$wp_50 = $wp_50 .'<img style="border: 0px; margin: 0px;" src="'.$wp_50_path.'" alt="wp photo slider" />';
				
                if($wp_50_link <> "") 
				{ 
					$wp_50 = $wp_50 .'</a>';
				}
				
                $wp_50 = $wp_50 .'</div>';
				
				if($wp_50_title <> "") 
				{ 
					$wp_50 = $wp_50."<p>".$wp_50_title."</p>"; 
				}
				
			$wp_50 = $wp_50 .'</div>';

		}
	}
	$wp_50 = $wp_50 .'</div>';
    $wp_50 = $wp_50 . '<script type="text/javascript">';
    $wp_50 = $wp_50 . '$(function() {';
	$wp_50 = $wp_50 . "$('#wp_50_photo1').cycle({fx: '".$wp_50_direction."',speed: 700,timeout: 5000";
	$wp_50 = $wp_50 . '});';
	$wp_50 = $wp_50 . '});';
	$wp_50 = $wp_50 . '</script>';
	
	return $wp_50;
}

function wp_50_add_to_menu() 
{
	add_options_page('Wp photo text slider 50', 'Wp photo text slider 50', 'manage_options', __FILE__, 'wp_50_admin_options' );
	add_options_page('Wp photo text slider 50', '', 'manage_options', "wp-photo-text-slider-50/image-management.php",'' );
}

if (is_admin()) 
{
	add_action('admin_menu', 'wp_50_add_to_menu');
}

function wp_50_control() 
{
	echo '<p>Wp photo text slider 50<br><br> To change the setting goto "Wp photo text slider 50" link on setting menu. ';
	echo '<a href="options-general.php?page=wp-photo-text-slider-50/wp-photo-text-slider-50.php">click here</a></p>';
}

function wp_50_widget($args) 
{
	extract($args);
	echo $before_widget . $before_title;
	echo get_option('wp_50_title');
	echo $after_title;
	wp_50_slider();
	echo $after_widget;
}

function wp_50_widget_init() 
{
	if(function_exists('wp_register_sidebar_widget')) 	
	{
		wp_register_sidebar_widget('Wp photo text slider 50', 'Wp photo text slider 50', 'wp_50_widget');
	}
	
	if(function_exists('wp_register_widget_control')) 	
	{
		wp_register_widget_control('Wp photo text slider 50', array('Wp photo text slider 50', 'widgets'), 'wp_50_control');
	} 
}

function wp_50_add_javascript_files() 
{
	if (!is_admin())
	{
		wp_enqueue_script( 'jquery-1.3.2.min', get_option('siteurl').'/wp-content/plugins/wp-photo-text-slider-50/js/jquery-1.3.2.min.js');
		wp_enqueue_script( 'jquery.cycle.all.min', get_option('siteurl').'/wp-content/plugins/wp-photo-text-slider-50/js/jquery.cycle.all.min.js');
		wp_enqueue_style( 'wp-photo-text-slider-50', get_option('siteurl').'/wp-content/plugins/wp-photo-text-slider-50/wp-photo-text-slider-50.css');
	}	
}
add_action('init', 'wp_50_add_javascript_files');


function wp_50_deactivation() 
{
	
}

add_action("plugins_loaded", "wp_50_widget_init");
register_activation_hook(__FILE__, 'wp_50_install');
register_deactivation_hook(__FILE__, 'wp_50_deactivation');
?>
