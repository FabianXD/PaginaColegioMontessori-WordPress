<?php
function fn_agenda_home($atts){


	$atts = shortcode_atts( array('cant' => '-1', 'proximos' => 1), $atts);


	$args=array(
		'posts_per_page'   	=> -1,
		'post_type' 		=> 'evento',
		);
	$eventos=get_posts($args);
	$i=0;
	foreach ($eventos as $key => $evento) {
		$fecha_ts=get_post_meta ($evento->ID, 'wpcf-fecha-evento',true);

		if ($atts["proximos"]==1)
		{
			$fecha_hoy=mktime(0,0,0, date("n"), date('j'), date('Y'));
		}
		else
		{
			$fecha_hoy=mktime(0,0,0, 1, 1, date('Y'));
		}
			
		
		if ($fecha_ts >= $fecha_hoy)
		{
			$eventos_publicar[$i]['ID']=$evento->ID;
			$eventos_publicar[$i]['fecha']=$fecha_ts;
			$orden[]=$fecha_ts;
			$i++;
		}
	}
	
	
	$eventos_publicar_salida=array();
	$i=0;
	while (count($eventos_publicar) >0) {
		$menor_fecha=148176000000;
		foreach ($eventos_publicar as $key => $evento_publicar) {
			if ($evento_publicar["fecha"]<$menor_fecha)
			{	
				$menor_fecha=$evento_publicar["fecha"];
				$menor_indice=$key;
			}
		}
		$eventos_publicar_salida[]=$eventos_publicar[$menor_indice];
		unset($eventos_publicar[$menor_indice]);
		
		$i++;
		if ($i>50)
			break;
	}
	$eventos_publicar = $eventos_publicar_salida;



	$contador=0;
	$salida="<div class='eventos_home'>";
	foreach ($eventos_publicar as $key => $evento) {

		$fecha_ts=get_post_meta ($evento["ID"], 'wpcf-fecha-evento',true);
		$dia=date("d", $fecha_ts);
		$mes=date("M", $fecha_ts);
		setlocale (LC_TIME, "es_ES");
		$mes=ucfirst(strftime ("%B", $fecha_ts));

		$salida.="<div class='evento_item'>";
			$salida.="<div class='izquierda'><div class='evento_dia'>".$dia."</div> <div class='evento_mes'>".$mes."</div></div>";
			
			$salida.="<div class='derecha'>";

			if (strlen(get_post_meta ($evento["ID"], 'wpcf-hora',true))>0)
				$salida.="<div class='uno'><i class='fa fa-clock-o' aria-hidden='true'></i><span>".get_post_meta ($evento["ID"], 'wpcf-hora',true)."</span></div>";

			if (strlen(get_post_meta ($evento["ID"], 'wpcf-lugar',true))>0)
				$salida.="<div class='dos'><i class='fa fa-map-marker' aria-hidden='true'></i><span>".get_post_meta ($evento["ID"], 'wpcf-lugar',true)."</span></div>";

				$salida.="<div class='clear'></div>";
				$salida.="<div class='tres'><a href='".get_permalink($evento["ID"])."'>".get_the_title ($evento["ID"])."</a></div>";
				$salida.="<div class='cuatro'>".div_excerpt_by_id($evento["ID"], 20)."</div>";
			$salida.="</div>";//derecha
		$salida.="<div class='clear'></div>";	
		$salida.="</div>";//fin evento_item
		$contador++;
		if ($contador==$atts["cant"])
			break;
	}


	$salida.="</div>"; //fin eventos_home
	return $salida;
}


add_shortcode( 'agenda_home', 'fn_agenda_home' );


function array_orderby()
{
    $args = func_get_args();
    $data = array_shift($args);
    foreach ($args as $n => $field) {
        if (is_string($field)) {
            $tmp = array();
            foreach ($data as $key => $row)
                $tmp[$key] = $row[$field];
            $args[$n] = $tmp;
            }
    }
    $args[] = &$data;


    call_user_func_array('array_multisort', $args);
    return array_pop($args);
}