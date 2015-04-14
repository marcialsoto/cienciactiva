<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.social2s
 *
 * @copyright   Copyright (C) 2005 - 2013 dibuxo.com All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * social2s plugin.
 *
 * @package     Joomla.Plugin
 * @subpackage  Content.social2s
 * @since       1.5
 */
class PlgContentSocial2s extends JPlugin
{
	/**
	 * Load the language file on instantiation.
	 *
	 * @var    boolean
	 * @since  3.1
	 */
	protected $autoloadLanguage = true;


	public function __construct(&$subject, $config)
    {
    	$params = json_decode($config['params']);
    	$display_view = $params->display_view;

        $view = JFactory::getApplication()->input->getWord('view');


        //both
        if($params->display_view == "0"){
        	if(($view != 'article') && ($view != 'category')){
	            return;
	        }
	    //category
        }elseif($params->display_view == "1"){
        	if($view != 'category'){
	            return;
	        }
        //article
        }else{
        	if($view != 'article'){
	            return;
	        }
        }

        parent::__construct($subject, $config);
        $this->loadLanguage();

        $jversion = new JVersion();
        if($jversion->RELEASE >= "3.0"){
	        JHtml::_('jquery.framework', true, true);
	    }
    }

//MAIN FUNCTION AFTER OR BEFORE

	public function onContentBeforeDisplay($context, &$row, &$params, $page=0){

		if($this->params->get('plg_pos') == 1 || $this->params->get('plg_pos') == 3){

			if(!$this->checkPages_v3($this->params,$row)) return;
			$html = $this->formatTmpl($this->params,$row);
			return $html;
		}
	}

	public function onContentAfterDisplay($context, &$row, &$params, $page=0){
		if($this->params->get('plg_pos') == 2 || $this->params->get('plg_pos') == 3){

			if(!$this->checkPages_v3($this->params,$row)) return;
				$html = $this->formatTmpl($this->params,$row);
				return $html;
		}
	}

/*
V2.0
	function onContentPrepare( $context, &$article, &$params, $page = 0){

		if($this->params->get('plg_trigger') == 0){
			return false;
		}

		if ( JString::strpos( $article->text, '{social2s}' ) === false ) {
			return false;
		}else{
			$article->text = JString::str_ireplace('{social2s}', $this->formatTmpl($this->params,$article, true), $article->text);
		}

		return true;

	}
*/

