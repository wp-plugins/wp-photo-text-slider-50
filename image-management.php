<!--
/**
 *     Wp photo text slider 50
 *     Copyright (C) 2011  www.gopiplus.com
 * 
 *     This program is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU General Public License as published by
 *     the Free Software Foundation, either version 3 of the License, or
 *     (at your option) any later version.
 * 
 *     This program is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *     GNU General Public License for more details.
 * 
 *     You should have received a copy of the GNU General Public License
 *     along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
-->

<div class="wrap">
  <?php
  	global $wpdb;
    @$mainurl = get_option('siteurl')."/wp-admin/options-general.php?page=wp-photo-text-slider-50/image-management.php";
    @$DID=@$_GET["DID"];
    @$AC=@$_GET["AC"];
    @$submittext = "Insert Message";
	if($AC <> "DEL" and trim(@$_POST['wp_50_link']) <>"")
    {
			if(@$_POST['wp_50_id'] == "" )
			{
					$sql = "insert into ".WP_PHOTO_50_TABLE.""
					. " set `wp_50_path` = '" . mysql_real_escape_string(trim($_POST['wp_50_path']))
					. "', `wp_50_link` = '" . mysql_real_escape_string(trim($_POST['wp_50_link']))
					. "', `wp_50_target` = '" . mysql_real_escape_string(trim($_POST['wp_50_target']))
					. "', `wp_50_title` = '" . mysql_real_escape_string(trim($_POST['wp_50_title']))
					. "', `wp_50_order` = '" . mysql_real_escape_string(trim($_POST['wp_50_order']))
					. "', `wp_50_status` = '" . mysql_real_escape_string(trim($_POST['wp_50_status']))
					. "', `wp_50_extra1` = '" . mysql_real_escape_string(trim($_POST['wp_50_extra1']))
					. "', `wp_50_type` = '" . mysql_real_escape_string(trim($_POST['wp_50_type']))
					. "'";	
			}
			else
			{
					$sql = "update ".WP_PHOTO_50_TABLE.""
					. " set `wp_50_path` = '" . mysql_real_escape_string(trim($_POST['wp_50_path']))
					. "', `wp_50_link` = '" . mysql_real_escape_string(trim($_POST['wp_50_link']))
					. "', `wp_50_target` = '" . mysql_real_escape_string(trim($_POST['wp_50_target']))
					. "', `wp_50_title` = '" . mysql_real_escape_string(trim($_POST['wp_50_title']))
					. "', `wp_50_order` = '" . mysql_real_escape_string(trim($_POST['wp_50_order']))
					. "', `wp_50_status` = '" . mysql_real_escape_string(trim($_POST['wp_50_status']))
					. "', `wp_50_extra1` = '" . mysql_real_escape_string(trim($_POST['wp_50_extra1']))
					. "', `wp_50_type` = '" . mysql_real_escape_string(trim($_POST['wp_50_type']))
					. "' where `wp_50_id` = '" . $_POST['wp_50_id'] 
					. "'";	
			}
			//echo $sql;
			$wpdb->get_results($sql);
    }
    
    if($AC=="DEL" && $DID > 0)
    {
        $wpdb->get_results("delete from ".WP_PHOTO_50_TABLE." where wp_50_id=".$DID);
    }
    
    if($DID<>"" and $AC <> "DEL")
    {
        $data = $wpdb->get_results("select * from ".WP_PHOTO_50_TABLE." where wp_50_id=$DID limit 1");
        if ( empty($data) ) 
        {
           echo "<div id='message' class='error'><p>No data available! use below form to create!</p></div>";
           return;
        }
        $data = $data[0];
        if ( !empty($data) ) $wp_50_id_x = htmlspecialchars(stripslashes($data->wp_50_id)); 
		if ( !empty($data) ) $wp_50_path_x = htmlspecialchars(stripslashes($data->wp_50_path)); 
        if ( !empty($data) ) $wp_50_link_x = htmlspecialchars(stripslashes($data->wp_50_link));
		if ( !empty($data) ) $wp_50_target_x = htmlspecialchars(stripslashes($data->wp_50_target));
        if ( !empty($data) ) $wp_50_title_x = htmlspecialchars(stripslashes($data->wp_50_title));
		if ( !empty($data) ) $wp_50_order_x = htmlspecialchars(stripslashes($data->wp_50_order));
		if ( !empty($data) ) $wp_50_status_x = htmlspecialchars(stripslashes($data->wp_50_status));
		if ( !empty($data) ) $wp_50_extra1_x = htmlspecialchars(stripslashes($data->wp_50_extra1));
		if ( !empty($data) ) $wp_50_type_x = htmlspecialchars(stripslashes($data->wp_50_type));
        $submittext = "Update Message";
    }
    ?>
  <h2>Wp photo text slider 50</h2>
  <script language="JavaScript" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/wp-photo-text-slider-50/setting.js"></script>
  <form name="wp_50_form" method="post" action="<?php echo @$mainurl; ?>" onsubmit="return wp_50_submit()"  >
    <table width="100%">
      <tr>
        <td colspan="2" align="left" valign="middle">Enter image url:</td>
      </tr>
      <tr>
        <td colspan="2" align="left" valign="middle"><input name="wp_50_path" type="text" id="wp_50_path" value="<?php echo @$wp_50_path_x; ?>" size="130" /></td>
      </tr>
      <tr>
        <td colspan="2" align="left" valign="middle">Enter target link:</td>
      </tr>
      <tr>
        <td colspan="2" align="left" valign="middle"><input name="wp_50_link" type="text" id="wp_50_link" value="<?php echo @$wp_50_link_x; ?>" size="130" /></td>
      </tr>
	  <tr>
        <td colspan="2" align="left" valign="middle">Enter target option:</td>
      </tr>
      <tr>
        <td colspan="2" align="left" valign="middle"><input name="wp_50_target" type="text" id="wp_50_target" value="<?php echo @$wp_50_target_x; ?>" size="50" /> ( _blank, _parent, _self, _new )</td>
      </tr>
      <tr>
        <td colspan="2" align="left" valign="middle">Enter heading:</td>
      </tr>
      <tr>
        <td colspan="2" align="left" valign="middle"><input name="wp_50_extra1" type="text" id="wp_50_extra1" value="<?php echo @$wp_50_extra1_x; ?>" size="130" /></td>
      </tr>
	  <tr>
        <td colspan="2" align="left" valign="middle">Enter description:</td>
      </tr>
      <tr>
        <td colspan="2" align="left" valign="middle"><textarea name="wp_50_title" cols="120" rows="10" id="wp_50_title"><?php echo @$wp_50_title_x; ?></textarea></td>
      </tr>
	  <tr>
        <td colspan="2" align="left" valign="middle">Enter gallery type (This is to group the images):</td>
      </tr>
      <tr>
        <td colspan="2" align="left" valign="middle"><input name="wp_50_type" type="text" id="wp_50_type" value="<?php echo @$wp_50_type_x; ?>" size="50" /></td>
      </tr>
      <tr>
        <td align="left" valign="middle">Display Status:</td>
        <td align="left" valign="middle">Display Order:</td>
      </tr>
      <tr>
        <td width="22%" align="left" valign="middle"><select name="wp_50_status" id="wp_50_status">
            <option value="">Select</option>
            <option value='YES' <?php if(@$wp_50_status_x=='YES') { echo 'selected' ; } ?>>Yes</option>
            <option value='NO' <?php if(@$wp_50_status_x=='NO') { echo 'selected' ; } ?>>No</option>
          </select>
        </td>
        <td width="78%" align="left" valign="middle"><input name="wp_50_order" type="text" id="wp_50_rder" size="10" value="<?php echo @$wp_50_order_x; ?>" maxlength="3" /></td>
      </tr>
      <tr>
        <td height="35" colspan="2" align="left" valign="bottom"><table width="100%">
            <tr>
              <td width="50%" align="left"><input name="publish" lang="publish" class="button-primary" value="<?php echo @$submittext?>" type="submit" />
                <input name="publish" lang="publish" class="button-primary" onclick="wp_50_redirect()" value="Cancel" type="button" />
              </td>
              <td width="50%" align="right">
			  <input name="text_management" lang="text_management" class="button-primary" onClick="location.href='options-general.php?page=wp-photo-text-slider-50/image-management.php'" value="Go to - Image Management" type="button" />
        	  <input name="setting_management" lang="setting_management" class="button-primary" onClick="location.href='options-general.php?page=wp-photo-text-slider-50/wp-photo-text-slider-50.php'" value="Go to - Gallery Setting" type="button" />
			  <input name="Help" lang="publish" class="button-primary" onclick="wp_50_help()" value="Help" type="button" />
			  </td>
            </tr>
          </table></td>
      </tr>
      <input name="wp_50_id" id="wp_50_id" type="hidden" value="<?php echo @$wp_50_id_x; ?>">
    </table>
  </form>
  <div class="tool-box">
    <?php
	$data = $wpdb->get_results("select * from ".WP_PHOTO_50_TABLE." order by wp_50_type,wp_50_order");
	if ( empty($data) ) 
	{ 
		echo "<div id='message' class='error'>No data available! use below form to create!</div>";
		return;
	}
	?>
    <form name="frm_wp_50_display" method="post">
      <table width="100%" class="widefat" id="straymanage">
        <thead>
          <tr>
            <th width="10%" align="left" scope="col">Type
              </td>
            <th width="52%" align="left" scope="col">Heading
              </td>
			 <th width="10%" align="left" scope="col">Target
              </td>
            <th width="8%" align="left" scope="col">Order
              </td>
            <th width="7%" align="left" scope="col">Display
              </td>
            <th width="13%" align="left" scope="col">Action
              </td>
          </tr>
        </thead>
        <?php 
        $i = 0;
        foreach ( $data as $data ) { 
		if($data->wp_50_status=='YES') { $displayisthere="True"; }
        ?>
        <tbody>
          <tr class="<?php if ($i&1) { echo'alternate'; } else { echo ''; }?>">
            <td align="left" valign="middle"><?php echo(stripslashes($data->wp_50_type)); ?></td>
            <td align="left" valign="middle"><?php echo(stripslashes($data->wp_50_extra1)); ?></td>
			<td align="left" valign="middle"><?php echo(stripslashes($data->wp_50_target)); ?></td>
            <td align="left" valign="middle"><?php echo(stripslashes($data->wp_50_order)); ?></td>
            <td align="left" valign="middle"><?php echo(stripslashes($data->wp_50_status)); ?></td>
            <td align="left" valign="middle"><a href="options-general.php?page=wp-photo-text-slider-50/image-management.php&DID=<?php echo($data->wp_50_id); ?>">Edit</a> &nbsp; <a onClick="javascript:wp_50_delete('<?php echo($data->wp_50_id); ?>')" href="javascript:void(0);">Delete</a> </td>
          </tr>
        </tbody>
        <?php $i = $i+1; } ?>
        <?php if($displayisthere<>"True") { ?>
        <tr>
          <td colspan="6" align="center" style="color:#FF0000" valign="middle">No message available with display status 'Yes'!' </td>
        </tr>
        <?php } ?>
      </table>
    </form>
  </div>
  <table width="100%">
    <tr>
      <td align="right">
	  	<input name="text_management1" lang="text_management" class="button-primary" onClick="location.href='options-general.php?page=wp-photo-text-slider-50/image-management.php'" value="Go to - Image Management" type="button" />
        <input name="setting_management1" lang="setting_management" class="button-primary" onClick="location.href='options-general.php?page=wp-photo-text-slider-50/wp-photo-text-slider-50.php'" value="Go to - Gallery Setting" type="button" />
		<input name="Help1" lang="publish" class="button-primary" onclick="wp_50_help()" value="Help" type="button" />
      </td>
    </tr>
  </table>
</div>
<?php include("help.php"); ?>