<?php

use Bitrix\Main\Localization\Loc;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();
/** @var array $arCurrentValues */

if(!\Bitrix\Main\Loader::IncludeModule('iblock'))
	return;

$arTypesEx = CIBlockParameters::GetIBlockTypes(array('-'=>' '));

$arIBlocks=array();
$db_iblock = CIBlock::GetList(
	array('SORT'=>'ASC'),
	array(
		'SITE_ID'=>$_REQUEST['site'],
		'TYPE' => ($arCurrentValues['IBLOCK_TYPE']!='-'?$arCurrentValues['IBLOCK_TYPE']:'')
	)
);
while($arRes = $db_iblock->Fetch())
	$arIBlocks[$arRes['ID']] = '['.$arRes['ID'].'] '.$arRes['NAME'];

$arComponentParameters = array(
	'GROUPS' => [],
	'PARAMETERS' => array(
		'IBLOCK_TYPE' => array(
			'PARENT' => 'BASE',
			'NAME' => Loc::getMessage('T_IBLOCK_DESC_LIST_TYPE'),
			'TYPE' => 'LIST',
			'VALUES' => $arTypesEx,
			//'DEFAULT' => 'news',
			'REFRESH' => 'Y',
		),
		'IBLOCK_ID' => array(
			'PARENT' => 'BASE',
			'NAME' => Loc::getMessage('T_IBLOCK_DESC_LIST_ID'),
			'TYPE' => 'LIST',
			'VALUES' => $arIBlocks,
			//'DEFAULT' => '={$_REQUEST['ID']}',
			'ADDITIONAL_VALUES' => 'Y',
			'REFRESH' => 'Y',
		),
		'CURRENT_CITY' => array(
			'PARENT' => 'BASE',
			'NAME' => Loc::getMessage('S34WEBYB_SECTION_ID'),
			'TYPE' => 'STRING',
			//'VALUES' => $arIBlocks,
			'DEFAULT' => '45',
			'REFRESH' => 'Y',
		),
		'MAIN_COLOUR' => array(
			'PARENT' => 'BASE',
			'NAME' => Loc::getMessage('S34WEBYB_MAIN_COLOUR'),
			'TYPE' => 'COLORPICKER',
			'DEFAULT' => '#010EC8',
		),
		'SECOND_COLOUR' => array(
			'PARENT' => 'BASE',
			'NAME' => Loc::getMessage('S34WEBYB_SECOND_COLOUR'),
			'TYPE' => 'COLORPICKER',
			'DEFAULT' => '#FFF',
		),
		'THIRD_COLOUR' => array(
			'PARENT' => 'BASE',
			'NAME' => Loc::getMessage('S34WEBYB_THIRD_COLOUR'),
			'TYPE' => 'COLORPICKER',
			'DEFAULT' => '#070C54',
		),
	),
);