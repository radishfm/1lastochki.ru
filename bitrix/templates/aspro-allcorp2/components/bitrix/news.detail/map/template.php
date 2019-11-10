<? use Bitrix\Main\Localization\Loc;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$this->setFrameMode(true);
if($arResult['DISPLAY_PROPERTIES']['PHOTOS']['VALUE'] && is_array($arResult['DISPLAY_PROPERTIES']['PHOTOS']['VALUE'])){
	foreach($arResult['DISPLAY_PROPERTIES']['PHOTOS']['VALUE'] as $img){
		$arResult['GALLERY_BIG'][] = array(
			'DETAIL' => ($arPhoto = CFile::GetFileArray($img)),
			'PREVIEW' => CFile::ResizeImageGet($img, array('width' => 1500, 'height' => 1500), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true),
			'THUMB' => CFile::ResizeImageGet($img, array('width' => 60, 'height' => 60), BX_RESIZE_IMAGE_EXACT, true),
			'TITLE' => (strlen($arPhoto['DESCRIPTION']) ? $arPhoto['DESCRIPTION'] : (strlen($arResult['DETAIL_PICTURE']['TITLE']) ? $arResult['DETAIL_PICTURE']['TITLE']  :(strlen($arPhoto['TITLE']) ? $arPhoto['TITLE'] : $arResult['NAME']))),
			'ALT' => (strlen($arPhoto['DESCRIPTION']) ? $arPhoto['DESCRIPTION'] : (strlen($arResult['DETAIL_PICTURE']['ALT']) ? $arResult['DETAIL_PICTURE']['ALT']  : (strlen($arPhoto['ALT']) ? $arPhoto['ALT'] : $arResult['NAME']))),
		);
	}
}
//dump($arResult['DISPLAY_PROPERTIES']);
?>
	<div class="detail news fixed_wrapper">
		<?if($arResult['FIELDS']['DETAIL_PICTURE']){
		$atrTitle = (strlen($arResult['DETAIL_PICTURE']['DESCRIPTION']) ? $arResult['DETAIL_PICTURE']['DESCRIPTION'] : (strlen($arResult['DETAIL_PICTURE']['TITLE']) ? $arResult['DETAIL_PICTURE']['TITLE'] : $arResult['NAME']));
		$atrAlt = (strlen($arResult['DETAIL_PICTURE']['DESCRIPTION']) ? $arResult['DETAIL_PICTURE']['DESCRIPTION'] : (strlen($arResult['DETAIL_PICTURE']['ALT']) ? $arResult['DETAIL_PICTURE']['ALT'] : $arResult['NAME']));
			?>
			<div class="detailimage image-left">
				<a href="<?= $arResult['FIELDS']['DETAIL_PICTURE']['SRC']?>" class="fancybox" title="<?= $atrTitle?>">
					<img src="<?= $arResult['FIELDS']['DETAIL_PICTURE']['SRC']?>" class="img-responsive" title="<?= $atrTitle?>" alt="<?= $atrAlt?>">
				</a>
			</div>
		<?}?>

		<?if(strlen($arResult['FIELDS']['DETAIL_TEXT'])):?>
			<div class="content">
				<?// element detail text?>
				<?if(strlen($arResult['FIELDS']['DETAIL_TEXT'])):?>
					<?if($arResult['DETAIL_TEXT_TYPE'] == 'text'):?>
						<p><?=$arResult['FIELDS']['DETAIL_TEXT'];?></p>
					<?else:?>
						<?=$arResult['FIELDS']['DETAIL_TEXT'];?>
					<?endif;?>
				<?endif;?>
			</div>
		<?endif;?>

		<?if(count($arResult['GALLERY_BIG'])):?>
			<div class="drag_block n_<?=$number;?> <?=$value;?>">
				<div class="wraps gallerys">
				<hr/>
				<h5><?=($arParams["T_GALLERY"] ? $arParams["T_GALLERY"] : Loc::getMessage("T_GALLERY"));?></h5>
				<div class="gallery-block">
					<div class="gallery-wrapper">
						<div class="inner">
							<?if(count($arResult['GALLERY_BIG']) > 1):?>
								<div class="small-gallery-wrapper">
									<div class="thmb1 flexslider unstyled small-gallery rounded-nav" data-plugin-options='{"slideshow": "false", "animation": "slide", "animationLoop": true, "itemWidth": 60, "itemMargin": 20, "minItems": 1, "maxItems": 9, "slide_counts": 1, "asNavFor": ".gallery-wrapper .bigs"}' id="carousel1">
										<ul class="slides items">
											<?foreach($arResult['GALLERY_BIG'] as $arPhoto):?>
												<li class="item">
													<img class="img-responsive inline" src="<?=$arPhoto["THUMB"]["src"]?>" title="<?=$arPhoto['TITLE']?>" alt="<?=$arPhoto['ALT']?>" />
												</li>
											<?endforeach;?>
										</ul>
									</div>
								</div>
							<?endif;?>
							<div class="thmb1 flexslider unstyled row bigs color-controls" id="slider" data-plugin-options='{"animation": "slide", "directionNav": true, "controlNav" :true, "animationLoop": true, "slideshow": false, "sync": ".gallery-wrapper .small-gallery", "counts": [1, 1, 1]}'>
								<ul class="slides items">
									<?foreach($arResult['GALLERY_BIG'] as $i => $arPhoto):?>
										<li class="col-md-12 item">
											<a href="<?=$arPhoto['DETAIL']['SRC']?>" class="fancybox" data-fancybox-group="gallery" target="_blank" title="<?=$arPhoto['TITLE']?>">
												<img src="<?=$arPhoto['PREVIEW']['src']?>" class="img-responsive inline" title="<?=$arPhoto['TITLE']?>" alt="<?=$arPhoto['ALT']?>" />
												<span class="zoom"></span>
											</a>
										</li>
									<?endforeach;?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				</div>
			</div>
		<?endif;?>

		<?if($arResult['DISPLAY_PROPERTIES']['PHOTOLINK']['VALUE']){
			$link = explode('//', $arResult['DISPLAY_PROPERTIES']['PHOTOLINK']['VALUE']);
			echo Loc::getMessage('T_LINK')?> <a href="<?= $arResult['DISPLAY_PROPERTIES']['PHOTOLINK']['VALUE']?>"><?= $link[1]?></a>
		<?}?>
