<?php

if(!empty($arResult['ITEMS']) and is_array($arResult['ITEMS'])){
	$arResult['geoItemsElements'] = $arResult['geoItemsSections'] = $geoItemsSections = [];
	foreach ($arResult['ITEMS'] as $key => $item) {
		$arCoords = explode(',', $item['DISPLAY_PROPERTIES']['YANDEX_GEO']['VALUE']);
		$arResult['geoItemsElements'][$item['IBLOCK_SECTION_ID']][] =
			[
				'ID' => $item['ID'],
				'NAME' => $item['NAME'],
				'PREVIEW_TEXT' => $item['PREVIEW_TEXT'],
				'PREVIEW_PICTURE' => $item['PREVIEW_PICTURE'],
				'DETAIL_PAGE_URL' => $item['DETAIL_PAGE_URL'],
				'LON' => $arCoords[0],
				'LAT' => $arCoords[1],
			];
		$geoItemsSections[$item['IBLOCK_SECTION_ID']] = $item['IBLOCK_SECTION_ID'];
	}

	$entity = \Bitrix\Iblock\Model\Section::compileEntityByIblock($arParams['IBLOCK_ID']);

	$list = $entity::getList([
		'filter' => [
			//'IBLOCK_ID' => $arParams['IBLOCK_ID'],
			'ACTIVE' => 'Y',
			'GLOBAL_ACTIVE' => 'Y',
			'ID' => $geoItemsSections
		],
		'order' => [
			'LEFT_MARGIN' => 'ASC'
		],
		'select' => ['NAME', 'ID', 'UF_CURRENT']
	]);

	while($row = $list->Fetch()) {
		$arResult['geoItemsSections'][$row['ID']] = $row;
	}

	//dump([$arResult['geoItemsElements'], $arResult['geoItemsSections'], $arResult['ITEMS'][0]]);
}
