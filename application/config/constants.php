<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
|--------------------------------------------------------------------------
| Cantidad de Caracteres por Aviso en la cinta de mensajes, y por noticia
| en el panel lateral
|--------------------------------------------------------------------------
|
| Cantidad de caracteres permitido para desplegar en la cinta de
| de avisos del panel inferior, resultados por tabla en la paginacion 
*/
define('MAX_CHAR_PI', 75);
define('MAX_CHAR_LAT', 150);
define('ROWS_FOR_PAGES',5);

define('VIDEO_MODE','video');
define('TEXT_MODE','texto');

/*
|--------------------------------------------------------------------------
| Definicion de constantes para los perfiles de usuarios
|--------------------------------------------------------------------------
*/
define('ADMIN','administrador');
define('EDIT_NT','editor_noticias');
define('EDIT_AV','editor_avisos');

/*
|--------------------------------------------------------------------------
| Definicion de constantes para los estados de un tipo ed contenido
|--------------------------------------------------------------------------
*/
define('ACTIVO','activo');
define('DESACTIVADO','desactivado');



/* End of file constants.php */
/* Location: ./application/config/constants.php */