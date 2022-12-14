<?php

declare(strict_types=1);

use FW\Core\App;
use FW\Core\InstanceContainer;

if (!defined('FW_CORE_INCLUDE')) {
    die;
}

$app = InstanceContainer::get(App::class);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $app->getPage()->showProperty('title'); ?></title>
    <?= $app->getPage()->showHead(); ?>
</head>
<body>

<header class="bg-primary text-white p-1 text-center"><h2>Header</h2></header>
<div class="container  mt-2">
 <main class="row p-2">

  
