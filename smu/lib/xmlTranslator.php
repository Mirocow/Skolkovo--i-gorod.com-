<?php
 class xmlTranslator {protected $domDocument = false;protected $currentPageTranslated = false;protected   $rootNode    = null;public function __construct($v15bf7689c96501a9c9a529208718a204 = "response") {$this->domDocument = new DOMDocument();$this->rootNode    = $this->domDocument->createElement($v15bf7689c96501a9c9a529208718a204);$this->domDocument->appendChild($this->rootNode);}public function translateToXml($v56491f2e1c74898e18bb6e47d2425b19) {if(is_string($v56491f2e1c74898e18bb6e47d2425b19)) return $v56491f2e1c74898e18bb6e47d2425b19;$this->chooseTranslator($this->rootNode, $v56491f2e1c74898e18bb6e47d2425b19);return $this->domDocument->saveXML();}protected function chooseTranslator(DOMElement $v173a1756d2d82394cb803161f70f9a38, $v56491f2e1c74898e18bb6e47d2425b19, $ve30d41e6c131a13252ce15184b24d99b = false) {switch(gettype($v56491f2e1c74898e18bb6e47d2425b19)) {case "array": {$this->translateArray($v173a1756d2d82394cb803161f70f9a38, $v56491f2e1c74898e18bb6e47d2425b19);break;}default: {$this->translateBasic($v173a1756d2d82394cb803161f70f9a38, $v56491f2e1c74898e18bb6e47d2425b19);break;}}}protected function translateBasic(DOMElement $v173a1756d2d82394cb803161f70f9a38, $v56491f2e1c74898e18bb6e47d2425b19) {$vdd988cfd769c9f7fbd795a0f5da8e751 = $this->domDocument;$v8e2dcfd7e7e24b1ca76c1193f645902b = $vdd988cfd769c9f7fbd795a0f5da8e751->createTextNode( (string) $v56491f2e1c74898e18bb6e47d2425b19 );$v173a1756d2d82394cb803161f70f9a38->appendChild($v8e2dcfd7e7e24b1ca76c1193f645902b);}protected function translateArray(DOMElement $v173a1756d2d82394cb803161f70f9a38, $v56491f2e1c74898e18bb6e47d2425b19) {$vdd988cfd769c9f7fbd795a0f5da8e751 = $this->domDocument;foreach($v56491f2e1c74898e18bb6e47d2425b19 as $v3c6e0b8a9c15224a8228b9a98ca1531d => $v3a6d0284e743dc4a9b86f97d6dd1a3bf) {if($this->isKeySubnodes($v3c6e0b8a9c15224a8228b9a98ca1531d)) {$v3c6e0b8a9c15224a8228b9a98ca1531d = $this->getRealKey($v3c6e0b8a9c15224a8228b9a98ca1531d);$v9b207167e5381c47682c6b4f58a623fb[$v3c6e0b8a9c15224a8228b9a98ca1531d] = Array();$v9b207167e5381c47682c6b4f58a623fb[$v3c6e0b8a9c15224a8228b9a98ca1531d]['nodes:item'] = $v3a6d0284e743dc4a9b86f97d6dd1a3bf;$v3a6d0284e743dc4a9b86f97d6dd1a3bf = $v9b207167e5381c47682c6b4f58a623fb;unset($v9b207167e5381c47682c6b4f58a623fb);}switch(true) {case $this->isKeyANull($v3c6e0b8a9c15224a8228b9a98ca1531d): {break;}case $this->isKeyAFull($v3c6e0b8a9c15224a8228b9a98ca1531d): {$v3c6e0b8a9c15224a8228b9a98ca1531d = $this->getRealKey($v3c6e0b8a9c15224a8228b9a98ca1531d);if($v3c6e0b8a9c15224a8228b9a98ca1531d == false) {$v8e2dcfd7e7e24b1ca76c1193f645902b = $v173a1756d2d82394cb803161f70f9a38;}else {$v8e2dcfd7e7e24b1ca76c1193f645902b = $vdd988cfd769c9f7fbd795a0f5da8e751->createElement($v3c6e0b8a9c15224a8228b9a98ca1531d);}$this->chooseTranslator($v8e2dcfd7e7e24b1ca76c1193f645902b, $v3a6d0284e743dc4a9b86f97d6dd1a3bf, true);if($v3c6e0b8a9c15224a8228b9a98ca1531d != false) {$v173a1756d2d82394cb803161f70f9a38->appendChild($v8e2dcfd7e7e24b1ca76c1193f645902b);}break;}case $this->isKeyAnAttribute($v3c6e0b8a9c15224a8228b9a98ca1531d): {$v3c6e0b8a9c15224a8228b9a98ca1531d = $this->getRealKey($v3c6e0b8a9c15224a8228b9a98ca1531d);if($v3a6d0284e743dc4a9b86f97d6dd1a3bf === "") break;$v173a1756d2d82394cb803161f70f9a38->setAttribute($v3c6e0b8a9c15224a8228b9a98ca1531d, $v3a6d0284e743dc4a9b86f97d6dd1a3bf);break;}case $this->isKeyANode($v3c6e0b8a9c15224a8228b9a98ca1531d): {$v36c4536996ca5615dcf9911f068786dc = $vdd988cfd769c9f7fbd795a0f5da8e751->createTextNode($v3a6d0284e743dc4a9b86f97d6dd1a3bf);$v173a1756d2d82394cb803161f70f9a38->appendChild($v36c4536996ca5615dcf9911f068786dc);break;}case $this->isKeyNodes($v3c6e0b8a9c15224a8228b9a98ca1531d): {$v3c6e0b8a9c15224a8228b9a98ca1531d = $this->getRealKey($v3c6e0b8a9c15224a8228b9a98ca1531d);foreach($v3a6d0284e743dc4a9b86f97d6dd1a3bf as $vf19e92e810d08b6cf2d0265b779064d9) {$v8e2dcfd7e7e24b1ca76c1193f645902b = $vdd988cfd769c9f7fbd795a0f5da8e751->createElement($v3c6e0b8a9c15224a8228b9a98ca1531d);$this->chooseTranslator($v8e2dcfd7e7e24b1ca76c1193f645902b, $vf19e92e810d08b6cf2d0265b779064d9);$v173a1756d2d82394cb803161f70f9a38->appendChild($v8e2dcfd7e7e24b1ca76c1193f645902b);}break;}case $this->isKeyXml($v3c6e0b8a9c15224a8228b9a98ca1531d): {$v3c6e0b8a9c15224a8228b9a98ca1531d = $this->getRealKey($v3c6e0b8a9c15224a8228b9a98ca1531d);$v75e4635b97622e5504161a4a8ba7bea8 = simplexml_load_string($v3a6d0284e743dc4a9b86f97d6dd1a3bf);if($v75e4635b97622e5504161a4a8ba7bea8 !== false) {if($vce2efc879f403662a84494ec120a1543 = dom_import_simplexml($v75e4635b97622e5504161a4a8ba7bea8)) {$vce2efc879f403662a84494ec120a1543 = $vdd988cfd769c9f7fbd795a0f5da8e751->importNode($vce2efc879f403662a84494ec120a1543, true);$v173a1756d2d82394cb803161f70f9a38->appendChild($vce2efc879f403662a84494ec120a1543);}break;}else {$v173a1756d2d82394cb803161f70f9a38->appendChild($vdd988cfd769c9f7fbd795a0f5da8e751->createTextNode($v3a6d0284e743dc4a9b86f97d6dd1a3bf));break;}}case $this->isKeyXLink($v3c6e0b8a9c15224a8228b9a98ca1531d): {$v3c6e0b8a9c15224a8228b9a98ca1531d = $this->getRealKey($v3c6e0b8a9c15224a8228b9a98ca1531d);$v173a1756d2d82394cb803161f70f9a38->setAttributeNS("http://www.w3.org/TR/xlink", "xlink:" . $v3c6e0b8a9c15224a8228b9a98ca1531d, $v3a6d0284e743dc4a9b86f97d6dd1a3bf);break;}default: {if($v3c6e0b8a9c15224a8228b9a98ca1531d === 0) {throw new coreException("Can't translate to xml key {$v3c6e0b8a9c15224a8228b9a98ca1531d} with value {$v3a6d0284e743dc4a9b86f97d6dd1a3bf}");break;}$v8e2dcfd7e7e24b1ca76c1193f645902b = $vdd988cfd769c9f7fbd795a0f5da8e751->createElement($v3c6e0b8a9c15224a8228b9a98ca1531d);$this->chooseTranslator($v8e2dcfd7e7e24b1ca76c1193f645902b, $v3a6d0284e743dc4a9b86f97d6dd1a3bf);$v173a1756d2d82394cb803161f70f9a38->appendChild($v8e2dcfd7e7e24b1ca76c1193f645902b);break;}}}}protected function isKeyANull($v3c6e0b8a9c15224a8228b9a98ca1531d) {return $this->getSubKey($v3c6e0b8a9c15224a8228b9a98ca1531d) == "void";}protected function isKeyAFull($v3c6e0b8a9c15224a8228b9a98ca1531d) {return $this->getSubKey($v3c6e0b8a9c15224a8228b9a98ca1531d) == "full";}protected function isKeyAnAttribute($v3c6e0b8a9c15224a8228b9a98ca1531d) {$v518d8dec3947df909fe6e4c9940f98a6 = $this->getSubKey($v3c6e0b8a9c15224a8228b9a98ca1531d);if($v518d8dec3947df909fe6e4c9940f98a6 == "attr" || $v518d8dec3947df909fe6e4c9940f98a6 == "attribute") {return true;}else {return false;}}protected function isKeyANode($v3c6e0b8a9c15224a8228b9a98ca1531d) {$v518d8dec3947df909fe6e4c9940f98a6 = $this->getSubKey($v3c6e0b8a9c15224a8228b9a98ca1531d);return ($v518d8dec3947df909fe6e4c9940f98a6 == "node");}protected function isKeyNodes($v3c6e0b8a9c15224a8228b9a98ca1531d) {$v518d8dec3947df909fe6e4c9940f98a6 = $this->getSubKey($v3c6e0b8a9c15224a8228b9a98ca1531d);return ($v518d8dec3947df909fe6e4c9940f98a6 == "nodes");}protected function isKeySubnodes($v3c6e0b8a9c15224a8228b9a98ca1531d) {$v518d8dec3947df909fe6e4c9940f98a6 = $this->getSubKey($v3c6e0b8a9c15224a8228b9a98ca1531d);return ($v518d8dec3947df909fe6e4c9940f98a6 == "subnodes");}protected function isKeyXml($v3c6e0b8a9c15224a8228b9a98ca1531d) {$v518d8dec3947df909fe6e4c9940f98a6 = $this->getSubKey($v3c6e0b8a9c15224a8228b9a98ca1531d);return ($v518d8dec3947df909fe6e4c9940f98a6 == "xml");}protected function isKeyXLink($v3c6e0b8a9c15224a8228b9a98ca1531d) {$v518d8dec3947df909fe6e4c9940f98a6 = $this->getSubKey($v3c6e0b8a9c15224a8228b9a98ca1531d);return ($v518d8dec3947df909fe6e4c9940f98a6 == "xlink");}public function getRealKey($v3c6e0b8a9c15224a8228b9a98ca1531d) {if($v5e0bdcbddccca4d66d74ba8c1cee1a68 = strpos($v3c6e0b8a9c15224a8228b9a98ca1531d, ":")) {++$v5e0bdcbddccca4d66d74ba8c1cee1a68;}else {$v5e0bdcbddccca4d66d74ba8c1cee1a68 = 0;}return substr($v3c6e0b8a9c15224a8228b9a98ca1531d, $v5e0bdcbddccca4d66d74ba8c1cee1a68);}public function getSubKey($v3c6e0b8a9c15224a8228b9a98ca1531d) {if($v5e0bdcbddccca4d66d74ba8c1cee1a68 = strpos($v3c6e0b8a9c15224a8228b9a98ca1531d, ":")) {return substr($v3c6e0b8a9c15224a8228b9a98ca1531d, 0, $v5e0bdcbddccca4d66d74ba8c1cee1a68);}else {return false;}}protected function translateException(DOMElement $v173a1756d2d82394cb803161f70f9a38, publicException $v42552b1f133f9f8eb406d4f306ea9fd1) {$v26b75b176d665f24a5fd22a2ad815763 = Array();$vcb5e100e5a9a3e7f6d1fd97512215282 = Array();$vcb5e100e5a9a3e7f6d1fd97512215282['node:msg'] = $v42552b1f133f9f8eb406d4f306ea9fd1->getMessage();$v26b75b176d665f24a5fd22a2ad815763['error'] = $vcb5e100e5a9a3e7f6d1fd97512215282;$this->chooseTranslator($v173a1756d2d82394cb803161f70f9a38, $v26b75b176d665f24a5fd22a2ad815763);}};?>