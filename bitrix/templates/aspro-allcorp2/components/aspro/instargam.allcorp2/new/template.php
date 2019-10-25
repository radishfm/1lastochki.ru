<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */

$this->setFrameMode(true);
class InstagramSimonov{
	const URL_INSTAGRAM_API = 'https://graph.instagram.com/';

	private $access_token = 0;
	public $token_params = 0;
	public $error = "";
	public $App = "";

	public function __construct($token){
		global $APPLICATION;
		$this->token_params = $token;
		$this->App=$APPLICATION;
	}

	public function checkApiToken(){
		if(!strlen($this->token_params)){
			$this->error="No API token instagram";
		}
		$this->access_token='access_token='.$this->token_params;
	}

	public function getFormatResult($method){
		if(function_exists('curl_init'))
		{
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, self::URL_INSTAGRAM_API.$method.$this->access_token);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
			$out = curl_exec($curl);
			$data =  $out ? $out : curl_error($curl);
		}
		else
		{
			$data = file_get_contents(self::URL_INSTAGRAM_API.$method.$this->access_token);
		}

		$data = json_decode($data, true);
		$data = $this->App->ConvertCharsetArray($data, 'UTF-8', LANG_CHARSET);

		return $data;
	}

	public function getInstagramPosts(){
		$this->checkApiToken();

		if($this->error){
			return $this->error;
		}else{
			$data=$this->getFormatResult('me/media?fields=id,caption,media_type,media_url,username,timestamp&');
		}

		return $data;
	}

	public function getInstagramUser(){
		$this->checkApiToken();

		if($this->error){
			return $this->error;
		}else{
			$data=$this->getFormatResult('me?fields=id,username&');
		}

		return $data;
	}
}

if(isset($_POST["AJAX_REQUEST_INSTAGRAM"]) && $_POST["AJAX_REQUEST_INSTAGRAM"] == "Y"):
	$inst=new InstagramSimonov($arParams["TOKEN"]);
	$arInstagramPosts=$inst->getInstagramPosts();
	$arInstagramUser=$inst->getInstagramUser();
	//echo '<pre>'; print_r($arInstagramPosts); echo '</pre>';

	if($arInstagramPosts['data'] /*&& !$arInstagramPosts["meta"]["error_message"]*/):?>
		<div class="item-views front blocks">
			<h3 class="text-center"><?=($arParams["TITLE"] ? $arParams["TITLE"] : GetMessage("TITLE"));?></h3>
			<div class="instagram clearfix">
				<div class="container">
					<?$index = 0;?>
					<div class="items row flexbox">
						<div class="item user">
							<div class="body2">
								<div class="title"><h4><?=GetMessage('INSTAGRAM_TITLE');?></h4></div>
								<div class="description"><?=GetMessage('INSTAGRAM_DESCRIPTION');?></div>
								<div class="link"><a href="https://www.instagram.com/<?=$arInstagramUser['username']?>/" target="_blank"><?=$arInstagramUser['username']?></a></div>
							</div>
						</div>
						<?foreach ($arInstagramPosts['data'] as $arItem):?>
							<div class="item">
								<div class="image shine" style="background:url(<?=$arItem['media_url'];?>) center center/cover no-repeat;"><a href="<?=$arItem['permalink']?>" target="_blank" title="<?=$arItem['caption'];?>"></a></div>
							</div>
							<?if ($index == 3) break;?>
							<?++$index;?>
						<?endforeach;?>
					</div>
				</div>
			</div>
		</div>
	<?endif;?>
<?else:?>
	<div class="row margin0">
		<div class="maxwidth-theme">
			<div class="col-md-12">
				<div class="instagram_ajax loader_circle"></div>
			</div>
		</div>
	</div>
<?endif;?>