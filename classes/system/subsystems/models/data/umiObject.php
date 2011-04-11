<?php
 class umiObject extends umiEntinty implements iUmiEntinty, iUmiObject {private $name, $type_id, $is_locked, $owner_id = false,   $type, $properties = Array(), $prop_groups = Array();protected $store_type = "object";public function getName() {return $this->translateLabel($this->name);}public function getTypeId() {return $this->type_id;}public function getType() {if(!$this->type) {$this->loadType();}return $this->type;}public function getIsLocked() {return $this->is_locked;}public function setName($vb068931cc450442b63f5b3d276ea4297) {if ($this->name !== $vb068931cc450442b63f5b3d276ea4297) {if(($this->translateLabel($this->name) != $this->name)) {$vb068931cc450442b63f5b3d276ea4297 = $this->translateI18n($vb068931cc450442b63f5b3d276ea4297);}$this->name = $vb068931cc450442b63f5b3d276ea4297;$this->setIsUpdated();}}public function setTypeId($v94757cae63fd3e398c0811a976dd6bbe) {if ($this->type_id !== $v94757cae63fd3e398c0811a976dd6bbe) {$this->type_id = $v94757cae63fd3e398c0811a976dd6bbe;$this->setIsUpdated();}return true;}public function setIsLocked($v1945c9a2a5e2ba6133f1db6757a35fcb) {if ($this->is_locked !== ((bool) $v1945c9a2a5e2ba6133f1db6757a35fcb)) {$this->is_locked = (bool) $v1945c9a2a5e2ba6133f1db6757a35fcb;$this->setIsUpdated();}}public function setOwnerId($vb0ab4f7791b60b1e8ea01057b77873b0) {if(!is_null($vb0ab4f7791b60b1e8ea01057b77873b0) and umiObjectsCollection::getInstance()->isExists($vb0ab4f7791b60b1e8ea01057b77873b0)) {if ($this->owner_id !== $vb0ab4f7791b60b1e8ea01057b77873b0) {$this->owner_id = $vb0ab4f7791b60b1e8ea01057b77873b0;$this->setIsUpdated();}return true;}else {if (!is_null($this->owner_id)) {$this->owner_id = NULL;$this->setIsUpdated();}return false;}}public function getOwnerId() {return $this->owner_id;}public function isFilled() {$vd05b6ed7d2345020440df396d6da7f73 = $this->type->getAllFields();foreach($vd05b6ed7d2345020440df396d6da7f73 as $v06e3d36fa30cea095545139854ad1fb9)    if($v06e3d36fa30cea095545139854ad1fb9->getIsRequired() && is_null($this->getValue($v06e3d36fa30cea095545139854ad1fb9->getName())))      return false;return true;}protected function save() {if ($this->is_updated) {$vb068931cc450442b63f5b3d276ea4297 = umiObjectProperty::filterInputString($this->name);$v94757cae63fd3e398c0811a976dd6bbe = (int) $this->type_id;$v1945c9a2a5e2ba6133f1db6757a35fcb = (int) $this->is_locked;$v5e7b19364b8de2dedd3aa48cf62706e3 = (int) $this->owner_id;$vac5c74b64b4b8352ef2f181affb5ac2a = "START TRANSACTION /* Updating object #{$this->id} info */";$result = l_mysql_query($vac5c74b64b4b8352ef2f181affb5ac2a);if($v56bd7107802ebe56c6918992f0608ec6 = mysql_error()) {throw new coreException($v56bd7107802ebe56c6918992f0608ec6);}$vc200d1cdcad0901ed1f5100f96a16c1e = $vb068931cc450442b63f5b3d276ea4297 ? "'{$vb068931cc450442b63f5b3d276ea4297}'" : "NULL";$vac5c74b64b4b8352ef2f181affb5ac2a = "UPDATE cms3_objects SET name = {$vc200d1cdcad0901ed1f5100f96a16c1e}, type_id = '{$v94757cae63fd3e398c0811a976dd6bbe}', is_locked = '{$v1945c9a2a5e2ba6133f1db6757a35fcb}', owner_id = '{$v5e7b19364b8de2dedd3aa48cf62706e3}' WHERE id = '{$this->id}'";l_mysql_query($vac5c74b64b4b8352ef2f181affb5ac2a);if($v56bd7107802ebe56c6918992f0608ec6 = mysql_error()) {throw new coreException($v56bd7107802ebe56c6918992f0608ec6);}foreach($this->properties as $v23a5b8ab834cb5140fa6665622eb6417) {if(is_object($v23a5b8ab834cb5140fa6665622eb6417)) $v23a5b8ab834cb5140fa6665622eb6417->commit();}$vac5c74b64b4b8352ef2f181affb5ac2a = "COMMIT";l_mysql_query($vac5c74b64b4b8352ef2f181affb5ac2a);if($v56bd7107802ebe56c6918992f0608ec6 = mysql_error()) {throw new coreException($v56bd7107802ebe56c6918992f0608ec6);}$this->setIsUpdated(false);}return true;}protected function loadInfo() {$vac5c74b64b4b8352ef2f181affb5ac2a = "SELECT SQL_CACHE name, type_id, is_locked, owner_id FROM cms3_objects WHERE id = '{$this->id}'";$result = l_mysql_query($vac5c74b64b4b8352ef2f181affb5ac2a, true);if($v56bd7107802ebe56c6918992f0608ec6 = mysql_error()) {cacheFrontend::getInstance()->del($va8cfde6331bd59eb2ac96f8911c4b666->getId(), "object");throw new coreException($v56bd7107802ebe56c6918992f0608ec6);return false;}if(list($vb068931cc450442b63f5b3d276ea4297, $v94757cae63fd3e398c0811a976dd6bbe, $v1945c9a2a5e2ba6133f1db6757a35fcb, $v5e7b19364b8de2dedd3aa48cf62706e3) = mysql_fetch_row($result)) {if(!$v94757cae63fd3e398c0811a976dd6bbe) {umiObjectsCollection::getInstance()->delObject($this->id);return false;}$this->name = $vb068931cc450442b63f5b3d276ea4297;$this->type_id = (int) $v94757cae63fd3e398c0811a976dd6bbe;$this->is_locked = (bool) $v1945c9a2a5e2ba6133f1db6757a35fcb;$this->owner_id = (int) $v5e7b19364b8de2dedd3aa48cf62706e3;return $this->loadType();}else {throw new coreException("Object #{$this->id} doesn't exists");return false;}}private function loadType() {$v599dcce2998a6b40b1e38e8c6006cb0a = umiObjectTypesCollection::getInstance()->getType($this->type_id);if(!$v599dcce2998a6b40b1e38e8c6006cb0a) {throw new coreException("Can't load type in object's init");}$this->type = $v599dcce2998a6b40b1e38e8c6006cb0a;return $this->loadProperties();}private function loadProperties() {$v599dcce2998a6b40b1e38e8c6006cb0a = $this->type;$v041f36f9e13e5473c5b995506bad2aaa = $v599dcce2998a6b40b1e38e8c6006cb0a->getFieldsGroupsList();foreach($v041f36f9e13e5473c5b995506bad2aaa as $vdb0f6f37ebeb6ea09489124345af2a45) {if($vdb0f6f37ebeb6ea09489124345af2a45->getIsActive() == false) continue;$vd05b6ed7d2345020440df396d6da7f73 = $vdb0f6f37ebeb6ea09489124345af2a45->getFields();$this->prop_groups[$vdb0f6f37ebeb6ea09489124345af2a45->getId()] = Array();foreach($vd05b6ed7d2345020440df396d6da7f73 as $v06e3d36fa30cea095545139854ad1fb9) {$this->properties[$v06e3d36fa30cea095545139854ad1fb9->getId()] = $v06e3d36fa30cea095545139854ad1fb9->getName();$this->prop_groups[$vdb0f6f37ebeb6ea09489124345af2a45->getId()][] = $v06e3d36fa30cea095545139854ad1fb9->getId();}}}public function getPropByName($vdfc394bd05a4b48161c790034af522a8) {$vdfc394bd05a4b48161c790034af522a8 = strtolower($vdfc394bd05a4b48161c790034af522a8);foreach($this->properties as $v3aabf39f2d943fa886d86dcbbee4d910 => $v23a5b8ab834cb5140fa6665622eb6417) {if(is_object($v23a5b8ab834cb5140fa6665622eb6417)) {if($v23a5b8ab834cb5140fa6665622eb6417->getName() == $vdfc394bd05a4b48161c790034af522a8) {return $v23a5b8ab834cb5140fa6665622eb6417;}}else {if(strtolower($v23a5b8ab834cb5140fa6665622eb6417) == $vdfc394bd05a4b48161c790034af522a8) {$v23a5b8ab834cb5140fa6665622eb6417 = cacheFrontend::getInstance()->load($this->id . "." . $v3aabf39f2d943fa886d86dcbbee4d910, "property");if($v23a5b8ab834cb5140fa6665622eb6417 instanceof umiObjectProperty == false) {$v23a5b8ab834cb5140fa6665622eb6417 = umiObjectProperty::getProperty($this->id, $v3aabf39f2d943fa886d86dcbbee4d910, $this->type_id);cacheFrontend::getInstance()->save($v23a5b8ab834cb5140fa6665622eb6417, "property");}$this->properties[$v3aabf39f2d943fa886d86dcbbee4d910] = $v23a5b8ab834cb5140fa6665622eb6417;return $v23a5b8ab834cb5140fa6665622eb6417;}}}return NULL;}public function getPropById($v3aabf39f2d943fa886d86dcbbee4d910) {if(!$this->isPropertyExists($v3aabf39f2d943fa886d86dcbbee4d910)) {return NULL;}else {if(!is_object($this->properties)) {$this->properties[$v3aabf39f2d943fa886d86dcbbee4d910] = umiObjectProperty::getProperty($this->id, $v3aabf39f2d943fa886d86dcbbee4d910, $this->type_id);}return $this->properties[$v3aabf39f2d943fa886d86dcbbee4d910];}}public function isPropertyExists($v3aabf39f2d943fa886d86dcbbee4d910) {return (bool) array_key_exists($v3aabf39f2d943fa886d86dcbbee4d910, $this->properties);}public function isPropGroupExists($vb78a51df08ebf5c0b87001c180e3c2ab) {return (bool) array_key_exists($vb78a51df08ebf5c0b87001c180e3c2ab, $this->prop_groups);}public function getPropGroupId($v630d7459cbc61bfef50b1a0fff2ea42e) {$v041f36f9e13e5473c5b995506bad2aaa = $this->getType()->getFieldsGroupsList();foreach($v041f36f9e13e5473c5b995506bad2aaa as $vdb0f6f37ebeb6ea09489124345af2a45) {if($vdb0f6f37ebeb6ea09489124345af2a45->getName() == $v630d7459cbc61bfef50b1a0fff2ea42e) {return $vdb0f6f37ebeb6ea09489124345af2a45->getId();}}return false;}public function getPropGroupByName($v630d7459cbc61bfef50b1a0fff2ea42e) {$v041f36f9e13e5473c5b995506bad2aaa = $this->type->getFieldsGroupsList();if($v0e939a4ffd3aacd724dd3b50147b4353 = $this->getPropGroupId($v630d7459cbc61bfef50b1a0fff2ea42e)) {return $this->getPropGroupById($v0e939a4ffd3aacd724dd3b50147b4353);}else {return false;}}public function getPropGroupById($vb78a51df08ebf5c0b87001c180e3c2ab) {if($this->isPropGroupExists($vb78a51df08ebf5c0b87001c180e3c2ab)) {return $this->prop_groups[$vb78a51df08ebf5c0b87001c180e3c2ab];}else {return false;}}public function getValue($vdfc394bd05a4b48161c790034af522a8, $v21ffce5b8a6cc8cc6a41448dd69623c9 = NULL) {if($v23a5b8ab834cb5140fa6665622eb6417 = $this->getPropByName($vdfc394bd05a4b48161c790034af522a8)) {return $v23a5b8ab834cb5140fa6665622eb6417->getValue($v21ffce5b8a6cc8cc6a41448dd69623c9);}else {return false;}}public function setValue($vdfc394bd05a4b48161c790034af522a8, $v2771be291c4a714ca95fd1f45a32403e) {if($v23a5b8ab834cb5140fa6665622eb6417 = $this->getPropByName($vdfc394bd05a4b48161c790034af522a8)) {$this->setIsUpdated();return $v23a5b8ab834cb5140fa6665622eb6417->setValue($v2771be291c4a714ca95fd1f45a32403e);}else {return false;}}public function commit() {l_mysql_query("START TRANSACTION /* Saving object {$this->id} */");$v3c9c288f4021bd9f84c98cc0eddd1838 = umiObjectProperty::$USE_TRANSACTIONS;umiObjectProperty::$USE_TRANSACTIONS = false;if($this->checkSelf()) {foreach($this->properties as $v23a5b8ab834cb5140fa6665622eb6417) {if(is_object($v23a5b8ab834cb5140fa6665622eb6417)) {$v23a5b8ab834cb5140fa6665622eb6417->commit();}}}parent::commit();l_mysql_query("COMMIT");umiObjectProperty::$USE_TRANSACTIONS = $v3c9c288f4021bd9f84c98cc0eddd1838;}public function checkSelf() {static $v9b207167e5381c47682c6b4f58a623fb;if($v9b207167e5381c47682c6b4f58a623fb !== null) {return $v9b207167e5381c47682c6b4f58a623fb;}if(!cacheFrontend::getInstance()->getIsConnected()) {return $v9b207167e5381c47682c6b4f58a623fb = true;}$vac5c74b64b4b8352ef2f181affb5ac2a = "SELECT id FROM cms3_objects WHERE id = '{$this->id}'";$result = l_mysql_query($vac5c74b64b4b8352ef2f181affb5ac2a);if($v56bd7107802ebe56c6918992f0608ec6 = mysql_error()) {throw new coreException($v56bd7107802ebe56c6918992f0608ec6);}$v9b207167e5381c47682c6b4f58a623fb = (bool) mysql_num_rows($result);if(!$v9b207167e5381c47682c6b4f58a623fb) {cacheFrontend::getInstance()->flush();}return $v9b207167e5381c47682c6b4f58a623fb;}public function setIsUpdated($v8de61324edc43f3acb1b73da3c63e89e = true) {umiObjectsCollection::getInstance()->addUpdatedObjectId($this->id);return parent::setIsUpdated($v8de61324edc43f3acb1b73da3c63e89e);}public function delete() {umiObjectsCollection::getInstance()->delObject($this->id);}public function __get($v51746fc9cfaaf892e94c2d56d7508b37) {switch($v51746fc9cfaaf892e94c2d56d7508b37) {case "id":  return $this->id;case "name": return $this->getName();case "ownerId": return $this->getOwnerId();case "typeId": return $this->getTypeId();case "xlink": return 'uobject://' . $this->id;default:  return $this->getValue($v51746fc9cfaaf892e94c2d56d7508b37);}}public function __set($v51746fc9cfaaf892e94c2d56d7508b37, $v2063c1608d6e0baf80249c42e2be5804) {switch($v51746fc9cfaaf892e94c2d56d7508b37) {case "id":  throw new coreException("Object id could not be changed");case "name": return $this->setName($v2063c1608d6e0baf80249c42e2be5804);case "ownerId": return $this->setOwnerId($v2063c1608d6e0baf80249c42e2be5804);default:  return $this->setValue($v51746fc9cfaaf892e94c2d56d7508b37, $v2063c1608d6e0baf80249c42e2be5804);}}public function beforeSerialize($v324b23d9adc662d7f9e99634ed47ab65 = false) {static $vd14a8022b085f9ef19d479cbdd581127 = array();if($v324b23d9adc662d7f9e99634ed47ab65 && isset($vd14a8022b085f9ef19d479cbdd581127[$this->type_id])) {$result = $vd14a8022b085f9ef19d479cbdd581127[$this->type_id];unset($vd14a8022b085f9ef19d479cbdd581127[$this->type_id]);return $result;}$vd14a8022b085f9ef19d479cbdd581127[$this->type_id] = $this->type;$this->type = null;}public function afterSerialize() {$this->beforeSerialize(true);}public function afterUnSerialize() {$this->getType();}public function getModule() {return $this->type->getModule();}public function getMethod() {return $this->type->getMethod();}}?>