	public function formatTmpl(&$params,$article, $trigger = false){

		$jversion = new JVersion();
		$document = JFactory::getDocument();

		$buttons = $this->getButtons($params);
		$plugin_path = JURI::base().'plugins/content/social2s';
		$images_path = JURI::base().'plugins/content/social2s/assets/';

		if($params->get('load_jquery', '0') == 1){
			$document->addScript($plugin_path.'/js/jquery-1.11.2.min.js', 'text/javascript');
		}
		if($params->get('load_bootstrap', '0') == 1){
			$document->addStyleSheet($plugin_path.'/css/bootstrap.css', 'text/css');
		}

		$document->addScript($plugin_path.'/js/social2s.js', 'text/javascript');

		$show_text = $params->get('show_text', 1);
		$twitter_via = $params->get('twitter_via', '');
		$button_size = $params->get('s2s_size', 'btn');

/*TEMPLATES*/
		$load_base = $params->get('social2s_load_base', true);
		$load_style = $params->get('social2s_load_style', true);
		$style = $params->get('social2s_style', "-default-");

		if($load_base){
			$document->addStyleSheet($plugin_path.'/css/social2s_base.css', 'text/css');
		}
		if($load_style){

			$document->addStyleSheet($plugin_path.'/css/styles/'.$style.'.css', 'text/css');
		}

		/*carga fontawesome*/
		if($params->get('load_awesome', 0)){
			$document->addStyleSheet($plugin_path.'/css/font-awesome.min.css', 'text/css');
		}
/*LANGUAGE*/
		$idioma = $params->get('s2s_language', '0');
		// Twitter and Gplus
		if($idioma != '0'){
			$idioma_twitter = substr($idioma, 0, 2);
		}else{
			$idioma_twitter =  substr(str_replace('-', '_', JFactory::getLanguage()->getTag()),0, 2);
			$idioma = str_replace('-', '_', JFactory::getLanguage()->getTag());
		}
/*FIN LANGUAGE*/

/*LINKS*/
		//$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language));
		$view = JFactory::getApplication()->input->getWord('view');

		//both
		if($params->get('display_view') == "0"){

		//category
		}elseif($params->get('display_view') == "1"){

		//article
		}else{

		}

		$link = JRoute::_('index.php?view=article&id='.$article->id.'&catid='.$article->catid);
		$full_link = JURI::base().substr(JRoute::_('index.php?view=article&id='.$article->id.'&catid='.$article->catid), strlen(JURI::base(true)) + 1);

		$title = $article->title;

		/*carga texts*/
		$texts = $this->getTexts($show_text);
/*fin LINKS*/

/*cookies*/
		$checkCookie = $params->get('s2s_stupid_cookie_on', '0');
		$cookie_button = $this->getCookieButton($params);

		$alineamiento = $params->get('button_align', 'left');

		$insert = $params->get('s2s_insert', '0');
		$insert_position = $params->get('s2s_insert_position', '0');
		$insert_element = $params->get('s2s_insert_element', '');

/*module & plugin common*/

		$html = "";
		$html .= '<div class="s2s_options" style="display:none">';
			$html .= '<div class="s2s_insert">'.$insert.'</div>';
			$html .= '<div class="s2s_insert_position">'.$insert_position.'</div>';
			$html .= '<div class="s2s_insert_element">'.$insert_element.'</div>';
			$html .= '<div class="checkCookie">'.$checkCookie.'</div>';
		$html .= '</div>';


	$html .= '<div class="s2s_supra_contenedor" align="'.$alineamiento.'">';
		$html .= '<div class="s2s_contenedor';

		if($params->get('s2sgroup')){
			$html .= ' btn-group';
		}
		$html .= '">';

		/*TWITTER*/
		if($params->get('twitter_on')){

			$html .= '<div class="s2s_twitter btn btn-default '.$button_size.'">
					<a>'.$buttons['twitter'].'</a>
					<div class="globo s2s_twitter_iframe">'.$cookie_button.'
						<a style="display:none"
							href="https://twitter.com/share"
							data-text="'.$title.'"
							data-url="'.$full_link.'"
							class="twitter-share-button"
							data-via="'.$twitter_via.'"
							data-lang="'.$idioma_twitter.'"
							data-size="large"
							data-count="none">'.$texts['twitter'].'
						</a>
					</div>
				</div>';
		}
		/*FACEBOOK*/
		if($params->get('facebook_on')){
			$html .=   '<div class="s2s_facebook btn btn-default '.$button_size.'" lang="'.$idioma.'"><a>'.$buttons['facebook'].'</a>
							<div class="globo s2s_facebook_iframe">'.$cookie_button.'<div id="fb-root"></div>';
							/*test*/
								//$html .= '<div class="fb-like" data-href="http://www.dibuxo.com" data-width="450" data-show-faces="false" data-send="true"></div>';
							/*real*/
								$html .= '<div class="fb-like"
									data-layout="button"
									data-action="like"';
									//$html .= 'data-href="'.JURI::getInstance()->toString().'"';
									$html .= 'data-href="'.$full_link.'"';
									$html .= 'data-layout="button_count"
									data-width="450"
									data-show-faces="false"
									data-send="true"
									data-share="true">
								</div>';
							$html .= '</div>
						</div>';




		}
		/*PINTEREST*/
		if($params->get('pinterest_on')){
			$html .=   '<div class="s2s_pinterest btn btn-default '.$button_size.'"><a>'.$buttons['pinterest'].'</a>
							<div class="globo s2s_pinterest_iframe">'.$cookie_button.'
								<a href="//www.pinterest.com/pin/create/button/?url='.rawurlencode(JURI::getInstance()->toString()).'&amp;description='.rawurlencode($document->getTitle()).'" data-pin-do="buttonBookmark"  data-pin-color="white" data-pin-height="28"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_white_28.png" alt="Pinterest"/></a>
							</div>
						</div>';
		}
		/*LINKEDIN*/
		if($params->get('linkedin_on')){
			$html .=   '<div class="s2s_linkedin btn btn-default '.$button_size.'" lang="'.$idioma.'">

				<a>'.$buttons['linkedin'].'</a>
					<div class="globo s2s_linkedin_iframe">'.$cookie_button.'
						<script type="IN/Share" data-counter="right" data-url="'.$full_link.'"></script>
					</div>
				</div>';
		}
		/*GOOGLE PLUS*/
		if($params->get('gplus_on')){
			$html .=   '<div class="s2s_gplus btn btn-default '.$button_size.'" lang="'.$idioma_twitter.'"><a>'.$buttons['gplus'].'</a>
					<div class="globo s2s_gplus_iframe">'.$cookie_button.'
							<div class="s2s_gplus_one">
								<div class="g-plus" data-action="share" data-href="'.$full_link.'" data-annotation="bubble" data-height="24"></div>
							</div>
							<div class="s2s_gplus_one">
								<div class="g-plusone" size="tall" data-href="'.$full_link.'" count="true"></div>
							</div>
					</div>
				</div>
			';
		}
		/*TUMBLR*/
		if($params->get('tumblr_on')){
			$html .=   '<div class="s2s_tumblr btn btn-default '.$button_size.'" lang="'.$idioma_twitter.'"><a>'.$buttons['tumblr'].'</a>
					<div class="globo s2s_tumblr_iframe">'.$cookie_button;
						//$html .= '<a href="http://www.tumblr.com/share" title="Share on Tumblr">Share on Tumblr</a>';
						$html .= '<a class="tumblr-share-button" data-locale="'.$idioma.'" data-href="'.$full_link.'" data-color="blue" data-notes="right" href="https://embed.tumblr.com/share"></a>
					</div>
				</div>
			';
		}

		/*vk*/
		if($params->get('vk_on')){

		if(!defined('VK_SCRIPT')){
			$html .= '<script type="text/javascript" src="http://vkontakte.ru/js/api/share.js?9" charset="windows-1251"></script>';
			define('VK_SCRIPT', 'true');
		}


			$html .=   '<div class="s2s_vk btn btn-default '.$button_size.'" lang="'.$idioma_twitter.'"><a>'.$buttons['vk'].'</a>
					<div class="globo s2s_vk_iframe" id="s2s_vk_iframe">'.$cookie_button.'
						<script type="text/javascript">
							document.write(VK.Share.button("'.$full_link.'"));
						</script>
					</div>
				</div>
			';
		}

		/*OPENGRAPH*/
		if($params->get('opengraph')){

			//título
			$opengraph    = '<meta property="og:title" content="'.$article->title.'"/>' ."\n";

			//IMAGES
			$introimages = json_decode($article->images);
			$image = "";
			if($introimages->image_fulltext != ""){
				$image = $introimages->image_fulltext;
			}elseif($introimages->image_intro != ""){
				$image = $introimages->image_intro;
			}else{
				$domdoc = new DOMDocument();
				@$domdoc->loadHTML($article->introtext);
				$tags = $domdoc->getElementsByTagName('img');

				//preg_match_all('/<img[^>]+>/i',$article->introtext, $result);
				foreach ($tags as $tag) {
				    $image = $tag->getAttribute('src');
				    break;
				}
			}

			if($image != ""){
				$opengraph .= '<meta property="og:image" content="'.JURI::base().$image.'" />';
			}

			//URL
			$uri = JFactory::getURI();
			$absolute_url = $uri->toString();
			$opengraph .= '<meta property="og:url"  content="'. $absolute_url.'" />';
			$opengraph .= '<meta property="og:type"  content="website" />';
			//DESCRIPCION
			$descripcion = implode(' ', array_slice(explode(' ', strip_tags($article->introtext,'<br>')), 0, 70));
			$opengraph .= '<meta property="og:description" content="'.htmlspecialchars($descripcion).'..." />';

			//SITE NAME
			$config = JFactory::getConfig();
			$opengraph .= '<meta property="og:site_name" content="'.$config->get( 'sitename' ).'" />';
			$opengraph .= '<meta property="fb:admins" content="514279921989553" />';

			$document->addCustomTag($opengraph);
		}





		/*cierro contenedor*/
		$html .= '</div>';
	$html .= '</div>';




		return $html;
	}

