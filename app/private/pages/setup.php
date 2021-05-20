<?php
require_once('classes/db.php');

$DB = new DB;
$DB->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, 0);
$places_data = file_get_contents('/var/www/private/data/places.sql');
$DB->pdo->exec($places_data);

$all = $DB->fetch_all('places');

$return = array(
  'message' => 'imported '. count($all) . ' places'
);

echo_json_array($return);

?>