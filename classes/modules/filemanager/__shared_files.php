<?php
 abstract class __shared_files extends baseModuleAdmin {public function shared_files() {$this->setDataType("list");$this->setActionType("view");if($this->ifNotXmlMode()) return $this->doData();$v9d85c254b5062e518a134a61950999c3 = 20;$ve1ba980ce14a8c0d7e2779f895ab8695 = getRequest('p');$v6942e8fa62b3cc9d93881a58210e2fd7 = umiHierarchyTypesCollection::getInstance();$v0715f6d9497f93911417c9c324265771 = $v6942e8fa62b3cc9d93881a58210e2fd7->getTypeByName("filemanager", "shared_file")->getId();$v8be74552df93e31bbdd6b36ed74bdb6a = new umiSelection;$v8be74552df93e31bbdd6b36ed74bdb6a->addLimit($v9d85c254b5062e518a134a61950999c3, $ve1ba980ce14a8c0d7e2779f895ab8695);$v8be74552df93e31bbdd6b36ed74bdb6a->addElementType($v0715f6d9497f93911417c9c324265771);$this->autoDetectAllFilters($v8be74552df93e31bbdd6b36ed74bdb6a);$v8be74552df93e31bbdd6b36ed74bdb6a->addPermissions();$result = umiSelectionsParser::runSelection($v8be74552df93e31bbdd6b36ed74bdb6a);$vfbb44b4487415b134bce9c790a27fe5e = umiSelectionsParser::runSelectionCounts($v8be74552df93e31bbdd6b36ed74bdb6a);$this->setDataType("list");$this->setActionType("view");$this->setDataRange($v9d85c254b5062e518a134a61950999c3, $ve1ba980ce14a8c0d7e2779f895ab8695 * $v9d85c254b5062e518a134a61950999c3);$v8d777f385d3dfec8815d20f7496026dc = $this->prepareData($result, "pages");$this->setData($v8d777f385d3dfec8815d20f7496026dc, $vfbb44b4487415b134bce9c790a27fe5e);return $this->doData();}public function shared_file_activity() {$v6a7f245843454cf4f28ad7c5e2572aa2 = getRequest('element');if(!is_array($v6a7f245843454cf4f28ad7c5e2572aa2)) {$v6a7f245843454cf4f28ad7c5e2572aa2 = Array($v6a7f245843454cf4f28ad7c5e2572aa2);}$v4264c638e0098acb172519b0436db099 = getRequest('active');foreach($v6a7f245843454cf4f28ad7c5e2572aa2 as $v7552cd149af7495ee7d8225974e50f80) {$v8e2dcfd7e7e24b1ca76c1193f645902b = $this->expectElement($v7552cd149af7495ee7d8225974e50f80, false, true);$v21ffce5b8a6cc8cc6a41448dd69623c9 = Array(     "element" => $v8e2dcfd7e7e24b1ca76c1193f645902b,     "allowed-element-types" => Array('shared_file'),     "activity" => $v4264c638e0098acb172519b0436db099    );$this->switchActivity($v21ffce5b8a6cc8cc6a41448dd69623c9);$v8e2dcfd7e7e24b1ca76c1193f645902b->commit();}$this->setDataType("list");$this->setActionType("view");$v8d777f385d3dfec8815d20f7496026dc = $this->prepareData($v6a7f245843454cf4f28ad7c5e2572aa2, "pages");$this->setData($v8d777f385d3dfec8815d20f7496026dc);return $this->doData();}public function add_shared_file() {$v599dcce2998a6b40b1e38e8c6006cb0a = "shared_file";$v15d61712450a686a7f365adf4fef581f = (string) getRequest("param0");$v8c7dd922ad47494fc02c388e12c00eac = getRequest("file");$ve62e4d22f2d8630f6e44e2b7c3f70ddc = Array( "type" => $v599dcce2998a6b40b1e38e8c6006cb0a,      "parent" => 0,      "allowed-element-types" => Array('shared_file'));if($v15d61712450a686a7f365adf4fef581f == "do") {$v7057e8409c7c531a1a6e9ac3df4ed549 = $this->saveAddedElementData($ve62e4d22f2d8630f6e44e2b7c3f70ddc);$v8e2dcfd7e7e24b1ca76c1193f645902b = umiHierarchy::getInstance()->getElement($v7057e8409c7c531a1a6e9ac3df4ed549);if(getRequest("select_fs_file")) {$v455023b47067adcd938d2581a0dbdf20 = getRequest("fs_dest_folder") . "/" . getRequest("select_fs_file");$v3b569bcd1bf089908a7a85ead9f9ab9a = new umiFile($v455023b47067adcd938d2581a0dbdf20);$v8e2dcfd7e7e24b1ca76c1193f645902b->setValue("fs_file", $v3b569bcd1bf089908a7a85ead9f9ab9a);$v8e2dcfd7e7e24b1ca76c1193f645902b->commit();}$this->chooseRedirect();}$this->setDataType("form");$this->setActionType("create");$v8d777f385d3dfec8815d20f7496026dc = $this->prepareData($ve62e4d22f2d8630f6e44e2b7c3f70ddc, "page");$this->setData($v8d777f385d3dfec8815d20f7496026dc);return $this->doData();}public function edit_shared_file() {$v8e2dcfd7e7e24b1ca76c1193f645902b = $this->expectElement("param0");$v15d61712450a686a7f365adf4fef581f = (String) getRequest('param1');$ve62e4d22f2d8630f6e44e2b7c3f70ddc = Array(    "element" => $v8e2dcfd7e7e24b1ca76c1193f645902b,    "allowed-element-types" => Array('shared_file')   );if($v15d61712450a686a7f365adf4fef581f == "do") {$va8cfde6331bd59eb2ac96f8911c4b666 = $this->saveEditedElementData($ve62e4d22f2d8630f6e44e2b7c3f70ddc);$this->chooseRedirect();}$this->setDataType("form");$this->setActionType("modify");$v8d777f385d3dfec8815d20f7496026dc = $this->prepareData($ve62e4d22f2d8630f6e44e2b7c3f70ddc, "page");$this->setData($v8d777f385d3dfec8815d20f7496026dc);return $this->doData();}public function del_shared_file() {$v6a7f245843454cf4f28ad7c5e2572aa2 = getRequest('element');if(!is_array($v6a7f245843454cf4f28ad7c5e2572aa2)) {$v6a7f245843454cf4f28ad7c5e2572aa2 = Array($v6a7f245843454cf4f28ad7c5e2572aa2);}foreach($v6a7f245843454cf4f28ad7c5e2572aa2 as $v7552cd149af7495ee7d8225974e50f80) {$v8e2dcfd7e7e24b1ca76c1193f645902b = $this->expectElement($v7552cd149af7495ee7d8225974e50f80, false, true);$v21ffce5b8a6cc8cc6a41448dd69623c9 = Array(        "element" => $v8e2dcfd7e7e24b1ca76c1193f645902b,        "allowed-element-types" => Array('shared_file')       );$this->deleteElement($v21ffce5b8a6cc8cc6a41448dd69623c9);}$this->setDataType("list");$this->setActionType("view");$v8d777f385d3dfec8815d20f7496026dc = $this->prepareData($v6a7f245843454cf4f28ad7c5e2572aa2, "pages");$this->setData($v8d777f385d3dfec8815d20f7496026dc);return $this->doData();}};?>