<?php
$db = NEW DB;

$stmt = $db->pdo->prepare("SELECT * FROM places WHERE osm_id=?");
$stmt->execute([$osm_id]); 
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo_json_array($result)

?>