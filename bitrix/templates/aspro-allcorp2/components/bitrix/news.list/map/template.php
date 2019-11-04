<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
use Bitrix\Main\Localization\Loc;
$this->setFrameMode(true);
$yandexApiKey = Bitrix\Main\Config\Option::get('fileman', 'yandex_map_api_key');
if(!empty($yandexApiKey)){
	$this->addExternalJs('https://api-maps.yandex.ru/2.1/?apikey='. $yandexApiKey .'&lang=ru_RU');
	$messages = Loc::loadLanguageFile(__FILE__);
	$arParams['MAIN_COLOUR'] = '#00aeef';
	$arParams['SECOND_COLOUR'] = 'white';
	$arParams['THIRD_COLOUR'] = '#ec1c2e';
	?>
	<style>
		.geoItems__section {
			background-color: <?= $arParams['MAIN_COLOUR']?>;
			border-color: <?= $arParams['SECOND_COLOUR']?>;
			color: <?= $arParams['SECOND_COLOUR']?>;
		}

		.geoItems__section.active{
			background-color: <?= $arParams['THIRD_COLOUR']?>;
			border-color: <?= $arParams['THIRD_COLOUR']?>;
		}

		.geoItems__elements {
			color: <?= $arParams['MAIN_COLOUR']?>;
		}

		.geoItems__element:hover,
		.geoItems__element.active {
			color: <?= $arParams['SECOND_COLOUR']?>;
		}
		.geoItems__element:hover{
			background: <?= $arParams['MAIN_COLOUR']?>;
		}
		.geoItems__element.active{
			background: <?= $arParams['THIRD_COLOUR']?>;
		}
	</style>
	<div class="yandexMap">
		<div class="geoItems flex">
			<div class="geoItems__list">
				<? foreach ($arResult['geoItemsSections'] as $section) { ?>
					<div class="geoItems__section<? if ($section['UF_CURRENT']) { ?> active<? } ?>"
						 data-name="<?= $section['NAME'] ?>"
						 data-id="<?= $section['ID'] ?>"><?= $section['NAME'] ?></div>
					<div class="geoItems__elements" data-sectionID="<?= $section['ID'] ?>"></div>
				<? } ?>
			</div>
			<div id="map" class="geoItems__map"></div>
		</div>
	</div>
	<script>
		BX.message(<?=CUtil::PhpToJSObject($messages)?>);

		document.addEventListener('DOMContentLoaded', function(event) {
			const ygi = new YandexGeoItems({
				'mainBlockSelector' : '.geoItems',
				'sectionSelector' : '.geoItems__section',
				'elementsSelector' : '.geoItems__elements',
				'elementSelector' : '.geoItems__element',
				'activeClass' : 'active',
				'iblock' : '<?= $arParams['IBLOCK_ID']?>',
				'mapID' : 'map',
				'YandexDefaultOption' : {
					center: [48.824246, 44.164892],
					zoom: 8,
					//type: 'yandex#map',
					//behaviors: ['default']
				},
				'color': '<?= $arParams["MAIN_COLOUR"] ?: 'blue'?>',
				'geoItemsElements' : <?= CUtil::PhpToJSObject($arResult['geoItemsElements'])?>,
			});
		});
	</script>
	<?
}
/*
?>
<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<p class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
						class="preview_picture"
						border="0"
						src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
						width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
						height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
						alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
						title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
						style="float:left"
						/></a>
			<?else:?>
				<img
					class="preview_picture"
					border="0"
					src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
					width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
					height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
					alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
					title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
					style="float:left"
					/>
			<?endif;?>
		<?endif?>
		<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
			<span class="news-date-time"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
		<?endif?>
		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><b><?echo $arItem["NAME"]?></b></a><br />
			<?else:?>
				<b><?echo $arItem["NAME"]?></b><br />
			<?endif;?>
		<?endif;?>
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<?echo $arItem["PREVIEW_TEXT"];?>
		<?endif;?>
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<div style="clear:both"></div>
		<?endif?>
		<?foreach($arItem["FIELDS"] as $code=>$value):?>
			<small>
			<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
			</small><br />
		<?endforeach;?>
		<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
			<small>
			<?=$arProperty["NAME"]?>:&nbsp;
			<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
				<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
			<?else:?>
				<?=$arProperty["DISPLAY_VALUE"];?>
			<?endif?>
			</small><br />
		<?endforeach;?>
	</p>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
*/
