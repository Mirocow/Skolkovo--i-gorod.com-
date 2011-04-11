<?php
 class umiObjectsCollection extends singleton implements iSingleton, iUmiObjectsCollection {private $objects = Array();private $updatedObjects = Array();protected function __construct() {}public static function getInstance() {return parent::getInstance(__CLASS__);}private function isLoaded($vaf31437ce61345f416579830a98c91e5) {if(gettype($vaf31437ce61345f416579830a98c91e5) == "object") {throw new coreException("Object given!");}return (bool) array_key_exists($vaf31437ce61345f416579830a98c91e5, $this->objects);}public function isExists($vaf31437ce61345f416579830a98c91e5) {$vaf31437ce61345f416579830a98c91e5 = (int) $vaf31437ce61345f416579830a98c91e5;$result = l_mysql_query("SELECT COUNT(*) FROM cms3_objects WHERE id = '{$vaf31437ce61345f416579830a98c91e5}'");if($v56bd7107802ebe56c6918992f0608ec6 = mysql_error()) {throw new coreException($v56bd7107802ebe56c6918992f0608ec6);}else {list($ve2942a04780e223b215eb8b663cf5353) = mysql_fetch_row($result);}return ($ve2942a04780e223b215eb8b663cf5353 > 0);}public function getObject($vaf31437ce61345f416579830a98c91e5) {$vaf31437ce61345f416579830a98c91e5 = (int) $vaf31437ce61345f416579830a98c91e5;if(!$vaf31437ce61345f416579830a98c91e5) {return false;}if($this->isLoaded($vaf31437ce61345f416579830a98c91e5)) {return $this->objects[$vaf31437ce61345f416579830a98c91e5];}$va8cfde6331bd59eb2ac96f8911c4b666 = cacheFrontend::getInstance()->load($vaf31437ce61345f416579830a98c91e5, "object");if($va8cfde6331bd59eb2ac96f8911c4b666 instanceof umiObject == false) {try {$va8cfde6331bd59eb2ac96f8911c4b666 = new umiObject($vaf31437ce61345f416579830a98c91e5);}catch (baseException $ve1671797c52e15f763380b45e841ec32) {return false;}cacheFrontend::getInstance()->save($va8cfde6331bd59eb2ac96f8911c4b666, "object");}if(is_object($va8cfde6331bd59eb2ac96f8911c4b666)) {$this->objects[$vaf31437ce61345f416579830a98c91e5] = $va8cfde6331bd59eb2ac96f8911c4b666;return $this->objects[$vaf31437ce61345f416579830a98c91e5];}else {return false;}}public function delObject($vaf31437ce61345f416579830a98c91e5) {if($this->isExists($vaf31437ce61345f416579830a98c91e5)) {$this->disableCache();$vaf31437ce61345f416579830a98c91e5 = (int) $vaf31437ce61345f416579830a98c91e5;if(defined("SV_USER_ID")) {if($vaf31437ce61345f416579830a98c91e5 == SV_USER_ID || $vaf31437ce61345f416579830a98c91e5 == SV_GROUP_ID || $vaf31437ce61345f416579830a98c91e5 == 2373) {throw new coreException("You are not allowed to delete object #{$vaf31437ce61345f416579830a98c91e5}. Never. Don't even try.");}}$va8cfde6331bd59eb2ac96f8911c4b666 = $this->getObject($vaf31437ce61345f416579830a98c91e5);$va8cfde6331bd59eb2ac96f8911c4b666->commit();$vac5c74b64b4b8352ef2f181affb5ac2a = "DELETE FROM cms3_objects WHERE id = '{$vaf31437ce61345f416579830a98c91e5}' AND is_locked='0'";l_mysql_query($vac5c74b64b4b8352ef2f181affb5ac2a);if($v56bd7107802ebe56c6918992f0608ec6 = mysql_error()) {throw new coreException($v56bd7107802ebe56c6918992f0608ec6);return false;}if($this->isLoaded($vaf31437ce61345f416579830a98c91e5)) {unset($this->objects[$vaf31437ce61345f416579830a98c91e5]);}cacheFrontend::getInstance()->del($vaf31437ce61345f416579830a98c91e5, "object");return true;}else {return false;}}public function addObject($vb068931cc450442b63f5b3d276ea4297, $v94757cae63fd3e398c0811a976dd6bbe, $v1945c9a2a5e2ba6133f1db6757a35fcb = false) {$this->disableCache();$v94757cae63fd3e398c0811a976dd6bbe = (int) $v94757cae63fd3e398c0811a976dd6bbe;if(!$v94757cae63fd3e398c0811a976dd6bbe) {throw new coreException("Can't create object without object type id (null given)");}$vac5c74b64b4b8352ef2f181affb5ac2a = "INSERT INTO cms3_objects (type_id) VALUES('$v94757cae63fd3e398c0811a976dd6bbe')";l_mysql_query($vac5c74b64b4b8352ef2f181affb5ac2a);if($v56bd7107802ebe56c6918992f0608ec6 = mysql_error()) {throw new coreException($v56bd7107802ebe56c6918992f0608ec6);return false;}$vaf31437ce61345f416579830a98c91e5 = mysql_insert_id();$va8cfde6331bd59eb2ac96f8911c4b666 = new umiObject($vaf31437ce61345f416579830a98c91e5);$va8cfde6331bd59eb2ac96f8911c4b666->setName($vb068931cc450442b63f5b3d276ea4297);$va8cfde6331bd59eb2ac96f8911c4b666->setIsLocked($v1945c9a2a5e2ba6133f1db6757a35fcb);if($v5571898aeb5505ee9a9111ddd83598f7 = cmsController::getInstance()->getModule("users")) {if($v5571898aeb5505ee9a9111ddd83598f7->is_auth()) {$ve8701ad48ba05a91604e480dd60899a3 = cmsController::getInstance()->getModule("users")->user_id;$va8cfde6331bd59eb2ac96f8911c4b666->setOwnerId($ve8701ad48ba05a91604e480dd60899a3);}}else {$va8cfde6331bd59eb2ac96f8911c4b666->setOwnerId(NULL);}$va8cfde6331bd59eb2ac96f8911c4b666->commit();$this->objects[$vaf31437ce61345f416579830a98c91e5] = $va8cfde6331bd59eb2ac96f8911c4b666;try {$this->resetObjectProperties($vaf31437ce61345f416579830a98c91e5);}catch (valueRequiredException $ve1671797c52e15f763380b45e841ec32) {$ve1671797c52e15f763380b45e841ec32->unregister();}return $vaf31437ce61345f416579830a98c91e5;}public function cloneObject($va77b1053cb200e022574f213c7553d88) {$v25d877efea6783c4bc6117555350c1d3 = false;$vd82f268d5a82fc66260ad083d1a2e5b4 = $this->getObject($va77b1053cb200e022574f213c7553d88);if ($vd82f268d5a82fc66260ad083d1a2e5b4 instanceof umiObject) {$v2ac03ecbbe52ba8d9e62808d586f02aa = "INSERT INTO cms3_objects (name, is_locked, type_id, owner_id) SELECT name, is_locked, type_id, owner_id FROM cms3_objects WHERE id = '{$va77b1053cb200e022574f213c7553d88}'";l_mysql_query($v2ac03ecbbe52ba8d9e62808d586f02aa);if ($v56bd7107802ebe56c6918992f0608ec6 = mysql_error()) {throw new coreException($v56bd7107802ebe56c6918992f0608ec6);return false;}$vadf62911d523a4c7be2611e6b5f23612 = mysql_insert_id();$v2ac03ecbbe52ba8d9e62808d586f02aa = "INSERT INTO cms3_object_content (obj_id, field_id, int_val, varchar_val, text_val, rel_val, tree_val,float_val)  SELECT '{$vadf62911d523a4c7be2611e6b5f23612}' as obj_id, field_id, int_val, varchar_val, text_val, rel_val, tree_val,float_val FROM cms3_object_content WHERE obj_id = '$va77b1053cb200e022574f213c7553d88'";l_mysql_query($v2ac03ecbbe52ba8d9e62808d586f02aa);if ($v56bd7107802ebe56c6918992f0608ec6 = mysql_error()) {throw new coreException($v56bd7107802ebe56c6918992f0608ec6);return false;}$v25d877efea6783c4bc6117555350c1d3 = $vadf62911d523a4c7be2611e6b5f23612;}return $v25d877efea6783c4bc6117555350c1d3;}public function getGuidedItems($v051369818a8073bba5feeb0e957eb308) {$v9b207167e5381c47682c6b4f58a623fb = Array();$v051369818a8073bba5feeb0e957eb308 = (int) $v051369818a8073bba5feeb0e957eb308;$v47474f16bc8e08736ec6d8eece4f8c96 = intval(regedit::getInstance()->getVal("//settings/ignore_guides_sort")) ? true : false;if($v47474f16bc8e08736ec6d8eece4f8c96)    $vac5c74b64b4b8352ef2f181affb5ac2a = "SELECT SQL_CACHE id, name FROM cms3_objects WHERE type_id = '{$v051369818a8073bba5feeb0e957eb308}' ORDER BY id ASC";else    $vac5c74b64b4b8352ef2f181affb5ac2a = "SELECT SQL_CACHE id, name FROM cms3_objects WHERE type_id = '{$v051369818a8073bba5feeb0e957eb308}' ORDER BY name ASC";$result = l_mysql_query($vac5c74b64b4b8352ef2f181affb5ac2a);if($v56bd7107802ebe56c6918992f0608ec6 = mysql_error()) {throw new coreException($v56bd7107802ebe56c6918992f0608ec6);return false;}while(list($vb80bb7740288fda1f201890375a60c8f, $vb068931cc450442b63f5b3d276ea4297) = mysql_fetch_row($result)) {$v9b207167e5381c47682c6b4f58a623fb[$vb80bb7740288fda1f201890375a60c8f] = $this->translateLabel($vb068931cc450442b63f5b3d276ea4297);}if(!$v47474f16bc8e08736ec6d8eece4f8c96)    natsort($v9b207167e5381c47682c6b4f58a623fb);return $v9b207167e5381c47682c6b4f58a623fb;}protected function resetObjectProperties($vaf31437ce61345f416579830a98c91e5) {$va8cfde6331bd59eb2ac96f8911c4b666 = $this->getObject($vaf31437ce61345f416579830a98c91e5);$v87306dd4235ed712ebc07fe169b76f83 = $va8cfde6331bd59eb2ac96f8911c4b666->getTypeId();$v7ae7003da59ae71dcc9f8638ef50593d = umiObjectTypesCollection::getInstance()->getType($v87306dd4235ed712ebc07fe169b76f83);$v37c0c66b0de38f0adb05826f136d75f7 = $v7ae7003da59ae71dcc9f8638ef50593d->getAllFields();foreach($v37c0c66b0de38f0adb05826f136d75f7 as $vb8b49ef6bc7c1cfa510520b8a17b9f69) {$va8cfde6331bd59eb2ac96f8911c4b666->setValue($vb8b49ef6bc7c1cfa510520b8a17b9f69->getName(), Array());}if(sizeof($v37c0c66b0de38f0adb05826f136d75f7) == 0) {$v80071f37861c360a27b7327e132c911a = umiBranch::getBranchedTableByTypeId($v87306dd4235ed712ebc07fe169b76f83);$vac5c74b64b4b8352ef2f181affb5ac2a = "INSERT INTO {$v80071f37861c360a27b7327e132c911a} (obj_id, field_id) VALUES ('{$vaf31437ce61345f416579830a98c91e5}', NULL)";l_mysql_query($vac5c74b64b4b8352ef2f181affb5ac2a);if($v56bd7107802ebe56c6918992f0608ec6 = mysql_error()) {throw new coreException($v56bd7107802ebe56c6918992f0608ec6);}}}public function unloadObject($vaf31437ce61345f416579830a98c91e5) {if($this->isLoaded($vaf31437ce61345f416579830a98c91e5)) {unset($this->objects[$vaf31437ce61345f416579830a98c91e5]);}else {return false;}}public function getCollectedObjects() {return array_keys($this->objects);}public function addUpdatedObjectId($vaf31437ce61345f416579830a98c91e5) {if(!in_array($vaf31437ce61345f416579830a98c91e5, $this->updatedObjects)) {$this->updatedObjects[] = $vaf31437ce61345f416579830a98c91e5;}}public function getUpdatedObjects() {return $this->updatedObjects;}public function __destruct() {if(sizeof($this->updatedObjects)) {if(function_exists("deleteObjectsRelatedPages")) {deleteObjectsRelatedPages();}}}}?>