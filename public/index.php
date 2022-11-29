<?php

declare(strict_types=1);

require './../fw/init.php';

use FW\Core\App;
use FW\Core\Multiton;

$app = Multiton::getInstance(App::class);

$mult = Multiton::getInstance();

dd($app);

dd($mult::getInstance() === $mult)

?>

<pre>
-------- 22.11.2022 --------
1) создана минимальная структура файлов
2) создан основной класс приложения

</pre>

<?php


?>