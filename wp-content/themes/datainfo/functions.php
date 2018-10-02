<?php
global $etheme_theme_data;
$etheme_theme_data = wp_get_theme( get_stylesheet_directory() . '/style.css' );
require_once( get_template_directory() . '/framework/init.php' );

$dir='wp-content/themes/temadiv/addons/*.php';
foreach (glob($dir) as $filename){
    include $filename;
}

function div_excerpt_by_id($post, $length = 10, $tags = '<a><em><strong>', $extra = ' . . .') {
 
	if(is_int($post)) {
		// get the post object of the passed ID
		$post = get_post($post);
	} elseif(!is_object($post)) {
		return false;
	}
 
	if(has_excerpt($post->ID)) {
		$the_excerpt = $post->post_excerpt;
		return apply_filters('the_content', $the_excerpt);
	} else {
		$the_excerpt = $post->post_content;
	}
 
	$the_excerpt = strip_shortcodes(strip_tags($the_excerpt), $tags);
	$the_excerpt = preg_split('/\b/', $the_excerpt, $length * 2+1);
	$excerpt_waste = array_pop($the_excerpt);
	$the_excerpt = implode($the_excerpt);

	if (strlen($the_excerpt)>0)
		$the_excerpt .= $extra;
 
	return apply_filters('the_content', $the_excerpt);
}


add_filter( 'wpcf7_validate_text*', 'fn_valida_rut', 20, 2 );
function fn_valida_rut( $result, $tag ) {
    $tag = new WPCF7_Shortcode( $tag );
    if ( 'rut' == $tag->name ) {
        $rut = isset( $_POST['rut'] ) ? trim( $_POST['rut'] ) : '';
        if (!valida_rut($rut)) {
            $result->invalidate( $tag, "El RUT no parece correcto" );
        }
    }
    return $result;
}


function valida_rut($rut)
{
    
	if (strlen($rut)<9 || strlen($rut)>10){
		return false;
	}

	if (substr($rut, strlen($rut) - 2, 1) != "-"){
		return false;
	}

	if (!(strpos($rut, ".")===false)){
		return false;
	}

	$num=substr($rut, 0, strlen($rut) - 2);

	if (!(strpos($num, "-")===false)){
		return false;
	}


    if (!preg_match("/^[0-9.]+[-]?+[0-9kK]{1}/", $rut)) {
        return false;
    }
    $rut = preg_replace('/[\.\-]/i', '', $rut);
    $dv = substr($rut, -1);
    $numero = substr($rut, 0, strlen($rut) - 1);
    $i = 2;
    $suma = 0;
    foreach (array_reverse(str_split($numero)) as $v) {
        if ($i == 8)
            $i = 2;
        $suma += $v * $i;
        ++$i;
    }
    $dvr = 11 - ($suma % 11);
    if ($dvr == 11)
        $dvr = 0;
    if ($dvr == 10)
        $dvr = 'K';
    if ($dvr == strtoupper($dv))
        return true;
    else
        return false;
}

















































