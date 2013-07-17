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

/**
 * @param $lang_id - id della lingua corrente
 * @param $result - result della query (facoltativo)
 * @param $post_id - id del post
 * @param $browser_lang - id della lingua per la quale si cerca l'articolo collegato
 * 
 *      [ A ] <--> [ B ] <--> [ C ]
 *
 * Ipotesi 1: St� visualizzando l'articolo B, ovvero quello della lingua predefinita.
 *	Da B posso ricavare il link della lingua che voglio tramite l'identificativo della stessa ($result->id)
 *
 * Ipotesi 2: Da A voglio ricavare i link di B e C
 *	Dato che ogni articolo pu� essere collegato a uno soltanto e che gli articoli collegati li trovo nella prima colonna della tabella (...)_id_1
 *	Per ottenere il link di B basta che recupero l'id_2 utilizzando come condizione l'id_1
 *	Se da A voglio recuperare l'articolo C devo passare prima per A e poi recuperare l'articolo C abbinato ad A
 *
 * Caso 2:
 *	[ A ] <--> [ C ]
 *
 *
 */
function cml_get_linked_post($lang_id, $result, $post_id, $browser_lang = null) {
  global $wpdb;

  $link = null;

  if(empty($result)) :
    if(empty($browser_lang)) $browser_lang = cml_get_current_language_id();
    $result = $wpdb->get_row(sprintf("SELECT * FROM %s WHERE id = %d", CECEPPA_ML_TABLE, $browser_lang));
  endif;

  //Non confronto la lingua con se stessa :D
  if(is_object($result) && $result->id != $lang_id) {
      /*
	* Devo cercare sia in cml_post_id_1 che in cml_post_id_2, xk� posso avere
	* degli articoli collegati tra di loro, ma non a quella predefinita, e considerando
	* solo cml_post_id_1 perderei questa informazione :(
	*/
      $query = sprintf("SELECT *, cml_post_id_2 as post_id FROM %s WHERE (cml_post_id_1 = %d OR cml_post_id_2 = %d) AND (cml_post_id_1 > 0 AND cml_post_id_2 > 0)",
			CECEPPA_ML_POSTS, $post_id, $post_id);
      $new_id = $wpdb->get_row($query);

      if(!empty($new_id)) :
	if($new_id->cml_post_lang_2 != $result->id && $new_id->post_id > 0) {
	  //Se la lingua che ho recuperato � diversa da quella attuale verifico se c'� un altro
	  //post in un'altra lingua collegato a questo
	  $query = sprintf("SELECT *, cml_post_id_1 as post_id FROM %s WHERE cml_post_id_2 = %d AND cml_post_lang_1 = %d",
			    CECEPPA_ML_POSTS, $new_id->post_id, $result->id);

	  $new_id = $wpdb->get_row($query);
	} else {
	  $new_id = $new_id->post_id;
	}
      endif;

      if(is_object($new_id)) $new_id = $new_id->post_id;
  } else
    $link = $post_id;

  if(!empty($new_id))
    $link = $new_id;

  return $link;
}


/**
 * http://www.cult-f.net/detect-crawlers-with-php/
 *
 * !!!ATTENZIONE!!! NON SO SE E' NECESSARIA QUESTA FUNZIONE, NEL CASO SI RIVELASSE INUTILE, VERRA' RIMOSSA :)
 * Questa funzione server per evitare di reindirizzare o nascondere i post nella lingua differente
 * da quella del browser se schi st� visitando il sito � un crawler, al fine di permettere l'indicizzazione di tutti
 * gli articoli
 *
 */
function isCrawler()
{
    $USER_AGENT = $_SERVER['HTTP_USER_AGENT'];

    // to get crawlers string used in function uncomment it
    // it is better to save it in string than use implode every time
    // global $crawlers
    // $crawlers_agents = implode('|',$crawlers);
    $crawlers_agents = 'Google|msnbot|Rambler|Yahoo|AbachoBOT|accoona|AcioRobot|ASPSeek|CocoCrawler|Dumbot|FAST-WebCrawler|GeonaBot|Gigabot|Lycos|MSRBOT|Scooter|AltaVista|IDBot|eStyle|Scrubby';
 
    if ( strpos($crawlers_agents , $USER_AGENT) === false )
       return false;
    // crawler detected
    // you can use it to return its name
    /*
    else {
       return array_search($USER_AGENT, $crawlers);
    }
    */
    return true;
}

