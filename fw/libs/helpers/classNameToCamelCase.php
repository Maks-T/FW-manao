<?php

function classNameToCamelCase(string $className): string
{
    $names = explode('.', $className);

    foreach ($names as &$name) {
      $name = ucfirst($name);
    }

    return implode('', $names);
}
