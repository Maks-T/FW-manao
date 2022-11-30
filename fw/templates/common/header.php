<?php

declare(strict_types=1);

use FW\Core\Multiton;
use FW\Core\Page;

if (!defined('FW_CORE_INCLUDE')) die;

$page = Multiton::getInstance(Page::class);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">  
  <title><?= $page->showProperty('title'); ?></title>
  <?= $page->showHead(); ?>
</head>
<body>
  <?= $page->showProperty('title2'); ?>
  <header><h2>Хеадер</h2></header>
  <main>

  
