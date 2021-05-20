<?php 
date_default_timezone_set(getenv('TZ'));
setlocale (LC_TIME, "de_DE");
set_include_path('/var/www/private');

session_start();

require_once('config.php');

if(APP_DEBUG == 'on'){
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
}

require_once('classes/db.php');
require_once('classes/AltoRouter.php');


function error_and_die($message,$e){
    echo 'Datenbankverbindung Fehlgeschlagen '."\n";
    if (APP_DEBUG == 'on') {
        echo $e->getMessage(), "\n";
    }
    die();
}


function echo_json_array($data){
    header('Content-Type: application/json');
    print_r(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

}

function echo_json_db_data($data){
    $data_array=array();
    foreach ($data as $key => $item) {
        array_push($data_array,$item);
    }
    echo_json_array($data_array);

}

# ROUTER
#=========================================================

$router = new AltoRouter();
$router->addMatchTypes(array('char' => '(?:[^\/]*)'));

/*
* setup
*/
$router->map( 'GET', '/setup', function() {
	require 'pages/setup.php';
});

/*
* start and docs
*/
$router->map( 'GET', '/', function() {
    $table='';
	require 'pages/home.php';
});

/*
* osm_id
*/
$router->map( 'GET', '/osm_id/[i:query]', function( $query ) {
    $db = NEW DB;
	echo_json_array($db->query('*', 'places', array('osm_id'=>$query)));
});

/*
* plz
*/
$router->map( 'GET', '/zip_code/[i:query]', function( $query ) {
    $db = NEW DB;
    echo_json_array($db->query('*', 'places', array('plz'=>$query)));
});

/*
* ags
*/
$router->map( 'GET', '/ags/[char:query]', function( $query ) {
    $db = NEW DB;
    echo_json_array($db->query('*', 'places', array('ort'=>$query)));
});

$router->map( 'GET', '/ags-search/[char:query]', function( $query ) {
    $db = NEW DB;
    echo_json_array($db->query_like('*', 'places', array('ags'=>$query.'%')));
});

/*
* ort
*/
$router->map( 'GET', '/place/[char:query]', function( $query ) {
    $db = NEW DB;
    echo_json_array($db->query('*', 'places', array('ort'=>$query)));
});

$router->map( 'GET', '/place-search/[char:query]', function( $query ) {
    $db = NEW DB;
    echo_json_array($db->query_like('*', 'places', array('ort'=>'%'.$query.'%')));
});


/*
=========================================================
* ROUTER RUN
=========================================================
*/

/*
* Match current request url
*/
$match = $router->match();

/*
* call closure or throw 404 status
*/
if( is_array($match) && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] ); 
} else {
    require 'pages/error.php';

}
?>
