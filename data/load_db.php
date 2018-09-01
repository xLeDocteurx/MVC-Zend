<?php
$db = new PDO('mysql:host=localhost;dbname=zend_test', 'root', 'xxxxxxxx');
$fh = fopen(__DIR__ . '/schema.sql', 'r');
while ($line = fread($fh, 4096)) {
    $db->exec($line);
}
fclose($fh);