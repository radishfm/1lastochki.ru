<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?
global $arTheme;
use \Bitrix\Main\Localization\Loc;

$bOrderViewBasket = $arParams['ORDER_VIEW'];
$basketURL = (isset($arTheme['URL_BASKET_SECTION']) && strlen(trim($arTheme['URL_BASKET_SECTION']['VALUE'])) ? $arTheme['URL_BASKET_SECTION']['VALUE'] : SITE_DIR.'cart/');
$dataItem = ($bOrderViewBasket ? CAllcorp2::getDataItem($arResult) : false);

/*set array props for component_epilog*/
$templateData = array(
	'LINK_SALE' => $arResult['DISPLAY_PROPERTIES']['LINK_SALE']['VALUE'],
	'LINK_NEWS' => $arResult['DISPLAY_PROPERTIES']['LINK_NEWS']['VALUE'],
	'LINK_TIZERS' => $arResult['DISPLAY_PROPERTIES']['LINK_TIZERS']['VALUE'],
	'LINK_TARIF' => $arResult['DISPLAY_PROPERTIES']['LINK_TARIF']['VALUE'],
	'LINK_STAFF' => $arResult['DISPLAY_PROPERTIES']['LINK_STAFF']['VALUE'],
	'LINK_ARTICLES' => $arResult['DISPLAY_PROPERTIES']['LINK_ARTICLES']['VALUE'],
	'DOCUMENTS' => $arResult['DISPLAY_PROPERTIES']['DOCUMENTS']['VALUE'],
	'LINK_FAQ' => $arResult['DISPLAY_PROPERTIES']['LINK_FAQ']['VALUE'],
	'LINK_PROJECTS' => $arResult['DISPLAY_PROPERTIES']['LINK_PROJECTS']['VALUE'],
	'LINK_SERVICES' => $arResult['DISPLAY_PROPERTIES']['LINK_SERVICES']['VALUE'],
	'LINK_GOODS' => $arResult['DISPLAY_PROPERTIES']['LINK_GOODS']['VALUE'],
	'LINK_REVIEWS' => $arResult['DISPLAY_PROPERTIES']['LINK_REVIEWS']['VALUE'],
	'LINK_STUDY' => $arResult['DISPLAY_PROPERTIES']['LINK_STUDY']['VALUE'],
	'BRAND_ITEM' => $arResult['BRAND_ITEM'],
	'GALLERY_BIG' => $arResult['GALLERY_BIG'],
	'CHARACTERISTICS' => $arResult['CHARACTERISTICS'],
	'VIDEO' => $arResult['VIDEO'],
	'VIDEO_IFRAME' => $arResult['VIDEO_IFRAME'],
	'DETAIL_TEXT' => $arResult['FIELDS']['DETAIL_TEXT'],
	'ORDER' => $bOrderViewBasket,
);
if(isset($arResult['PROPERTIES']['BNR_TOP']) && $arResult['PROPERTIES']['BNR_TOP']['VALUE_XML_ID'] == 'YES')
	$templateData['SECTION_BNR_CONTENT'] = true;
/**/
?>

<?// show top banners start?>
<?$bShowTopBanner = (isset($templateData['SECTION_BNR_CONTENT'] ) && $templateData['SECTION_BNR_CONTENT'] == true);?>
<?if($bShowTopBanner):?>
	<?$this->SetViewTarget("section_bnr_content");?>
		<?CAllcorp2::ShowTopDetailBanner($arResult, $arParams);?>
	<?$this->EndViewTarget();?>
<?endif;?>
<?// show top banners end?>

