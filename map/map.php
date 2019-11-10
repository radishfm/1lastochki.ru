<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Карта экспедиций");?><?$APPLICATION->IncludeComponent(
	"34web:s34web.yandex.branches",
	".default",
	Array(
		"COMPONENT_TEMPLATE" => ".default",
		"CURRENT_CITY" => "93",
		"IBLOCK_ID" => "40",
		"IBLOCK_TYPE" => "aspro_allcorp2_content",
		"MAIN_COLOUR" => "#010EC8",
		"SECOND_COLOUR" => "#FFF",
		"THIRD_COLOUR" => "#070C54"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>