<?php 
  global $wpCeceppaML;

  //Non posso richiamare lo script direttamente dal browser :)
  if(!is_object($wpCeceppaML)) die("Access denied");
  
?>
<h2><?php _e('Shortcode & Functions', 'ceceppaml') ?></h2>
<h2 class="nav-tab-wrapper">
    <a href="#" class="nav-tab nav-tab-active"><?php _e('Shortcode') ?></a>
</h2>
<h3>Translate strings in different languages</h3>
<blockquote>
  <span style="color: #00f;">
    <strong>[cml_text]</strong>
  </span>
  <br />
  <blockquote>
    <span style="color: #f00"><?php _e('Usage:', 'ceceppaml') ?></span>
    <br />
    <p style="padding-left: 20px">
      [cml_text lang1="value" lang2="value" ...]<br />
    </p>
      <ul style="float: none; list-style: circle;padding-left: 50px;">
	<li><strong>lang#:</strong> - "slug of language". Ex: it, en, epo...</li>
      </ul>

      <br />
      <strong><?php _e('Example:', 'ceceppaml') ?></strong><br />
      <p style="padding-left: 20px">
	<i>[cml_text it="Stringa in italiano" en="String in English" epo="Teksto en Esperanto"]</i>
      </p>
    </blockquote>
</blockquote>
<br />
<h3><?php _e('How to use the translations saved in "My Translations" page', 'ceceppaml') ?></h3>
<blockquote>
  <span style="color: #00f;">
    <strong>[cml_translate]</strong>
  </span>
  <br />
  <blockquote>
    <span style="color: #f00"><?php _e('Usage:', 'ceceppaml') ?></span>
    <br />
      <p style="padding-left: 20px">
	[cml_shortcode  string="string to search" in="language to translate"]
      </p>
	<ul style="float: none; list-style: circle;padding-left: 50px;">
	  <li><strong>string:</strong> - string previously saved in "My Translation"</li>
	  <li><strong>in:</strong> - <i>(optional)</i>language to translate. If you don't pass this parameter, will be used the current language</li>
	</ul>
      <br />
      <strong><?php _e('Example:', 'ceceppaml') ?></strong>
      <p style="padding-left: 20px">
	<?php _e('Suppose that our default language is <strong>"English"</strong>, and we have:', 'ceceppaml') ?><br />
	<img src="<?php echo CECEPPA_PLUGIN_URL . "/images/example.png" ?>" /><br />
	<?php _e('If we want to translate the word <strong>"Hello"</strong> in "Italian", we must write:', 'ceceppaml') ?><br />
	<p style="padding-left: 40px">
	  <i>[cml_translate string="Hello" in="it"]</i>
	</p>
      </p>
    </blockquote>
</blockquote>
<br />
<h3><?php _e('Execute another shortcode and pass parameters in according to current language', 'ceceppaml') ?></h3>
<blockquote>
  <span style="color: #00f;">
    <strong>[cml_shortcode]</strong>
  </span>
  <br />
  <blockquote>
    <span style="color: #f00"><?php _e('Usage:', 'ceceppaml') ?></span>
    <br />
      <p style="padding-left: 20px">
	[cml_shortcode shortcode="[shortcode to execute]" [parameters]="[default parameters]" [language]="[values]"]
      </p>
	<ul style="float: none; list-style: circle;padding-left: 50px;">
	  <li><strong>shortcode:</strong> - name of the shortcode to execeute</li>
	  <li><strong>parameters:</strong> - "fixed parameters", this paramaters will be passed always</li>
	  <li><strong>languages:</strong> - "slug of language". Ex: it, en, epo...</li>
	  <li><strong>list of values:</strong> - value to pass</li>
	</ul>
      <br />
      <strong><?php _e('Example:', 'ceceppaml') ?></strong>
      <p style="padding-left: 20px">
	<i>[cml_shortcode shortcode="amrp" parameters="limit=4″ it="cats=28″ epo="cats=1″ en="cats=2″]</i>
      </p>
    </blockquote>
</blockquote>
<br />
<h3><?php _e('How to show all available languages', 'ceceppaml') ?></h3>
<blockquote>
  <span style="color: #00f;">
    <strong>[cml_show_flags]</strong><br />
  </span><br />
    <?php _e('This shortcode return an &lt;ul&gt;...&lt;/ul&gt; list', 'ceceppaml') ?>
    <?php _e('This shortcode is available also as function with same name and paramaters', 'ceceppaml') ?>
  <br />
  <blockquote>
    <span style="color: #f00"><?php _e('Usage:', 'ceceppaml') ?></span>
    <br />
      <p style="padding-left: 20px">
	[cml_show_available_langs show="flag|text|both" size="tiny|small" class="classname" image="classname"]
      </p>
	<ul style="float: none; list-style: circle;padding-left: 50px;">
	  <li><strong>show:</strong> - indicates what to display. Possible values are:
	    <ul style="float: none; list-style: square;padding-left: 20px;">
	      <li><strong style="color: #00f">flag</strong> - will be shown only flags</li>
	      <li><strong style="color: #00f">text</strong> - will be shown only the names</li>
	      <li><strong style="color: #00f">both</strong> - will be shown only both, flags and names</li>
	    </ul>
	  </li>
	  <li><strong>size:</strong> - Size of flags.
	    <ul style="float: none; list-style: square;padding-left: 20px;">
	      <li><strong style="color: #00f">tiny</strong> - 20x12</li>
	      <li><strong style="color: #00f">small</strong> - 80x55</li>
	    </ul>
	  </li>
	  <li><strong>class:</strong> - classname to be assigned to the &lt;ul&gt;...&lt;/ul&gt; list.</li>
	  <li><strong>image:</strong> - classname to be assigned to the &lt;img /&gt; element</li>
	</ul>
      <br />
      <strong><?php _e('Example:', 'ceceppaml') ?></strong>
      <p style="padding-left: 20px">
	<i>[cml_show_flags show="both" size="small" class="cml_flags"]</i>
	<?php echo do_shortcode('[cml_show_flags show="both" size="small" class="cml_flags"]'); ?>
      </p>
      <br />
    </blockquote>
</blockquote>
<br />
<h3><?php _e('How to show in which language is available current page/post/category.', 'ceceppaml') ?></h3>
<blockquote>
  <span style="color: #00f;">
    <strong>[cml_show_available_langs]</strong><br />
  </span><br />
    <?php _e('This shortcode return an &lt;ul&gt;...&lt;/ul&gt; list') ?>
  <br />
  <blockquote>
    <span style="color: #f00"><?php _e('Usage:', 'ceceppaml') ?></span>
    <br />
      <p style="padding-left: 20px">
	[cml_show_available_langs class="[classname]"]
      </p>
	<ul style="float: none; list-style: circle;padding-left: 50px;">
	  <li><strong>class:</strong> - classname to be assigned to the &lt;ul&gt;...&lt;/ul&gt; list.</li>
	</ul>
      <br />
      <strong><?php _e('Example:', 'ceceppaml') ?></strong>
      <p style="padding-left: 20px">
	<i>[cml_show_available_langs class="myclassname"]</i>
      </p>
    </blockquote>
</blockquote>
<br />