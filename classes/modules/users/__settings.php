<?php
 abstract class __settings_users {public function loadUserSettings() {$permissions = permissionsCollection::getInstance();$v5891da2d64975cae48d175d1e001f5da = umiObjectsCollection::getInstance();$ve8701ad48ba05a91604e480dd60899a3 = $permissions->getUserId();$vee11cbb19052e40b07aac0ca060c23ee = $v5891da2d64975cae48d175d1e001f5da->getObject($ve8701ad48ba05a91604e480dd60899a3);if($vee11cbb19052e40b07aac0ca060c23ee instanceof umiObject == false) {throw new coreException("Can't get current user with id #{$ve8701ad48ba05a91604e480dd60899a3}");}$v6919f4e2e064985f15130949d3a085b0 = $vee11cbb19052e40b07aac0ca060c23ee->user_settings_data;$v3779e4bb5d832c6851b39a544b27c6b4 = unserialize($v6919f4e2e064985f15130949d3a085b0);if(!is_array($v3779e4bb5d832c6851b39a544b27c6b4)) {$v3779e4bb5d832c6851b39a544b27c6b4 = array();}$vfca1bff8ad8b3a8585abfb0ad523ba42 = array();$v691d502cfd0e0626cd3b058e5682ad1c = array();foreach($v3779e4bb5d832c6851b39a544b27c6b4 as $v3c6e0b8a9c15224a8228b9a98ca1531d => $v8d777f385d3dfec8815d20f7496026dc) {$ve253bed1357afcefc5fadfbc92f9eb97 = array();$ve253bed1357afcefc5fadfbc92f9eb97['attribute:key'] = (string) $v3c6e0b8a9c15224a8228b9a98ca1531d;$vde5b1cd11c4544e7f3fe792f2e0d8b8b = array();foreach($v8d777f385d3dfec8815d20f7496026dc as $ve4d23e841d8e8804190027bce3180fa5 => $v2063c1608d6e0baf80249c42e2be5804) {$vbab19954b9d2a1eaf4d925a3630dd3c4 = array();$vbab19954b9d2a1eaf4d925a3630dd3c4['attribute:tag'] = (string) $ve4d23e841d8e8804190027bce3180fa5;if($v3c6e0b8a9c15224a8228b9a98ca1531d == 'dockItems' && $ve4d23e841d8e8804190027bce3180fa5 == 'common') {$v2063c1608d6e0baf80249c42e2be5804 = $this->filterModulesList($v2063c1608d6e0baf80249c42e2be5804);}$vbab19954b9d2a1eaf4d925a3630dd3c4['node:value'] = (string) $v2063c1608d6e0baf80249c42e2be5804;$vde5b1cd11c4544e7f3fe792f2e0d8b8b[] = $vbab19954b9d2a1eaf4d925a3630dd3c4;}$ve253bed1357afcefc5fadfbc92f9eb97['nodes:value'] = $vde5b1cd11c4544e7f3fe792f2e0d8b8b;$v691d502cfd0e0626cd3b058e5682ad1c[] = $ve253bed1357afcefc5fadfbc92f9eb97;}$vfca1bff8ad8b3a8585abfb0ad523ba42['items']['nodes:item'] = $v691d502cfd0e0626cd3b058e5682ad1c;return $vfca1bff8ad8b3a8585abfb0ad523ba42;}public function saveUserSettings() {$this->flushAsXML("saveUserSettings");$permissions = permissionsCollection::getInstance();$v5891da2d64975cae48d175d1e001f5da = umiObjectsCollection::getInstance();$ve8701ad48ba05a91604e480dd60899a3 = $permissions->getUserId();$vee11cbb19052e40b07aac0ca060c23ee = $v5891da2d64975cae48d175d1e001f5da->getObject($ve8701ad48ba05a91604e480dd60899a3);if($vee11cbb19052e40b07aac0ca060c23ee instanceof umiObject == false) {throw new coreException("Can't get current user with id #{$ve8701ad48ba05a91604e480dd60899a3}");}$v6919f4e2e064985f15130949d3a085b0 = $vee11cbb19052e40b07aac0ca060c23ee->getValue("user_settings_data");$v6919f4e2e064985f15130949d3a085b0 = unserialize($v6919f4e2e064985f15130949d3a085b0);if(!is_array($v6919f4e2e064985f15130949d3a085b0)) {$v6919f4e2e064985f15130949d3a085b0 = Array();}$v3c6e0b8a9c15224a8228b9a98ca1531d = getRequest('key');$v2063c1608d6e0baf80249c42e2be5804 = getRequest('value');$vd57ac45256849d9b13e2422d91580fb9 = (Array) getRequest('tags');if(!$v3c6e0b8a9c15224a8228b9a98ca1531d) {throw new publicException("You should pass \"key\" parameter to this resourse");}if(sizeof($vd57ac45256849d9b13e2422d91580fb9) == 0) {$vd57ac45256849d9b13e2422d91580fb9[] = 'common';}foreach($vd57ac45256849d9b13e2422d91580fb9 as $ve4d23e841d8e8804190027bce3180fa5) {if(!$v2063c1608d6e0baf80249c42e2be5804) {if(isset($v6919f4e2e064985f15130949d3a085b0[$v3c6e0b8a9c15224a8228b9a98ca1531d][$ve4d23e841d8e8804190027bce3180fa5])) {unset($v6919f4e2e064985f15130949d3a085b0[$v3c6e0b8a9c15224a8228b9a98ca1531d][$ve4d23e841d8e8804190027bce3180fa5]);if(sizeof($v6919f4e2e064985f15130949d3a085b0[$v3c6e0b8a9c15224a8228b9a98ca1531d]) == 0) {unset($v6919f4e2e064985f15130949d3a085b0[$v3c6e0b8a9c15224a8228b9a98ca1531d]);}}}else {$v6919f4e2e064985f15130949d3a085b0[$v3c6e0b8a9c15224a8228b9a98ca1531d][$ve4d23e841d8e8804190027bce3180fa5] = $v2063c1608d6e0baf80249c42e2be5804;}}$vee11cbb19052e40b07aac0ca060c23ee->setValue("user_settings_data", serialize($v6919f4e2e064985f15130949d3a085b0));$vee11cbb19052e40b07aac0ca060c23ee->commit();}public function filterModulesList($v0eb9b3af2e4a00837a1b1a854c9ea18c) {if(!is_string($v0eb9b3af2e4a00837a1b1a854c9ea18c)) {return null;}$v406501513436d425b747becde4780677 = explode(";", $v0eb9b3af2e4a00837a1b1a854c9ea18c);$v8b1dc169bf460ee884fceef66c6607d6 = cmsController::getInstance();$v349bc7e7b1547a51da3f312048e1e636 = $v8b1dc169bf460ee884fceef66c6607d6->getModulesList();$result = array();foreach($v406501513436d425b747becde4780677 as $v52a43e48ec4649dee819dadabcab1bde) {if(in_array($v52a43e48ec4649dee819dadabcab1bde, $v349bc7e7b1547a51da3f312048e1e636)) {if($v52a43e48ec4649dee819dadabcab1bde == 'data' && defined('CURRENT_VERSION_LINE')) {if(CURRENT_VERSION_LINE == "free" || CURRENT_VERSION_LINE == "lite" || CURRENT_VERSION_LINE == "freelance") {continue;}}$result[] = $v52a43e48ec4649dee819dadabcab1bde;}}return implode(";", $result);}};?>