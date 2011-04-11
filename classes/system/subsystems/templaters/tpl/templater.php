<?php
class templater extends singleton implements iTemplater {public $defaultMacroses = Array(Array("%content%", "macros_content"),  Array("%menu%", "macros_menu"),  Array("%header%", "macros_header"),  Array("%pid%", "macros_returnPid"),  Array("%parent_id%", "macros_returnParentId"),  Array("%pre_lang%", "macros_returnPreLang"),  Array("%curr_time%", "macros_curr_time"),  Array("%domain%", "macros_returnDomain"),  Array("%domain_floated%", "macros_returnDomainFloated"),   Array("%title%", "macros_title"),  Array("%keywords%", "macros_keywords"),  Array("%describtion%", "macros_describtion"),  Array("%description%", "macros_describtion"),  Array("%adm_menu%", "macros_adm_menu"),  Array("%adm_navibar%", "macros_adm_navibar"),  Array("%skin_path%", "macros_skin_path"),  Array("%ico_ext%", "macros_ico_ext"),   Array("%current_user_id%", "macros_current_user_id"),  Array("%current_version_line%", "macros_current_version_line"),  Array("%context_help%", "macros_help"),  Array("%current_alt_name%", "macros_current_alt_name"));public $cacheMacroses = Array();public $processingCache = array();public $cachePermitted = false;public $LANGS = Array();public $cacheEnabled = 0;protected function __construct() {}public static function getInstance() {return parent::getInstance(__CLASS__);}public function init($va43c1b0aa53a0c908810c06ab1ff3967) {$this->loadLangs();$this->cacheMacroses["%content%"] = $this->parseInput(cmsController::getInstance()->parsedContent);$v9b207167e5381c47682c6b4f58a623fb = $this->parseInput($va43c1b0aa53a0c908810c06ab1ff3967);$v9b207167e5381c47682c6b4f58a623fb = $this->putLangs($v9b207167e5381c47682c6b4f58a623fb);$this->output = system_parse_short_calls($v9b207167e5381c47682c6b4f58a623fb);}public function loadLangs() {$vdcb02837c3430cb5b0b73a05d1d40c8e = CURRENT_WORKING_DIR . "/classes/modules/lang." . cmsController::getInstance()->getLang()->getPrefix() . ".php";if(!file_exists($vdcb02837c3430cb5b0b73a05d1d40c8e)) {$vdcb02837c3430cb5b0b73a05d1d40c8e = CURRENT_WORKING_DIR . "/classes/modules/lang.php";}include_once $vdcb02837c3430cb5b0b73a05d1d40c8e;if(isset($LANG_EXPORT)) {$v4d424a5679c0aa6e84a0235ec1949c43 = cmsController::getInstance();$v4d424a5679c0aa6e84a0235ec1949c43->langs = array_merge($v4d424a5679c0aa6e84a0235ec1949c43->langs, $LANG_EXPORT);unset($LANG_EXPORT);}return true;}public function putLangs($va43c1b0aa53a0c908810c06ab1ff3967) {$v9b207167e5381c47682c6b4f58a623fb = $va43c1b0aa53a0c908810c06ab1ff3967;if(($v83878c91171338902e0fe0fb97a8c47a = strpos($v9b207167e5381c47682c6b4f58a623fb, "%")) === false) return $v9b207167e5381c47682c6b4f58a623fb;$v5a05866850c28651fe234659f6c92ada = cmsController::getInstance()->langs;foreach($v5a05866850c28651fe234659f6c92ada as $vde3ec0aa2234aa1e3ee275bbc715c6c9 => $v05f59f175b8961c00305e4ee7c88f9f2) {if(is_array($v05f59f175b8961c00305e4ee7c88f9f2)) continue;$v6f8f57715090da2632453988d9a1501b = "%" . $vde3ec0aa2234aa1e3ee275bbc715c6c9 . "%";if(($v1f2dfa567dcf95833eddf7aec167fec7 = strpos($v9b207167e5381c47682c6b4f58a623fb, $v6f8f57715090da2632453988d9a1501b, $v83878c91171338902e0fe0fb97a8c47a)) !== false) {$v9b207167e5381c47682c6b4f58a623fb = str_replace($v6f8f57715090da2632453988d9a1501b, $v05f59f175b8961c00305e4ee7c88f9f2, $v9b207167e5381c47682c6b4f58a623fb, $v1f2dfa567dcf95833eddf7aec167fec7);}}return $v9b207167e5381c47682c6b4f58a623fb;}public function parseInput($va43c1b0aa53a0c908810c06ab1ff3967) {$v9b207167e5381c47682c6b4f58a623fb = $va43c1b0aa53a0c908810c06ab1ff3967;if(is_array($v9b207167e5381c47682c6b4f58a623fb)) {return $v9b207167e5381c47682c6b4f58a623fb;}$v0db3209e1adc6d67be435a81baf9a66e = cmsController::getInstance()->getCurrentElementId();$va43c1b0aa53a0c908810c06ab1ff3967 = str_replace("%pid%", $v0db3209e1adc6d67be435a81baf9a66e, $va43c1b0aa53a0c908810c06ab1ff3967);if(strrpos($v9b207167e5381c47682c6b4f58a623fb, "%") === false) {return $v9b207167e5381c47682c6b4f58a623fb;}$va43c1b0aa53a0c908810c06ab1ff3967 = str_replace("%%", "%\r\n%", $va43c1b0aa53a0c908810c06ab1ff3967);if(preg_match_all("/%([A-z_]{3,})%/m", $va43c1b0aa53a0c908810c06ab1ff3967, $v3d801aa532c1cec3ee82d87a99fdf63f)) {$v3d801aa532c1cec3ee82d87a99fdf63f = $v3d801aa532c1cec3ee82d87a99fdf63f[0];$v7dabf5c198b0bab2eaa42bb03a113e55 = sizeof($v3d801aa532c1cec3ee82d87a99fdf63f);for($v865c0c0b4ab0e063e5caa3387c1a8741 = 0;$v865c0c0b4ab0e063e5caa3387c1a8741 < $v7dabf5c198b0bab2eaa42bb03a113e55;$v865c0c0b4ab0e063e5caa3387c1a8741++) {try {$v4b43b0aee35624cd95b910189b3dc231 = $this->parseMacros($v3d801aa532c1cec3ee82d87a99fdf63f[$v865c0c0b4ab0e063e5caa3387c1a8741]);}catch (publicException $ve1671797c52e15f763380b45e841ec32) {}}}if(preg_match_all("/%([A-zА-Яа-я0-9]+\s+[A-zА-Яа-я0-9_]+\([A-zА-Яа-я \/\._\-\(\)0-9%:<>,!@\|'&=;\?\+#]*\))%/mu", $va43c1b0aa53a0c908810c06ab1ff3967, $v3d801aa532c1cec3ee82d87a99fdf63f)) {$v3d801aa532c1cec3ee82d87a99fdf63f = $v3d801aa532c1cec3ee82d87a99fdf63f[0];$v7dabf5c198b0bab2eaa42bb03a113e55 = sizeof($v3d801aa532c1cec3ee82d87a99fdf63f);for($v865c0c0b4ab0e063e5caa3387c1a8741 = 0;$v865c0c0b4ab0e063e5caa3387c1a8741 < $v7dabf5c198b0bab2eaa42bb03a113e55;$v865c0c0b4ab0e063e5caa3387c1a8741++) {try {$v4b43b0aee35624cd95b910189b3dc231 = $this->parseMacros($v3d801aa532c1cec3ee82d87a99fdf63f[$v865c0c0b4ab0e063e5caa3387c1a8741]);}catch (publicException $ve1671797c52e15f763380b45e841ec32) {}}}if(is_array($v9b207167e5381c47682c6b4f58a623fb)) implode('',$v9b207167e5381c47682c6b4f58a623fb);$v0fea6a13c52b4d4725368f24b045ca84 = $this->cacheMacroses;$v0fea6a13c52b4d4725368f24b045ca84 = array_reverse($v0fea6a13c52b4d4725368f24b045ca84);foreach($v0fea6a13c52b4d4725368f24b045ca84 as $vee33e909372d935d190f4fcb2a92d542 => $vd9394066970e44ae252fd0347e58c03e) {if(($v83878c91171338902e0fe0fb97a8c47a = strpos($v9b207167e5381c47682c6b4f58a623fb, $vee33e909372d935d190f4fcb2a92d542)) !== false) {$v9b207167e5381c47682c6b4f58a623fb = str_replace($vee33e909372d935d190f4fcb2a92d542, $vd9394066970e44ae252fd0347e58c03e, $v9b207167e5381c47682c6b4f58a623fb);}}$v9b207167e5381c47682c6b4f58a623fb = $this->cleanUpResult( $this->putLangs($v9b207167e5381c47682c6b4f58a623fb) );if($v0db3209e1adc6d67be435a81baf9a66e) {$v9b207167e5381c47682c6b4f58a623fb = system_parse_short_calls($v9b207167e5381c47682c6b4f58a623fb, $v0db3209e1adc6d67be435a81baf9a66e);}return $v9b207167e5381c47682c6b4f58a623fb;}public function parseMacros($vdc3ef687d19cc2fb071d846f9360ecbe) {$v8ee1d4327d02df333859c8dd0101aae8 = Array();if(strrpos($vdc3ef687d19cc2fb071d846f9360ecbe, "%") === false)   return $v8ee1d4327d02df333859c8dd0101aae8;if(isset($this->processingCache[$vdc3ef687d19cc2fb071d846f9360ecbe])) return $vdc3ef687d19cc2fb071d846f9360ecbe;$this->processingCache[$vdc3ef687d19cc2fb071d846f9360ecbe] = true;$v63a86638c46e7c3bcc05b4b73aa7dd79 = "/%([A-z0-9]+)\s+([A-z0-9]+)\((.*)\)%/m";if(defined("TPL_MODE")) {if(TPL_MODE == "SIMPLE") {$v63a86638c46e7c3bcc05b4b73aa7dd79 = "/%([A-z0-9]+)\s+([A-z0-9]+)\((.*)\)%/Um";}}if(preg_match($v63a86638c46e7c3bcc05b4b73aa7dd79, $vdc3ef687d19cc2fb071d846f9360ecbe, $v7f51cd1d44922c57f8f7945fc268ef09)) {$v8ee1d4327d02df333859c8dd0101aae8['str']    = $v7f51cd1d44922c57f8f7945fc268ef09[0];$v8ee1d4327d02df333859c8dd0101aae8['module'] = $v7f51cd1d44922c57f8f7945fc268ef09[1];$v8ee1d4327d02df333859c8dd0101aae8['method'] = $v7f51cd1d44922c57f8f7945fc268ef09[2];$v8ee1d4327d02df333859c8dd0101aae8['args']   = $v7f51cd1d44922c57f8f7945fc268ef09[3];if(array_key_exists($v8ee1d4327d02df333859c8dd0101aae8['str'], $this->cacheMacroses)) {unset($this->processingCache[$vdc3ef687d19cc2fb071d846f9360ecbe]);return $this->cacheMacroses[$v8ee1d4327d02df333859c8dd0101aae8['str']];}$v21ffce5b8a6cc8cc6a41448dd69623c9 = split(",", $v8ee1d4327d02df333859c8dd0101aae8['args']);$v7dabf5c198b0bab2eaa42bb03a113e55 = sizeof($v21ffce5b8a6cc8cc6a41448dd69623c9);for($v865c0c0b4ab0e063e5caa3387c1a8741 = 0;$v865c0c0b4ab0e063e5caa3387c1a8741 < $v7dabf5c198b0bab2eaa42bb03a113e55;$v865c0c0b4ab0e063e5caa3387c1a8741++) {$vf33a4e939ffe21234596860b7249c246 = $v21ffce5b8a6cc8cc6a41448dd69623c9[$v865c0c0b4ab0e063e5caa3387c1a8741];if(strpos($vf33a4e939ffe21234596860b7249c246, "%") !== false) {$vf33a4e939ffe21234596860b7249c246 = $this->parseInput($vf33a4e939ffe21234596860b7249c246);}$v21ffce5b8a6cc8cc6a41448dd69623c9[$v865c0c0b4ab0e063e5caa3387c1a8741] = trim($vf33a4e939ffe21234596860b7249c246, "'\" ");}$v8ee1d4327d02df333859c8dd0101aae8['args'] = $v21ffce5b8a6cc8cc6a41448dd69623c9;$v9b207167e5381c47682c6b4f58a623fb = $v8ee1d4327d02df333859c8dd0101aae8['result'] = $this->executeMacros($v8ee1d4327d02df333859c8dd0101aae8);$this->cacheMacroses[$v8ee1d4327d02df333859c8dd0101aae8['str']] = $v8ee1d4327d02df333859c8dd0101aae8['result'];unset($this->processingCache[$vdc3ef687d19cc2fb071d846f9360ecbe]);return $v9b207167e5381c47682c6b4f58a623fb;}else {$vf96b9890e2821e2b15992ff81ce1806d = $this->defaultMacroses;$v7dabf5c198b0bab2eaa42bb03a113e55 = sizeof($vf96b9890e2821e2b15992ff81ce1806d);for($v865c0c0b4ab0e063e5caa3387c1a8741 = 0;$v865c0c0b4ab0e063e5caa3387c1a8741 < $v7dabf5c198b0bab2eaa42bb03a113e55;$v865c0c0b4ab0e063e5caa3387c1a8741++)    if(stripos($vdc3ef687d19cc2fb071d846f9360ecbe, $vf96b9890e2821e2b15992ff81ce1806d[$v865c0c0b4ab0e063e5caa3387c1a8741][0]) !== false) {if(array_key_exists($vf96b9890e2821e2b15992ff81ce1806d[$v865c0c0b4ab0e063e5caa3387c1a8741][0], $this->cacheMacroses)) {unset($this->processingCache[$vdc3ef687d19cc2fb071d846f9360ecbe]);return $this->cacheMacroses[$vf96b9890e2821e2b15992ff81ce1806d[$v865c0c0b4ab0e063e5caa3387c1a8741][0]];}if(!isset($vf96b9890e2821e2b15992ff81ce1806d[$v865c0c0b4ab0e063e5caa3387c1a8741][2])) {$vf96b9890e2821e2b15992ff81ce1806d[$v865c0c0b4ab0e063e5caa3387c1a8741][2] = NULL;}$v9b207167e5381c47682c6b4f58a623fb = $this->executeMacros(          Array(           "module" => $vf96b9890e2821e2b15992ff81ce1806d[$v865c0c0b4ab0e063e5caa3387c1a8741][1],           "method" => $vf96b9890e2821e2b15992ff81ce1806d[$v865c0c0b4ab0e063e5caa3387c1a8741][2],           "args"   => Array()           )         );$v9b207167e5381c47682c6b4f58a623fb = $this->parseInput($v9b207167e5381c47682c6b4f58a623fb);$this->cacheMacroses[$vf96b9890e2821e2b15992ff81ce1806d[$v865c0c0b4ab0e063e5caa3387c1a8741][0]] = $v9b207167e5381c47682c6b4f58a623fb;unset($this->processingCache[$vdc3ef687d19cc2fb071d846f9360ecbe]);return $v9b207167e5381c47682c6b4f58a623fb;}$this->cacheMacroses[$vdc3ef687d19cc2fb071d846f9360ecbe] = $vdc3ef687d19cc2fb071d846f9360ecbe;unset($this->processingCache[$vdc3ef687d19cc2fb071d846f9360ecbe]);return $vdc3ef687d19cc2fb071d846f9360ecbe;}}public function executeMacros($v8ee1d4327d02df333859c8dd0101aae8) {$v22884db148f0ffb0d830ba431102b0b5 = $v8ee1d4327d02df333859c8dd0101aae8['module'];$vea9f6aca279138c58f705c8d4cb4b8ce = $v8ee1d4327d02df333859c8dd0101aae8['method'];if($v22884db148f0ffb0d830ba431102b0b5 == "current_module")   $v22884db148f0ffb0d830ba431102b0b5 = cmsController::getInstance()->getCurrentModule();$v9b207167e5381c47682c6b4f58a623fb = "";if(!$vea9f6aca279138c58f705c8d4cb4b8ce) {$vb69957bad52d90073d0bd2ed82d0a7cb = $v8ee1d4327d02df333859c8dd0101aae8['args'];$v9b207167e5381c47682c6b4f58a623fb = call_user_func_array($v8ee1d4327d02df333859c8dd0101aae8['module'], $vb69957bad52d90073d0bd2ed82d0a7cb);}if($v22884db148f0ffb0d830ba431102b0b5 == "core" || $v22884db148f0ffb0d830ba431102b0b5 == "system" || $v22884db148f0ffb0d830ba431102b0b5 == "custom") {$v1cd3c693132f4c31b5b5e5f4c5eed6bd = &system_buildin_load($v22884db148f0ffb0d830ba431102b0b5);if($v1cd3c693132f4c31b5b5e5f4c5eed6bd) {$v9b207167e5381c47682c6b4f58a623fb = $v1cd3c693132f4c31b5b5e5f4c5eed6bd->cms_callMethod($vea9f6aca279138c58f705c8d4cb4b8ce, $v8ee1d4327d02df333859c8dd0101aae8['args']);}}if($v22884db148f0ffb0d830ba431102b0b5 != "core" && $v22884db148f0ffb0d830ba431102b0b5 != "system") {if(system_is_allowed($v22884db148f0ffb0d830ba431102b0b5, $vea9f6aca279138c58f705c8d4cb4b8ce)) {if($v47a12618c9a47b69a3050e6b9313a351 = cmsController::getInstance()->getModule($v22884db148f0ffb0d830ba431102b0b5)) {$v9b207167e5381c47682c6b4f58a623fb = $v47a12618c9a47b69a3050e6b9313a351->cms_callMethod($vea9f6aca279138c58f705c8d4cb4b8ce, $v8ee1d4327d02df333859c8dd0101aae8['args']);}}}if(is_array($v9b207167e5381c47682c6b4f58a623fb)) {$vfa816edb83e95bf0c8da580bdfd491ef = "";foreach($v9b207167e5381c47682c6b4f58a623fb as $v03c7c0ace395d80182db07ae2c30f034) {if(!is_array($v03c7c0ace395d80182db07ae2c30f034)) {$vfa816edb83e95bf0c8da580bdfd491ef .= $v03c7c0ace395d80182db07ae2c30f034;}}$v9b207167e5381c47682c6b4f58a623fb = $vfa816edb83e95bf0c8da580bdfd491ef;}if(strpos($v9b207167e5381c47682c6b4f58a623fb, "%") !== false) {$v9b207167e5381c47682c6b4f58a623fb = $this->parseInput($v9b207167e5381c47682c6b4f58a623fb);}return $v9b207167e5381c47682c6b4f58a623fb;}public function __destruct() {}public static $blocks = Array();public static function pushEditable($v22884db148f0ffb0d830ba431102b0b5, $vea9f6aca279138c58f705c8d4cb4b8ce, $vb80bb7740288fda1f201890375a60c8f) {if($v22884db148f0ffb0d830ba431102b0b5 === false && $vea9f6aca279138c58f705c8d4cb4b8ce === false) {if($v8e2dcfd7e7e24b1ca76c1193f645902b = umiHierarchy::getInstance()->getElement($vb80bb7740288fda1f201890375a60c8f)) {$v94efb9bd8805ffa2a3d248cbe836b6ef = $v8e2dcfd7e7e24b1ca76c1193f645902b->getTypeId();if($v481a5f16b24d461e31d85aba607238b8 = umiObjectTypesCollection::getInstance()->getType($v94efb9bd8805ffa2a3d248cbe836b6ef)) {$v09f4280d9972439d11df682357c4b807 = $v481a5f16b24d461e31d85aba607238b8->getHierarchyTypeId();if($v5f8d8192d2d4ff7e065aaf1958d15913 = umiHierarchyTypesCollection::getInstance()->getType($v09f4280d9972439d11df682357c4b807)) {$v22884db148f0ffb0d830ba431102b0b5 = $v5f8d8192d2d4ff7e065aaf1958d15913->getName();$vea9f6aca279138c58f705c8d4cb4b8ce = $v5f8d8192d2d4ff7e065aaf1958d15913->getExt();}else {return false;}}}}templater::$blocks[] = array($v22884db148f0ffb0d830ba431102b0b5, $vea9f6aca279138c58f705c8d4cb4b8ce, $vb80bb7740288fda1f201890375a60c8f);}public static function prepareQuickEdit() {$v5e72c7891093d301b60783c6a47f7aa0 = templater::$blocks;if(sizeof($v5e72c7891093d301b60783c6a47f7aa0) == 0) return;$v3c6e0b8a9c15224a8228b9a98ca1531d = md5("http://" . getServer('HTTP_HOST') . getServer('REQUEST_URI'));$_SESSION[$v3c6e0b8a9c15224a8228b9a98ca1531d] = $v5e72c7891093d301b60783c6a47f7aa0;}final public static function getSomething($v0f4153145310ca3a80263d772ccd01d4 = "pro") {$v520579a4307a11304874d3845f4e67cb = domainsCollection::getInstance()->getDefaultDomain();$v3545bca7585a63de97c30a1e6cd8992b = getServer('SERVER_ADDR');if($v3545bca7585a63de97c30a1e6cd8992b) {$v43c8ce94d81492e62c60092a3664a65f = md5($v3545bca7585a63de97c30a1e6cd8992b);}else {$v43c8ce94d81492e62c60092a3664a65f = md5(str_replace("\\", "", getServer('DOCUMENT_ROOT')));}switch($v0f4153145310ca3a80263d772ccd01d4) {case "pro":    $v834c51a71b8c3cca066197db43bb209d = md5(md5(md5(md5(md5(md5(md5(md5(md5(md5($v520579a4307a11304874d3845f4e67cb->getHost()))))))))));break;case "free":    $v834c51a71b8c3cca066197db43bb209d = md5(md5(md5($v520579a4307a11304874d3845f4e67cb->getHost())));break;case "lite":    $v834c51a71b8c3cca066197db43bb209d = md5(md5(md5(md5(md5($v520579a4307a11304874d3845f4e67cb->getHost())))));break;case "freelance":    $v834c51a71b8c3cca066197db43bb209d = md5(md5(md5(md5(md5(md5(md5($v520579a4307a11304874d3845f4e67cb->getHost())))))));break;case "trial": {$v834c51a71b8c3cca066197db43bb209d = md5(md5(md5(md5(md5(md5($v520579a4307a11304874d3845f4e67cb->getHost()))))));}}$v90fdeb3fda515dc805fa06fda3504d5c = strtoupper(substr($v43c8ce94d81492e62c60092a3664a65f, 0, 11) . "-" . substr($v834c51a71b8c3cca066197db43bb209d, 0, 11));return $v90fdeb3fda515dc805fa06fda3504d5c;}public function cleanUpResult($va43c1b0aa53a0c908810c06ab1ff3967) {return $va43c1b0aa53a0c908810c06ab1ff3967;$va43c1b0aa53a0c908810c06ab1ff3967 = str_replace("%pid%", cmsController::getInstance()->getCurrentElementId(), $va43c1b0aa53a0c908810c06ab1ff3967);if(!regedit::getInstance()->getVal("//settings/show_macros_onerror")) {$va43c1b0aa53a0c908810c06ab1ff3967 = preg_replace("/%([A-z?-?А-я \/\._\-\(\)0-9%:<>,!@\|'&=;\?\+#]*)%/m", "", $va43c1b0aa53a0c908810c06ab1ff3967);}return $va43c1b0aa53a0c908810c06ab1ff3967;}};?>