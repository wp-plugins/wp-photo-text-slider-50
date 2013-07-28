<div class="wrap">
<?php
$wp_50_errors = array();
$wp_50_success = '';
$wp_50_error_found = FALSE;

// Preset the form fields
$form = array(
	'wp_50_id' => '',
	'wp_50_path' => '',
	'wp_50_link' => '',
	'wp_50_target' => '',
	'wp_50_title' => '',
	'wp_50_order' => '',
	'wp_50_status' => '',
	'wp_50_type' => '',
	'wp_50_extra1' => '',
	'wp_50_extra2' => ''
);

// Form submitted, check the data
if (isset($_POST['wp_50_form_submit']) && $_POST['wp_50_form_submit'] == 'yes')
{
	//	Just security thingy that wordpress offers us
	check_admin_referer('wp_50_form_add');
	
	$form['wp_50_path'] = isset($_POST['wp_50_path']) ? $_POST['wp_50_path'] : '';
	$form['wp_50_link'] = isset($_POST['wp_50_link']) ? $_POST['wp_50_link'] : '';
	$form['wp_50_target'] = isset($_POST['wp_50_target']) ? $_POST['wp_50_target'] : '';
	$form['wp_50_title'] = isset($_POST['wp_50_title']) ? $_POST['wp_50_title'] : '';
	$form['wp_50_order'] = isset($_POST['wp_50_order']) ? $_POST['wp_50_order'] : '';
	$form['wp_50_status'] = isset($_POST['wp_50_status']) ? $_POST['wp_50_status'] : '';
	$form['wp_50_type'] = isset($_POST['wp_50_type']) ? $_POST['wp_50_type'] : '';
	$form['wp_50_extra1'] = isset($_POST['wp_50_extra1']) ? $_POST['wp_50_extra1'] : '';

	//	No errors found, we can add this Group to the table
	if ($wp_50_error_found == FALSE)
	{
		$sql = $wpdb->prepare(
			"INSERT INTO `".WP_PHOTO_50_TABLE."`
			(`wp_50_path`, `wp_50_link`, `wp_50_target`, `wp_50_title`, `wp_50_order`, `wp_50_status`, `wp_50_type`, `wp_50_extra1`)
			VALUES(%s, %s, %s, %s, %s, %s, %s, %s)",
			array($form['wp_50_path'], $form['wp_50_link'], $form['wp_50_target'], $form['wp_50_title'], $form['wp_50_order'], $form['wp_50_status'], strtoupper($form['wp_50_type']), $form['wp_50_extra1'])
		);
		
		$wpdb->query($sql);
		
		$wp_50_success = __('New details was successfully added.', WP_PHOTO_50_UNIQUE_NAME);
		
		// Reset the form fields
		$form = array(
			'wp_50_id' => '',
			'wp_50_path' => '',
			'wp_50_link' => '',
			'wp_50_target' => '',
			'wp_50_title' => '',
			'wp_50_order' => '',
			'wp_50_status' => '',
			'wp_50_type' => '',
			'wp_50_extra1' => '',
			'wp_50_extra2' => ''
		);
	}
}

