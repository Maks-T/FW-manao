<?php

declare(strict_types=1);

require './../fw/init.php';

use FW\Core\App;
use FW\Core\Router;

$app = App::getInstance();
Router::match('www');

echo 'Старт проекта 22-11-2022';
