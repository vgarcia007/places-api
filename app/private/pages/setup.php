<?php
header('Content-Type: application/json');

require_once('classes/db.php');


$retrun=array();

$DB = new DB;

$TABLE_OPTIONS = '
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci
ENGINE=INNODB';

$TABLES['APP'] = '
CREATE TABLE IF NOT EXISTS app (
id INT AUTO_INCREMENT PRIMARY KEY,
firstrun VARCHAR(30) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)' . $TABLE_OPTIONS;


$TABLES['places'] = '
CREATE TABLE IF NOT EXISTS places (
id INT AUTO_INCREMENT PRIMARY KEY,
osm_id INT NOT NULL,
ags INT NOT NULL,
place VARCHAR(255),
zip INT NOT NULL,
district VARCHAR(255),
state VARCHAR(255)
)' . $TABLE_OPTIONS;


foreach ($TABLES as $key => $TABLE) {
  $sth = $DB->pdo->prepare($TABLE);
  $sth->execute();
  $sql_errors = $sth->errorInfo();
    
}

if (APP_DEBUG == 'on') {
  $retrun['errinfo'][$key] = $sql_errors;
}

//check if setup runs the first time

$retrun['firstrun']=true;

$app_settings = $DB->fetch_id('app',1);

if ( isset($app_settings['firstrun']) ) {
  if($app_settings['firstrun'] == 'completed'){
    $retrun['firstrun']=false;
  }
}

if ($retrun['firstrun'] == true) {


  $data = [
    'firstrun' => 'completed'
    ];

  $DB->insert('app',$data);
  unset($data);


}

print_r(json_encode($retrun, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
?>