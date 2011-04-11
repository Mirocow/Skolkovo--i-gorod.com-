<?php
 class umiMimePart {const UMI_MIMEPART_CRLF = "\n";const UMI_MIMEPART_CHARSET = 'utf-8';private $arrHeaders = array();private $sBody = "";private $sEncoding = '7bit';private $arrSubParts = array();private $sEncBody = "";private $bEncoded = false;public function __construct($vc32e13633ba3c3faea1235c6bf43328c, $v2dd5b0c609fb5581aa2297e86ebd6f48) {$this->arrHeaders['Content-Type'] = 'text/plain; charset='.self::UMI_MIMEPART_CHARSET.'';$this->sBody = $vc32e13633ba3c3faea1235c6bf43328c;foreach ($v2dd5b0c609fb5581aa2297e86ebd6f48 as $v930239f88416d28dd2d2a430ab183915 => $v7016dbed20f6d544afcc2fae05d697d8) {switch ($v930239f88416d28dd2d2a430ab183915) {case "content-type":       $this->arrHeaders['Content-Type'] = $v7016dbed20f6d544afcc2fae05d697d8 . (isset($v2dd5b0c609fb5581aa2297e86ebd6f48['charset'])? "; charset=" . $v2dd5b0c609fb5581aa2297e86ebd6f48['charset'] . "" : "");break;case "encoding":       $this->sEncoding = $v7016dbed20f6d544afcc2fae05d697d8;$this->arrHeaders['Content-Transfer-Encoding'] = $v7016dbed20f6d544afcc2fae05d697d8;break;case 'cid':       $this->arrHeaders['Content-ID'] = "<" . $v7016dbed20f6d544afcc2fae05d697d8 . ">";break;case 'disposition':       $this->arrHeaders['Content-Disposition'] = $v7016dbed20f6d544afcc2fae05d697d8 . (isset($v2dd5b0c609fb5581aa2297e86ebd6f48['']) ? '; filename="' . $vb9b628834b363cc1db76f7fd989ac9fb . '"' : '');}}}private function addSubPart($vc32e13633ba3c3faea1235c6bf43328c, $v2dd5b0c609fb5581aa2297e86ebd6f48) {$v8f7935d68b6be276571c20c4d6399da0 = new self($vc32e13633ba3c3faea1235c6bf43328c, $v2dd5b0c609fb5581aa2297e86ebd6f48);$this->arrSubParts[] = $v8f7935d68b6be276571c20c4d6399da0;return $v8f7935d68b6be276571c20c4d6399da0;}public function addMixedPart() {return $this->addSubPart('', array('content-type' => 'multipart/mixed'));}public function addAlternativePart() {return $this->addSubPart('', array('content-type' => 'multipart/alternative'));}public function addRelatedPart() {return $this->addSubPart('', array('content-type' => 'multipart/related'));}public function addTextPart($v15fda7fe509db172563b55549dd9697a) {$v2dd5b0c609fb5581aa2297e86ebd6f48 = array();$v2dd5b0c609fb5581aa2297e86ebd6f48['content-type'] = 'text/plain';$v2dd5b0c609fb5581aa2297e86ebd6f48['encoding'] = '7bit';$v2dd5b0c609fb5581aa2297e86ebd6f48['charset'] = self::UMI_MIMEPART_CHARSET;return $this->addSubPart($v15fda7fe509db172563b55549dd9697a, $v2dd5b0c609fb5581aa2297e86ebd6f48);}public function addHtmlPart($vbdfc3e7a3c325bf42bd373138608b279) {$v2dd5b0c609fb5581aa2297e86ebd6f48 = array();$v2dd5b0c609fb5581aa2297e86ebd6f48['content-type'] = 'text/html';$v2dd5b0c609fb5581aa2297e86ebd6f48['encoding'] = 'base64';$v2dd5b0c609fb5581aa2297e86ebd6f48['charset'] = self::UMI_MIMEPART_CHARSET;return $this->addSubPart($vbdfc3e7a3c325bf42bd373138608b279, $v2dd5b0c609fb5581aa2297e86ebd6f48);}public function addHtmlImagePart($vaf931fce3ed10a376eb1cd947f8efbc0) {$v2dd5b0c609fb5581aa2297e86ebd6f48 = array();$v2dd5b0c609fb5581aa2297e86ebd6f48['content-type'] = (isset($vaf931fce3ed10a376eb1cd947f8efbc0['content-type'])? $vaf931fce3ed10a376eb1cd947f8efbc0['content-type'] : "image/jpeg"). '; ' . 'name="' . (isset($vaf931fce3ed10a376eb1cd947f8efbc0['name'])? $vaf931fce3ed10a376eb1cd947f8efbc0['name']: "undefined.jpg" ). '"';$v2dd5b0c609fb5581aa2297e86ebd6f48['encoding'] = 'base64';$v2dd5b0c609fb5581aa2297e86ebd6f48['disposition'] = 'inline';$v2dd5b0c609fb5581aa2297e86ebd6f48['dfilename'] = isset($vaf931fce3ed10a376eb1cd947f8efbc0['name'])? $vaf931fce3ed10a376eb1cd947f8efbc0['name']: "undefined.jpg";$v2dd5b0c609fb5581aa2297e86ebd6f48['cid'] = isset($vaf931fce3ed10a376eb1cd947f8efbc0['cid'])? $vaf931fce3ed10a376eb1cd947f8efbc0['cid'] : "";return $this->addSubPart(isset($vaf931fce3ed10a376eb1cd947f8efbc0['data'])? $vaf931fce3ed10a376eb1cd947f8efbc0['data'] : "", $v2dd5b0c609fb5581aa2297e86ebd6f48);}public function addAttachmentPart($v3d4621d9cc912a5fea4701512419d75a) {$v2dd5b0c609fb5581aa2297e86ebd6f48 = array();$v2dd5b0c609fb5581aa2297e86ebd6f48['dfilename'] = isset($v3d4621d9cc912a5fea4701512419d75a['name'])? $v3d4621d9cc912a5fea4701512419d75a['name']: "undefined.jpg";$v2dd5b0c609fb5581aa2297e86ebd6f48['encoding'] = isset($v3d4621d9cc912a5fea4701512419d75a['encoding'])? $v3d4621d9cc912a5fea4701512419d75a['encoding']: "base64";$v2dd5b0c609fb5581aa2297e86ebd6f48['content-type'] = (isset($v3d4621d9cc912a5fea4701512419d75a['content-type'])? $v3d4621d9cc912a5fea4701512419d75a['content-type'] : "image/jpeg"). '; ' . 'name="' . (isset($v3d4621d9cc912a5fea4701512419d75a['name'])? $v3d4621d9cc912a5fea4701512419d75a['name']: "undefined.jpg" ). '"';$v2dd5b0c609fb5581aa2297e86ebd6f48['disposition'] = 'attachment';return $this->addSubPart(isset($v3d4621d9cc912a5fea4701512419d75a['data'])? $v3d4621d9cc912a5fea4701512419d75a['data'] : "", $v2dd5b0c609fb5581aa2297e86ebd6f48);}public static function quotedPrintableEncode($v1420021a3913b3124c49929ac583bfba , $vd1ce0855e11471cd5649fcb5a2258ea0 = 76) {$vdccc8c8d061984a56d899361b4934477 = '';$vcc450b99593b044c1a1f912c10482016  = preg_split("/\r?\n/", $v1420021a3913b3124c49929ac583bfba);$v7db0d3a4fb1a5015fc404f43144452d9 = '=';while(@list(, $vd208be0c82080d285de6953f1369e8bb) = each($vcc450b99593b044c1a1f912c10482016)){$v90eae52bece75d5705bbbff3906960dd = preg_split('||', $vd208be0c82080d285de6953f1369e8bb, -1, PREG_SPLIT_NO_EMPTY);$v724adb32aee38e8b9d8f91e63159e62c = '';for ($v168965c34d6a1fd6ad3d68aa5e76ae56 = 0;$v168965c34d6a1fd6ad3d68aa5e76ae56 < count($v90eae52bece75d5705bbbff3906960dd);$v168965c34d6a1fd6ad3d68aa5e76ae56++) {$v474965a36fa0e983ddc7626cbbe968da = $v90eae52bece75d5705bbbff3906960dd[$v168965c34d6a1fd6ad3d68aa5e76ae56];$v6dc4bf6fa40f9efadceb88ac4bcf700a  = ord($v474965a36fa0e983ddc7626cbbe968da);if (($v6dc4bf6fa40f9efadceb88ac4bcf700a == 32) AND ($v168965c34d6a1fd6ad3d68aa5e76ae56 == (count($v90eae52bece75d5705bbbff3906960dd) - 1))) {$v474965a36fa0e983ddc7626cbbe968da = '=20';}elseif(($v6dc4bf6fa40f9efadceb88ac4bcf700a == 9) AND ($v168965c34d6a1fd6ad3d68aa5e76ae56 == (count($v90eae52bece75d5705bbbff3906960dd) - 1))) {$v474965a36fa0e983ddc7626cbbe968da = '=09';}elseif($v6dc4bf6fa40f9efadceb88ac4bcf700a == 9) {;}elseif(($v6dc4bf6fa40f9efadceb88ac4bcf700a == 61) OR ($v6dc4bf6fa40f9efadceb88ac4bcf700a < 32 ) OR ($v6dc4bf6fa40f9efadceb88ac4bcf700a > 126)) {$v474965a36fa0e983ddc7626cbbe968da = $v7db0d3a4fb1a5015fc404f43144452d9 . strtoupper(sprintf('%02s', dechex($v6dc4bf6fa40f9efadceb88ac4bcf700a)));}elseif (($v6dc4bf6fa40f9efadceb88ac4bcf700a == 46) AND ($v724adb32aee38e8b9d8f91e63159e62c == '')) {$v474965a36fa0e983ddc7626cbbe968da = '=2E';}if ((strlen($v724adb32aee38e8b9d8f91e63159e62c) + strlen($v474965a36fa0e983ddc7626cbbe968da)) >= $vd1ce0855e11471cd5649fcb5a2258ea0) {$vdccc8c8d061984a56d899361b4934477  .= $v724adb32aee38e8b9d8f91e63159e62c . $v7db0d3a4fb1a5015fc404f43144452d9 . self::UMI_MIMEPART_CRLF;$v724adb32aee38e8b9d8f91e63159e62c  = '';}$v724adb32aee38e8b9d8f91e63159e62c .= $v474965a36fa0e983ddc7626cbbe968da;}$vdccc8c8d061984a56d899361b4934477 .= $v724adb32aee38e8b9d8f91e63159e62c . self::UMI_MIMEPART_CRLF;}$vdccc8c8d061984a56d899361b4934477 = substr($vdccc8c8d061984a56d899361b4934477, 0, -1 * strlen(self::UMI_MIMEPART_CRLF));return $vdccc8c8d061984a56d899361b4934477;}private static function encodeData($v1420021a3913b3124c49929ac583bfba, $vbad28ee3823bb7cfc0dff0e1df46f16a = '7bit') {$vdccc8c8d061984a56d899361b4934477 = "";switch ($vbad28ee3823bb7cfc0dff0e1df46f16a) {case 'quoted-printable':      $vdccc8c8d061984a56d899361b4934477 = self::quotedPrintableEncode($v1420021a3913b3124c49929ac583bfba , 76);break;case 'base64':      $vdccc8c8d061984a56d899361b4934477 = rtrim(chunk_split(base64_encode($v1420021a3913b3124c49929ac583bfba), 76, self::UMI_MIMEPART_CRLF));break;default:     $vdccc8c8d061984a56d899361b4934477 = $v1420021a3913b3124c49929ac583bfba;break;}return $vdccc8c8d061984a56d899361b4934477;}public function encodePart() {if (count($this->arrSubParts)) {srand((double)microtime()*1000000);$vb3288b8968a85ebac553ed1a69f4cdfa = '=_' . md5(rand() . microtime());$this->arrHeaders['Content-Type'] .= ';' . self::UMI_MIMEPART_CRLF . "\t" . 'boundary="' . $vb3288b8968a85ebac553ed1a69f4cdfa . '"';$v2841431fdb4cb527d59474ab53f9b799 = array();for ($v168965c34d6a1fd6ad3d68aa5e76ae56 = 0;$v168965c34d6a1fd6ad3d68aa5e76ae56 < count($this->arrSubParts);$v168965c34d6a1fd6ad3d68aa5e76ae56++) {$v189098faa1db4b17398346436c9663d4 = array();$v3f8ef0665eec2c6c4b1b7a84b23771f5 = $this->arrSubParts[$v168965c34d6a1fd6ad3d68aa5e76ae56];if ($v3f8ef0665eec2c6c4b1b7a84b23771f5 instanceof self) {$vf91df61d0acf54b6d28997906045583f = $v3f8ef0665eec2c6c4b1b7a84b23771f5->encodePart();foreach ($vf91df61d0acf54b6d28997906045583f['headers'] as $vfc19ae0e7cb9076cc4077381bbe0b168 => $v3288421a9d18689376a59ae6a38cd186) {$v189098faa1db4b17398346436c9663d4[] = $vfc19ae0e7cb9076cc4077381bbe0b168 . ": " . $v3288421a9d18689376a59ae6a38cd186;}$v2841431fdb4cb527d59474ab53f9b799[] = implode(self::UMI_MIMEPART_CRLF, $v189098faa1db4b17398346436c9663d4) . self::UMI_MIMEPART_CRLF . self::UMI_MIMEPART_CRLF . $vf91df61d0acf54b6d28997906045583f['body'];}}$this->sEncBody = '--' . $vb3288b8968a85ebac553ed1a69f4cdfa . self::UMI_MIMEPART_CRLF . implode('--' . $vb3288b8968a85ebac553ed1a69f4cdfa . self::UMI_MIMEPART_CRLF, $v2841431fdb4cb527d59474ab53f9b799) . '--' . $vb3288b8968a85ebac553ed1a69f4cdfa. '--' . self::UMI_MIMEPART_CRLF . self::UMI_MIMEPART_CRLF;}else {$this->sEncBody = self::encodeData($this->sBody, $this->sEncoding) . self::UMI_MIMEPART_CRLF;}return array('body'=>$this->sEncBody, 'headers'=>$this->arrHeaders);}public function __toString() {return $this->encodePart();}}?>