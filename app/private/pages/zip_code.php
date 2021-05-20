<?php
$db = NEW DB;



echo_json_array($db->query('*', 'places', array('plz'=>$zip_code)));

?>