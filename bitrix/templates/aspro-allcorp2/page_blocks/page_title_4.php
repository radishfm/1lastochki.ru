<div class="page-top-wrapper color v3">
	<section class="page-top maxwidth-theme <?CAllcorp2::ShowPageProps('TITLE_CLASS');?>">	
		<div class="row">
			<div class="col-md-12">
				<h1 id="pagetitle"><?$APPLICATION->ShowTitle(false)?></h1>
				<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "corp", array(
					"START_FROM" => "0",
					"PATH" => "",
					"SITE_ID" => SITE_ID
					),
					false
				);?>				
			</div>
		</div>
	</section>
</div>