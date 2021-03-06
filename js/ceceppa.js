function toggleDetails(index) {
  jQuery('#ceceppaml-table').find('.lang-row').each(function() {
    $this = jQuery(this);
    var id = $this.attr('id');
    var row = id.split('-');

    //Se index == -1, controllo che l'utente abbia fornito le descrizioni degli avvisi :)
    if(index < 0 || row[1] == index) {
      //Trovo la riga successiva
      var $next = $this.next('tr');
      $next.toggle();

      var ok = ($next.find('input:text[value=""]').length == 0);
	//Rimuovo/aggiungo rowspan senno succede un casino :)
	if($next.is(":visible")) {
	    $this.find('td:first').attr('rowspan', '2')
	} else {
	    $this.find('td[rowspan="2"]').removeAttr('rowspan');
	}
    }
  });
}

function addRow(count, lid) {
  $table = jQuery("table.wp-ceceppaml");
  $tr = jQuery("<tr>");
  
  //Stringa
  $td = jQuery("<td>");
    $hidden = jQuery("<input>").attr('type', 'hidden').attr('name', 'id[]');
    $td.append($hidden);

    $input = jQuery("<input>").attr('type', 'text').attr('name', 'string[]').css('width', '100%');
    $td.append($input);
    $tr.append($td);

  id = lid.split(',');
  row = $table.find("tr").length - 1;
  for(var i = 0; i < count; i++) {
    $td = jQuery("<td>");

    $hidden = jQuery("<input>").attr('type', 'hidden').attr('name', 'lang_id[' + row + '][' + i + ']').attr('value', id[i]);
    $td.append($hidden);

    $input = jQuery("<input>").attr('type', 'text').attr('name', 'value[' + row + '][' + i + ']').css('width', '100%');
    $td.append($input);
    $tr.append($td);
  }

  $table.append($tr);
}

jQuery(document).ready(function(e) {
  //DropDown
  jQuery("#ceceppaml-meta-box .linked_post").msDropDown();
  jQuery("#ceceppaml-meta-box .link-category").msDropDown();
  jQuery("#ceceppaml-meta-box .page_lang").msDropDown();
  jQuery("#ceceppaml-meta-box .post_lang").msDropDown();
  jQuery('#ceceppaml-meta-box .linked_page').msDropDown();
  jQuery(".ceceppa-form select:not(.no-dd)").msDropDown();
  jQuery(".cml-widget-flags").msDropDown();

  //Tooltip
  jQuery('._tipsy').tipsy({gravity: 'n', html: true});
  jQuery('.tipsy-e').tipsy({gravity: 'e', html: true});
  jQuery('img').tipsy({gravity: 'e', html: true});
  jQuery('th.column-cml_flags a').tipsy({html: true});

  //Delete language
  jQuery('a._delete').click(function() {
	  if(!confirm('Delete selected language?'))
		  return false;
	  else {
	    var id = jQuery(this).attr('id');
	    var ids = id.split("-");

	    jQuery('input#delete').attr('value', ids[1]);
	    jQuery('form input#submit').click();
	  }
  });

  //Aggiorno le info sul numero di righe da tradurre
  if( jQuery( '.ceceppaml-theme-translations' ).length > 0 ) updateInfo();

  //Get language name and locale from dropdown list
  jQuery('.ceceppa-ml-flags').change(function() {
	  var $this = jQuery(this);
	  var val = $this.val();
	  var ids = $this.attr('id');

	  console.log( val, val.substring( 0, 6 ) );
	  if( val.substring( 0, 6 ) == "upload" ) {
	    var id = val.substring( 7 );
	    $input = ( jQuery( '#' + ids ).parent().parent().find( 'input#flag-file-' + id ) );
	    $input.trigger( 'click' );

	    return;
	  }

	  //Locale and Id
	  var locale = val.split('@');
	  var id = ids.split('-');

	  //Testo dell'elemento selezionato 
	  var text = $this.children("option:selected").text();

	  //Set language name
	  jQuery('#language-' + id[1]).val(text);

	  //Url slug, come predefinito considero le prime 2 cifre del "locale"
	  var loc = locale[0];
	  var l = loc.split("_");
	  jQuery('#slug-' + id[1]).val(l[0].toLowerCase());

	  //Set locale
	  jQuery('#locale-' + id[1]).val(locale[0]);
  });

  //Toggle all details
  toggleDetails(-1);

  jQuery('table.ceceppaml-theme-translations tr.row-domain').click(function() {
    jQuery( this ).removeClass( 'row-open' );

    $next = jQuery( this ).next();
    $next.toggle();
    if( $next.is(":visible") ) jQuery( this ).addClass( 'row-open' );
  });
});

function showStrings( id, what ) {
  if( what == undefined )
    what = ".row-domain";
  else
    what = ".string-" + what;

  jQuery( 'h2.tab-strings a' ).removeClass( 'nav-tab-active' );
  jQuery( jQuery( 'h2.tab-strings a' ).get( id ) ).addClass( 'nav-tab-active' );

  console.log( what );
  jQuery( 'table.ceceppaml-theme-translations tbody tr' + what ).show();
  
  if( what != undefined || what != "" )
    jQuery( 'table.ceceppaml-theme-translations tbody tr' ).not( what ).hide();
}

function updateInfo() {
  $a = jQuery( '.tab-strings a' );
  
  $a.first().find( 'span' ).html( " (" + jQuery( '.row-domain' ).length + ")" );
  jQuery( $a.get( 1 ) ).find( 'span' ).html( " (" + jQuery( '.string-to-translate' ).length + ")" );
  jQuery( $a.get( 2 ) ).find( 'span' ).html( " (" + jQuery( '.string-incomplete' ).length + ")" );
  $a.last().find( 'span' ).html( " (" + jQuery( '.string-translated' ).length + ")" );
}
