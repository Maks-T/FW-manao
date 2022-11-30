<?php

declare(strict_types=1);

require './../fw/init.php';

if (!defined('FW_CORE_INCLUDE')) die;

use FW\Core\App;
use FW\Core\Multiton;
use FW\Core\Page;

$app = Multiton::getInstance(App::class);
$page = Multiton::getInstance(Page::class);

$page->setProperty('title', 'Главная страница');
$page->addJs('./assets/js/script.js');
$page->addJs('./assets/js/script2.js');
$page->addCss('./assets/css/styles.css');
$app->renderHeader();
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

</pre>

<?= $app->renderFooter(); ?>