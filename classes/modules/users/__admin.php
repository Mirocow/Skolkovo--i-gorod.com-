<?php
 abstract class __users extends baseModuleAdmin {public function users_list_all() {return $this->users_list(true);}public function users_list($v0e939a4ffd3aacd724dd3b50147b4353 = false) {$this->setDataType("list");$this->setActionType("view");if($this->ifNotXmlMode()) return $this->doData();$vaa9f73eea60a006820d0f8768bc8a3fc = 20;$ve1ba980ce14a8c0d7e2779f895ab8695 = (int) getRequest('p');$v7a86c157ee9713c34fbd7a1ee40f0c5a = $vaa9f73eea60a006820d0f8768bc8a3fc * $ve1ba980ce14a8c0d7e2779f895ab8695;$v8be74552df93e31bbdd6b36ed74bdb6a = new selector('objects');$v8be74552df93e31bbdd6b36ed74bdb6a->types('object-type')->name('users', 'user');$v8be74552df93e31bbdd6b36ed74bdb6a->limit($v7a86c157ee9713c34fbd7a1ee40f0c5a, $vaa9f73eea60a006820d0f8768bc8a3fc);if(getRequest('param0') == 'outgroup') {$v8be74552df93e31bbdd6b36ed74bdb6a->where('groups')->isnull(true);}else {if($v47db2588331bbe530c80dd001fc60aed = $this->expectObjectId('param0')) {$v8be74552df93e31bbdd6b36ed74bdb6a->where('groups')->equals($v47db2588331bbe530c80dd001fc60aed);}}if($ve619dccee03babaae05746d2735aa703 = getRequest('search')) {$v8be74552df93e31bbdd6b36ed74bdb6a->where('login')->like('%' . $ve619dccee03babaae05746d2735aa703 . '%');}selectorHelper::detectFilters($v8be74552df93e31bbdd6b36ed74bdb6a);$this->setDataRange($vaa9f73eea60a006820d0f8768bc8a3fc, $v7a86c157ee9713c34fbd7a1ee40f0c5a);$v8d777f385d3dfec8815d20f7496026dc = $this->prepareData($v8be74552df93e31bbdd6b36ed74bdb6a->result, "objects");$this->setData($v8d777f385d3dfec8815d20f7496026dc, $v8be74552df93e31bbdd6b36ed74bdb6a->length);return $this->doData();}public function groups_list() {$this->setDataType("list");$this->setActionType("view");if($this->ifNotXmlMode()) return $this->doData();$vaa9f73eea60a006820d0f8768bc8a3fc = 20;$ve1ba980ce14a8c0d7e2779f895ab8695 = (int) getRequest('p');$v7a86c157ee9713c34fbd7a1ee40f0c5a = $vaa9f73eea60a006820d0f8768bc8a3fc * $ve1ba980ce14a8c0d7e2779f895ab8695;$v8be74552df93e31bbdd6b36ed74bdb6a = new selector('objects');$v8be74552df93e31bbdd6b36ed74bdb6a->types('object-type')->name('users', 'users');$v8be74552df93e31bbdd6b36ed74bdb6a->limit($v7a86c157ee9713c34fbd7a1ee40f0c5a, $vaa9f73eea60a006820d0f8768bc8a3fc);selectorHelper::detectFilters($v8be74552df93e31bbdd6b36ed74bdb6a);$this->setDataRange($vaa9f73eea60a006820d0f8768bc8a3fc, $v7a86c157ee9713c34fbd7a1ee40f0c5a);$v8d777f385d3dfec8815d20f7496026dc = $this->prepareData($v8be74552df93e31bbdd6b36ed74bdb6a->result, "objects");$this->setData($v8d777f385d3dfec8815d20f7496026dc, $v8be74552df93e31bbdd6b36ed74bdb6a->length);return $this->doData();}public function add() {$v599dcce2998a6b40b1e38e8c6006cb0a = (string) getRequest('param0');$v15d61712450a686a7f365adf4fef581f = (string) getRequest('param1');$this->setHeaderLabel("header-users-add-" . $v599dcce2998a6b40b1e38e8c6006cb0a);$ve62e4d22f2d8630f6e44e2b7c3f70ddc = array(    'type'     => $v599dcce2998a6b40b1e38e8c6006cb0a,    'type-id'     => getRequest('type-id'),    'aliases'    => array('name' => 'login'),    'allowed-element-types' => array('user', 'users')   );if($v15d61712450a686a7f365adf4fef581f == "do") {$va8cfde6331bd59eb2ac96f8911c4b666 = $this->saveAddedObjectData($ve62e4d22f2d8630f6e44e2b7c3f70ddc);$permissions = permissionsCollection::getInstance();$permissions = permissionsCollection::getInstance();if(!$permissions->isSv($permissions->getUserId())) {$v1471e4e05a4db95d353cc867fe317314 = $va8cfde6331bd59eb2ac96f8911c4b666->getValue("groups");if(in_array(SV_GROUP_ID, $v1471e4e05a4db95d353cc867fe317314)) {unset($v1471e4e05a4db95d353cc867fe317314[array_search(SV_GROUP_ID, $v1471e4e05a4db95d353cc867fe317314)]);$va8cfde6331bd59eb2ac96f8911c4b666->setValue("groups", $v1471e4e05a4db95d353cc867fe317314);}}$va8cfde6331bd59eb2ac96f8911c4b666->setValue('user_dock', 'content,news,blogs20,forum,comments,vote,webforms,photoalbum,faq,dispatches,catalog,eshop,banners,users,stat,trash');$va8cfde6331bd59eb2ac96f8911c4b666->commit();$this->save_perms($va8cfde6331bd59eb2ac96f8911c4b666->getId());$permissions->setAllElementsDefaultPermissions($va8cfde6331bd59eb2ac96f8911c4b666->getId());$this->chooseRedirect($this->pre_lang . '/admin/users/edit/' . $va8cfde6331bd59eb2ac96f8911c4b666->getId() . '/');}$this->setDataType("form");$this->setActionType("create");$v8d777f385d3dfec8815d20f7496026dc = $this->prepareData($ve62e4d22f2d8630f6e44e2b7c3f70ddc, "object");$this->setData($v8d777f385d3dfec8815d20f7496026dc);return $this->doData();}public function edit() {$va8cfde6331bd59eb2ac96f8911c4b666 = $this->expectObject("param0", true);$v15d61712450a686a7f365adf4fef581f = (string) getRequest('param1');$v16b2b26000987faccb260b9d39df1269 = $va8cfde6331bd59eb2ac96f8911c4b666->getId();$this->setHeaderLabel("header-users-edit-" . $this->getObjectTypeMethod($va8cfde6331bd59eb2ac96f8911c4b666));$this->checkSv($v16b2b26000987faccb260b9d39df1269);$ve62e4d22f2d8630f6e44e2b7c3f70ddc = Array( "object" => $va8cfde6331bd59eb2ac96f8911c4b666,      "aliases" => Array("name" => "login"),      "allowed-element-types" => Array('users', 'user')   );if($v15d61712450a686a7f365adf4fef581f == "do") {if(isset($_REQUEST['data'][$v16b2b26000987faccb260b9d39df1269]['login'])) {if(!$this->checkIsUniqueLogin($_REQUEST['data'][$v16b2b26000987faccb260b9d39df1269]['login'], $v16b2b26000987faccb260b9d39df1269)) {$this->errorNewMessage(getLabel("error-users-non-unique-login"));$this->errorPanic();}}$va8cfde6331bd59eb2ac96f8911c4b666 = $this->saveEditedObjectData($ve62e4d22f2d8630f6e44e2b7c3f70ddc);$v16b2b26000987faccb260b9d39df1269 = $va8cfde6331bd59eb2ac96f8911c4b666->getId();if(isset($_REQUEST['data'][$v16b2b26000987faccb260b9d39df1269]['password'][0])) {$v5f4dcc3b5aa765d61d8327deb882cf99 = $_REQUEST['data'][$v16b2b26000987faccb260b9d39df1269]['password'][0];}else {$v5f4dcc3b5aa765d61d8327deb882cf99 = false;}$permissions = permissionsCollection::getInstance();$v92ad7554e2e0d208f33729db6d54b59b = $permissions->getGuestId();$v8e44f0089b076e18a718eb9ca3d94674 = $permissions->getUserId();if($va8cfde6331bd59eb2ac96f8911c4b666->getId() == $v8e44f0089b076e18a718eb9ca3d94674) {if($v5f4dcc3b5aa765d61d8327deb882cf99) {$_SESSION['cms_pass'] = $va8cfde6331bd59eb2ac96f8911c4b666->password;}}if(in_array($va8cfde6331bd59eb2ac96f8911c4b666->getId(), array($v8e44f0089b076e18a718eb9ca3d94674, $v92ad7554e2e0d208f33729db6d54b59b, SV_USER_ID))) {if(!$va8cfde6331bd59eb2ac96f8911c4b666->is_activated) {$va8cfde6331bd59eb2ac96f8911c4b666->is_activated = true;$va8cfde6331bd59eb2ac96f8911c4b666->commit();}}$this->save_perms($v16b2b26000987faccb260b9d39df1269);$this->chooseRedirect();}$this->setDataType("form");$this->setActionType("modify");$v8d777f385d3dfec8815d20f7496026dc = $this->prepareData($ve62e4d22f2d8630f6e44e2b7c3f70ddc, "object");$this->setData($v8d777f385d3dfec8815d20f7496026dc);return $this->doData();}public function del() {$v5891da2d64975cae48d175d1e001f5da = getRequest('element');if(!is_array($v5891da2d64975cae48d175d1e001f5da)) {$v5891da2d64975cae48d175d1e001f5da = Array($v5891da2d64975cae48d175d1e001f5da);}foreach($v5891da2d64975cae48d175d1e001f5da as $v16b2b26000987faccb260b9d39df1269) {$va8cfde6331bd59eb2ac96f8911c4b666 = $this->expectObject($v16b2b26000987faccb260b9d39df1269, false, true);if(!$va8cfde6331bd59eb2ac96f8911c4b666) continue;$this->checkSv($va8cfde6331bd59eb2ac96f8911c4b666->getId());$vaf31437ce61345f416579830a98c91e5 = $va8cfde6331bd59eb2ac96f8911c4b666->getId();if($vaf31437ce61345f416579830a98c91e5 == SV_GROUP_ID) {throw new publicAdminException(getLabel('error-sv-group-delete'));}if($vaf31437ce61345f416579830a98c91e5 == SV_USER_ID) {throw new publicAdminException(getLabel('error-sv-user-delete'));}$vb1444fb0c07653567ad325aa25d4e37a = regedit::getInstance();if($vaf31437ce61345f416579830a98c91e5 == $vb1444fb0c07653567ad325aa25d4e37a->getVal("//modules/users/guest_id")) {throw new publicAdminException(getLabel('error-guest-user-delete'));}if($vaf31437ce61345f416579830a98c91e5 == $vb1444fb0c07653567ad325aa25d4e37a->getVal("//modules/users/def_group")) {throw new publicAdminException(getLabel('error-sv-group-delete'));}if($vaf31437ce61345f416579830a98c91e5 == permissionsCollection::getInstance()->getUserId()) {throw new publicAdminException(getLabel('error-delete-yourself'));}$v21ffce5b8a6cc8cc6a41448dd69623c9 = Array(     'object'  => $va8cfde6331bd59eb2ac96f8911c4b666,     'allowed-element-types' => Array('user', 'users')    );$this->deleteObject($v21ffce5b8a6cc8cc6a41448dd69623c9);}$this->setDataType("list");$this->setActionType("view");$v8d777f385d3dfec8815d20f7496026dc = $this->prepareData($v5891da2d64975cae48d175d1e001f5da, "objects");$this->setData($v8d777f385d3dfec8815d20f7496026dc);return $this->doData();}public function activity() {$v5891da2d64975cae48d175d1e001f5da = getRequest('object');if(!is_array($v5891da2d64975cae48d175d1e001f5da)) {$v5891da2d64975cae48d175d1e001f5da = Array($v5891da2d64975cae48d175d1e001f5da);}$v4264c638e0098acb172519b0436db099 = (bool) getRequest('active');foreach($v5891da2d64975cae48d175d1e001f5da as $v16b2b26000987faccb260b9d39df1269) {$va8cfde6331bd59eb2ac96f8911c4b666 = $this->expectObject($v16b2b26000987faccb260b9d39df1269, false, true);$this->checkSv($v16b2b26000987faccb260b9d39df1269);if(!$v4264c638e0098acb172519b0436db099) {if($v16b2b26000987faccb260b9d39df1269 == SV_USER_ID) {throw new publicAdminException(getLabel('error-sv-user-activity'));}$vb1444fb0c07653567ad325aa25d4e37a = regedit::getInstance();if($v16b2b26000987faccb260b9d39df1269 == $vb1444fb0c07653567ad325aa25d4e37a->getVal("//modules/users/guest_id")) {throw new publicAdminException(getLabel('error-guest-user-activity'));}}$va8cfde6331bd59eb2ac96f8911c4b666->setValue("is_activated", $v4264c638e0098acb172519b0436db099);$va8cfde6331bd59eb2ac96f8911c4b666->commit();}$this->setDataType("list");$this->setActionType("view");$v8d777f385d3dfec8815d20f7496026dc = $this->prepareData($v5891da2d64975cae48d175d1e001f5da, "objects");$this->setData($v8d777f385d3dfec8815d20f7496026dc);return $this->doData();}public function getPermissionsOwners() {$this->flushAsXML("getPermissionsOwners");$v7f2db423a49b305459147332fb01cf87 = outputBuffer::current();$v5891da2d64975cae48d175d1e001f5da = umiObjectsCollection::getInstance();$v0e8133eb006c0f85ed9444ae07a60842 = umiObjectTypesCollection::getInstance();$v68e435576960d83c891fcb5072d73497 = $v0e8133eb006c0f85ed9444ae07a60842->getBaseType("users", "users");$v279dd2ff4023b5b9c664543d4721a42f = array(14, 15);$v8be74552df93e31bbdd6b36ed74bdb6a = new selector('objects');$v8be74552df93e31bbdd6b36ed74bdb6a->types('object-type')->name('users', 'users');$v8be74552df93e31bbdd6b36ed74bdb6a->types('object-type')->name('users', 'user');$v8be74552df93e31bbdd6b36ed74bdb6a->limit(0, 15);selectorHelper::detectFilters($v8be74552df93e31bbdd6b36ed74bdb6a);$v691d502cfd0e0626cd3b058e5682ad1c = array();foreach($v8be74552df93e31bbdd6b36ed74bdb6a as $va8cfde6331bd59eb2ac96f8911c4b666) {if(in_array($va8cfde6331bd59eb2ac96f8911c4b666->id, $v279dd2ff4023b5b9c664543d4721a42f)) continue;$v44dbba227f7ca8db21f9d6d74ecc34c3 = array();if($va8cfde6331bd59eb2ac96f8911c4b666->getTypeId() == $v68e435576960d83c891fcb5072d73497) {$v9bc65c2abec141778ffaa729489f3e87 = new selector('objects');$v9bc65c2abec141778ffaa729489f3e87->types('object-type')->name('users', 'user');$v9bc65c2abec141778ffaa729489f3e87->where('groups')->equals($va8cfde6331bd59eb2ac96f8911c4b666->id);$v9bc65c2abec141778ffaa729489f3e87->limit(0, 5);foreach($v9bc65c2abec141778ffaa729489f3e87 as $vee11cbb19052e40b07aac0ca060c23ee) {$v44dbba227f7ca8db21f9d6d74ecc34c3[] = array(       'attribute:id'  => $vee11cbb19052e40b07aac0ca060c23ee->id,       'attribute:name' => $vee11cbb19052e40b07aac0ca060c23ee->name,       'xlink:href'  => $vee11cbb19052e40b07aac0ca060c23ee->xlink      );}$v599dcce2998a6b40b1e38e8c6006cb0a = 'group';}else $v599dcce2998a6b40b1e38e8c6006cb0a = 'user';$v691d502cfd0e0626cd3b058e5682ad1c[] = array(     'attribute:id'  => $va8cfde6331bd59eb2ac96f8911c4b666->id,     'attribute:name' => $va8cfde6331bd59eb2ac96f8911c4b666->name,     'attribute:type' => $v599dcce2998a6b40b1e38e8c6006cb0a,     'xlink:href'  => $va8cfde6331bd59eb2ac96f8911c4b666->xlink,     'nodes:user'  => $v44dbba227f7ca8db21f9d6d74ecc34c3    );}return array(    'list' => array(     'nodes:owner' => $v691d502cfd0e0626cd3b058e5682ad1c    )   );}public function json_change_dock() {$v36a1b554eb8d3a46c8454ac350f5813f = getRequest('dock_panel');if ($v59435db0619ef2a263f89c07b89d3b40 = cmsController::getInstance()->getModule("users")) {$vbc8a7343779d62b3f0dc86f78848bde1 = $v59435db0619ef2a263f89c07b89d3b40->user_id;$v43bbebb781ee33ce5b5a1d36c838d545 = umiObjectsCollection::getInstance()->getObject($vbc8a7343779d62b3f0dc86f78848bde1);if ($v43bbebb781ee33ce5b5a1d36c838d545) {$v43bbebb781ee33ce5b5a1d36c838d545->setValue("user_dock", $v36a1b554eb8d3a46c8454ac350f5813f);$v43bbebb781ee33ce5b5a1d36c838d545->commit();}}header('HTTP/1.1 200 OK');header("Cache-Control: public, must-revalidate");header("Pragma: no-cache");header('Date: ' . date("D M j G:i:s T Y"));header('Last-Modified: ' . date("D M j G:i:s T Y"));header ("Content-type: text/javascript");exit();}public function checkSv ($v16b2b26000987faccb260b9d39df1269) {$va8cfde6331bd59eb2ac96f8911c4b666 = $this->expectObject($v16b2b26000987faccb260b9d39df1269, true, true);$v58f57b98cc8cfb81907179e9b4635762 = permissionsCollection::getInstance();$v8e44f0089b076e18a718eb9ca3d94674 = $v58f57b98cc8cfb81907179e9b4635762->getUserId();$v695a9f5f52f4fa95ed33cf7aea04e935 = $v58f57b98cc8cfb81907179e9b4635762->isSv ($va8cfde6331bd59eb2ac96f8911c4b666->getId());if ($v58f57b98cc8cfb81907179e9b4635762->isSv ($va8cfde6331bd59eb2ac96f8911c4b666->getId()) && !$v58f57b98cc8cfb81907179e9b4635762->isSv($v8e44f0089b076e18a718eb9ca3d94674)) {throw new publicAdminException (getLabel('error-break-action-with-sv'));}}public function getGroupUsersCount($v47db2588331bbe530c80dd001fc60aed = false) {$v0e8133eb006c0f85ed9444ae07a60842 = umiObjectTypesCollection::getInstance();$vb6c143ffc727fc7bdb927c1fb8946827 = $v0e8133eb006c0f85ed9444ae07a60842->getBaseType("users", "user");$v85bbdc878473eb44a8514e9747e74473 = $v0e8133eb006c0f85ed9444ae07a60842->getType($vb6c143ffc727fc7bdb927c1fb8946827);if($v85bbdc878473eb44a8514e9747e74473 instanceof umiObjectType == false) {throw new publicException("Can't load user object type");}$v8be74552df93e31bbdd6b36ed74bdb6a = new umiSelection;$v8be74552df93e31bbdd6b36ed74bdb6a->addObjectType($vb6c143ffc727fc7bdb927c1fb8946827);if($v47db2588331bbe530c80dd001fc60aed !== false) {if($v47db2588331bbe530c80dd001fc60aed != 0) {$v8be74552df93e31bbdd6b36ed74bdb6a->addPropertyFilterEqual($v85bbdc878473eb44a8514e9747e74473->getFieldId('groups'), $v47db2588331bbe530c80dd001fc60aed);}else {$v8be74552df93e31bbdd6b36ed74bdb6a->addPropertyFilterIsNull($v85bbdc878473eb44a8514e9747e74473->getFieldId('groups'));}}return umiSelectionsParser::runSelectionCounts($v8be74552df93e31bbdd6b36ed74bdb6a);}public function getDatasetConfiguration($veca07335a33c5aeb5e1bc7c98b4b9d80 = '') {if($veca07335a33c5aeb5e1bc7c98b4b9d80 == 'groups' || $veca07335a33c5aeb5e1bc7c98b4b9d80 === "users") {$v89ab96b2cae2569ced36d70f6866f57d = "groups_list";$v599dcce2998a6b40b1e38e8c6006cb0a       = 'users';$vc21f969b5f03d33d43e04f8f136e7682    = '';}else {$v89ab96b2cae2569ced36d70f6866f57d = $veca07335a33c5aeb5e1bc7c98b4b9d80 ? ('users_list/' . $veca07335a33c5aeb5e1bc7c98b4b9d80) : 'users_list_all';$v599dcce2998a6b40b1e38e8c6006cb0a       = 'user';$vc21f969b5f03d33d43e04f8f136e7682    = 'fname[99px]|lname[81px]|e-mail[96px]|groups[141px]|is_activated[100px]';}return array(     'methods' => array(      array('title'=>getLabel('smc-load'), 'forload'=>true,     'module'=>'users', '#__name'=>$v89ab96b2cae2569ced36d70f6866f57d),      array('title'=>getLabel('smc-delete'),           'module'=>'users', '#__name'=>'del', 'aliases' => 'tree_delete_element,delete,del'),      array('title'=>getLabel('smc-activity'),    'module'=>'users', '#__name'=>'activity', 'aliases' => 'tree_set_activity,activity'),      array('title'=>getLabel('smc-copy'), 'module'=>'content', '#__name'=>'tree_copy_element'),      array('title'=>getLabel('smc-move'),       'module'=>'content', '#__name'=>'tree_move_element'),      array('title'=>getLabel('smc-change-template'),        'module'=>'content', '#__name'=>'change_template'),      array('title'=>getLabel('smc-change-lang'),       'module'=>'content', '#__name'=>'move_to_lang')),     'types' => array(      array('common' => 'true', 'id' => $v599dcce2998a6b40b1e38e8c6006cb0a)     ),     'stoplist' => array('avatar', 'userpic', 'user_settings_data', 'user_dock', 'orders_refs', 'activate_code', 'password', 'last_request_time', 'login', 'is_online', 'delivery_addresses'),     'default' => $vc21f969b5f03d33d43e04f8f136e7682    );}public function onCreateObject($ve1671797c52e15f763380b45e841ec32) {$va8cfde6331bd59eb2ac96f8911c4b666 = $ve1671797c52e15f763380b45e841ec32->getRef('object');$v726e8e4809d4c1b28a6549d86436a124 = umiObjectTypesCollection::getInstance()->getType($va8cfde6331bd59eb2ac96f8911c4b666->getTypeId());if($v726e8e4809d4c1b28a6549d86436a124->getModule() != "users" || $v726e8e4809d4c1b28a6549d86436a124->getMethod() != "user") {return;}if(!isset($_REQUEST['data']['new']['login'])) {$_REQUEST['data']['new']['login'] = $_REQUEST['name'];}if($ve1671797c52e15f763380b45e841ec32->getMode() == "before") {$v8be74552df93e31bbdd6b36ed74bdb6a = new umiSelection;$v8be74552df93e31bbdd6b36ed74bdb6a->addLimit(1);$v8be74552df93e31bbdd6b36ed74bdb6a->addObjectType($v726e8e4809d4c1b28a6549d86436a124->getId());$v8be74552df93e31bbdd6b36ed74bdb6a->addNameFilterEquals((string) $_REQUEST['data']['new']['login']);if(umiSelectionsParser::runSelectionCounts($v8be74552df93e31bbdd6b36ed74bdb6a) > 1) {if($va8cfde6331bd59eb2ac96f8911c4b666 instanceof umiObject) {umiObjectsCollection::getInstance()->delObject($va8cfde6331bd59eb2ac96f8911c4b666->getId());}$this->errorRegisterFailPage($this->pre_lang . "/admin/users/add/user/");$this->errorNewMessage(getLabel('error-login-exists'), true);}}}public function onModifyObject(umiEventPoint $ve1671797c52e15f763380b45e841ec32) {static $v489691481302a37aa37f9dc818a74b54 = Array();$va8cfde6331bd59eb2ac96f8911c4b666 = $ve1671797c52e15f763380b45e841ec32->getRef('object');$v16b2b26000987faccb260b9d39df1269 = $va8cfde6331bd59eb2ac96f8911c4b666->getId();$v726e8e4809d4c1b28a6549d86436a124 = umiObjectTypesCollection::getInstance()->getType($va8cfde6331bd59eb2ac96f8911c4b666->getTypeId());if($v726e8e4809d4c1b28a6549d86436a124->getModule() != "users" || $v726e8e4809d4c1b28a6549d86436a124->getMethod() != "user") {return;}if($ve1671797c52e15f763380b45e841ec32->getMode() == "before") {$v489691481302a37aa37f9dc818a74b54[$v16b2b26000987faccb260b9d39df1269] = $va8cfde6331bd59eb2ac96f8911c4b666->getValue('groups');}if($ve1671797c52e15f763380b45e841ec32->getMode() == "after") {$permissions = permissionsCollection::getInstance();$v1b747442de0fb075fcdc59af978fa41b = $permissions->isSv($permissions->getUserId());if($v16b2b26000987faccb260b9d39df1269 == SV_USER_ID) {$va8cfde6331bd59eb2ac96f8911c4b666->setValue("groups", Array(SV_GROUP_ID));}else {$v1471e4e05a4db95d353cc867fe317314 = $va8cfde6331bd59eb2ac96f8911c4b666->getValue("groups");if(!$v1b747442de0fb075fcdc59af978fa41b) {if(in_array(SV_GROUP_ID, $v1471e4e05a4db95d353cc867fe317314) && !in_array(SV_GROUP_ID, $v489691481302a37aa37f9dc818a74b54[$v16b2b26000987faccb260b9d39df1269])) {unset($v1471e4e05a4db95d353cc867fe317314[array_search(SV_GROUP_ID, $v1471e4e05a4db95d353cc867fe317314)]);$va8cfde6331bd59eb2ac96f8911c4b666->setValue("groups", $v1471e4e05a4db95d353cc867fe317314);}else if (!in_array(SV_GROUP_ID, $v1471e4e05a4db95d353cc867fe317314) && in_array(SV_GROUP_ID, $v489691481302a37aa37f9dc818a74b54[$v16b2b26000987faccb260b9d39df1269])){$v1471e4e05a4db95d353cc867fe317314[] = SV_GROUP_ID;$va8cfde6331bd59eb2ac96f8911c4b666->setValue("groups", $v1471e4e05a4db95d353cc867fe317314);}}}$va8cfde6331bd59eb2ac96f8911c4b666->commit();}}};?>