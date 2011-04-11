<?php
abstract class __stat_auditory extends baseModuleAdmin {public function auditory() {$this->updateFilter();$v3086f2e00ea19967e011c652edfc2884 = getRequest('param0');$v7982b1e077e535e00dc62cf8d6e9a455 = cmsController::getInstance()->getCurrentDomain()->getHost();$v23a2cbb13502e40ff869bbfa3211fc9b = cmsController::getInstance()->getCurrentLang()->getPrefix();$v5430f956c571aa9e86e91947b5da11a2 = '/'.$v23a2cbb13502e40ff869bbfa3211fc9b.'/admin/stat/'.__FUNCTION__;$v4062f8ff37e55691af3f19fac2155cf9 = '';$v9549dd6065d019211460c59a86dd6536 = new statisticFactory(dirname(__FILE__) . '/classes');$v9549dd6065d019211460c59a86dd6536->isValid('auditoryVolume');if ($v3086f2e00ea19967e011c652edfc2884 === 'xml1') {$v9549dd6065d019211460c59a86dd6536->isValid('auditoryVolume');$ve98d2f001da5678b39482efbdf5770dc = $v9549dd6065d019211460c59a86dd6536->get('auditoryVolume');$ve98d2f001da5678b39482efbdf5770dc->setStart($this->from_time);$ve98d2f001da5678b39482efbdf5770dc->setFinish($this->to_time);$ve98d2f001da5678b39482efbdf5770dc->setDomain($this->domain);$ve98d2f001da5678b39482efbdf5770dc->setUser($this->user);$ve98d2f001da5678b39482efbdf5770dc->setLimit(PHP_INT_MAX);$ve98d2f001da5678b39482efbdf5770dc->setOffset(0);$result = $ve98d2f001da5678b39482efbdf5770dc->get();$v34150d337d460ce2d2ae7d28e9b18494 = $result['groupby'];$v536abab2f53adfbd61d1d1c2485196a7 = 86400;$v9f78da2c282346d78bcb244ed7a40440    = 'md';$v990caa935af0f7848def80c4410e1336    = 'M-d';$va7c8f591dfc4706427b53f589726651c = 'от';$vae1f708a884ba6bffaccd0d92bfa14f2 = "Период";$v86c7c363d64c6177a277eca03af6b92a = "периодам";if ($v34150d337d460ce2d2ae7d28e9b18494 === 'month') {$vae1f708a884ba6bffaccd0d92bfa14f2 = "Месяц";$v86c7c363d64c6177a277eca03af6b92a = "месяцам";$v9f78da2c282346d78bcb244ed7a40440    = 'md';$v536abab2f53adfbd61d1d1c2485196a7 = 86400*7*30;}elseif ($v34150d337d460ce2d2ae7d28e9b18494 === 'week') {$vae1f708a884ba6bffaccd0d92bfa14f2   = "Неделя";$v86c7c363d64c6177a277eca03af6b92a = "неделям";$v9f78da2c282346d78bcb244ed7a40440   =  "W";$v536abab2f53adfbd61d1d1c2485196a7 = 86400*7;}elseif($v34150d337d460ce2d2ae7d28e9b18494 === 'hour') {$vae1f708a884ba6bffaccd0d92bfa14f2 = "Час";$v86c7c363d64c6177a277eca03af6b92a = "часам";$v990caa935af0f7848def80c4410e1336    = 'G';$va7c8f591dfc4706427b53f589726651c = 'час';$v536abab2f53adfbd61d1d1c2485196a7 = 3600;$v9f78da2c282346d78bcb244ed7a40440    = 'H';}$va985177e18afdab154ab615657ef1514 = "";$va985177e18afdab154ab615657ef1514 .= "<"."?xml version=\"1.0\" encoding=\"utf-8\"?".">\n";$va985177e18afdab154ab615657ef1514 .= <<<END
				<statistics>
				<report name="auditoryVolume" title="Динамика изменения объема аудитории сайта" host="{$v7982b1e077e535e00dc62cf8d6e9a455}" lang="{$v23a2cbb13502e40ff869bbfa3211fc9b}" timerange_start="{$this->from_time}" timerange_finish="{$this->to_time}" groupby="{$v34150d337d460ce2d2ae7d28e9b18494}">
				<table>
					<column field="period" title="{$vae1f708a884ba6bffaccd0d92bfa14f2}" units="" prefix="" />
					<column field="count" title="Посетителей" units="" prefix="" />
				</table>
				<chart type="column" drawTrendLine="true">
					<argument/>
					<value field="count" description="Количество посетителей" axisTitle="Количество посетителей" />
					<caption field="period" />
				</chart>
				<data>
END;
				<statistics>
				<report name="auditoryVolumeGrowth" title="Динамика прироста объема аудитории сайта" host="{$v7982b1e077e535e00dc62cf8d6e9a455}" lang="{$v23a2cbb13502e40ff869bbfa3211fc9b}" timerange_start="{$this->from_time}" timerange_finish="{$this->to_time}" groupby="{$v34150d337d460ce2d2ae7d28e9b18494}">
				<table>
					<column field="period" title="{$vae1f708a884ba6bffaccd0d92bfa14f2}" units="" prefix="" />
					<column field="count" title="Новых посетителей" units="" prefix="" />
				</table>
				<chart type="column" drawTrendLine="true">
					<argument />
					<value field="count" description="Количество новых посетителей" axisTitle="Количество новых посетителей"  />
					<caption field="period" />
				</chart>
				<data>
END;
				<statistic report="auditoryVolume" title="Динамика изменения объема аудитории сайта" host="{$v7982b1e077e535e00dc62cf8d6e9a455}" lang="{$v23a2cbb13502e40ff869bbfa3211fc9b}" timerange_start="{$this->from_time}" timerange_finish="{$this->to_time}" groupby="{$v34150d337d460ce2d2ae7d28e9b18494}">
				<cols>
					<col name="name" title="{$vae1f708a884ba6bffaccd0d92bfa14f2}" units="" prefix="" />
					<col name="cnt" title="Посетителей" units="" prefix="" />
				</cols>
				<reports>
					<report type="xml" title="xml" uri="{$v5430f956c571aa9e86e91947b5da11a2}/xml/{$v4062f8ff37e55691af3f19fac2155cf9}" />
					<report type="txt" title="txt" uri="{$v5430f956c571aa9e86e91947b5da11a2}/txt/{$v4062f8ff37e55691af3f19fac2155cf9}" />
					<report type="rfccsv" title="csv" uri="{$v5430f956c571aa9e86e91947b5da11a2}/rfccsv/{$v4062f8ff37e55691af3f19fac2155cf9}" />
					<report type="mscsv" title="xls" uri="{$v5430f956c571aa9e86e91947b5da11a2}/mscsv/{$v4062f8ff37e55691af3f19fac2155cf9}" />
				</reports>
				<details>
END;
				<statistic report="auditoryVolumeGrowth" title="Динамика прироста объема аудитории сайта" host="{$v7982b1e077e535e00dc62cf8d6e9a455}" lang="{$v23a2cbb13502e40ff869bbfa3211fc9b}" timerange_start="{$this->from_time}" timerange_finish="{$this->to_time}" groupby="{$v34150d337d460ce2d2ae7d28e9b18494}">
				<cols>
					<col name="name" title="{$vae1f708a884ba6bffaccd0d92bfa14f2}" units="" prefix="" />
					<col name="cnt" title="Увеличение количества посетителей" units="" prefix="" />
				</cols>
				<reports>
					<report type="xml" title="xml" uri="{$v5430f956c571aa9e86e91947b5da11a2}/xml/{$v4062f8ff37e55691af3f19fac2155cf9}" />
					<report type="txt" title="txt" uri="{$v5430f956c571aa9e86e91947b5da11a2}/txt/{$v4062f8ff37e55691af3f19fac2155cf9}" />
					<report type="rfccsv" title="csv" uri="{$v5430f956c571aa9e86e91947b5da11a2}/rfccsv/{$v4062f8ff37e55691af3f19fac2155cf9}" />
					<report type="mscsv" title="xls" uri="{$v5430f956c571aa9e86e91947b5da11a2}/mscsv/{$v4062f8ff37e55691af3f19fac2155cf9}" />
				</reports>
				<details>
END;
				<statistic report="auditoryLoyality" host="{$v7982b1e077e535e00dc62cf8d6e9a455}" lang="{$v23a2cbb13502e40ff869bbfa3211fc9b}" timerange_start="{$this->from_time}" timerange_finish="{$this->to_time}" groupby="{$v34150d337d460ce2d2ae7d28e9b18494}">
				<details>
END;
				</details>
				<dynamic>
END;
				</dynamic>
			</statistic>
END;
				<statistics>
				<report name="auditoryLoyality1" title="Количество посетителей с повторными визитами" host="{$v7982b1e077e535e00dc62cf8d6e9a455}" lang="{$v23a2cbb13502e40ff869bbfa3211fc9b}" timerange_start="{$this->from_time}" timerange_finish="{$this->to_time}">
				<table>
					<column field="name" title="Повторных посещений" units="" prefix="" />
					<column field="cnt" title="Посетителей абс." units="" prefix="" />
					<column field="rel" title="Посетителей отн." valueSuffix="%" />
				</table>
				<chart type="pie">
					<argument />
					<value   field="cnt" description="Количество посетителей с повторными визитами"/>
					<caption field="name"/>
				</chart>
				<data>
END;
				<statistics>
				<report name="auditoryLoyality2" title="Динамика изменения среднего количества повторных посещений" host="{$v7982b1e077e535e00dc62cf8d6e9a455}" lang="{$v23a2cbb13502e40ff869bbfa3211fc9b}" timerange_start="{$this->from_time}" timerange_finish="{$this->to_time}" groupby="{$v34150d337d460ce2d2ae7d28e9b18494}">
				<table>
					<column field="name" title="{$vae1f708a884ba6bffaccd0d92bfa14f2}" units="" prefix="" />
					<column field="cnt" title="Повторных посещений" units="" prefix="" />
				</table>
				<chart type="line" drawTrendLine="true">
					<argument />
					<value   field="cnt"  description="Повторных посещений"/>
					<caption field="name"/>
				</chart>                
				<data>
END;
				<statistics report="auditoryActivity" host="{$v7982b1e077e535e00dc62cf8d6e9a455}" lang="{$v23a2cbb13502e40ff869bbfa3211fc9b}" timerange_start="{$this->from_time}" timerange_finish="{$this->to_time}" groupby="{$v34150d337d460ce2d2ae7d28e9b18494}">
				<details>
END;
				</details>
				<dynamic>
END;
				</dynamic>
			</statistic>
END;
				<statistics> 
				<report name="auditoryActivity1" title="Количество дней между возвратами посетителей" host="{$v7982b1e077e535e00dc62cf8d6e9a455}" lang="{$v23a2cbb13502e40ff869bbfa3211fc9b}" timerange_start="{$this->from_time}" timerange_finish="{$this->to_time}">
				<table>
					<column field="name" title="Дней между возвратами" />
					<column field="cnt" title="Посетителей абс." />
					<column field="rel" title="Посетителей отн." valueSuffix="%" />
				</table>
				<chart type="pie">
					<argument />
					<value field="cnt" description="Количество посетителей" />
					<caption field="name" />
				</chart>
				<data>
END;
				<statistics>
				<report name="auditoryActivity2" title="Динамика изменения среднего промежутка между возвратами посетителей" host="{$v7982b1e077e535e00dc62cf8d6e9a455}" lang="{$v23a2cbb13502e40ff869bbfa3211fc9b}" timerange_start="{$this->from_time}" timerange_finish="{$this->to_time}" groupby="{$v34150d337d460ce2d2ae7d28e9b18494}">
				<table>
					<column field="name" title="{$vae1f708a884ba6bffaccd0d92bfa14f2}" units="" />
					<column field="cnt" title="Промежуток между возвратами" valueSuffix=" дн." />
				</table>
				<chart type="line" drawTrendLine="true">
					<argument />
					<value field="cnt" description="Количество дней между возвратами" axisTitle="Количество дней между возвратами"  />
					<caption field="name" />
				</chart>
				<data>
END;
				<statistic report="visitDeep" host="{$v7982b1e077e535e00dc62cf8d6e9a455}" lang="{$v23a2cbb13502e40ff869bbfa3211fc9b}" timerange_start="{$this->from_time}" timerange_finish="{$this->to_time}" groupby="{$v34150d337d460ce2d2ae7d28e9b18494}">
				<details>
END;
				</details>
				<dynamic>
END;
				</dynamic>
			</statistic>
END;
				<statistics>
				<report name="visitDeep1" title="Распределение посещений по глубине просмотра сайта" host="{$v7982b1e077e535e00dc62cf8d6e9a455}" lang="{$v23a2cbb13502e40ff869bbfa3211fc9b}" timerange_start="{$this->from_time}" timerange_finish="{$this->to_time}">
				<table>
					<column field="name" title="Глубина" units="страниц" prefix="" />
					<column field="cnt" title="Посещений абс." units="" prefix="" />
					<column field="rel" title="Посещений отн." valueSuffix="%" prefix="" />
				</table>
				<chart type="column" drawTrendLine="true">
					<argument />
					<value field="cnt" description="Количество посещений" axisTitle="Количество посещений" />
					<caption field="name" />
				</chart>
				<data>
END;
				<statistics>
				<report name="visitDeep2" title="Динамика средней глубины просмотра сайта" host="{$v7982b1e077e535e00dc62cf8d6e9a455}" lang="{$v23a2cbb13502e40ff869bbfa3211fc9b}" timerange_start="{$this->from_time}" timerange_finish="{$this->to_time}" groupby="{$v34150d337d460ce2d2ae7d28e9b18494}">
				<table>
					<column field="name" title="{$vae1f708a884ba6bffaccd0d92bfa14f2}" units="" prefix="" />
					<column field="cnt" title="Средняя глубина" valueSuffix=" страниц" prefix="" />
				</table>
				<chart type="line" drawTrendLine="true">
					<argument />
					<value field="cnt" description="Средняя глубина (страниц)" axisTitle="Страниц" />
					<caption field="name" />
				</chart>
				<data>
END;
				<statistic report="visitTime" host="{$v7982b1e077e535e00dc62cf8d6e9a455}" lang="{$v23a2cbb13502e40ff869bbfa3211fc9b}" timerange_start="{$this->from_time}" timerange_finish="{$this->to_time}" groupby="{$v34150d337d460ce2d2ae7d28e9b18494}">
				<details>
END;
				</details>
				<dynamic>
END;
				</dynamic>
			</statistic>
END;
				<statistics>
				<report name="visitTime1" title="Распределение посещений по времени нахождения на сайте" host="{$v7982b1e077e535e00dc62cf8d6e9a455}" lang="{$v23a2cbb13502e40ff869bbfa3211fc9b}" timerange_start="{$this->from_time}" timerange_finish="{$this->to_time}">
				<table>
					<column field="name" title="Продолжительность" units="минут" prefix="" />
					<column field="cnt" title="Посещений абс." units="" prefix="" />
					<column field="rel" title="Посещений отн." valueSuffix="%" prefix="" />
				</table>
				<chart type="pie">
					<argument  />
					<value field="cnt" description="Количество посещений" axisTitle="Количество посещений" />
					<caption field="name" />
				</chart>
				<data>
END;
				<statistics>
				<report name="visitTime2" title="Динамика средней продолжительности нахождения посетителей на сайте" host="{$v7982b1e077e535e00dc62cf8d6e9a455}" lang="{$v23a2cbb13502e40ff869bbfa3211fc9b}" timerange_start="{$this->from_time}" timerange_finish="{$this->to_time}" groupby="{$v34150d337d460ce2d2ae7d28e9b18494}">
				<table>
					<column field="ts" title="{$vae1f708a884ba6bffaccd0d92bfa14f2}" showas="date" units="" prefix="" />
					<column field="cnt" title="Средняя продолжительность" units="" prefix="" />
				</table>
				<chart type="{$v2d53044f25b9618c5b464d8ad32738ee}" drawTrendLine="true">
					<argument fiels="ts" axisTitle="{$vcdfd49c0cb3b82478900e281be6d69a8}"  />
					<value field="cnt" description="Средняя продолжительность" axisTitle="Минут"  />
					<caption field="name" />
				</chart>                                
END;
				<report name="auditoryLocation" title="Распределение аудитории по городам" 
						host="'.$v7982b1e077e535e00dc62cf8d6e9a455.'" lang="'.$v23a2cbb13502e40ff869bbfa3211fc9b.'" timerange_start="'.$this->from_time.'" timerange_finish="'.$this->to_time.'">
				<table>
					<column field="name"  title="Город" />
					<column field="count" title="Количество посетителей"  />
				</table>
				<chart type="pie">
					<argument />
					<value field="count" />
					<caption field="name" />
				</chart>                    
				<data>';foreach($v5c633ca74df261fa24405e9e8ff9e444 as $vad4f3b23a9c1baee57e5d091271a0053) {$vfc19ae0e7cb9076cc4077381bbe0b168  = $vad4f3b23a9c1baee57e5d091271a0053['location'];$v4001fcc4579ade3073c3d6b350f1cb1d = $vad4f3b23a9c1baee57e5d091271a0053['count'];$va985177e18afdab154ab615657ef1514 .= "<row name=\"".$vfc19ae0e7cb9076cc4077381bbe0b168."\" count=\"".$v4001fcc4579ade3073c3d6b350f1cb1d."\" />";}$va985177e18afdab154ab615657ef1514 .= "</data></report></statistics>";header("Content-type: text/xml; charset=utf-8");header("Content-length: ".strlen($va985177e18afdab154ab615657ef1514));$this->flush($va985177e18afdab154ab615657ef1514);return "";}if(!(cmsController::getInstance()->getModule("geoip") === false)) {$v21ffce5b8a6cc8cc6a41448dd69623c9 = array();$v21ffce5b8a6cc8cc6a41448dd69623c9['filter'] = $this->getFilterPanel();$v21ffce5b8a6cc8cc6a41448dd69623c9['ReportLocation']['flash:report1']       = "url=".$v5430f956c571aa9e86e91947b5da11a2."/xml/".$v4062f8ff37e55691af3f19fac2155cf9;$this->setDataType("settings");$this->setActionType("view");$v8d777f385d3dfec8815d20f7496026dc = $this->prepareData($v21ffce5b8a6cc8cc6a41448dd69623c9, 'settings');$this->setData($v8d777f385d3dfec8815d20f7496026dc);return $this->doData();}else {throw new publicAdminException(getLabel('error-no-geoip'));return null;}}}?>