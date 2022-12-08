<?php

declare(strict_types=1);

require './../fw/init.php';

if (!defined('FW_CORE_INCLUDE')) {
  die;
}

use FW\Core\App;
use FW\Core\InstanceContainer;


$app = InstanceContainer::get(App::class);
$page = $app->getPage();
$page->setProperty('title', 'Главная страница');
$page->addJs('./assets/js/script.js');
$page->addJs('./assets/js/bootstrap.bundle.min.js');
$page->addCss('./assets/css/styles.css');
$page->addCss('./assets/css/bootstrap.min.css');
$app->header();

$app->includeComponent(
  'fw:interface.form',
  'default',
  [
    'title' => 'Форма InterfaceForm',
    'additional_class' => 'window--full-form', //доп класс на контейнер формы
    'attr' => [  // доп атрибуты
      'data-form-id' => 'form-123'
    ],
    'method' => 'post',
    'action' => '', //url отправки
    'elements' => [  //список элементов формы
      [
        'type' => 'text',
        'name' => 'login',
        'additional_class' => 'js-login',
        'attr' => [
          'data-id' => '17'
        ],
        'title' => 'Логин',
        'default' => 'Введите имя'
      ],
      [
        'type' => 'password',
        'name' => 'password',
        'title' => 'пароль',
        'default' => 'Введите пароль'
      ],
      [
        'type' => 'number',
        'name' => 'number',
        'title' => 'возраст',
        'default' => 'Введите возраст'
      ],
      [
        'type' => 'input_multiple',
        'name' => 'input_multiple',
        'title' => 'дополнительные параметры',
        'additional_class' => 'input-multiple',
        'elements' =>
          [  //список элементов input_multiple
            [
              'type' => 'text',
              'name' => 'input_multiple_login',
              'attr' => [
                'data-id' => '18'
              ],
              'title' => 'Логин',
              'default' => 'Введите имя'
            ],
            [
              'type' => 'password',
              'name' => 'input_multiple_password',
              'title' => 'пароль',
              'default' => 'Введите пароль'
            ],
            [
              'type' => 'number',
              'name' => 'input_multiple_number',
              'title' => 'возраст',
              'default' => 'Введите возраст'
            ]
          ]
      ],
      [
        'type' => 'checkbox',
        'name' => 'single_checkbox',
        'title' => 'одиночный checkbox',
        'id' => 'flexCheckDefault',
        'checked' => ''
      ],
      [
        'type' => 'checkbox_multiple',
        'name' => 'checkbox_multiple',
        'title' => 'CheckBox multiple',
        'elements' => [
          [
            'type' => 'checkbox',
            'name' => 'one_checkbox',
            'title' => 'первый checkbox',
            'id' => 'one_checkbox',
            'checked' => ''
          ],
          [
            'type' => 'checkbox',
            'name' => 'second_checkbox',
            'title' => 'второй checkbox',
            'id' => 'second_checkbox',
          ],
          [
            'type' => 'checkbox',
            'name' => 'third_checkbox',
            'title' => 'третий checkbox',
            'id' => 'third_checkbox',
            'checked' => ''
          ],
          [
            'type' => 'checkbox',
            'name' => 'forth_checkbox',
            'title' => 'четвертый checkbox',
            'id' => 'forth_checkbox',

          ],

        ],
      ],
      [
        'type' => 'radio',
        'name' => 'single_radio',
        'title' => 'одиночный radio button',
        'id' => 'flexRadioDefault',
        'checked' => ''
      ],
      [
        'type' => 'select',
        'name' => 'select',
        'title' => 'элемент Select',
        'selected' => 'value2',
        'options' => [
          'value1' => 'Значение 1',
          'value2' => 'Значение 2',
          'value3' => 'Значение 3',
          'value4' => 'Значение 4',
        ]
      ],
      [
        'type' => 'select_multiple',
        'name' => 'select_multiple',
        'title' => 'элемент Select Multiple',
        'selected' => ['value2', 'value4'],
        'options' => [
          'value1' => 'Значение 1',
          'value2' => 'Значение 2',
          'value3' => 'Значение 3',
          'value4' => 'Значение 4',
        ]
      ]
    ]
  ]
);
?>

    <pre class="row">
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
    -------- 05.12.2022 --------
    1) Убрал вызов метода Render() из класса Base
    2) Убрал лишние методы в Template
    -------- 06.12.2022 --------
    1) Добавил сборщик файлов стилей и скриптов
    2) Добавил кеширование изменений файлов стилей и скриптов в сборщик
    3) Добавил стили и скрипты бутстрапа на страницу
    -------- 07.12.2022 --------
    1) Добавил компонент 'interface.form'
    -------- 08.12.2022 --------
    1) Добавил остальные interface компоненты

    </pre>

<?= $app->footer(); ?>