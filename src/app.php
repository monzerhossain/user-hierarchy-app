<?php
/**
 * Created by PhpStorm.
 * User: monzer
 * Date: 6/29/21
 * Time: 5:48 PM
 */

require_once 'RoleManager.php';
require_once 'UserManager.php';

//user id to search sub-ordinates
CONST USER_ID = 1;

$roleContent = file_get_contents('../input/roles.txt');
$roles = json_decode($roleContent, true);
$roleManager = new RoleManager($roles);


$userContent = file_get_contents('../input/users.txt');
$users = json_decode($userContent, true);
$userManager = new UserManager($roleManager, $users);

$allSubordinates = $userManager->getAllSubordinates(USER_ID);
print($allSubordinates . "\n");