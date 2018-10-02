<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'colegio_07');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', '');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '8+PQ6@(ganL#4K7Xf7t/]X%NZWW^LhsX7zHt0n1$ZA?aw0vWp<;o!p2BNpFmQyb8');
define('SECURE_AUTH_KEY', '2~J$ufXkRtj|$)h@2cKr1crnF=J~VENGrw^3Fuk76y%2~5dG-)9s$!]22Bo^aB;*');
define('LOGGED_IN_KEY', 'dhHG`Nns$lt3{a:tJ:gJ}a=b^fPX0UrmKglQm~82%y~DIU(eXr#*siI+FVHX!5XV');
define('NONCE_KEY', 'R_hbB/dto@1|=1H .n+QTLnIVb:zxR40/46}DThr|Oo({^.3| btV5GMSL+|u:F0');
define('AUTH_SALT', 'h}FS0PV9nHkp7v+M6)Gi?`|*+./]uE9ZJGf=(C!A&)h45xjooVwKKvA!hASoQ^Tf');
define('SECURE_AUTH_SALT', 'b9rch) cWY/R&giCo6cQ`$E_{X-ZQRUI_/HNewDLK8NsX`O!^!+`c7uaLsG#~SV(');
define('LOGGED_IN_SALT', 'P;&nM$hpG{o?:1/G_$u[>c^qdPWI,{wV8?`MQyAh3XT+hYQ3h8kV{J/xejuzTl|#');
define('NONCE_SALT', '?Ame$TnYk8WO~ z401?yEpNPl_fK3A=JyP;J[XwIv-%4~PJF;5o<X[3-G:p+ H|2');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

