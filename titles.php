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
?>
<div class="wrap">
   <h2><?php _e('Widget\'s titles', 'ceceppaml'); ?></h2>
<?php
function cml_widgets_title($wtitles) {
  global $wpdb;

  $langs = cml_get_languages();
?>
    <form class="ceceppa-form" name="wrap" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?page=ceceppaml-widgettitles-page">
    <input type="hidden" name="form" value="1" />
    <table class="ceceppaml CSSTableGenerator">
      <tbody>
      <tr>
	  <td><?php _e('Widget\'s title', 'ceceppaml') ?></td>
<?php
	  foreach($langs as $lang) {
	    echo "<td><img src='" . cml_get_flag($lang->cml_flag) . "'/>&nbsp;$lang->cml_language</td>";
	  }
?>
      </tr>
<?php 
  foreach($wtitles as $title) :
    if(!empty($title)) :
      echo "<tr>";

      echo "<td style=\"height:2.5em\">\n";
      echo "\t<input type=\"hidden\" name=\"string[]\" value=\"$title\" />\n";
      echo $title . "</td>";
      $i = 0;

      foreach($langs as $lang) :
	$d = cml_translate($title, $lang->id);
	echo "<td>\n";
	echo "<input type=\"text\" name=\"lang_" . $lang->id . "[]\" value=\"$d\" /></td>\n";

	$i++;
      endforeach;

      echo "</tr>";
    endif;
  endforeach;
?>
     </tbody>
    </table>
    <div style="text-align:right">
      <input type="submit" class="ceceppa-salva" name="action" value="<?php _e('Update', 'ceceppaml') ?>" />
    </div>
    </form>
</div>
<?php
}
?>