// http://betterwp.net/wordpress-tips/url_to_postid-for-custom-post-types/
function bwp_url_to_postid($url)
{
    global $wp_rewrite;
 
    $url = apply_filters('url_to_postid', $url);
 
    // First, check to see if there is a 'p=N' or 'page_id=N' to match against
    if ( preg_match('#[?&](p|page_id|attachment_id)=(\d+)#', $url, $values) )   {
        $id = absint($values[2]);
        if ( $id )
            return $id;
    }
 
    // Check to see if we are using rewrite rules
    $rewrite = $wp_rewrite->wp_rewrite_rules();

    // Not using rewrite rules, and 'p=N' and 'page_id=N' methods failed, so we're out of options
    if ( empty($rewrite) )
	return 0;

    // Get rid of the #anchor
    $url_split = explode('#', $url);
    $url = $url_split[0];
 
    // Get rid of URL ?query=string
    $url_split = explode('?', $url);
    $url = $url_split[0];
 
    // Add 'www.' if it is absent and should be there
    if ( false !== strpos(home_url(), '://www.') && false === strpos($url, '://www.') )
        $url = str_replace('://', '://www.', $url);
 
    // Strip 'www.' if it is present and shouldn't be
    if ( false === strpos(home_url(), '://www.') )
        $url = str_replace('://www.', '://', $url);
 
    // Strip 'index.php/' if we're not using path info permalinks
    if (!$wp_rewrite->using_index_permalinks() )
        $url = str_replace('index.php/', '', $url);
 
    if ( false !== strpos($url, home_url()) ) {
        // Chop off http://domain.com
        $url = str_replace(home_url(), '', $url);
    } else {
        // Chop off /path/to/blog
        $home_path = parse_url(home_url());
        $home_path = isset( $home_path['path'] ) ? $home_path['path'] : '' ;
        $url = str_replace($home_path, '', $url);
    }
 
    // Trim leading and lagging slashes
    $url = trim($url, '/');
 
    $request = $url;
    // Look for matches.
    $request_match = $request;
    foreach ( (array)$rewrite as $match => $query) {
        // If the requesting file is the anchor of the match, prepend it
        // to the path info.
        if ( !empty($url) && ($url != $request) && (strpos($match, $url) === 0) )
            $request_match = $url . '/' . $request;
 
        if ( preg_match("!^$match!", $request_match, $matches) ) {
            // Got a match.
            // Trim the query of everything up to the '?'.
            $query = preg_replace("!^.+\?!", '', $query);
 
            // Substitute the substring matches into the query.
            $query = addslashes(WP_MatchesMapRegex::apply($query, $matches));
 
            // Filter out non-public query vars
            global $wp;
            parse_str($query, $query_vars);
            $query = array();
            foreach ( (array) $query_vars as $key => $value ) {
                if ( in_array($key, $wp->public_query_vars) )
                    $query[$key] = $value;
            }
 
        // Taken from class-wp.php
        foreach ( $GLOBALS['wp_post_types'] as $post_type => $t )
            if ( $t->query_var )
                $post_type_query_vars[$t->query_var] = $post_type;
 
        foreach ( $wp->public_query_vars as $wpvar ) {
            if ( isset( $wp->extra_query_vars[$wpvar] ) )
                $query[$wpvar] = $wp->extra_query_vars[$wpvar];
            elseif ( isset( $_POST[$wpvar] ) )
                $query[$wpvar] = $_POST[$wpvar];
            elseif ( isset( $_GET[$wpvar] ) )
                $query[$wpvar] = $_GET[$wpvar];
            elseif ( isset( $query_vars[$wpvar] ) )
                $query[$wpvar] = $query_vars[$wpvar];
 
            if ( !empty( $query[$wpvar] ) ) {
                if ( ! is_array( $query[$wpvar] ) ) {
                    $query[$wpvar] = (string) $query[$wpvar];
                } else {
                    foreach ( $query[$wpvar] as $vkey => $v ) {
                        if ( !is_object( $v ) ) {
                            $query[$wpvar][$vkey] = (string) $v;
                        }
                    }
                }
 
                if ( isset($post_type_query_vars[$wpvar] ) ) {
                    $query['post_type'] = $post_type_query_vars[$wpvar];
                    $query['name'] = $query[$wpvar];
                }
            }
        }
 
            // Do the query
            $query = new WP_Query($query);
            if ( !empty($query->posts) && $query->is_singular )
                return $query->post->ID;
            else
                return 0;
        }
    }
    return 0;
}

/**
 * Retrieves a page given its path.
 *
 * @since 2.1.0
 * @uses $wpdb
 *
 * @param string $page_path Page path
 * @param string $output Optional. Output type. OBJECT, ARRAY_N, or ARRAY_A. Default OBJECT.
 * @param array $post_type Optional. Post type. Default page.
 * @return WP_Post|null WP_Post on success or null on failure
 */
function cml_get_page_by_path($page_path, $output = OBJECT, $post_type = array('page')) {
	global $wpdb;

    $page_path = rawurlencode(urldecode($page_path));
    $page_path = str_replace('%2F', '/', $page_path);
    $page_path = str_replace('%20', ' ', $page_path);
    $parts = explode( '/', trim( $page_path, '/' ) );
    $parts = array_map( 'esc_sql', $parts );
    $parts = array_map( 'sanitize_title_for_query', $parts );

    $in_string = "'". implode( "','", $parts ) . "'";
    $post_type_sql = implode( "','", $post_type );
//     $wpdb->escape_by_ref( $post_type_sql );
    $pages = $wpdb->get_results("SELECT ID, post_name, post_parent, post_type FROM $wpdb->posts WHERE post_name IN ($in_string) AND (post_type IN ('$post_type_sql'))", OBJECT_K );
    $revparts = array_reverse( $parts );

    $foundid = 0;
    foreach ( (array) $pages as $page ) {
	    if ( $page->post_name == $revparts[0] ) {
		    $count = 0;
		    $p = $page;
		    while ( $p->post_parent != 0 && isset( $pages[ $p->post_parent ] ) ) {
			    $count++;
			    $parent = $pages[ $p->post_parent ];
			    if ( ! isset( $revparts[ $count ] ) || $parent->post_name != $revparts[ $count ] )
				    break;
			    $p = $parent;
		    }

		    if ( $p->post_parent == 0 && $count+1 == count( $revparts ) && $p->post_name == $revparts[ $count ] ) {
			    $foundid = $page->ID;
			    if ( $page->post_type == $post_type )
				    break;
		    }
	    }
    }

    if ( $foundid )
	    return get_post( $foundid, $output );

    return null;
}

?>