<?php

declare(strict_types=1);

require './../fw/init.php';

if (!defined('FW_CORE_INCLUDE')) {
    die;
}

use FW\Core\App;
use FW\Core\InstanceContainer;

$app = InstanceContainer::get(App::class);
$app->getPage()->setProperty('title', 'Главная страница');
$app->getPage()->addJs('./assets/js/script.js');
$app->getPage()->addCss('./assets/css/styles.css');
$app->header();

$app->includeComponent(
  'fw:element.list',
  'default',
  [
    "sort" => "id",
    "limit" => 10,
    "show_title" => "N"
  ]
);
$app->includeComponent(
  'fw:element.list',
  'default',
  [
    "sort" => "id",
    "limit" => 10,
    "show_title" => "N"
  ]
);
?>

    <pre>
    -------- 28.11.2022 --------
    1) создана минимальная структура файлов
    2) создан основной класс приложения

    -------- 29.11.2022 --------
    1) создан Multiton class
    2) добавлена константа подключения ядра (в init.php).

    -------- 30.11.2022 --------
    1) создана структуры шаблона сайта
    2) доработан App, внедрен буффер
    3) создан класс Page
    4) Добавлена инициализация Page в конструктор App в поле $page

    -------- 01.12.2022 --------
    1) изменил Multiton на InstanceContainer
    2) Исправил все классы
    3) Добавил класс Dictionary

    -------- 02.12.2022 --------
    1) Добавил класс Component/Base
    2) Добавил класс Component/Template
    3) Добавил компонент element.list

    -------- 03.12.2022 --------
    1) декомпозировал класс Component/Template
    2) добавил URL JS CSS компонента на старницу

    -------- 04.12.2022 --------
    1) Добавил запрет на поторное подключение компонентов
    2) Декомпозировал класс Component/Template
    3) Добавил массив классов компонентов в App
    4) Добавил phpDocs
    4) Добавил phpDocs

    </pre>

<?= $app->footer(); ?>