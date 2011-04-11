<?php
 class stat extends def_module {private $isStatCollected = false;public $domainArray = array();public $domain     = "";public $usersArray  = array();public $user        = "0";public $mode   = "";const DEF_ITEMS_PER_PAGE = 20;const DEF_PER_PAGE = 20;public function __construct() {parent::__construct();$this->enabled = regedit::getInstance()->getVal("//modules/stat/collect");if(cmsController::getInstance()->getCurrentMode() == "admin") {$this->__loadLib("__admin.php");$this->__implement("__stat_admin");$this->__loadLib("__popular.php");$this->__implement("__popular_stat");$this->__loadLib("__visitors.php");$this->__implement("__visitors_stat");$this->__loadLib("__sources.php");$this->__implement("__sources_stat");$this->__loadLib("__phrases.php");$this->__implement("__phrases_stat");$this->__loadLib("__seo.php");$this->__implement("__seo_stat");$this->__loadLib("__admin_tags_cloud.php");$this->__implement("__admin_tags_cloud_stat");$this->__loadLib("__visits.php");$this->__implement("__stat_visits");$this->__loadLib("__sections.php");$this->__implement("__stat_sections");$this->__loadLib("__auditory.php");$this->__implement("__stat_auditory");$this->__loadLib("__openstat.php");$this->__implement("__stat_openstat");$this->__loadLib("__paths.php");$this->__implement("__stat_paths");$this->items_per_page = regedit::getInstance()->getVal("//modules/stat/items_per_page");$this->items_per_page = self::DEF_ITEMS_PER_PAGE;$this->per_page = self::DEF_PER_PAGE;$v38d1e18b54816e157dda5426c36970e3 = $this->getCommonTabs();if($v38d1e18b54816e157dda5426c36970e3) {$v38d1e18b54816e157dda5426c36970e3->add("total", array("tag"));$v38d1e18b54816e157dda5426c36970e3->add("popular_pages", array("sectionHits"));$v38d1e18b54816e157dda5426c36970e3->add("visits", array(      "visits_sessions",      "visits_visitors",      "auditoryActivity",      "auditoryLoyality",      "auditoryLocation",      "visitDeep",      "visitTime"     ));$v38d1e18b54816e157dda5426c36970e3->add("sources", array(      "engines",      "phrases",      "entryPoints",      "exitPoints"     ));$v38d1e18b54816e157dda5426c36970e3->add("openstatCampaigns", array(      "openstatServices",      "openstatSources",      "openstatAds"     ));}}else {if(defined("DB_DRIVER") && DB_DRIVER == "xml") {return;}if(!$this->enabled) {return;}if(defined("STAT_DISABLE")) {if(STAT_DISABLE) {return;}}$this->__loadLib("__tags_cloud.php");$this->__implement("__tags_cloud_stat");$this->__loadLib("__json.php");$this->__implement("__json_stat");}$this->usersArray = array();$v91906e8530b45392b7dba05436fbfa17  = umiObjectsCollection::getInstance()->getGuidedItems( umiObjectTypesCollection::getInstance()->getBaseType('users', 'user') );foreach($v91906e8530b45392b7dba05436fbfa17 as $v8c1604c64857e79a748c27062fedf5a2 => $v3a54d77839369a7360548214a5a1e110) {$this->usersArray[$v8c1604c64857e79a748c27062fedf5a2] = $v3a54d77839369a7360548214a5a1e110;}$this->usersArray[0] = getLabel('all');$this->ts        = time();$this->from_time = mktime(0, 0, 0, date("m"), date("d"), date("Y"));$this->to_time   = strtotime('+1 day', $this->from_time);$this->domain    = "all";$this->domainArray = array();$vea05d1743eb9645dbaeaf8db5c892873     = domainsCollection::getInstance()->getList();foreach($vea05d1743eb9645dbaeaf8db5c892873 as $veae639a70006feff484a39363c977e24) {$v7e3b9bb0f97e57e647a6c597849b7e5c = $veae639a70006feff484a39363c977e24->getHost();$this->domainArray[$v7e3b9bb0f97e57e647a6c597849b7e5c] = $v7e3b9bb0f97e57e647a6c597849b7e5c;}$this->domainArray["all"] = getLabel('all');require_once dirname(__FILE__) . '/classes/simpleStat.php';require_once dirname(__FILE__) . '/classes/statistic.php';require_once dirname(__FILE__) . '/classes/statisticFactory.php';require_once dirname(__FILE__) . '/classes/xml/xmlDecorator.php';$this->mode = cmsController::getInstance()->getCurrentMode();}public function __destruct() {if($this->mode == "" && !$this->isStatCollected) {$this->pushStat();}}public function remove_to_temp() {$vb1444fb0c07653567ad325aa25d4e37a = regedit::getInstance();$ve8f2adbfad3deeca96af2f860f85a60b = $vb1444fb0c07653567ad325aa25d4e37a->getVal("//modules/stat/delete_after");$vf32b314b18f5c4d1bbdcf9ad12965229 = $ve8f2adbfad3deeca96af2f860f85a60b * 3600 * 24;$v5a3d34343ad0690635725494d8e9e385 = time() - $vf32b314b18f5c4d1bbdcf9ad12965229;$vac5c74b64b4b8352ef2f181affb5ac2a = "INSERT INTO cms_stat_old SELECT * FROM cms_stat WHERE entrytime < " . $v5a3d34343ad0690635725494d8e9e385;l_mysql_query($vac5c74b64b4b8352ef2f181affb5ac2a);$vac5c74b64b4b8352ef2f181affb5ac2a = "DELETE FROM cms_stat WHERE entrytime < " . $v5a3d34343ad0690635725494d8e9e385;l_mysql_query($vac5c74b64b4b8352ef2f181affb5ac2a);}public function pushStat() {if(!isset($_SESSION['old_logged_in_value'])) $_SESSION['old_logged_in_value'] = false;if(defined("DB_DRIVER") && DB_DRIVER == "xml") {return;}if(!$this->enabled || $this->isStatCollected) {return false;}if(defined("STAT_DISABLE")) {if(STAT_DISABLE) {return false;}}$this->isStatCollected = true;$v7057e8409c7c531a1a6e9ac3df4ed549 = cmsController::getInstance()->getCurrentElementId();if($v8e2dcfd7e7e24b1ca76c1193f645902b = umiHierarchy::getInstance()->getElement($v7057e8409c7c531a1a6e9ac3df4ed549)) {$vd57ac45256849d9b13e2422d91580fb9 = $v8e2dcfd7e7e24b1ca76c1193f645902b->getValue("tags");}else {return false;}$v77ddcb5f19832f4145345889013ab3a4 = new statistic();$v77ddcb5f19832f4145345889013ab3a4->setReferer(getServer('HTTP_REFERER'));$v77ddcb5f19832f4145345889013ab3a4->setUri(getServer('REQUEST_URI'));$v77ddcb5f19832f4145345889013ab3a4->setServerName((getServer('HTTP_HOST'))?getServer('HTTP_HOST'):getServer('SERVER_NAME'));$v77ddcb5f19832f4145345889013ab3a4->setRemoteAddr(getServer('REMOTE_ADDR'));if($v5571898aeb5505ee9a9111ddd83598f7 = cmsController::getInstance()->getModule("users")) {if($v5571898aeb5505ee9a9111ddd83598f7->is_auth() != $_SESSION['old_logged_in_value']) {$v77ddcb5f19832f4145345889013ab3a4->doLogin();}$_SESSION['old_logged_in_value'] = $v5571898aeb5505ee9a9111ddd83598f7->is_auth();}if(is_array($vd57ac45256849d9b13e2422d91580fb9)) {foreach($vd57ac45256849d9b13e2422d91580fb9 as $ve4d23e841d8e8804190027bce3180fa5) {$v77ddcb5f19832f4145345889013ab3a4->event($ve4d23e841d8e8804190027bce3180fa5);}}$v77ddcb5f19832f4145345889013ab3a4->run();}public function isStringCP1251($v341be97d9aff90c9978347f66f945b77) {$v7dabf5c198b0bab2eaa42bb03a113e55 = strlen($v341be97d9aff90c9978347f66f945b77);for($v865c0c0b4ab0e063e5caa3387c1a8741 = 0;$v865c0c0b4ab0e063e5caa3387c1a8741 < $v7dabf5c198b0bab2eaa42bb03a113e55;$v865c0c0b4ab0e063e5caa3387c1a8741++) {$vd95679752134a2d9eb61dbd7b91c4bcc = ord(substr($v341be97d9aff90c9978347f66f945b77, $v865c0c0b4ab0e063e5caa3387c1a8741, 1));if((!($vd95679752134a2d9eb61dbd7b91c4bcc >= 32 && $vd95679752134a2d9eb61dbd7b91c4bcc <= 122)) && !($vd95679752134a2d9eb61dbd7b91c4bcc >= 192 && $vd95679752134a2d9eb61dbd7b91c4bcc <= 255)) {return false;}}return true;}public function getCurrentUserTags() {if(isset($_SESSION['stat']['user_id'])) {$v945fa9125ec0bcb1c5978e89ab4fb695 = $_SESSION['stat']['user_id'];}else {return false;}$v9549dd6065d019211460c59a86dd6536 = new statisticFactory(dirname(__FILE__) . '/classes');$v9549dd6065d019211460c59a86dd6536->isValid('fastUserTags');$ve98d2f001da5678b39482efbdf5770dc = $v9549dd6065d019211460c59a86dd6536->get('fastUserTags');$ve98d2f001da5678b39482efbdf5770dc->setParams(Array("user_id" => $v945fa9125ec0bcb1c5978e89ab4fb695));$v18566cda79f670c2098360799275aa31 = $ve98d2f001da5678b39482efbdf5770dc->get();return $v18566cda79f670c2098360799275aa31['labels'];}};?>