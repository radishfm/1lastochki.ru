<?php
/**
 * Created by PhpStorm.
 * User: radishfm
 * DateTime: 30.05.2019 16:54
 * Company: 34web
 * To change this template use File | Settings | Editor | File and Code Templates | PHP File Header.
 */
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var CBitrixComponent $this */
class YandexBranches extends \CBitrixComponent
{
	private function start()
	{
		\Bitrix\Main\Loader::IncludeModule('iblock');
		$request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();
		$cityGet = htmlspecialchars($request->getQuery('city'));
		$cityCookie = $request->getCookie('city');

		$this->arResult['CURRENT_CITY'] = $cityGet ?: $cityCookie ?: $this->arParams['CURRENT_CITY'];
	}

	private function getCities()
	{
		$this->arResult['CITIES'] = [];

		$list = \Bitrix\Iblock\SectionTable::getList([
			'filter' => [
				'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
				'ACTIVE' => 'Y',
				'GLOBAL_ACTIVE' => 'Y'
			],
			'order' => [
				'LEFT_MARGIN' => 'ASC'
			],
			'select' => ['NAME', 'ID']
		]);

		while($row = $list->Fetch()) {
			$this->arResult['CITIES'][$row['ID']] = $row;
		}
	}

	private function getBranchesByCity()
	{
		$this->arResult['BRANCHES'] = [];
		$select = [
			'ID',
			'IBLOCK_ID',
			'IBLOCK_SECTION_ID',
			'PROPERTY_ADDRESS',
			'PROPERTY_LAT',
			'PROPERTY_LON',
			'PROPERTY_TELEFON',
			'PROPERTY_NAMESHOPS'
		];
		$filter = [
			'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
			'ACTIVE' => 'Y',
			//'IBLOCK_SECTION_ID' => $section_id
		];

		$list = CIBlockElement::GetList(['SORT' => 'ASC'], $filter, false, false, $select);
		while ($row = $list->Fetch()) {
			$this->arResult['BRANCHES'][$row['IBLOCK_SECTION_ID']][] = [
				'ID' => $row['ID'],
				'ADDRESS' => $row['PROPERTY_ADDRESS_VALUE'],
				'LAT' => $row['PROPERTY_LAT_VALUE'],
				'LON' => $row['PROPERTY_LON_VALUE'],
				'PHONE' => $row['PROPERTY_TELEFON_VALUE'],
				'NAME' => $row['PROPERTY_NAMESHOPS_VALUE']
			];
		}
	}

	private function getCurrentCity()
	{
		if(!empty($this->arResult['CITIES'])){
			foreach ($this->arResult['CITIES'] as &$CITY) {
				if(
					$CITY['NAME'] == $this->arResult['CURRENT_CITY']
					|| $CITY['ID'] == $this->arResult['CURRENT_CITY']
				){
					$CITY['CURRENT'] = true;
				} else {
					$CITY['CURRENT'] = false;
				}
			}
			unset($CITY);
		}
	}

	public function executeComponent()
	{
		try {
			$this->start();
			$this->getCities();
			$this->getCurrentCity();
			$this->getBranchesByCity();

			if ($this->startResultCache()) {
				$this->includeComponentTemplate();
			}
		} catch (\Exception $e) {
			ShowError($e->getMessage());
		}
	}
}