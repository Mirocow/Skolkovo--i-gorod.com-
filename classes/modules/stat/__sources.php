<?php
 abstract class __sources_stat extends baseModuleAdmin {public function sources() {$this->updateFilter();$v3086f2e00ea19967e011c652edfc2884 = getRequest('param0');$v7982b1e077e535e00dc62cf8d6e9a455 = cmsController::getInstance()->getCurrentDomain()->getHost();$v23a2cbb13502e40ff869bbfa3211fc9b = cmsController::getInstance()->getCurrentLang()->getPrefix();$v935ce824edb160b3142d2c3f4ad8f9d5 = '/'.$v23a2cbb13502e40ff869bbfa3211fc9b.'/admin/stat/';$v5430f956c571aa9e86e91947b5da11a2 = $v935ce824edb160b3142d2c3f4ad8f9d5.__FUNCTION__;$v4062f8ff37e55691af3f19fac2155cf9 = '';$v9549dd6065d019211460c59a86dd6536 = new statisticFactory(dirname(__FILE__) . '/classes');$v9549dd6065d019211460c59a86dd6536->isValid('sourcesDomains');$ve98d2f001da5678b39482efbdf5770dc = $v9549dd6065d019211460c59a86dd6536->get('sourcesDomains');$ve98d2f001da5678b39482efbdf5770dc->setStart($this->from_time);$ve98d2f001da5678b39482efbdf5770dc->setFinish($this->to_time);$ve98d2f001da5678b39482efbdf5770dc->setLimit($this->items_per_page);$ve98d2f001da5678b39482efbdf5770dc->setDomain($this->domain);$ve98d2f001da5678b39482efbdf5770dc->setUser($this->user);if ($v3086f2e00ea19967e011c652edfc2884 === 'xml') {$result = $ve98d2f001da5678b39482efbdf5770dc->get();$v03f1bcf4bdfde045733bb97482344c55 = 0;$v58048d5700b450e117e35a9c095fa5cb = $result['summ'];$v233762765fbf2a8381bb11dac5c21b8f = $result['total'];$va985177e18afdab154ab615657ef1514 = "";$va985177e18afdab154ab615657ef1514 .= "<"."?xml version=\"1.0\" encoding=\"utf-8\"?".">\n";$va985177e18afdab154ab615657ef1514 .= <<<END
					<statistics>
					<report name="sourcesDomains" title="Источники переходов" host="{$v7982b1e077e535e00dc62cf8d6e9a455}" lang="{$v23a2cbb13502e40ff869bbfa3211fc9b}"  timerange_start="{$this->from_time}" timerange_finish="{$this->to_time}">
					<table>
						<column field="name" title="Ссылающийся домен" valueSuffix="" prefix="" />
						<column field="cnt" title="Переходов абс." valueSuffix="" prefix="" />
						<column field="rel" title="Переходов отн." valueSuffix="%" prefix="" />
					</table>
					<chart type="pie">
						<argument />
						<value field="cnt" />
						<caption field="name" />
					</chart>
					<data>
END;
						<row cnt="{$v02f23ea9e3029ddaa616ddb1af52ada9}" name="{$v2b9331d042732a4c71ed6b1975fe04c4}" uri="{$ve334be05f2d25b295e8542a58661ed67}" rel="{$va140ee0297c98eb2fcdcffb026609e8d}" />
END;
					<statistics>
					<report name="sourcesDomainsConcrete" title="Источники переходов с выбранного домена" host="{$v7982b1e077e535e00dc62cf8d6e9a455}" lang="{$v23a2cbb13502e40ff869bbfa3211fc9b}"  timerange_start="{$this->from_time}" timerange_finish="{$this->to_time}">
					<table>
						<column field="name"  title="Ссылающаяся страница" valueSuffix="" prefix=""/>
						<column field="cnt"   title="Переходов абс." valueSuffix="" prefix="" />
						<column field="rel"   title="Переходов отн." valueSuffix="%" prefix="" />
						<column field="entry" title="Точки входа" uriField="entryUri" />
					</table>
					<chart type="pie">
						<argument />
						<value field="cnt" />
						<caption field="name" />
					</chart>
					
					<data>
END;
						<row cnt="{$v02f23ea9e3029ddaa616ddb1af52ada9}" name="{$v2b9331d042732a4c71ed6b1975fe04c4}" uri="{$ve334be05f2d25b295e8542a58661ed67}" rel="{$va140ee0297c98eb2fcdcffb026609e8d}" entry="[Двойной щелчок для просмотра]" entryUri="{$vea1b895328132c524becf9139b29ef5d}" />
END;
					<report name="sourcesEntry" title="Точки входа для выбранного источника" 
							host="'.$v7982b1e077e535e00dc62cf8d6e9a455.'" lang="'.$v23a2cbb13502e40ff869bbfa3211fc9b.'" timerange_start="'.$this->from_time.'" timerange_finish="'.$this->to_time.'">
					<table>
						<column field="name"  title="Точка входа" datatipField="uri" />
						<column field="count" title="Переходов"  />
					</table>
					<chart type="pie">
						<argument />
						<value field="count" />
						<caption field="name" />
					</chart>					
					<data>';foreach($v5c633ca74df261fa24405e9e8ff9e444 as $vad4f3b23a9c1baee57e5d091271a0053) {$vfc19ae0e7cb9076cc4077381bbe0b168  = $vad4f3b23a9c1baee57e5d091271a0053['section'];$vb7be9c18cf270cc2f6ddd546fd8a938d   = htmlspecialchars($vad4f3b23a9c1baee57e5d091271a0053['uri']);$v4001fcc4579ade3073c3d6b350f1cb1d = $vad4f3b23a9c1baee57e5d091271a0053['count'];$va985177e18afdab154ab615657ef1514 .= "<row name=\"".$vfc19ae0e7cb9076cc4077381bbe0b168."\" count=\"".$v4001fcc4579ade3073c3d6b350f1cb1d."\" uri=\"".$vb7be9c18cf270cc2f6ddd546fd8a938d."\" />";}$va985177e18afdab154ab615657ef1514 .= "</data></report></statistics>";header("Content-type: text/xml; charset=utf-8");header("Content-length: ".strlen($va985177e18afdab154ab615657ef1514));$this->flush($va985177e18afdab154ab615657ef1514);return "";}$v21ffce5b8a6cc8cc6a41448dd69623c9 = array();$v21ffce5b8a6cc8cc6a41448dd69623c9['filter'] = $this->getFilterPanel();$v21ffce5b8a6cc8cc6a41448dd69623c9['ReportSourcesEntry']['flash:report1']       = "url=".$v5430f956c571aa9e86e91947b5da11a2."/xml/".$v4062f8ff37e55691af3f19fac2155cf9;$this->setDataType("settings");$this->setActionType("view");$v8d777f385d3dfec8815d20f7496026dc = $this->prepareData($v21ffce5b8a6cc8cc6a41448dd69623c9, 'settings');$this->setData($v8d777f385d3dfec8815d20f7496026dc);return $this->doData();}};?>