	public function getButtons(&$params){

		/*params*/
		$button_style = $params->get('button_style', 0);
		$fontawesome_sign = $params->get('fontawesome_sign', 0);
		$show_text = $params->get('show_text', 1);
		$s2sgroup = $params->get('s2sgroup', 0);

		/*paths*/
		$images_path = JURI::base().'plugins/content/social2s/assets/';

		/*signs*/
		if($fontawesome_sign){
			$fontawesome_sign_value = '';
		}else{
			$fontawesome_sign_value = '';
		}

		$texts = $this->getTexts($show_text);

		$buttons = array();

		/*FONTAWESOME*/
		if($button_style == '1'){
			$buttons['twitter'] = '<i class="fa fa-twitter'.$fontawesome_sign_value.'">  '.$texts['twitter'].'</i>';

			$buttons['facebook'] = '<i class="fa fa-facebook'.$fontawesome_sign_value.'">  '.$texts['facebook'].'</i>';

			$buttons['pinterest'] = '<i class="fa fa-pinterest'.$fontawesome_sign_value.'">  '.$texts['pinterest'].'</i>';

			$buttons['linkedin'] = '<i class="fa fa-linkedin'.$fontawesome_sign_value.'">  '.$texts['linkedin'].'</i>';

			$buttons['gplus'] = '<i class="fa fa-google-plus'.$fontawesome_sign_value.'">  '.$texts['gplus'].'</i>';

			$buttons['tumblr'] = '<i class="fa fa-tumblr'.$fontawesome_sign_value.'">  '.$texts['tumblr'].'</i>';

			$buttons['vk'] = '<i class="fa fa-vk">  '.$texts['vk'].'</i>';

		/*IMAGES*/
		}else if($button_style == '2'){
			$buttons['twitter'] = '<img src="'.$images_path.'twitter.png" alt="twitter button"/>'.$texts['twitter'];

			$buttons['facebook'] = '<img src="'.$images_path.'facebook.png" alt="facebook button"/>'.$texts['facebook'];

			$buttons['pinterest'] = '<img src="'.$images_path.'pinterest.png" alt="pinterest button"/>'.$texts['pinterest'];

			$buttons['linkedin'] = '<img src="'.$images_path.'linkedin.png" alt="linkedin button" />'.$texts['linkedin'];

			$buttons['gplus'] = '<img src="'.$images_path.'gplus.png" alt="gplus button"/>'.$texts['gplus'];

			$buttons['tumblr'] = '<img src="'.$images_path.'tumblr.png" alt="tumblr button"/>'.$texts['tumblr'];

			$buttons['vk'] = '<img src="'.$images_path.'vk.png" alt="vk button"/>'.$texts['vk'];
		}else{
			/*default*/
			$buttons['twitter'] = $texts['twitter'];
			$buttons['facebook'] = $texts['facebook'];
			$buttons['pinterest'] = $texts['pinterest'];
			$buttons['linkedin'] = $texts['linkedin'];
			$buttons['gplus'] = $texts['gplus'];
			$buttons['tumblr'] = $texts['tumblr'];
			$buttons['vk'] = $texts['vk'];
		}

		return $buttons;
	}

