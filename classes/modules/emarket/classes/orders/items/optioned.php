<?php
 class optionedOrderItem extends orderItem {protected $options = array();public function __construct(umiObject $va8cfde6331bd59eb2ac96f8911c4b666) {parent::__construct($va8cfde6331bd59eb2ac96f8911c4b666);$this->reloadOptions();}public function getOptions() {return $this->options;}public function appendOption($v9190e95d1c478aceb70ac5c82692a74c, $v5f966ba427f81d4e3b5c4f1735f63499, $v78a5eb43deef9a7b5b9ce157b9d52ac4 = false) {$v93da65a9fd0004d9477aeac024e08e15 = $this->object->options;if(!$v78a5eb43deef9a7b5b9ce157b9d52ac4) {$v78a5eb43deef9a7b5b9ce157b9d52ac4 = $this->getOptionPrice($v9190e95d1c478aceb70ac5c82692a74c, $v5f966ba427f81d4e3b5c4f1735f63499);}$v93da65a9fd0004d9477aeac024e08e15[] = array(    'varchar' => $v9190e95d1c478aceb70ac5c82692a74c,    'rel' => (string) $v5f966ba427f81d4e3b5c4f1735f63499,    'float' => $v78a5eb43deef9a7b5b9ce157b9d52ac4   );$this->object->options = $v93da65a9fd0004d9477aeac024e08e15;$this->reloadOptions();}public function removeOption($v9190e95d1c478aceb70ac5c82692a74c) {if(isset($this->options[$v9190e95d1c478aceb70ac5c82692a74c])) {$v5f966ba427f81d4e3b5c4f1735f63499 = $this->options[$v9190e95d1c478aceb70ac5c82692a74c];$v93da65a9fd0004d9477aeac024e08e15 = $this->object->options;foreach($v93da65a9fd0004d9477aeac024e08e15 as $v865c0c0b4ab0e063e5caa3387c1a8741 => $v5ecf0a02e02bd528df985f4f51a5af41) {if($v5ecf0a02e02bd528df985f4f51a5af41['varchar'] == $v9190e95d1c478aceb70ac5c82692a74c) {unset($v93da65a9fd0004d9477aeac024e08e15[$v865c0c0b4ab0e063e5caa3387c1a8741]);}}$this->object->options = $v93da65a9fd0004d9477aeac024e08e15;$this->reloadOptions();}}public function getItemPrice() {$v78a5eb43deef9a7b5b9ce157b9d52ac4 = parent::getItemPrice();$v93da65a9fd0004d9477aeac024e08e15 = $this->getOptions();foreach($v93da65a9fd0004d9477aeac024e08e15 as $v5ecf0a02e02bd528df985f4f51a5af41) {$v80336ccf4f1089c1f1d95f347a59baf4 = getArrayKey($v5ecf0a02e02bd528df985f4f51a5af41, 'price');if($v80336ccf4f1089c1f1d95f347a59baf4) {$v78a5eb43deef9a7b5b9ce157b9d52ac4 += (float) $v80336ccf4f1089c1f1d95f347a59baf4;}}return $v78a5eb43deef9a7b5b9ce157b9d52ac4;}public function setOptionPrice($v9190e95d1c478aceb70ac5c82692a74c, $v78a5eb43deef9a7b5b9ce157b9d52ac4) {if(isset($this->options[$v9190e95d1c478aceb70ac5c82692a74c])) {$v5f966ba427f81d4e3b5c4f1735f63499 = $this->options[$v9190e95d1c478aceb70ac5c82692a74c]['option-id'];$this->removeOption($v9190e95d1c478aceb70ac5c82692a74c);$this->appendOption($v9190e95d1c478aceb70ac5c82692a74c, $v5f966ba427f81d4e3b5c4f1735f63499, $v78a5eb43deef9a7b5b9ce157b9d52ac4);return true;}else {return false;}}public function refresh() {$this->price = $this->getElementPrice();$v8e2dcfd7e7e24b1ca76c1193f645902b = $this->getItemElement();if($v8e2dcfd7e7e24b1ca76c1193f645902b instanceof iUmiHierarchyElement) {$vb068931cc450442b63f5b3d276ea4297 = $v8e2dcfd7e7e24b1ca76c1193f645902b->getName();$v93da65a9fd0004d9477aeac024e08e15 = array();$v5891da2d64975cae48d175d1e001f5da = umiObjectsCollection::getInstance();foreach($this->getOptions() as $v5ecf0a02e02bd528df985f4f51a5af41) {$v5f966ba427f81d4e3b5c4f1735f63499 = $v5ecf0a02e02bd528df985f4f51a5af41['option-id'];$vef3e30e070f70244fd6578d88a6b77ac = $v5891da2d64975cae48d175d1e001f5da->getObject($v5f966ba427f81d4e3b5c4f1735f63499);if($vef3e30e070f70244fd6578d88a6b77ac instanceof iUmiObject) {$v93da65a9fd0004d9477aeac024e08e15[] = $vef3e30e070f70244fd6578d88a6b77ac->getName();}}if(sizeof($v93da65a9fd0004d9477aeac024e08e15)) {$vb068931cc450442b63f5b3d276ea4297 .= ' (' . implode(", ", $v93da65a9fd0004d9477aeac024e08e15) . ')';}$this->object->setName($vb068931cc450442b63f5b3d276ea4297);}parent::refresh();}protected function reloadOptions() {$v93da65a9fd0004d9477aeac024e08e15 = array();$v4472d2aff36d1d70f93e10860ae2e915 = $this->object->options;foreach($v4472d2aff36d1d70f93e10860ae2e915 as $v5ecf0a02e02bd528df985f4f51a5af41) {$v93da65a9fd0004d9477aeac024e08e15[$v5ecf0a02e02bd528df985f4f51a5af41['varchar']] = array(     'option-id'  => getArrayKey($v5ecf0a02e02bd528df985f4f51a5af41, 'rel'),     'price'   => getArrayKey($v5ecf0a02e02bd528df985f4f51a5af41, 'float'),     'field-name' => getArrayKey($v5ecf0a02e02bd528df985f4f51a5af41, 'varchar')    );}$this->options = $v93da65a9fd0004d9477aeac024e08e15;}protected function getOptionPrice($v9190e95d1c478aceb70ac5c82692a74c, $v5f966ba427f81d4e3b5c4f1735f63499) {$v9996ee3391a281322fe357d6c7547495 = $this->object->item_link;if(is_array($v9996ee3391a281322fe357d6c7547495) && sizeof($v9996ee3391a281322fe357d6c7547495)) {list($v8e2dcfd7e7e24b1ca76c1193f645902b) = $v9996ee3391a281322fe357d6c7547495;$v21ffce5b8a6cc8cc6a41448dd69623c9 = array(     'filter' => array('rel' => $v5f966ba427f81d4e3b5c4f1735f63499)    );$v2063c1608d6e0baf80249c42e2be5804 = $v8e2dcfd7e7e24b1ca76c1193f645902b->getValue($v9190e95d1c478aceb70ac5c82692a74c, $v21ffce5b8a6cc8cc6a41448dd69623c9);if(is_array($v2063c1608d6e0baf80249c42e2be5804) && sizeof($v2063c1608d6e0baf80249c42e2be5804)) {return $v78a5eb43deef9a7b5b9ce157b9d52ac4 = getArrayKey($v2063c1608d6e0baf80249c42e2be5804[0], 'float');}else {return false;}}else {return false;}}};?>