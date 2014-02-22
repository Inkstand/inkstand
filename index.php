<?php

require_once 'config.php';

$user = new User();
$user->populate(1);
$user->set("firstname", "Cuds");
$user->update();

$user2 = new User();
$user2->set('email', 'tester@gmail.com');
$user2->set('username', 'tester');
$user2->set('firstname', 'Test');
$user2->set('lastname', 'Er');
$user2->create();

echo '<pre>';
print_r($user->getInfo());
echo '</pre>';

?>