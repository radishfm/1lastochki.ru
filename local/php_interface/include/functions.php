<?php
/**
 * Function for Debug by Admins
 * @param $result
 * @param bool $types
 * @deprecated
 */
function dump($result, $types = false)
{
	global $USER;
	if ($USER->IsAdmin()) {
		echo "<pre>";
		if ($types) {
			var_dump($result);
		} else {
			print_r($result);
		}
		echo "</pre>";
	}
}
/**
 * @param $value
 * @param $path
 * @deprecated
 */
function dumpLog($value, $path)
{
	$value = (array) $value;
	$value = array_merge([date('d.m.Y H:i:s')], $value);
	if (TEST_MODE) {
		\Bitrix\Main\Diag\Debug::writeToFile($value, '', $path);
	}
}