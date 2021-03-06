<?php
/*  Copyright 2013  Alessandro Senese (email : senesealessandro@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

global $wpCeceppaML;

//Non posso richiamare lo script direttamente dal browser :)
if(!is_object($wpCeceppaML)) die("Access denied");

?>
<div class="wrap">
  <div class="icon32">
    <img src="<?php echo CECEPPA_PLUGIN_URL ?>images/logo.png" height="32"/>
  </div>
  <h2 class="nav-tab-wrapper">
    <a class="nav-tab nav-tab-active" href="#"><?php _e('Widget titles', 'ceceppaml'); ?></a>
  </h2>
<?php
function cml_widgets_title($wtitles) {
  global $wpdb;

  $langs = cml_get_languages();
?>
    <div class="updated">
      <p>
	<?php $link = add_query_arg(array("page" => "ceceppaml-language-page", "tab" => 1)); ?>
	<?php $text = __('If you want to use default translation check <a href="%s">here</a> if language file are availables for all languages :)', 'ceceppaml'); ?>
	<?php echo sprintf($text, $link) ?>
      </p>
      <p>
	<?php $text = __('If you want to customize widget titles you must assign a title for each of them in "Appearance" -> "Widgets"', 'ceceppaml'); ?>
	<?php echo sprintf($text, $link) ?>
      </p>
    </div>
    <form class="ceceppa-form" name="wrap" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?page=ceceppaml-widgettitles-page">
    <input type="hidden" name="form" value="1" />
    <table class="wp-list-table widefat wp-ceceppaml">
      <thead>
      <tr>
	  <th><?php _e('Title', 'ceceppaml') ?></th>
<?php
	  foreach($langs as $lang) {
	    echo "<th><img src='" . cml_get_flag($lang->cml_flag) . "' height='10'/>&nbsp;&nbsp;$lang->cml_language</th>";
	  }
?>
      </tr>
<?php 
  foreach($wtitles as $title) :
    if(!empty($title)) :
      $title = html_entity_decode($title);
	//Non posso utilizzare htmlentities perché sennò su un sito in lingua russa mi ritrovo tutti simboli strani :'(
      $title = str_replace("\"", "&quot;", $title);
      $alternate = @empty($alternate) ? "alternate" : "";
      echo "<tr class=\"${alternate}\">";

      echo "<td style=\"height:2.5em\">\n";
      echo "\t<input type=\"hidden\" name=\"string[]\" value=\"$title\" />\n";
      echo $title . "</td>";
      $i = 0;

      foreach($langs as $lang) :
	$d = cml_translate($title, $lang->id, 'W', false, true);
	$d = str_replace("\"", "&quot;", $d);
	echo "<td>\n";
	echo "<input type=\"text\" name=\"lang_" . $lang->id . "[]\" value=\"$d\"  style=\"width: 100%\" /></td>\n";

	$i++;
      endforeach;

      echo "</tr>";
    endif;
  endforeach;
?>
     </tbody>
    </table>
    <div style="text-align:right">
      <p class="submit">
	<?php submit_button( __('Reset titles', 'ceceppaml'), "button-secondary", "delete", false ) ?>&nbsp;&nbsp;
	<?php submit_button( __('Update', 'ceceppaml', 'ceceppaml'), "button-primary", "action", false, 'class="button button-primary"' ); ?>
      </p>
    </div>
    </form>
</div>
<?php
}
?>