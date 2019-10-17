<?if( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true ) die();?>
<?\Bitrix\Main\Localization\Loc::loadMessages(__FILE__);?>
<?$APPLICATION->AddChainItem(GetMessage("TITLE"));?>
<?$APPLICATION->SetTitle(GetMessage("TITLE"));?>
<?$APPLICATION->SetPageProperty("TITLE_CLASS", "center");?>
<?global $USER, $APPLICATION;
$APPLICATION->SetPageProperty('MENU', 'N');
if( !$USER->IsAuthorized() ){?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:system.auth.forgotpasswd",
		"main", array(
			"URL" => $arParams["SEF_FOLDER"].$arParams["SEF_URL_TEMPLATES"]["forgot"],
		),
		false
	);?>
<?}else{
	LocalRedirect( $arParams["SEF_FOLDER"] );
}?>