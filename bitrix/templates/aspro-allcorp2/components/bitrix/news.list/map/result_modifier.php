<?php

if(!empty($arResult['ITEMS']) and is_array($arResult['ITEMS'])){
	$arResult['geoItemsElements'] = $arResult['geoItemsSections'] = $geoItemsSections = [];
	foreach ($arResult['ITEMS'] as $key => $item) {
		$this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		$arCoords = explode(',', $item['DISPLAY_PROPERTIES']['YANDEX_GEO']['VALUE']);
		//dump($item['DISPLAY_PROPERTIES']['TYPE']);
		$arResult['geoItemsElements'][$item['IBLOCK_SECTION_ID']][] =
			[
				'ID' => $item['ID'],
				'NAME' => $item['NAME'],
				'PREVIEW_TEXT' => $item['PREVIEW_TEXT'],
				'PREVIEW_PICTURE' => $item['PREVIEW_PICTURE'],
				'DETAIL_PAGE_URL' => $item['DETAIL_PAGE_URL'],
				'LON' => $arCoords[0],
				'LAT' => $arCoords[1],
				'TYPE' => $item['DISPLAY_PROPERTIES']['TYPE']['VALUE_XML_ID'],
				'editArea' => $this->GetEditAreaId($item['ID']),
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
