<?php
 abstract class __domains_config extends baseModuleAdmin {public function domains() {$v15d61712450a686a7f365adf4fef581f = getRequest("param0");if($v15d61712450a686a7f365adf4fef581f == "do") {$this->saveEditedList("domains");$this->chooseRedirect($this->pre_lang . '/admin/config/domains/');}$ve4e46deb7f9cc58c7abfb32e5570b6f3 = domainsCollection::getInstance()->getList();$this->setDataType("list");$this->setActionType("modify");$v8d777f385d3dfec8815d20f7496026dc = $this->prepareData($ve4e46deb7f9cc58c7abfb32e5570b6f3, "domains");$this->setData($v8d777f385d3dfec8815d20f7496026dc, sizeof($ve4e46deb7f9cc58c7abfb32e5570b6f3));return $this->doData();}public function domain_mirrows() {$v662cbf1253ac7d8750ed9190c52163e5 = getRequest('param0');$v15d61712450a686a7f365adf4fef581f = getRequest("param1");$vb1444fb0c07653567ad325aa25d4e37a = regedit::getInstance();$v78e6dd7a49f5b0cb2106a3a434dd5c86 = cmsController::getInstance()->getCurrentLang()->getId();$vd90727b246a54fba377da573f3f615f1 = Array();$vd90727b246a54fba377da573f3f615f1['string:seo-title'] = $vb1444fb0c07653567ad325aa25d4e37a->getVal("//settings/title_prefix/{$v78e6dd7a49f5b0cb2106a3a434dd5c86}/{$v662cbf1253ac7d8750ed9190c52163e5}");$vd90727b246a54fba377da573f3f615f1['string:seo-keywords'] = $vb1444fb0c07653567ad325aa25d4e37a->getVal("//settings/meta_keywords/{$v78e6dd7a49f5b0cb2106a3a434dd5c86}/{$v662cbf1253ac7d8750ed9190c52163e5}");$vd90727b246a54fba377da573f3f615f1['string:seo-description'] = $vb1444fb0c07653567ad325aa25d4e37a->getVal("//settings/meta_description/{$v78e6dd7a49f5b0cb2106a3a434dd5c86}/{$v662cbf1253ac7d8750ed9190c52163e5}");$vd90727b246a54fba377da573f3f615f1['string:ga-id'] = $vb1444fb0c07653567ad325aa25d4e37a->getVal("//settings/ga-id/{$v662cbf1253ac7d8750ed9190c52163e5}");$v21ffce5b8a6cc8cc6a41448dd69623c9 = Array(    'seo' => $vd90727b246a54fba377da573f3f615f1   );if($v15d61712450a686a7f365adf4fef581f == "do") {$this->saveEditedList("domain_mirrows");$v21ffce5b8a6cc8cc6a41448dd69623c9 = $this->expectParams($v21ffce5b8a6cc8cc6a41448dd69623c9);$vd5d3db1765287eef77d7927cc956f50a = $v21ffce5b8a6cc8cc6a41448dd69623c9['seo']['string:seo-title'];$v59aeb2c9970b7b25be2fab2317e31fcb = $v21ffce5b8a6cc8cc6a41448dd69623c9['seo']['string:seo-keywords'];$v67daf92c833c41c95db874e18fcb2786 = $v21ffce5b8a6cc8cc6a41448dd69623c9['seo']['string:seo-description'];$vaab6f4a8019d0cb3783945c4ba29eb4d = $v21ffce5b8a6cc8cc6a41448dd69623c9['seo']['string:ga-id'];$vb1444fb0c07653567ad325aa25d4e37a->setVal("//settings/title_prefix/{$v78e6dd7a49f5b0cb2106a3a434dd5c86}/{$v662cbf1253ac7d8750ed9190c52163e5}", $vd5d3db1765287eef77d7927cc956f50a);$vb1444fb0c07653567ad325aa25d4e37a->setVal("//settings/meta_keywords/{$v78e6dd7a49f5b0cb2106a3a434dd5c86}/{$v662cbf1253ac7d8750ed9190c52163e5}", $v59aeb2c9970b7b25be2fab2317e31fcb);$vb1444fb0c07653567ad325aa25d4e37a->setVal("//settings/meta_description/{$v78e6dd7a49f5b0cb2106a3a434dd5c86}/{$v662cbf1253ac7d8750ed9190c52163e5}", $v67daf92c833c41c95db874e18fcb2786);$vb1444fb0c07653567ad325aa25d4e37a->setVal("//settings/ga-id/{$v662cbf1253ac7d8750ed9190c52163e5}", $vaab6f4a8019d0cb3783945c4ba29eb4d);$this->chooseRedirect($this->pre_lang . '/admin/config/domain_mirrows/' . $v662cbf1253ac7d8750ed9190c52163e5 . '/');}$ve4e46deb7f9cc58c7abfb32e5570b6f3 = domainsCollection::getInstance()->getDomain($v662cbf1253ac7d8750ed9190c52163e5);$v1971009c5db21ab4fa6ae028d9fd2c9f = $ve4e46deb7f9cc58c7abfb32e5570b6f3->getMirrowsList();$this->setDataType("list");$this->setActionType("modify");$v72c17d8462f61e41991de070221c43f0 = $this->prepareData($v21ffce5b8a6cc8cc6a41448dd69623c9, 'settings');$v324693b14d5a0b231873b065caad1e22 = $this->prepareData($v1971009c5db21ab4fa6ae028d9fd2c9f, "domain_mirrows");$v8d777f385d3dfec8815d20f7496026dc = $v72c17d8462f61e41991de070221c43f0 + $v324693b14d5a0b231873b065caad1e22;$this->setData($v8d777f385d3dfec8815d20f7496026dc, sizeof($ve4e46deb7f9cc58c7abfb32e5570b6f3));return $this->doData();}public function domain_mirrow_del() {$v662cbf1253ac7d8750ed9190c52163e5 = (int) getRequest('param0');$vdae415652515f78b591a5f12da8c4925 = (int) getRequest('param1');$vad5f82e879a9c5d6b5b442eb37e50551 = domainsCollection::getInstance()->getDomain($v662cbf1253ac7d8750ed9190c52163e5);$vad5f82e879a9c5d6b5b442eb37e50551->delMirrow($vdae415652515f78b591a5f12da8c4925);$vad5f82e879a9c5d6b5b442eb37e50551->commit();$this->chooseRedirect($this->pre_lang . "/admin/config/domain_mirrows/{$v662cbf1253ac7d8750ed9190c52163e5}/");}public function domain_del() {$v662cbf1253ac7d8750ed9190c52163e5 = (int) getRequest('param0');domainsCollection::getInstance()->delDomain($v662cbf1253ac7d8750ed9190c52163e5);$this->chooseRedirect($this->pre_lang . '/admin/config/domains/');}};?>