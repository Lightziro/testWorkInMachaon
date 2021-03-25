<?php
/** Функция возвращает информацию о настройках
 *
 * @param string $optionName - наименование опции в виде пути до него(пример: путь.путь.путь)
 * @param string|null $defaultValue - стандартное значение которое вернется, если свойства не существует
 * @return array|bool|Exception|mixed|string
 */
function config(string $optionName, string $defaultValue = null)
{
    $newArray = require 'settings.php';
    $configSearch = getValueInArrayByPath($newArray, $optionName);
    if (!$configSearch)
    {
        return (!is_null($defaultValue))
            ? $defaultValue
            : new Exception('Не удалось найти данные по настройкам');
    }
    return $configSearch;
}

/** Функция ищет в массиве заданный элемент через путь(пример: ключ.ключ.ключ)
 *
 * @param array $arraySearch - массив, в котором будет осуществляться поиск элемента
 * @param string $path - путь к элементу массива
 * @return array|bool|mixed
 */
function getValueInArrayByPath(array $arraySearch, string $path)
{
    foreach ($arraySearch as $key => $value)
    {

        $pathSplit = explode('.', $path);
        $newArray = $arraySearch;
        foreach ($pathSplit as $pathElement)
        {
            if (!empty($newArray[$pathElement]) && is_array($newArray))
            {
                $newArray = $newArray[$pathElement];
            }
            elseif (is_array($value))
            {
                return getValueInArrayByPath($value, $path);
            }
        }
        return (!empty($newArray) && !is_array($newArray)) ? $newArray : (bool)false;
    }
}
/*
 * Пример тестирования и вызова соответствующих конфигов элемента настройки
 */
echo config('app.services.resizer.prefer_format') . '<br>';
echo config("info.description") . '<br>';
echo config("app.services.resizer.prefer_format") . '<br>';
echo config("site_url") . '<br>';
echo config("site_info", 'None') . '<br>';
echo config("db.host") . '<br>';
echo config("db.host", 'localhost') . '<br>';
echo config("app.services.info.programType.type", 'PC') . '<br>';
echo config("staffList.programmer.front-end.chief", 'false') . '<br>';
