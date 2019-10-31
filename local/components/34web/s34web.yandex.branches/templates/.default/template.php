<?if(!defined('B_PROLOG_INCLUDED')||B_PROLOG_INCLUDED!==true)die();
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
//dump($arParams);
use Bitrix\Main\Localization\Loc;
$arMessagesJS = [
	'address' => Loc::getMessage('S34WEBYB_TEMPLATE_ADDRESS'),
	'phone' => Loc::getMessage('S34WEBYB_TEMPLATE_PHONE'),
];
?>
<? if ($arParams['MAIN_COLOUR'] and $arParams['SECOND_COLOUR'] and $arParams['THIRD_COLOUR']) { ?>
	<style>
		.branches__city {
			background-color: <?= $arParams['MAIN_COLOUR']?>;
			border-color: <?= $arParams['SECOND_COLOUR']?>;
			color: <?= $arParams['SECOND_COLOUR']?>;
		}

		.branches__city.active{
			background-color: <?= $arParams['THIRD_COLOUR']?>;
			border-color: <?= $arParams['THIRD_COLOUR']?>;
		}

		.branches__elements {
			color: <?= $arParams['MAIN_COLOUR']?>;
		}

		.branches__element:hover,
		.branches__element.active {
			color: <?= $arParams['SECOND_COLOUR']?>;
		}
		.branches__element:hover{
			background: <?= $arParams['MAIN_COLOUR']?>;
		}
		.branches__element.active{
			background: <?= $arParams['THIRD_COLOUR']?>;
		}
	</style>
<? } ?>
<section class="section section--no-pt">
	<div class="grid grid--container">
		<div class="content-container">
			<? if (!empty($arResult['CITIES'])) {
				Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID('map');
				$this->addExternalJs('https://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU');
				?>
				<div class="map" id="id_map">
					<div class="branches flex">
						<div class="branches__list">
							<? foreach ($arResult['CITIES'] as $CITY) { ?>
								<div class="branches__city custom-btn custom-btn--style-2<? if ($CITY['CURRENT']) { ?> active<? } ?>"
									 data-name="<?= $CITY['NAME'] ?>"
									 data-id="<?= $CITY['ID'] ?>"><?= $CITY['NAME'] ?></div>
								<div class="branches__elements" data-cityid="<?= $CITY['ID'] ?>"></div>
							<? } ?>
						</div>
						<div id="YMapsID" class="YMap"></div>
					</div>
				</div>
				<? Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID('map', Loc::getMessage('S34WEBYB_TEMPLATE_LOADING')); ?>
			<? } else {
				echo Loc::getMessage('S34WEBYB_TEMPLATE_NO_BRANCHES');
			} ?>
		</div>
	</div>
</section>
<script>
	document.addEventListener('DOMContentLoaded', function(event) {
		const branches = new YandexBranches({
			'mainBlock' : '.branches',
			'iblock' : '<?= $arParams['IBLOCK_ID']?>',
			'mapID' : 'YMapsID',
			'YandexDefaultOption' : {
				center: [44.0075, 56.326944],
				zoom: 15,
				type: 'yandex#map',
				behaviors: ['default']
			},
			'color': '<?= $arParams["MAIN_COLOUR"]?>',
			'branchesList' : <?= CUtil::PhpToJSObject($arResult['BRANCHES'])?>,
			'messages' : <?= CUtil::PhpToJSObject($arMessagesJS)?>
		});
	});
</script>
