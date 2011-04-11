<?php
 class umiDistrReader {protected $distrFilePath, $fh;public  $signature = "ucp", $author, $comment, $timestamp, $totalSize;protected $version = "1.0.0";public function __construct($vfa03d051a60ae017e45ababa450025bc) {if(!is_file($vfa03d051a60ae017e45ababa450025bc)) {trigger_error("Distributive file \"{$vfa03d051a60ae017e45ababa450025bc}\" doesn't exists", E_USER_ERROR);}$this->distrFilePath = $vfa03d051a60ae017e45ababa450025bc;$this->readHeader();while($vbe8f80182e0c983916da7338c2c1c040 = $this->getNextResource()) {$vbe8f80182e0c983916da7338c2c1c040->restore();unset($vbe8f80182e0c983916da7338c2c1c040);}fclose($this->fh);}public function __destruct() {if(is_resource($this->fh)) {trigger_error("Resource \"{$this->fh}\" is not closed.", E_USER_NOTICE);fclose($this->fh);}}protected function readHeader() {if(!is_readable($this->distrFilePath)) {trigger_error("Distributive file \"{$this->distrFilePath}\" is not readable", E_USER_ERROR);}$this->fh = $v8fa14cdd754f91cc6554c9e71929cce7 = fopen($this->distrFilePath, "r");fseek($v8fa14cdd754f91cc6554c9e71929cce7, 0);if(stream_get_line($v8fa14cdd754f91cc6554c9e71929cce7, 5, "\0") != $this->signature) {trigger_error("Distributive file corrupted: wrong signature", E_USER_ERROR);return false;}fseek($v8fa14cdd754f91cc6554c9e71929cce7, 5);if(version_compare($v3680337aa2756317b4f51911126a75df = stream_get_line($v8fa14cdd754f91cc6554c9e71929cce7, 5, "\0"), $this->version, "<=") != 1) {trigger_error("You need installer at least version {$v3680337aa2756317b4f51911126a75df} to read this distribute file", E_USER_ERROR);return false;}fseek($v8fa14cdd754f91cc6554c9e71929cce7, 10);$this->timestamp = (int) stream_get_line($v8fa14cdd754f91cc6554c9e71929cce7, 15, "\0");fseek($v8fa14cdd754f91cc6554c9e71929cce7, 25);$this->totalSize = (int) stream_get_line($v8fa14cdd754f91cc6554c9e71929cce7, 25, "\0");fseek($v8fa14cdd754f91cc6554c9e71929cce7, 50);$this->author = (string) stream_get_line($v8fa14cdd754f91cc6554c9e71929cce7, 25, "\0");fseek($v8fa14cdd754f91cc6554c9e71929cce7, 75);$this->comment = (string) stream_get_line($v8fa14cdd754f91cc6554c9e71929cce7, 330, "\0");fseek($v8fa14cdd754f91cc6554c9e71929cce7, 331);}public function getNextResource() {$v8fa14cdd754f91cc6554c9e71929cce7 = $this->fh;$v83878c91171338902e0fe0fb97a8c47a = ftell($v8fa14cdd754f91cc6554c9e71929cce7);$v480d1b61a0432d1319f7504a3d7318dd = (int) stream_get_line($v8fa14cdd754f91cc6554c9e71929cce7, 25, "\0");fseek($v8fa14cdd754f91cc6554c9e71929cce7, $v83878c91171338902e0fe0fb97a8c47a + 25);$v214db69b84e8e3579228ff9279bfd837 = (string) stream_get_line($v8fa14cdd754f91cc6554c9e71929cce7, $v480d1b61a0432d1319f7504a3d7318dd);if(strlen($v214db69b84e8e3579228ff9279bfd837) == $v480d1b61a0432d1319f7504a3d7318dd) {$vbe8f80182e0c983916da7338c2c1c040 = unserialize(base64_decode($v214db69b84e8e3579228ff9279bfd837));return $vbe8f80182e0c983916da7338c2c1c040;}else {return false;}}};?>