<div class="item <?=($arResult['GALLERY'] ? '' : ' wg')?>" data-id="<?=$arResult['ID']?>"<?=($bOrderViewBasket ? ' data-item="'.$dataItem.'"' : '')?>>
	<?// element name?>
	<?if($arParams['DISPLAY_NAME'] != 'N' && strlen($arResult['NAME'])):?>
		<h2 itemprop="name"><?=$arResult['NAME']?></h2>
	<?endif;?>
	<div class="head<?=($arResult['GALLERY'] ? '' : ' wti')?>">
		<div class="row">
			<?if($arResult['GALLERY']):?>
				<div class="col-md-<?=(($arParams['NARROW'] == 'Y') ? 7 : 6);?> col-sm-6">
					<div class="row galery">
						<div class="inner zomm_wrapper-block">
							<?if($arResult['PROPERTIES']['HIT']['VALUE']):?>
								<div class="stickers">
									<div class="stickers-wrapper">
										<?foreach($arResult['PROPERTIES']['HIT']['VALUE_XML_ID'] as $key => $class):?>
											<div class="sticker_<?=strtolower($class);?>"><?=$arResult['PROPERTIES']['HIT']['VALUE'][$key]?></div>
										<?endforeach;?>
									</div>
								</div>
							<?endif;?>
							<?$countAll = count($arResult['GALLERY']);?>
							<div class="flexslider s_<?=($arResult['POPUP_VIDEO'] ? $countAll+1 : $countAll);?> color-controls dark-nav2 top-bigs" data-slice="Y" id="slider" data-plugin-options='{"animationLoop": true, "slideshow": false, "counts": [1, 1, 1]}'>
								<ul class="slides items">
									<?foreach($arResult['GALLERY'] as $i => $arPhoto):?>
										<li class="item" data-slice-block="Y" data-slide_key="<?=$i;?>" data-slice-params='{"lineheight": -3}'>
											<a href="<?=$arPhoto['DETAIL']['SRC']?>" target="_blank" title="<?=$arPhoto['TITLE']?>" class="fancybox" data-fancybox-group="gallery">
												<img src="<?=$arPhoto['PREVIEW']['src']?>" class="img-responsive inline" title="<?=$arPhoto['TITLE']?>" alt="<?=$arPhoto['ALT']?>" itemprop="image" />
												<span class="zoom"></span>
											</a>
										</li>
									<?endforeach;?>
								</ul>
							</div>
							<?if($countAll > 1 || $arResult['POPUP_VIDEO']):?>
								<div class="top-small-wrapper">
									<?$countThmb = $countAll;
									if($countThmb > 4)
										$countThmb = 4;?>
									<div class="top-small-wrapper2 s_<?=$countThmb;?><?=($arResult['POPUP_VIDEO'] ? 'v' : '');?>">
										<?if($countAll > 1):?>
											<div class="thmb flexslider bxSlider unstyled top-small" id="carousel2">
												<ul class="slides">
													<?foreach($arResult["GALLERY"] as $key => $arPhoto):?>
														<li class="" data-slide_key="<?=$key;?>">
															<img class="img-responsive inline" src="<?=$arPhoto["THUMB"]["src"]?>" title="<?=$arPhoto['TITLE']?>" alt="<?=$arPhoto['ALT']?>" />
														</li>
													<?endforeach;?>
												</ul>
											</div>
										<?endif;?>
										<?if($arResult['POPUP_VIDEO']):?>
											<div class="popup_video <?=($countAll > 4 ? 'fromtop' : '');?>"><a class="various video_link" href="<?=$arResult['POPUP_VIDEO'];?>"><?=GetMessage("VIDEO")?></a></div>
										<?endif;?>
									</div>
								</div>
								<script type="text/javascript">
									$(document).ready(function(){
										$('.bxSlider.top-small .slides').bxSlider({
											mode: 'vertical',
											// infiniteLoop: false,
											minSlides: 4,
											maxSlides: 4,
											slideMargin: 10,
											pager: false,
											oneToOneTouch: false,
											moveSlides: <?=($countAll > 4 ? 1 : 0);?>,
											preventDefaultSwipeY: true,
											onSliderLoad: function(index)
											{
												$('.detail .galery .top-small-wrapper li[data-slide_key="0"]').addClass('flex-active-slide');
											}
										})
									})
								</script>
							<?endif;?>
						</div>
					</div>
				</div>
			<?endif;?>
			
			<div class="<?=($arResult['GALLERY'] ? 'col-md-'.(($arParams['NARROW'] == 'Y') ? 5 : 6).' col-sm-6' : 'col-md-12 col-sm-12');?>">
				<meta itemprop="name" content="<?=$arResult["NAME"];?>" />
				<div class="info" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
					<meta itemprop="url" content="<?=$arResult['DETAIL_PAGE_URL']?>">
					<?
					$frame = $this->createFrame('info')->begin('');
					$frame->setAnimation(true);
					?>
					<?if($arResult['DISPLAY_PROPERTIES']['STATUS']['VALUE_XML_ID'] || strlen($arResult['DISPLAY_PROPERTIES']['ARTICLE']['VALUE']) || $arResult['BRAND_ITEM']):?>
						<div class="hh">
							<?if(strlen($arResult['DISPLAY_PROPERTIES']['STATUS']['VALUE'])):?>
								<div><?=\Aspro\Functions\CAsproAllcorp2::showSchemaAvailabilityMeta($arResult['DISPLAY_PROPERTIES']['STATUS']['VALUE_XML_ID']);?><div class="status-icon <?=$arResult['DISPLAY_PROPERTIES']['STATUS']['VALUE_XML_ID']?>"><?=$arResult['DISPLAY_PROPERTIES']['STATUS']['VALUE']?></div></div>
							<?endif;?>
							<?if(strlen($arResult['DISPLAY_PROPERTIES']['ARTICLE']['VALUE'])):?>
								<div class="article">
									<?=Loc::getMessage('ARTICLE')?>&nbsp;<span><?=$arResult['DISPLAY_PROPERTIES']['ARTICLE']['VALUE']?></span>
								</div>
							<?endif;?>
							<?if($arResult['BRAND_ITEM']):?>
								<div class="brand">
									<?if(!$arResult["BRAND_ITEM"]["IMAGE"]):?>
										<a href="<?=$arResult["BRAND_ITEM"]["DETAIL_PAGE_URL"]?>"><?=$arResult["BRAND_ITEM"]["NAME"]?></a>
									<?else:?>
										<a class="brand_picture" href="<?=$arResult["BRAND_ITEM"]["DETAIL_PAGE_URL"]?>">
											<img  src="<?=$arResult["BRAND_ITEM"]["IMAGE"]["src"]?>" alt="<?=$arResult["BRAND_ITEM"]["NAME"]?>" title="<?=$arResult["BRAND_ITEM"]["NAME"]?>" />
										</a>
									<?endif;?>
								</div>
							<?endif;?>
						</div>
					<?endif;?>
					<?if($arParams['NARROW'] == 'Y'):?>
						<?if(strlen($arResult['FIELDS']['PREVIEW_TEXT']) && !$bShowTopBanner):?>
							<div class="previewtext" itemprop="description">
								<?// element detail text?>
								<?if($arResult['PREVIEW_TEXT_TYPE'] == 'text'):?>
									<p><?=$arResult['FIELDS']['PREVIEW_TEXT'];?></p>
								<?else:?>
									<?=$arResult['FIELDS']['PREVIEW_TEXT'];?>
								<?endif;?>
							</div>
							<?if(strlen($arResult['FIELDS']['DETAIL_TEXT'])):?>
								<div class="link-block-more">
									<span class="btn-inline sm desc"><?=Loc::getMessage('MORE_TEXT_BOTTOM');?></span>
								</div>
							<?endif;?>
						<?endif;?>
						<div class="bottom-wrapper">
							<div class="bottom-wrapper-inner">
								<?=\Aspro\Functions\CAsproAllcorp2::showPrice($arResult, $arParams, $bOrderViewBasket);?>
								<?if($arResult['DISPLAY_PROPERTIES']['FORM_ORDER']['VALUE_XML_ID'] == 'YES'):?>
									<?=\Aspro\Functions\CAsproAllcorp2::showBasketButton($arResult, $arParams, $bOrderButton, $bOrderViewBasket, $basketURL, true);?>
								<?else:?>
									<?if($arResult['PROPERTIES']['LINK_TARIF']['VALUE']):?>
										<div class="wrapper-block-btn">
											<div class="wrapper">
												<span class="btn btn-default choise" data-block=".tarif-link"><?=(strlen($arParams['S_CHOISE_PRODUCT']) ? $arParams['S_CHOISE_PRODUCT'] : Loc::getMessage('S_CHOISE_PRODUCT'))?></span>
											</div>
									<?endif;?>

									<?// ask question?>
									<?if($arResult['DISPLAY_PROPERTIES']['FORM_QUESTION']['VALUE_XML_ID'] == 'YES'):?>
										<div class="wrapper">
											<span class="btn btn-default btn-transparent-bg animate-load  wide-block" data-event="jqm" data-param-id="<?=CAllcorp2::getFormID("aspro_allcorp2_question");?>" data-autoload-need_product="<?=CAllcorp2::formatJsName($arResult['NAME'])?>" data-name="question"><span><?=(strlen($arParams['S_ASK_QUESTION']) ? $arParams['S_ASK_QUESTION'] : Loc::getMessage('S_ASK_QUESTION'))?></span></span>
										</div>
									<?endif;?>

									<?if($arResult['PROPERTIES']['LINK_TARIF']['VALUE']):?>
										</div>
									<?endif;?>
								<?endif;?>
								<div class="garanty-block <?=($arResult['INCLUDE_CONTENT'] ? 'filed' : '');?>">
									<?if($arResult['INCLUDE_CONTENT']):?>
										<?if($arResult['CONTENT_FROM_DYNAMIC']):?>
											<?=$arResult['INCLUDE_CONTENT'];?>
										<?else:?>
											<?$APPLICATION->IncludeComponent(
												"bitrix:main.include",
												"",
												Array(
													"AREA_FILE_SHOW" => "page",
													"AREA_FILE_SUFFIX" => "garanty",
													"EDIT_TEMPLATE" => ""
												)
											);?>
										<?endif;?>
									<?endif;?>
								</div>
							</div>
						</div>
					<?else:?>
						<div class="row">
							<?if($arResult['CHARACTERISTICS'] || strlen($arResult['FIELDS']['PREVIEW_TEXT'])):?>
								<div class="col-md-6">
									<?if(strlen($arResult['FIELDS']['PREVIEW_TEXT'])):?>
										<div class="previewtext" itemprop="description">
											<?// element detail text?>
											<?if($arResult['PREVIEW_TEXT_TYPE'] == 'text'):?>
												<p><?=$arResult['FIELDS']['PREVIEW_TEXT'];?></p>
											<?else:?>
												<?=$arResult['FIELDS']['PREVIEW_TEXT'];?>
											<?endif;?>
										</div>
										<?if(strlen($arResult['FIELDS']['DETAIL_TEXT'])):?>
											<div class="link-block-more">
												<span class="btn-inline sm desc"><?=Loc::getMessage('MORE_TEXT_BOTTOM');?></span>
											</div>
										<?endif;?>
									<?endif;?>
									<?if($arResult['CHARACTERISTICS']):?>
										<div class="char-block">
											<div class="titles_block"><?=($arParams["T_CHARACTERISTICS"] ? $arParams["T_CHARACTERISTICS"] : Loc::getMessage("T_CHARACTERISTICS"));?></div>
											<div class="chars">
												<div class="char-wrapp">
													<table class="props_table">
														<?$i = 0;
														$iCountChar = count($templateData['CHARACTERISTICS']);?>
														<?foreach($templateData['CHARACTERISTICS'] as $arProp):
															++$i;
															if($i > 3)
																continue;?>
															<tr class="char">
																<td class="char_name">
																	<?if($arProp['HINT']):?>
																		<div class="hint">
																			<span class="icons" data-toggle="tooltip" data-placement="top" title="<?=$arProp['HINT']?>"></span>
																		</div>
																	<?endif;?>
																	<span><?=$arProp['NAME']?></span>
																</td>
																<td class="char_value">
																	<span>
																		<?if(is_array($arProp['DISPLAY_VALUE'])):?>
																			<?foreach($arProp['DISPLAY_VALUE'] as $key => $value):?>
																				<?if($arProp['DISPLAY_VALUE'][$key + 1]):?>
																					<?=$value.'&nbsp;/ '?>
																				<?else:?>
																					<?=$value?>
																				<?endif;?>
																			<?endforeach;?>
																		<?else:?>
																			<?=$arProp['DISPLAY_VALUE']?>
																		<?endif;?>
																	</span>
																</td>
															</tr>
														<?endforeach;?>
													</table>
												</div>
											</div>
											<?if($iCountChar > 3):?>
												<div class="link-block-more">
													<span class="btn-inline sm char"><?=Loc::getMessage('MORE_CHAR_BOTTOM');?></span>
												</div>
											<?endif;?>
										</div>
									<?endif;?>
								</div>
								<div class="col-md-6">
							<?else:?>
								<div class="col-md-12">
							<?endif;?>
								<div class="bottom-wrapper">
									<div class="bottom-wrapper-inner">
										<?=\Aspro\Functions\CAsproAllcorp2::showPrice($arResult, $arParams, $bOrderViewBasket, true);?>
										<?if($arResult['DISPLAY_PROPERTIES']['FORM_ORDER']['VALUE_XML_ID'] == 'YES'):?>
											<?=\Aspro\Functions\CAsproAllcorp2::showBasketButton($arResult, $arParams, $bOrderButton, $bOrderViewBasket, $basketURL, true);?>
										<?else:?>
											<?if($arResult['PROPERTIES']['LINK_TARIF']['VALUE']):?>
												<div class="wrapper-block-btn">
													<div class="wrapper">
														<span class="btn btn-default choise" data-block=".tarif-link"><?=(strlen($arParams['S_CHOISE_PRODUCT']) ? $arParams['S_CHOISE_PRODUCT'] : Loc::getMessage('S_CHOISE_PRODUCT'))?></span>
													</div>
											<?endif;?>

											<?// ask question?>
											<?if($arResult['DISPLAY_PROPERTIES']['FORM_QUESTION']['VALUE_XML_ID'] == 'YES'):?>
												<div class="wrapper">
													<span class="btn btn-default btn-transparent-bg animate-load  wide-block" data-event="jqm" data-param-id="<?=CAllcorp2::getFormID("aspro_allcorp2_question");?>" data-autoload-need_product="<?=CAllcorp2::formatJsName($arResult['NAME'])?>" data-name="question"><span><?=(strlen($arParams['S_ASK_QUESTION']) ? $arParams['S_ASK_QUESTION'] : Loc::getMessage('S_ASK_QUESTION'))?></span></span>
												</div>
											<?endif;?>

											<?if($arResult['PROPERTIES']['LINK_TARIF']['VALUE']):?>
												</div>
											<?endif;?>
										<?endif;?>
									</div>
								</div>
							</div>
						</div>
					<?endif;?>
					
					<?// ask question?>
					<?if($arResult['PROPERTIES']['FORM_QUESTION_SIDE']['VALUE_XML_ID'] == 'Y'):?>
						<?$this->SetViewTarget('under_sidebar_content');?>
							<div class="ask_a_question">
								<div class="inner">
									<div class="text-block">
										<?=CAllcorp2::showIconSvg('ask colored', SITE_TEMPLATE_PATH.'/images/svg/Question_lg.svg');?>
										<?$APPLICATION->IncludeComponent(
											'bitrix:main.include',
											'',
											array(
												"AREA_FILE_SHOW" => "page",
												"AREA_FILE_SUFFIX" => "ask",
												"EDIT_TEMPLATE" => ""
											)
										);?>
									</div>
								</div>
								<div class="outer">
									<span><span class="btn btn-default btn-lg btn-transparent-bg animate-load" data-event="jqm" data-param-id="<?=CAllcorp2::getFormID("aspro_allcorp2_question");?>" data-autoload-need_product="<?=CAllcorp2::formatJsName($arResult['NAME'])?>" data-name="question"><span><?=(strlen($arParams['S_ASK_QUESTION']) ? $arParams['S_ASK_QUESTION'] : Loc::getMessage('S_ASK_QUESTION'))?></span></span></span>
								</div>
							</div>
						<?$this->EndViewTarget();?>
					<?endif;?>
					<?$frame->end();?>
				</div>
			</div>
		</div>
	</div>
</div>