<?/*


<div class="news-detail">
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		<img
			class="detail_picture"
			border="0"
			src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
			width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
			height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
			alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
			title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
			/>
	<?endif?>
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
	<?endif;?>
	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		<h3><?=$arResult["NAME"]?></h3>
	<?endif;?>
	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
		<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
	<?endif;?>
	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
	<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
		<?echo $arResult["DETAIL_TEXT"];?>
	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>
	<div style="clear:both"></div>
	<br />
	<?foreach($arResult["FIELDS"] as $code=>$value):
		if ('PREVIEW_PICTURE' == $code || 'DETAIL_PICTURE' == $code)
		{
			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?
			if (!empty($value) && is_array($value))
			{
				?><img border="0" src="<?=$value["SRC"]?>" width="<?=$value["WIDTH"]?>" height="<?=$value["HEIGHT"]?>"><?
			}
		}
		else
		{
			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?><?
		}
		?><br />
	<?endforeach;
	foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

		<?=$arProperty["NAME"]?>:&nbsp;
		<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
			<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
		<?else:?>
			<?=$arProperty["DISPLAY_VALUE"];?>
		<?endif?>
		<br />
	<?endforeach;
	if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
	{
		?>
		<div class="news-detail-share">
			<noindex>
			<?
			$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
					"HANDLERS" => $arParams["SHARE_HANDLERS"],
					"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
					"PAGE_TITLE" => $arResult["~NAME"],
					"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
					"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
					"HIDE" => $arParams["SHARE_HIDE"],
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);
			?>
			</noindex>
		</div>
		<?
	}
	?>
</div>