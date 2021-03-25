<?php
header("Content-type: text/plain");
/** Функция возвращает информацию о настройках
 *
 * @param string $optionName - наименование опции в виде пути до него(пример: путь.путь.путь)
 * @param string|null $defaultValue - стандартное значение которое вернется, если свойства не существует
 * @return array|bool|Exception|mixed|string
 */
function config(string $optionName, string $defaultValue = null)
{
	$newArray = require "settings.php";
	$configSearch = getValueInArrayByPath($newArray, $optionName);

	if (!$configSearch["status"])
	{
		return (!is_null($defaultValue))
			? $defaultValue
			: new Exception("Не удалось найти данные по настройкам");
	}
	return $configSearch["output"];
}

/** Функция ищет в массиве заданный элемент через путь(пример: ключ.ключ.ключ)
 *
 * @param array $arraySearch - массив, в котором будет осуществляться поиск элемента
 * @param string $path - путь к элементу массива
 * @return array|bool|mixed
 */
function getValueInArrayByPath(array $arraySearch, string $path)
{
	$pathSplit = explode(".", $path);
	if (empty($pathSplit) || $pathSplit == array())
	{
		return getOutputStatus(
			isset($arraySearch[$path]) ? true : false,
			$arraySearch[$path]
		);
	}
	foreach ($arraySearch as $key => $value)
	{
		$lastElement = end($pathSplit);
		$newArray = $arraySearch;

		foreach ($pathSplit as $pathElement)
		{
			if (isset($newArray[$lastElement]) && $lastElement == $pathElement)
				return getOutputStatus(true, $newArray[$pathElement]);

			if (isset($newArray[$pathElement]) && is_array($newArray)) {
				$newArray = $newArray[$pathElement];
			}
		}

		$statusReturn = !is_array($newArray) ? true : false;
		return getOutputStatus($statusReturn, $newArray);
	}
}

/** Функция для вывода возвратного значения из функции
 *
 * @param bool $type - тип выполненной функции
 * @param null $content - информация которую требуется вывести из функции
 * @return array
 */
function getOutputStatus(bool $type = true, $content = null)
{
	return ["status" => $type, "output" => $content];
}

/*
 * Пример тестирования и вызова соответствующих конфигов элемента настройки
 */
print_r(config("dbs")) . PHP_EOL;
print_r(config("app.services")) . PHP_EOL;
print_r(config("app.services.resizer")) . PHP_EOL;
print_r(config("staffList.programmer")) . PHP_EOL;
print_r(config("staffList.programmer.back-end")) . PHP_EOL;
print_r(config("info.programType")) . PHP_EOL;

echo config("app.services.resizer.prefer_format") . PHP_EOL;
echo config("app.services.resizer.prefer_format") . PHP_EOL;
echo config("info.description") . PHP_EOL;
echo config("site_url") . PHP_EOL;
echo config("site_info", "None") . PHP_EOL;
echo config("db.host") . PHP_EOL;
echo config("db.host", "localhost") . PHP_EOL;
echo config("app.services.info.programType.type", "PC") . PHP_EOL;
echo config("staffList.programmer.front-end.chief", "false") . PHP_EOL;
echo config("staffList.programmer.back-end.senior-developer.job.5.first_name", "None") . PHP_EOL;

