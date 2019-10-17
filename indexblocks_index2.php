<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?global $arMainPageOrder; //global array for order blocks?>
<?global $arTheme;?>
<?if($arMainPageOrder && is_array($arMainPageOrder)):?>
	<?foreach($arMainPageOrder as $key => $optionCode):?>
			<?//BIG_BANNER_INDEX?>
			<?if($optionCode == "BIG_BANNER_INDEX"):?>
				<?global $bBigBannersIndex, $bBigBannersIndexClass;?>
				<?if($bBigBannersIndex):?>
					<div class="drag-block container <?=$optionCode?> <?=$bBigBannersIndexClass;?>" data-class="<?=$optionCode?>_drag" data-order="<?=++$key;?>">
						<div class="row margin0">
							<?$APPLICATION->IncludeComponent(
								"bitrix:news.list", 
								"front-banners-big-short",
								array(
									"IBLOCK_TYPE" => "aspro_allcorp2_adv",
									"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_allcorp2_adv"]["aspro_allcorp2_advtbig"][0],
									"NEWS_COUNT" => "30",
									"SORT_BY1" => "SORT",
									"SORT_ORDER1" => "ASC",
									"SORT_BY2" => "ID",
									"SORT_ORDER2" => "ASC",
									"FILTER_NAME" => "",
									"FIELD_CODE" => array(
										0 => "NAME",
										1 => "PREVIEW_TEXT",
										2 => "PREVIEW_PICTURE",
										3 => "DETAIL_PICTURE",
										4 => "",
									),
									"PROPERTY_CODE" => array(
										0 => "",
										1 => "BANNERTYPE",
										2 => "TEXTCOLOR",
										3 => "LINKIMG",
										4 => "BUTTON1TEXT",
										5 => "BUTTON1CLASS",
										6 => "BUTTON2TEXT",
										7 => "BUTTON2LINK",
										8 => "",
									),
									"CHECK_DATES" => "Y",
									"DETAIL_URL" => "",
									"AJAX_MODE" => "N",
									"AJAX_OPTION_JUMP" => "N",
									"AJAX_OPTION_STYLE" => "Y",
									"AJAX_OPTION_HISTORY" => "N",
									"CACHE_TYPE" => "A",
									"CACHE_TIME" => "3600000",
									"CACHE_FILTER" => "Y",
									"CACHE_GROUPS" => "N",
									"PREVIEW_TRUNCATE_LEN" => "",
									"ACTIVE_DATE_FORMAT" => "d.m.Y",
									"SET_TITLE" => "N",
									"SET_STATUS_404" => "N",
									"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
									"ADD_SECTIONS_CHAIN" => "N",
									"HIDE_LINK_WHEN_NO_DETAIL" => "N",
									"PARENT_SECTION" => "",
									"PARENT_SECTION_CODE" => "",
									"INCLUDE_SUBSECTIONS" => "N",
									"PAGER_TEMPLATE" => ".default",
									"DISPLAY_TOP_PAGER" => "N",
									"DISPLAY_BOTTOM_PAGER" => "N",
									"PAGER_TITLE" => "Новости",
									"PAGER_SHOW_ALWAYS" => "N",
									"PAGER_DESC_NUMBERING" => "N",
									"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600000",
									"PAGER_SHOW_ALL" => "N",
									"AJAX_OPTION_ADDITIONAL" => "",
									"COMPONENT_TEMPLATE" => "front-banners-big-short_mix",
									"IBLOCK_SMALL_BANNERS_TYPE" => "aspro_allcorp2_adv",
									"IBLOCK_SMALL_BANNERS_ID" => CCache::$arIBlocks[SITE_ID]["aspro_allcorp2_adv"]["aspro_allcorp2_smbanners"][0],
									"SET_BROWSER_TITLE" => "Y",
									"SET_META_KEYWORDS" => "Y",
									"SET_META_DESCRIPTION" => "Y",
									"SET_LAST_MODIFIED" => "N",
									"STRICT_SECTION_CHECK" => "N",
									"PAGER_BASE_LINK_ENABLE" => "N",
									"SHOW_404" => "N",
									"MESSAGE_404" => ""
								),
								false
							);?>
						</div>
					</div>
				<?endif;?>
			<?endif;?>
			<?//TEASERS_INDEX?>
			<?if($optionCode == "TEASERS_INDEX"):?>
				<?global $bTeasersIndex, $bTeasersIndexClass;?>
				<?if($bTeasersIndex):?>
					<div class="drag-block container <?=$optionCode?> <?=$bTeasersIndexClass;?>" data-class="<?=$optionCode?>_drag" data-order="<?=++$key;?>">
						<div class="row margin0">
							<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"tizers2", 
	array(
		"IBLOCK_TYPE" => "aspro_allcorp2_content",
		"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_allcorp2_content"]["aspro_allcorp2_front_tizers"][0],
		"NEWS_COUNT" => "5",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "ID",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arFrontFilter",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "PREVIEW_PICTURE",
			3 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "LINK",
			2 => "TYPE",
			3 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "j F Y",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "N",
		"PAGER_TEMPLATE" => "main",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600000",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"COMPONENT_TEMPLATE" => "tizers2",
		"SET_LAST_MODIFIED" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);?>
						</div>
					</div>
				<?endif;?>
			<?endif;?>
			<?//FLOAT_BANNERS_INDEX?>
			<?if($optionCode == "FLOAT_BANNERS_INDEX"):?>
				<?global $bFloatBannersIndex, $bFloatBannersIndexClass;?>
				<?if($bFloatBannersIndex):?>
					<div class="drag-block container <?=$optionCode?> <?=$bFloatBannersIndexClass;?>" data-class="<?=$optionCode?>_drag" data-order="<?=++$key;?>">
						<div class="row margin0 greyline">
							<?=CAllcorp2::ShowPageType('mainpage', 'floatbanners_'.$arTheme['TEMPLATE_PARAMS'][$arTheme['INDEX_TYPE']['VALUE']][$arTheme['INDEX_TYPE']['VALUE'].'_'.$optionCode.'_TEMPLATE']['VALUE']);?>
						</div>
					</div>
				<?endif;?>
			<?endif;?>
			<?//PORTFOLIO_INDEX?>
			<?if($optionCode == "PORTFOLIO_INDEX"):?>
				<?global $bPortfolioIndex, $bPortfolioIndexClass;?>
				<?if($bPortfolioIndex):?>
					<div class="drag-block container <?=$optionCode?> <?=$bPortfolioIndexClass;?>" data-class="<?=$optionCode?>_drag" data-order="<?=++$key;?>">
						<?=CAllcorp2::ShowPageType('mainpage', 'portfolio_'.$arTheme['TEMPLATE_PARAMS'][$arTheme['INDEX_TYPE']['VALUE']][$arTheme['INDEX_TYPE']['VALUE'].'_'.$optionCode.'_TEMPLATE']['VALUE']);?>
					</div>
				<?endif;?>
			<?endif;?>
			<?//CATALOG_SECTIONS_INDEX?>
			<?if($optionCode == "CATALOG_SECTIONS_INDEX"):?>
				<?global $bCatalogSectionsIndex, $bCatalogSectionsIndexClass;?>
				<?if($bCatalogSectionsIndex):?>
					<div class="drag-block container <?=$optionCode?> <?=$bCatalogSectionsIndexClass;?>" data-class="<?=$optionCode?>_drag" data-order="<?=++$key;?>">
						<?$APPLICATION->IncludeComponent(
	"aspro:catalog.section.list.allcorp2", 
	"front_sections_with_childs", 
	array(
		"IBLOCK_TYPE" => "aspro_allcorp2_catalog",
		"IBLOCK_ID" => "37",
		"CACHE_TYPE" => "A",
		"SECTION_COUNT" => "6",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"COUNT_ELEMENTS" => "N",
		"FILTER_NAME" => "arrPopularSections",
		"TOP_DEPTH" => "",
		"SECTION_URL" => "",
		"VIEW_MODE" => "",
		"SHOW_PARENT_NAME" => "N",
		"HIDE_SECTION_NAME" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"SHOW_SECTIONS_LIST_PREVIEW" => "N",
		"SECTIONS_LIST_PREVIEW_PROPERTY" => "N",
		"SECTIONS_LIST_PREVIEW_DESCRIPTION" => "N",
		"SHOW_SECTION_LIST_PICTURES" => "N",
		"DISPLAY_PANEL" => "N",
		"COMPONENT_TEMPLATE" => "front_sections_with_childs",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_USER_FIELDS" => array(
			0 => "UF_TOP_SEO",
			1 => "",
		),
		"TITLE" => "Каталог товаров",
		"RIGHT_TITLE" => "Весь каталог",
		"RIGHT_LINK" => "product/"
	),
	false
);?>
					</div>
				<?endif;?>
			<?endif;?>
			<?//CATALOG_INDEX?>
			<?if($optionCode == "CATALOG_INDEX"):?>
				<?global $bCatalogIndexClass;?>
				<div class="drag-block container <?=$optionCode?> <?=$bCatalogIndexClass;?>" data-class="<?=$optionCode?>_drag" data-order="<?=++$key;?>">
					<?$APPLICATION->IncludeComponent(
						"aspro:tabs.allcorp2", 
						"main", 
						array(
							"CACHE_FILTER" => "Y",
							"CACHE_GROUPS" => "N",
							"CACHE_TIME" => "36000000",
							"CACHE_TYPE" => "A",
							"COMPOSITE_FRAME_MODE" => "A",
							"COMPOSITE_FRAME_TYPE" => "AUTO",
							"DETAIL_URL" => "",
							"FILTER_NAME" => "arFilterCatalog",
							"HIT_PROP" => "HIT",
							"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_allcorp2_catalog"]["aspro_allcorp2_catalog"][0],
							"IBLOCK_TYPE" => "aspro_allcorp2_catalog",
							"NEWS_COUNT" => "20",
							"PARENT_SECTION" => "",
							"PROPERTY_CODE" => array(
								0 => "FORM_ORDER",
								1 => "SHOW_ON_INDEX_PAGE",
								2 => "PRICE",
								3 => "PRICEOLD",
								4 => "STATUS",
								5 => "ARTICLE",
								6 => "AGE",
								7 => "KARTOPR",
								8 => "HEIGHT",
								9 => "DEPTH",
								10 => "DEEP",
								11 => "GRUZ",
								12 => "GRUZ_STRELI",
								13 => "DLINA_STRELI",
								14 => "DLINA",
								15 => "CATEGORY",
								16 => "CLASS",
								17 => "KOL_FORMULA",
								18 => "USERS",
								19 => "EXTENSION",
								20 => "MARK_STEEL",
								21 => "MASS",
								22 => "MODEL",
								23 => "POWER",
								24 => "UPDATES",
								25 => "VOLUME",
								26 => "PROIZVODSTVO",
								27 => "SIZE",
								28 => "PLACE",
								29 => "RECOMMEND",
								30 => "SERIES",
								31 => "SPEED",
								32 => "DURATION",
								33 => "TYPE_TUR",
								34 => "THICKNESS",
								35 => "MARK",
								36 => "HIT",
								37 => "FREQUENCY",
								38 => "WIDTH_PROHOD",
								39 => "WIDTH_PROEZD",
								40 => "WIDTH",
								41 => "LANGUAGES",
								42 => "BRAND",
								43 => "",
							),
							"SORT_BY1" => "SORT",
							"SORT_BY2" => "ID",
							"SORT_ORDER1" => "ASC",
							"SORT_ORDER2" => "ASC",
							"TITLE" => "Наши продукты",
							"COMPONENT_TEMPLATE" => "main",
							"SECTION_ID" => "",
							"SECTION_CODE" => "",
							"FIELD_CODE" => array(
								0 => "NAME",
								1 => "PREVIEW_PICTURE",
								2 => "DETAIL_PICTURE",
								3 => "",
							),
							"S_ORDER_PRODUCT" => "Заказать",
							"S_MORE_PRODUCT" => "Подробнее",
							"ELEMENTS_TABLE_TYPE_VIEW" => "FROM_MODULE",
							"SHOW_SECTION" => "Y",
							"COUNT_IN_LINE" => "4"
						),
						false
					);?>
				</div>
			<?endif;?>
			<?//PARTNERS_INDEX?>
			<?if($optionCode == "PARTNERS_INDEX"):?>
				<?global $bPartnersIndex, $bPartnersIndexClass;?>
				<?if($bPartnersIndex):?>
					<div class="drag-block container <?=$optionCode?> <?=$bPartnersIndexClass;?>" data-class="<?=$optionCode?>_drag" data-order="<?=++$key;?>">
						<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"front-partners", 
	array(
		"IBLOCK_TYPE" => "aspro_allcorp2_content",
		"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_allcorp2_content"]["aspro_allcorp2_partners"][0],
		"NEWS_COUNT" => "20",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "ID",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arFrontFilter",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_PICTURE",
			2 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "100000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"ITEM_IN_BLOCK" => "6",
		"SHOW_DETAIL_LINK" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"COMPONENT_TEMPLATE" => "front-partners",
		"SET_LAST_MODIFIED" => "N",
		"TITLE" => "",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"STRICT_SECTION_CHECK" => "N",
		"RIGHT_TITLE" => "",
		"RIGHT_LINK" => "company/partners/"
	),
	false
);?>
					</div>
				<?endif;?>
			<?endif;?>
			<?//INSTAGRAMM_INDEX?>
			<?if($optionCode == "INSTAGRAMM_INDEX"):?>
				<?global $bInstagrammIndexClass;?>
				<div class="drag-block container <?=$optionCode?> <?=$bInstagrammIndexClass;?>" data-class="<?=$optionCode?>_drag" data-order="<?=++$key;?>">
				<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
					array(
						"COMPONENT_TEMPLATE" => ".default",
						"PATH" => SITE_DIR."include/mainpage/comp_instagramm.php",
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "",
						"AREA_FILE_RECURSIVE" => "Y",
						"EDIT_TEMPLATE" => "include_area.php"
					),
					false
				);?>
			</div>
			<?endif;?>
			<?//NEWS_INDEX?>
			<?if($optionCode == "NEWS_INDEX"):?>
				<?global $bNewsIndex, $bNewsIndexClass;?>
				<?if($bNewsIndex):?>
					<div class="drag-block container <?=$optionCode?> <?=$bNewsIndexClass;?>" data-class="<?=$optionCode?>_drag" data-order="<?=++$key;?>">
						<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"front-news", 
	array(
		"IBLOCK_TYPE" => "aspro_allcorp2_content",
		"IBLOCK_ID" => "30",
		"NEWS_COUNT" => "4",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arFrontFilter",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "PREVIEW_PICTURE",
			3 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "PERIOD",
			1 => "REDIRECT",
			2 => "",
		),
		"CHECK_DATES" => "Y",
		"SHOW_SECTION" => "N",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "j F Y",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "N",
		"PAGER_TEMPLATE" => "main",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600000",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"TITLE" => "Новости",
		"RIGHT_TITLE" => "Все новости",
		"RIGHT_LINK" => "info/news/",
		"COMPONENT_TEMPLATE" => "front-news",
		"SET_LAST_MODIFIED" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"SHOW_DETAIL_LINK" => "Y",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"SHOW_DATE" => "Y",
		"COUNT_IN_LINE" => "4"
	),
	false
);?>
					</div>
				<?endif;?>
			<?endif;?>
			<?//MAP_INDEX?>
			<?if($optionCode == "MAP_INDEX"):?>
				<?global $bMapIndex, $bMapIndexClass;?>
				<?if($bMapIndex):?>
					<div class="drag-block container <?=$optionCode?> <?=$bMapIndexClass?>" data-class="<?=$optionCode?>_drag" data-order="<?=++$key;?>">
						<?Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("front-contacts-map");?>
						<?$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view", 
	"front_map", 
	array(
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:55.7289429754008;s:10:\"yandex_lon\";d:37.61089089256047;s:12:\"yandex_scale\";i:14;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:37.612693337019;s:3:\"LAT\";d:55.727562544985;s:4:\"TEXT\";s:7:\"Company\";}}}",
		"MAP_HEIGHT" => "500",
		"MAP_ID" => "",
		"MAP_WIDTH" => "100%",
		"CONTROLS" => array(
		),
		"OPTIONS" => array(
			0 => "ENABLE_DBLCLICK_ZOOM",
			1 => "ENABLE_DRAGGING",
		),
		"COMPONENT_TEMPLATE" => "front_map"
	),
	false
);?>
						<?Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("front-contacts-map", "");?>
					</div>
				<?endif;?>
			<?endif;?>
			<?//REVIEWS_INDEX?>
			<?if($optionCode == "REVIEWS_INDEX"):?>
				<?global $bReviewsIndex, $bReviewsIndexClass;?>
				<?if($bReviewsIndex):?>
					<div class="drag-block container <?=$optionCode?> <?=$bReviewsIndexClass;?>" data-class="<?=$optionCode?>_drag" data-order="<?=++$key;?>">
						<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"front-reviews", 
	array(
		"IBLOCK_TYPE" => "aspro_allcorp2_content",
		"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_allcorp2_content"]["aspro_allcorp2_reviews"][0],
		"NEWS_COUNT" => "5",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "ID",
		"SORT_ORDER2" => "DESC",
		"FILTER_NAME" => "arFrontFilter",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "PREVIEW_PICTURE",
			3 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "POST",
			1 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "230",
		"ACTIVE_DATE_FORMAT" => "j F Y",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "N",
		"PAGER_TEMPLATE" => "main",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600000",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"TITLE" => "Отзывы клиентов",
		"RIGHT_TITLE" => "Все отзывы",
		"RIGHT_LINK" => "company/reviews/",
		"COMPONENT_TEMPLATE" => "front-reviews",
		"SET_LAST_MODIFIED" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"SHOW_DETAIL_LINK" => "Y",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"SHOW_DATE" => "N",
		"COUNT_IN_LINE" => "4",
		"SHOW_SECTIONS" => "Y"
	),
	false
);?>
					</div>
				<?endif;?>
			<?endif;?>
			<?//COMPANY_INDEX?>
			<?if($optionCode == "COMPANY_INDEX"):?>
				<?global $bCompanyIndex, $bCompanyIndexClass;?>
				<?if($bCompanyIndex):?>
					<div class="drag-block container <?=$optionCode?> <?=$bCompanyIndexClass;?>" data-class="<?=$optionCode?>_drag" data-order="<?=++$key;?>">
						<div class="row">
							<div class="maxwidth-theme company-front flexbox">
								<?CAllcorp2::showCompanyFront();?>
							</div>
						</div>
					</div>
				<?endif;?>
			<?endif;?>
			<?//BLOG_INDEX?>
			<?if($optionCode == "BLOG_INDEX"):?>
				<?global $bBlogIndex, $bBlogIndexClass;?>
				<?if($bBlogIndex):?>
					<div class="drag-block container <?=$optionCode?> <?=$bBlogIndexClass;?>" data-class="<?=$optionCode?>_drag" data-order="<?=++$key;?>">
						<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"front-projects_1", 
	array(
		"IBLOCK_TYPE" => "aspro_allcorp2_content",
		"IBLOCK_ID" => "34",
		"NEWS_COUNT" => "5",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "ID",
		"SORT_ORDER2" => "DESC",
		"FILTER_NAME" => "arFrontFilter",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "PREVIEW_PICTURE",
			3 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "BIG_BLOCK",
			1 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "j F Y",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "N",
		"PAGER_TEMPLATE" => "main",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600000",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"TITLE" => "Статьи",
		"RIGHT_TITLE" => "Все статьи",
		"RIGHT_LINK" => "info/articles/",
		"COMPONENT_TEMPLATE" => "front-projects_1",
		"SET_LAST_MODIFIED" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"SHOW_DETAIL_LINK" => "Y",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"SHOW_DATE" => "Y",
		"COUNT_IN_LINE" => "4",
		"SHOW_SECTIONS" => "Y"
	),
	false
);?>
					</div>
				<?endif;?>
			<?endif;?>
	<?endforeach;?>
<?endif;?>