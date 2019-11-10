<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>


<?$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view",
	"map",
	array(
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:48.78920807800623;s:10:\"yandex_lon\";d:44.74831013757321;s:12:\"yandex_scale\";i:17;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:44.747612763229;s:3:\"LAT\";d:48.789305553989;s:4:\"TEXT\";s:129:\"Социально-досуговый центр детей и молодежи \"Искатель\", Первые ласточки\";}}}",
		"MAP_WIDTH" => "100%",
		"MAP_HEIGHT" => "500",
		"CONTROLS" => array(
			0 => "ZOOM",
			1 => "TYPECONTROL",
			2 => "SCALELINE",
		),
		"OPTIONS" => array(
			0 => "ENABLE_DBLCLICK_ZOOM",
			1 => "ENABLE_DRAGGING",
		),
		"MAP_ID" => "",
		"COMPONENT_TEMPLATE" => "map"
	),
	false
);
?>