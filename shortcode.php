<?php
/**
  * Shortcode per tradurre stringhe, ex. titoli o contenuti dei widget
  * Nel caso la lingua impostata tramite il parametro LANG, non esiste tra le scelte, viene
  * restituita la stringa associata alla lingua di default
  *
  *  cml_text - serve a tradurre stringhe in verie lingue.
  *      Utilizzo: 
  *       [cml_text lingua1="valore" lingua2="valore" ...]
  *
  *      Esempio: 
  *       [cml_text it="Stringa in italiano" en="String in English" epo="Teksto en Esperanto"]
  *
  *  cml_shortcode - serve a eseguire un'altro shortcode e passargli parametri in base alla lingua
  *    Utilizzo:
  *      [cml_shortcode shortcode="[shortcode]" [parameters]="[valore]" [languages]="[elenco_valori]"
  *        
  *      @shortcode - nome dello shortcode da eseguire
  *      @params - parametri "fissi" da passare allo shortcode
  *      @[languages] - serve a specificare valori per ogni lingua
  *
  *    Esempio:
  *      [amrp parameters="limit=4" it="cats=28" epo="1" en="2"]
  *
  *  cml_show_available_lang - Serve a visualizzare l'elenco delle lingue in cui � disponibile la catagoria/pagina/articolo
  *
  *  cml_show_flags - visualizza le lingue disponibile con le relative bandiere
  *      Utilizzo:
  *        [cml_show_flags show="flag" size="tiny"]
  *
  *        @show - indica se visualizzare solo la bandiere o anche il nome della lingua. I valori possibili sono:
  *                "flag" - viene visualizzata solo la bandiera
  *                ""     - viene visualizzato anche il nome della lingua all'interno della lista
  *        @size - dimensione dell'immagine. I valori possibili sono
  *                "tiny" = 20x15
  *                "small" = 80x55
  *        
  */
add_shortcode( "cml_text", 'cml_shortcode_text' );
add_shortcode( "cml_shortcode", 'cml_do_shortcode' );
add_shortcode( 'cml_show_available_langs', 'cml_show_available_langs');
add_shortcode( 'cml_other_langs_available', 'cml_shortcode_other_langs_available' );
add_shortcode( 'cml_show_flags', 'cml_shortcode_show_flags' );
add_shortcode( 'cml_translate', 'cml_shortcode_translate' );

function cml_shortcode_text($attrs) {
  global $wpCeceppaML;

  $string = @$attrs[ $wpCeceppaML->get_current_language_slug() ];
  if(!empty($string))
    return $string;
  else
    return $attrs[$wpCeceppaML->get_default_language_slug()];
}

/*
  [cml_translate string="Hello" in="it"]
*/
function cml_shortcode_translate( $attrs ) {
  global $wpCeceppaML;

  extract(shortcode_atts( array( "string" => "", 
                                "in" => "" ), $attrs ) );
  
  $id = ( ! empty( $in ) ) ? $wpCeceppaML->get_language_id_by_slug( $in ) : cml_get_current_language_id();

  return cml_translate( $string, $id );
}

function cml_do_shortcode($attrs) {
  global $wpCeceppaML;

  $shortcode = $attrs['shortcode'];
  $params = @$attrs['params'];
  $lang = $attrs[$wpCeceppaML->get_current_lang()];

  return do_shortcode("[$shortcode $params $lang]");
}

function cml_show_available_langs( $attrs ) {
  extract(shortcode_atts(array("show" => "flag", 
				"size" => "tiny", 
				"class" => "cml_flags",
				"image" => "",
                "sort" => false), $attrs));

  return cml_show_flags( $show, $size, $class, $image, false, true, true, $sort );
}

function cml_shortcode_other_langs_available( $attrs ) {
  global $wpdb, $wpCeceppaML;

  //Controllo se il post � dotato di traduzione ;)
  $id = isset( $attrs[ 'id' ] ) ? intval( $attrs( $id ) ) : get_the_ID();

  if( $wpCeceppaML->has_translations( $id ) )
    return cml_show_available_langs( $attrs );
    
  return "";
}

function cml_shortcode_show_flags($attrs) {
  extract(shortcode_atts(array("show" => "flag", 
				"size" => "tiny", 
				"class" => "cml_flags",
				"image" => ""), $attrs));

  return cml_show_flags( $show, $size, $class, $image, false, true );
}

?>