if ($wp_50_error_found == TRUE && isset($wp_50_errors[0]) == TRUE)
{
	?>
	<div class="error fade">
		<p><strong><?php echo $wp_50_errors[0]; ?></strong></p>
	</div>
	<?php
}
if ($wp_50_error_found == FALSE && strlen($wp_50_success) > 0)
{
	?>
	<div class="updated fade">
		<p><strong><?php echo $wp_50_success; ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/options-general.php?page=wp-photo-text-slider-50">Click here</a> to view the details</strong></p>
	</div>
	<?php
}
?>
<script language="JavaScript" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/wp-photo-text-slider-50/pages/setting.js"></script>
<div class="form-wrap">
	<div id="icon-edit" class="icon32 icon32-posts-post"><br></div>
	<h2><?php echo WP_PHOTO_50_TITLE; ?></h2>
	<form name="wp_50_form" method="post" action="#" onsubmit="return wp_50_submit()"  >
      <h3>Add details</h3>
      
		<label for="tag-title">Enter image path (URL)</label>
		<input name="wp_50_path" type="text" id="wp_50_path" value="" size="123" />
		<p>Where is the picture located on the internet (ex: http://www.gopiplus.com/work/wp-content/uploads/pluginimages/250x167/250x167_2.jpg)</p>
		
		<label for="tag-title">Enter target link</label>
		<input name="wp_50_link" type="text" id="wp_50_link" value="#" size="123" />
		<p>When someone clicks on the picture, where do you want to send them.</p>
			
		<label for="tag-title">Select target option</label>
		<select name="wp_50_target" id="wp_50_target">
			<option value='_blank'>_blank</option>
			<option value='_parent'>_parent</option>
			<option value='_self'>_self</option>
			<option value='_new'>_new</option>
      	</select>
		<p>Do you want to open link in new window?</p>
		
		<label for="tag-title">Enter heading (Title)</label>
		<input name="wp_50_extra1" type="text" id="wp_50_extra1" value="" size="123" />
		<p>Enter your title.</p>
		
		<label for="tag-title">Enter description</label>
		<textarea name="wp_50_title" cols="120" rows="10" id="wp_50_title"></textarea>
		<p>Enter your description.</p>
		
		<label for="tag-title">Select gallery type (This is to group the images)</label>
		<select name="wp_50_type" id="wp_50_type">
		<option value=''>Select</option>
		<?php
		$sSql = "SELECT distinct(wp_50_type) as wp_50_type FROM `".WP_PHOTO_50_TABLE."` order by wp_50_type";
		$myDistinctData = array();
		$arrDistinctDatas = array();
		$myDistinctData = $wpdb->get_results($sSql, ARRAY_A);
		$i = 0;
		foreach ($myDistinctData as $DistinctData)
		{
			$arrDistinctData[$i]["wp_50_type"] = strtoupper($DistinctData['wp_50_type']);
			$i = $i+1;
		}
		for($j=$i; $j<$i+5; $j++)
		{
			$arrDistinctData[$j]["wp_50_type"] = "GROUP" . $j;
		}
		$arrDistinctDatas = array_unique($arrDistinctData, SORT_REGULAR);
		foreach ($arrDistinctDatas as $arrDistinct)
		{
			?><option value='<?php echo strtoupper($arrDistinct["wp_50_type"]); ?>'><?php echo strtoupper($arrDistinct["wp_50_type"]); ?></option><?php
		}
		?>
		</select>
		<p>This is to group the text. Select your slideshow group.</p>
		
		<label for="tag-title">Display status</label>
		<select name="wp_50_status" id="wp_50_status">
			<option value='YES'>Yes</option>
			<option value='NO'>No</option>
		</select>
		<p>Do you want the display this in your slider?</p>
		
		<label for="tag-title">Display order</label>
		<input name="wp_50_order" type="text" id="wp_50_rder" size="10" value="1" maxlength="3" />
		<p>Enter your display order.</p>
		
      <input name="wp_50_id" id="wp_50_id" type="hidden" value="">
      <input type="hidden" name="wp_50_form_submit" value="yes"/>
      <p class="submit">
        <input name="publish" lang="publish" class="button add-new-h2" value="Insert Details" type="submit" />&nbsp;
        <input name="publish" lang="publish" class="button add-new-h2" onclick="wp_50_redirect()" value="Cancel" type="button" />&nbsp;
        <input name="Help" lang="publish" class="button add-new-h2" onclick="wp_50_help()" value="Help" type="button" />
      </p>
	  <?php wp_nonce_field('wp_50_form_add'); ?>
    </form>
</div>
<p class="description"><?php echo WP_PHOTO_50_LINK; ?></p>
</div>