	public function getTexts(&$show_text){
		$texts = array();

		if($show_text){
			$texts['twitter'] = JText::_('SOCIAL2S_TWITTER');
			$texts['facebook'] = JText::_('SOCIAL2S_FACEBOOK');
			$texts['pinterest'] = JText::_('SOCIAL2S_PINTEREST');
			$texts['linkedin'] = JText::_('SOCIAL2S_LINKEDIN');
			$texts['gplus'] = JText::_('SOCIAL2S_GPLUS');
			$texts['tumblr'] = JText::_('SOCIAL2S_TUMBLR');
			$texts['vk'] = JText::_('SOCIAL2S_VK');
		}else{
			$texts['twitter'] = "";
			$texts['facebook'] = "";
			$texts['pinterest']= "";
			$texts['linkedin'] = "";
			$texts['gplus'] = "";
			$texts['tumblr'] = "";
			$texts['vk']  = "";
		}
		return $texts;
	}

	public function getCookieButton($params){
			/*cookie*/
		$checkCookie = $params->get('s2s_stupid_cookie_on', '0');
		$cookieLink = $params->get('s2s_stupid_cookie_link', '0');
		$ccm_support = $params->get('s2s_stupid_cookie_ccm_support', '0');
		/*paths*/
		$images_path = JURI::base().'plugins/content/social2s/assets/';

		/* Find article alias and catid */
		$db = JFactory::getDBO();
		$sql = 'select alias, catid from #__content where id=' . $cookieLink;
		$db->setQuery($sql);
		$row = $db->loadAssoc();
		$alias = $row['alias'];
		$catid = $row['catid'];

		$cookieLink_url = ContentHelperRoute::getArticleRoute($cookieLink.':'.$alias, $catid);

		$muestra_cookies = false;
		if($checkCookie == "1"){

			if($ccm_support == "1"){

				if(!isset($_COOKIE['ccm_cookies_accepted']) || $_COOKIE['ccm_cookies_accepted'] == null || $_COOKIE['ccm_cookies_accepted'] == "no"){

					if(!isset($_COOKIE['s2s_cookie']) || $_COOKIE['s2s_cookie'] == null || $_COOKIE['s2s_cookie'] != "1"){
						$muestra_cookies = true;
					}
				}
			}else{

					if(!isset($_COOKIE['s2s_cookie']) || $_COOKIE['s2s_cookie'] == null || $_COOKIE['s2s_cookie'] != "1"){
						$muestra_cookies = true;
					}
			}
		}

		if($muestra_cookies){
			$cookie_button = '<aside class="s2s_cookie_contenedor">
							<span>'.JText::_('SOCIAL2S_COOKIES_PERMISSION').'</span>
							<a class="s2s_cookie_button btn btn-success">'.JText::_('SOCIAL2S_COOKIES_ACCEPT').'</a>
							<a class="s2s_cookie_information"><span class="fa fa-info-circle">'.JText::_('SOCIAL2S_COOKIES_INFO').'</span></a>
							<div class="s2s_cookie_more_info">
								<p>
									<img class="s2s_cookie_eulogo" src="'.$images_path.'social2s.svg" width="32" height="32" alt="dibuxo social2s ue cookies"/>
									'.JText::_('SOCIAL2S_COOKIES_MORE_INFO').'
								</p>
								<p class="s2s_cookie_read_policy">'.JText::_('SOCIAL2S_COOKIES_READ_POLICY').' <a href="'.$cookieLink_url.'">'.JText::_('SOCIAL2S_COOKIES_COOKIES_POLICY').'</a></p>
								<p class="s2s_cookie_copyright"><a href="http://store.dibuxo.com" target="_blank">About Social2s</a></p>
							</div>
						</aside>';
		}else{
			$cookie_button = '';
		}


		return $cookie_button;
	}


/*JUST PLUGIN*/
	public function checkPages_v3($pluginParams, $row) {

		$category_id_v3 = $row->catid;
		$article_id_v3 = $row->id;

		$exists = (boolean)false;

		//In/ex categories
		$catids = $pluginParams->get('categories','');
		$cat_exc_inc = $pluginParams->get('cat_inc_exc','ex');

		if(gettype($catids)=="string") $catids = array("-1");

		if($cat_exc_inc=="in" && !$exists){
			//INclude
			if (is_array($catids)) {
				$exists = (in_array($category_id_v3,$catids)) ? true:false;
			}
			//all selected
			if($catids[0]=="0") $exists = true;

		}else if($cat_exc_inc=="ex" && !$exists){
			//INclude
			if (is_array($catids)) {
				$exists = (in_array($category_id_v3,$catids)) ? false:true;
			}
			//all selected
			if($catids[0]=="0") $exists = false;
		}

		//In/ex articles
		//$article_ids = explode(',',$pluginParams->get('article_ids',''));
		$article_ids = $pluginParams->get('article_ids','');
		$article_exc_inc = $pluginParams->get('article_inc_exc','ex');

		if($article_exc_inc=="in" && !$exists){
			//INclude
			if (is_array($article_ids)) {
				$exists = (in_array($article_id_v3,$article_ids)) ? true:false;
			}

		}else if($article_exc_inc=="ex" && $exists){

			//INclude
			if (is_array($article_ids)) {
				$exists = (in_array($article_id_v3,$article_ids)) ? false:true;
			}else {
				//not sure
				$include = true;
			}
		}
		return $exists;
	}

}
