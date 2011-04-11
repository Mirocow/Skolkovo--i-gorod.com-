<?php
 abstract class __emarket_purchasing extends def_module {public static $purchaseSteps = array('required');public function onInit() {$vb1444fb0c07653567ad325aa25d4e37a = regedit::getInstance();if($vb1444fb0c07653567ad325aa25d4e37a->getVal('//modules/emarket/enable-delivery')) {self::$purchaseSteps[] = 'delivery';}if($vb1444fb0c07653567ad325aa25d4e37a->getVal('//modules/emarket/enable-payment')) {self::$purchaseSteps[] = 'payment';}self::$purchaseSteps[] = 'result';if(in_array(cmsController::getInstance()->getCurrentMethod(), array("gateway", "receipt") )) {$this->__loadLib("__payments.php");$this->__implement("__emarket_payment");}}public function basketAddLink($v7552cd149af7495ee7d8225974e50f80, $v66f6181bcb4cff4cd38fbc804a036db6 = 'default') {list($v31912934b8f34be4364cc043cd8a0176) = def_module::loadTemplates("./tpls/emarket/{$v66f6181bcb4cff4cd38fbc804a036db6}.tpl", 'basket_add_link');return def_module::parseTemplate($v31912934b8f34be4364cc043cd8a0176, array(    'link' => $this->pre_lang . '/emarket/basket/put/element/' . (int) $v7552cd149af7495ee7d8225974e50f80 . '/'   ));}public function getPrice(iUmiHierarchyElement $v8e2dcfd7e7e24b1ca76c1193f645902b, $vaf067b857816c1e2e298ee76f10b13f4 = false) {$ve2dc6c48c56de466f6d13781796abf3d = itemDiscount::search($v8e2dcfd7e7e24b1ca76c1193f645902b);$v78a5eb43deef9a7b5b9ce157b9d52ac4 = $v8e2dcfd7e7e24b1ca76c1193f645902b->price;if(!$vaf067b857816c1e2e298ee76f10b13f4 && $ve2dc6c48c56de466f6d13781796abf3d instanceof discount) {$v78a5eb43deef9a7b5b9ce157b9d52ac4 = $ve2dc6c48c56de466f6d13781796abf3d->recalcPrice($v78a5eb43deef9a7b5b9ce157b9d52ac4);}return $v78a5eb43deef9a7b5b9ce157b9d52ac4;}public function price($v7552cd149af7495ee7d8225974e50f80 = null, $v66f6181bcb4cff4cd38fbc804a036db6 = 'default', $v59972bebe275e6a999b5c03c48c30baa = true) {if(!$v7552cd149af7495ee7d8225974e50f80) return;$vb81ca7c0ccaa77e7aa91936ab0070695 = umiHierarchy::getInstance();$v7552cd149af7495ee7d8225974e50f80 = $this->analyzeRequiredPath($v7552cd149af7495ee7d8225974e50f80);if($v7552cd149af7495ee7d8225974e50f80 == false) {throw new publicException("Wrong element id given");}$v8e2dcfd7e7e24b1ca76c1193f645902b = $vb81ca7c0ccaa77e7aa91936ab0070695->getElement($v7552cd149af7495ee7d8225974e50f80);if($v8e2dcfd7e7e24b1ca76c1193f645902b instanceof iUmiHierarchyElement == false) {throw new publicException("Wrong element id given");}list($v31912934b8f34be4364cc043cd8a0176) = def_module::loadTemplates("./tpls/emarket/{$v66f6181bcb4cff4cd38fbc804a036db6}.tpl", 'price_block');$v26b9632b8ee118c32a553473c2e43969 = $v8e2dcfd7e7e24b1ca76c1193f645902b->price;$result = array(    'attribute:element-id' => $v7552cd149af7495ee7d8225974e50f80   );$ve2dc6c48c56de466f6d13781796abf3d = itemDiscount::search($v8e2dcfd7e7e24b1ca76c1193f645902b);if($ve2dc6c48c56de466f6d13781796abf3d instanceof discount) {$result['discount'] = array(     'attribute:id'  => $ve2dc6c48c56de466f6d13781796abf3d->id,     'attribute:name' => $ve2dc6c48c56de466f6d13781796abf3d->getName(),     'description'  => $ve2dc6c48c56de466f6d13781796abf3d->getValue('description')    );$result['void:discount_id'] = $ve2dc6c48c56de466f6d13781796abf3d->id;}$v78a5eb43deef9a7b5b9ce157b9d52ac4 = self::formatPrice($v8e2dcfd7e7e24b1ca76c1193f645902b->price, $ve2dc6c48c56de466f6d13781796abf3d);if($v59972bebe275e6a999b5c03c48c30baa && $vb01ab0998bdd68a4ed8f29436cf0fdc9 = $this->formatCurrencyPrice($v78a5eb43deef9a7b5b9ce157b9d52ac4)) {$result['price'] = $vb01ab0998bdd68a4ed8f29436cf0fdc9;}else {$result['price'] = $v78a5eb43deef9a7b5b9ce157b9d52ac4;}if($v31912934b8f34be4364cc043cd8a0176) {$result['price'] = $this->parsePriceTpl($v66f6181bcb4cff4cd38fbc804a036db6, $result['price']);$result['void:price-original'] = getArrayKey($result['price'], 'original');$result['void:price-actual'] = getArrayKey($result['price'], 'actual');}if($v59972bebe275e6a999b5c03c48c30baa) {$result['currencies'] = $this->formatCurrencyPrices($v78a5eb43deef9a7b5b9ce157b9d52ac4);$result['currency-prices'] = $this->parseCurrencyPricesTpl($v66f6181bcb4cff4cd38fbc804a036db6, $v78a5eb43deef9a7b5b9ce157b9d52ac4);}return def_module::parseTemplate($v31912934b8f34be4364cc043cd8a0176, $result);}public function basket($v15d61712450a686a7f365adf4fef581f = false, $v6149843274f2e068b5b7de0061ffa338 = false, $v59a814aa020a1b32c4674a5887a35022 = false) {$v70a17ffa722a3985b86d30b034ad06d7 = self::getBasketOrder();$v15d61712450a686a7f365adf4fef581f = $v15d61712450a686a7f365adf4fef581f ? $v15d61712450a686a7f365adf4fef581f : getRequest('param0');$v6149843274f2e068b5b7de0061ffa338 = $v6149843274f2e068b5b7de0061ffa338 ? $v6149843274f2e068b5b7de0061ffa338 : getRequest('param1');$v59a814aa020a1b32c4674a5887a35022 = $v59a814aa020a1b32c4674a5887a35022 ? $v59a814aa020a1b32c4674a5887a35022 : getRequest('param2');$ve9f40e1f1d1658681dad2dac4ae0971e = getRequest('amount');$v93da65a9fd0004d9477aeac024e08e15 = getRequest('options');$v70a17ffa722a3985b86d30b034ad06d7->refresh();if($v15d61712450a686a7f365adf4fef581f == 'put') {$v39b91a7e3e05f526a19899c65efe3675 = ($v6149843274f2e068b5b7de0061ffa338 == 'element') ? $this->getBasketItem($v59a814aa020a1b32c4674a5887a35022) : $v70a17ffa722a3985b86d30b034ad06d7->getItem($v59a814aa020a1b32c4674a5887a35022);if(is_array($v93da65a9fd0004d9477aeac024e08e15)) {if($v6149843274f2e068b5b7de0061ffa338 != 'element') {throw new publicException("Put basket method required element id of optionedOrderItem");}$v125400e5879efb03f17ff21cd2697b9e = $v70a17ffa722a3985b86d30b034ad06d7->getItems();foreach($v125400e5879efb03f17ff21cd2697b9e as $v39b91a7e3e05f526a19899c65efe3675) {$vd647dda26932e7b3bc42d1cba8798b68 = $v39b91a7e3e05f526a19899c65efe3675->getOptions();if(sizeof($vd647dda26932e7b3bc42d1cba8798b68) != sizeof($v93da65a9fd0004d9477aeac024e08e15)) {$vd647dda26932e7b3bc42d1cba8798b68 = null;$v39b91a7e3e05f526a19899c65efe3675 = null;continue;}foreach($v93da65a9fd0004d9477aeac024e08e15 as $v3362c2e683feb614336ab0f41324ec57 => $v5f966ba427f81d4e3b5c4f1735f63499) {$v39d6a1ec10a76988fa91d55806d930b8 = getArrayKey($vd647dda26932e7b3bc42d1cba8798b68, $v3362c2e683feb614336ab0f41324ec57);if(getArrayKey($v39d6a1ec10a76988fa91d55806d930b8, 'option-id') != $v5f966ba427f81d4e3b5c4f1735f63499) {$v39b91a7e3e05f526a19899c65efe3675 = null;continue 2;}}break;}if(is_null($v39b91a7e3e05f526a19899c65efe3675)) {$v39b91a7e3e05f526a19899c65efe3675 = orderItem::create($v59a814aa020a1b32c4674a5887a35022);$v70a17ffa722a3985b86d30b034ad06d7->appendItem($v39b91a7e3e05f526a19899c65efe3675);}if($v39b91a7e3e05f526a19899c65efe3675 instanceof optionedOrderItem) {foreach($v93da65a9fd0004d9477aeac024e08e15 as $v3362c2e683feb614336ab0f41324ec57 => $v5f966ba427f81d4e3b5c4f1735f63499) {if($v5f966ba427f81d4e3b5c4f1735f63499) {$v39b91a7e3e05f526a19899c65efe3675->appendOption($v3362c2e683feb614336ab0f41324ec57, $v5f966ba427f81d4e3b5c4f1735f63499);}else {$v39b91a7e3e05f526a19899c65efe3675->removeOption($v3362c2e683feb614336ab0f41324ec57);}}}}$ve9f40e1f1d1658681dad2dac4ae0971e = $ve9f40e1f1d1658681dad2dac4ae0971e ? $ve9f40e1f1d1658681dad2dac4ae0971e : ($v39b91a7e3e05f526a19899c65efe3675->getAmount() + 1);$v39b91a7e3e05f526a19899c65efe3675->setAmount($ve9f40e1f1d1658681dad2dac4ae0971e ? $ve9f40e1f1d1658681dad2dac4ae0971e : 1);$v39b91a7e3e05f526a19899c65efe3675->refresh();if($v6149843274f2e068b5b7de0061ffa338 == 'element') {$v70a17ffa722a3985b86d30b034ad06d7->appendItem($v39b91a7e3e05f526a19899c65efe3675);}$v70a17ffa722a3985b86d30b034ad06d7->refresh();}if($v15d61712450a686a7f365adf4fef581f == 'remove') {$v39b91a7e3e05f526a19899c65efe3675 = ($v6149843274f2e068b5b7de0061ffa338 == 'element') ? $this->getBasketItem($v59a814aa020a1b32c4674a5887a35022, false) : orderItem::get($v59a814aa020a1b32c4674a5887a35022);if($v39b91a7e3e05f526a19899c65efe3675 instanceof orderItem) {$v70a17ffa722a3985b86d30b034ad06d7->removeItem($v39b91a7e3e05f526a19899c65efe3675);$v70a17ffa722a3985b86d30b034ad06d7->refresh();}}$vc66c00ae9f18fc0c67d8973bd07dc4cd = getServer('HTTP_REFERER');$vff393ffe060b803eb72c60c6e721febf = getRequest('no-redirect');if($v75e25c507b3048beaab01a12e7624ba2 = getRequest('redirect-uri')) {$this->redirect($v75e25c507b3048beaab01a12e7624ba2);}else if (!defined('VIA_HTTP_SCHEME') && !$vff393ffe060b803eb72c60c6e721febf && $vc66c00ae9f18fc0c67d8973bd07dc4cd) {$this->redirect($vc66c00ae9f18fc0c67d8973bd07dc4cd);}$v70a17ffa722a3985b86d30b034ad06d7->refresh();return $this->order($v70a17ffa722a3985b86d30b034ad06d7->getId());}public function cart($v66f6181bcb4cff4cd38fbc804a036db6 = 'default') {$v70a17ffa722a3985b86d30b034ad06d7 = self::getBasketOrder();$v70a17ffa722a3985b86d30b034ad06d7->refresh();return $this->order($v70a17ffa722a3985b86d30b034ad06d7->getId(), $v66f6181bcb4cff4cd38fbc804a036db6);}public function order($v61e9abeaa2ba0e1296555c135d818e6e = false, $v66f6181bcb4cff4cd38fbc804a036db6 = 'default') {if($this->breakMe()) return;if(!$v66f6181bcb4cff4cd38fbc804a036db6) $v66f6181bcb4cff4cd38fbc804a036db6 = 'default';$permissions = permissionsCollection::getInstance();$v61e9abeaa2ba0e1296555c135d818e6e = (int) ($v61e9abeaa2ba0e1296555c135d818e6e ? $v61e9abeaa2ba0e1296555c135d818e6e : getRequest('param0'));if(!$v61e9abeaa2ba0e1296555c135d818e6e) {throw new publicException("You should specify order id");}$v70a17ffa722a3985b86d30b034ad06d7 = order::get($v61e9abeaa2ba0e1296555c135d818e6e);if($v70a17ffa722a3985b86d30b034ad06d7 instanceof order == false) {throw new publicException("Order #{$v61e9abeaa2ba0e1296555c135d818e6e} doesn't exists");}if(!$permissions->isSv() && (customer::get()->getId() != $v70a17ffa722a3985b86d30b034ad06d7->customer_id)) {throw new publicException(getLabel('error-require-more-permissions'));}list($v31912934b8f34be4364cc043cd8a0176, $vd268fd226c122b3da2fabee66e798225) = def_module::loadTemplates("./tpls/emarket/{$v66f6181bcb4cff4cd38fbc804a036db6}.tpl",    'order_block', 'order_block_empty');$ve2dc6c48c56de466f6d13781796abf3d = $v70a17ffa722a3985b86d30b034ad06d7->getDiscount();$vba1ab1f527cb86ed46733ee90be3d58e = $v70a17ffa722a3985b86d30b034ad06d7->getTotalAmount();$v26b9632b8ee118c32a553473c2e43969 = $v70a17ffa722a3985b86d30b034ad06d7->getOriginalPrice();$v928419bc24fdb7d83103496423c71f5c = $v70a17ffa722a3985b86d30b034ad06d7->getActualPrice();if($v26b9632b8ee118c32a553473c2e43969 == $v928419bc24fdb7d83103496423c71f5c) {$v26b9632b8ee118c32a553473c2e43969 = null;}$result = array(    'attribute:id' => ($v61e9abeaa2ba0e1296555c135d818e6e),    'xlink:href' => ('uobject://' . $v61e9abeaa2ba0e1296555c135d818e6e),    'customer'  => $v31912934b8f34be4364cc043cd8a0176 ? null : $this->renderOrderCustomer($v70a17ffa722a3985b86d30b034ad06d7, $v66f6181bcb4cff4cd38fbc804a036db6),    'items'   => $this->renderOrderItems($v70a17ffa722a3985b86d30b034ad06d7, $v66f6181bcb4cff4cd38fbc804a036db6),    'summary'  => array(     'amount'  => $vba1ab1f527cb86ed46733ee90be3d58e,     'price'   => $this->formatCurrencyPrice(array(      'original'  => $v26b9632b8ee118c32a553473c2e43969,      'actual'  => $v928419bc24fdb7d83103496423c71f5c     ))    )   );if($v70a17ffa722a3985b86d30b034ad06d7->number) {$result['number'] = $v70a17ffa722a3985b86d30b034ad06d7->number;$result['status'] = selector::get('object')->id($v70a17ffa722a3985b86d30b034ad06d7->status_id);}if($v31912934b8f34be4364cc043cd8a0176) {$result['items'] = $result['items']['nodes:item'];if(sizeof($result['items']) == 0) {$v31912934b8f34be4364cc043cd8a0176 = $vd268fd226c122b3da2fabee66e798225;}}$result['void:total-price'] = $this->parsePriceTpl($v66f6181bcb4cff4cd38fbc804a036db6, $result['summary']['price']);$result['void:total-amount'] = $vba1ab1f527cb86ed46733ee90be3d58e;if($ve2dc6c48c56de466f6d13781796abf3d instanceof discount) {$result['discount'] = array(     'attribute:id'  => $ve2dc6c48c56de466f6d13781796abf3d->id,     'attribute:name' => $ve2dc6c48c56de466f6d13781796abf3d->getName(),     'description'  => $ve2dc6c48c56de466f6d13781796abf3d->getValue('description')    );$result['void:discount_id'] = $ve2dc6c48c56de466f6d13781796abf3d->id;}return def_module::parseTemplate($v31912934b8f34be4364cc043cd8a0176, $result, false, $v70a17ffa722a3985b86d30b034ad06d7->id);}public function getBasketOrder() {static $v0fea6a13c52b4d4725368f24b045ca84;if($v0fea6a13c52b4d4725368f24b045ca84 instanceof order) {if($v0fea6a13c52b4d4725368f24b045ca84->getOrderStatus()) {$v0fea6a13c52b4d4725368f24b045ca84 = null;}else return $v0fea6a13c52b4d4725368f24b045ca84;}$v91ec1f9324753048c0096d036a694f86 = customer::get();$v8be74552df93e31bbdd6b36ed74bdb6a = new selector('objects');$v8be74552df93e31bbdd6b36ed74bdb6a->types('object-type')->name('emarket', 'order');$v8be74552df93e31bbdd6b36ed74bdb6a->where('customer_id')->equals($v91ec1f9324753048c0096d036a694f86->getId());$v8be74552df93e31bbdd6b36ed74bdb6a->order('id')->desc();$result = $v8be74552df93e31bbdd6b36ed74bdb6a->result();if($v8be74552df93e31bbdd6b36ed74bdb6a->length()) {list($v70a17ffa722a3985b86d30b034ad06d7) = $result;if($v70a17ffa722a3985b86d30b034ad06d7->status_id) {$v9acb44549b41563697bb490144ec6258 = order::getCodeByStatus($v70a17ffa722a3985b86d30b034ad06d7->status_id);if(!($v9acb44549b41563697bb490144ec6258 == 'executing' ||         ($v9acb44549b41563697bb490144ec6258 == 'payment' && order::getCodeByStatus($v70a17ffa722a3985b86d30b034ad06d7->payment_status_id) == 'initialized'))) {return $v0fea6a13c52b4d4725368f24b045ca84 = order::create();}}return $v0fea6a13c52b4d4725368f24b045ca84 = order::get($v70a17ffa722a3985b86d30b034ad06d7->id);}else {return $v0fea6a13c52b4d4725368f24b045ca84 = order::create();}}public function getBasketItem($v7552cd149af7495ee7d8225974e50f80, $v57fa476ff3da9b4562b7688adb125ad9 = true) {$v70a17ffa722a3985b86d30b034ad06d7 = self::getBasketOrder();$v125400e5879efb03f17ff21cd2697b9e = $v70a17ffa722a3985b86d30b034ad06d7->getItems();foreach($v125400e5879efb03f17ff21cd2697b9e as $v39b91a7e3e05f526a19899c65efe3675) {$v8e2dcfd7e7e24b1ca76c1193f645902b = $v39b91a7e3e05f526a19899c65efe3675->getItemElement();if($v8e2dcfd7e7e24b1ca76c1193f645902b instanceof umiHierarchyElement) {if($v8e2dcfd7e7e24b1ca76c1193f645902b->getId() == $v7552cd149af7495ee7d8225974e50f80) {return $v39b91a7e3e05f526a19899c65efe3675;}}}return $v57fa476ff3da9b4562b7688adb125ad9 ? (orderItem::create($v7552cd149af7495ee7d8225974e50f80)) : null;}public function loadPurchaseSteps() {$this->__loadLib("__payments.php");$this->__implement("__emarket_payment");$this->__loadLib("__delivery.php");$this->__implement("__emarket_delivery");$this->__loadLib("__required.php");$this->__implement("__emarket_required");}public function purchase($v66f6181bcb4cff4cd38fbc804a036db6 = 'default') {if($this->breakMe()) return;$this->loadPurchaseSteps();list($v31912934b8f34be4364cc043cd8a0176) = def_module::loadTemplates("./tpls/emarket/{$v66f6181bcb4cff4cd38fbc804a036db6}.tpl", 'purchase');$v9a8c2b9d518bc163e99611fbacea63b2 = getRequest('param0');$v2764ca9d34e90313978d044f27ae433b = getRequest('param1');$v15d61712450a686a7f365adf4fef581f = getRequest('param2');$v70a17ffa722a3985b86d30b034ad06d7 = $this->getBasketOrder();if($v70a17ffa722a3985b86d30b034ad06d7->isEmpty() && $v9a8c2b9d518bc163e99611fbacea63b2 != 'result') {throw new publicException('%error-market-empty-basket%');}$v9a8c2b9d518bc163e99611fbacea63b2 = self::getStage($v9a8c2b9d518bc163e99611fbacea63b2);if(sizeof(self::$purchaseSteps) == 2 && $v9a8c2b9d518bc163e99611fbacea63b2 == 'result' && !getRequest('param0')) {$v9a8c2b9d518bc163e99611fbacea63b2 = '';}if(!$v9a8c2b9d518bc163e99611fbacea63b2) {$v70a17ffa722a3985b86d30b034ad06d7->order();$this->redirect($this->pre_lang . '/emarket/purchase/result/successful/');}$v2ba1bc39eefd01feb1c6ed54a258c7a4 = $v9a8c2b9d518bc163e99611fbacea63b2 . 'CheckStep';$v2764ca9d34e90313978d044f27ae433b = $this->$v2ba1bc39eefd01feb1c6ed54a258c7a4($v70a17ffa722a3985b86d30b034ad06d7, $v2764ca9d34e90313978d044f27ae433b);if(!$v2764ca9d34e90313978d044f27ae433b) {$this->redirect($this->pre_lang . '/emarket/purchase/' . $v9a8c2b9d518bc163e99611fbacea63b2 . '/choose/');}$v8f3ae612227e4b266bafbf4c89d689e7 = $this->$v9a8c2b9d518bc163e99611fbacea63b2($v70a17ffa722a3985b86d30b034ad06d7, $v2764ca9d34e90313978d044f27ae433b, $v15d61712450a686a7f365adf4fef581f, $v66f6181bcb4cff4cd38fbc804a036db6);$result = array(    'purchasing' => array(     'attribute:stage' => $v9a8c2b9d518bc163e99611fbacea63b2,     'attribute:step' => $v2764ca9d34e90313978d044f27ae433b    )   );$this->setHeader("%header-{$v9a8c2b9d518bc163e99611fbacea63b2}-{$v2764ca9d34e90313978d044f27ae433b}%");if(is_array($v8f3ae612227e4b266bafbf4c89d689e7)) {$result['purchasing'] = array_merge($result['purchasing'], $v8f3ae612227e4b266bafbf4c89d689e7);}else if ($v31912934b8f34be4364cc043cd8a0176) {$result['purchasing'] = $v8f3ae612227e4b266bafbf4c89d689e7;}else {throw new publicException("Incorrect return value from {$v9a8c2b9d518bc163e99611fbacea63b2}() purchasing method");}return def_module::parseTemplate($v31912934b8f34be4364cc043cd8a0176, $result);}public function resultCheckStep(order $v70a17ffa722a3985b86d30b034ad06d7, $v2764ca9d34e90313978d044f27ae433b) {return $v2764ca9d34e90313978d044f27ae433b;}public function result(order $v70a17ffa722a3985b86d30b034ad06d7, $v2764ca9d34e90313978d044f27ae433b, $v15d61712450a686a7f365adf4fef581f, $v66f6181bcb4cff4cd38fbc804a036db6) {list($v3345917f4c165c688caa9b77653ff59e, $v427ab9439e8775e0f8a23081ebf46b1b) = def_module::loadTemplates("./tpls/emarket/{$v66f6181bcb4cff4cd38fbc804a036db6}.tpl",    'purchase_successful', 'purchase_failed');$v31912934b8f34be4364cc043cd8a0176 = ($v2764ca9d34e90313978d044f27ae433b == 'successful') ? $v3345917f4c165c688caa9b77653ff59e : $v427ab9439e8775e0f8a23081ebf46b1b;if($v31912934b8f34be4364cc043cd8a0176) {return def_module::parseTemplate($v31912934b8f34be4364cc043cd8a0176, array());}else {return array('status' => $v2764ca9d34e90313978d044f27ae433b);}}public function getCustomerInfo($v66f6181bcb4cff4cd38fbc804a036db6 = 'default') {$v70a17ffa722a3985b86d30b034ad06d7 = self::getBasketOrder();return $this->renderOrderCustomer($v70a17ffa722a3985b86d30b034ad06d7, $v66f6181bcb4cff4cd38fbc804a036db6);}public function renderOrderCustomer(order $v70a17ffa722a3985b86d30b034ad06d7, $v66f6181bcb4cff4cd38fbc804a036db6 = 'default') {$v91ec1f9324753048c0096d036a694f86 = selector::get('object')->id($v70a17ffa722a3985b86d30b034ad06d7->customer_id);if($v91ec1f9324753048c0096d036a694f86 instanceof iUmiObject == false) {throw new publicException(getLabel('error-object-does-not-exist', null, $v70a17ffa722a3985b86d30b034ad06d7->customer_id));}if(xslTemplater::getInstance()->getIsInited()) {return array(     'full:object' => $v91ec1f9324753048c0096d036a694f86    );}list($v8e926cde1dcac8f17a31c999291245bb, $vc0782b4da4d3cc46499e374593aad052) = def_module::loadTemplates("./tpls/emarket/customer/{$v66f6181bcb4cff4cd38fbc804a036db6}.tpl", "customer_user", "customer_guest");$v726e8e4809d4c1b28a6549d86436a124 = selector::get('object-type')->id($v91ec1f9324753048c0096d036a694f86->typeId);$v4f2afc9c4099ee1f39c9f551123e54bd = ($v726e8e4809d4c1b28a6549d86436a124->getModule() == 'users') ? $v8e926cde1dcac8f17a31c999291245bb : $vc0782b4da4d3cc46499e374593aad052;return def_module::parseTemplate($v4f2afc9c4099ee1f39c9f551123e54bd, array(), false, $v91ec1f9324753048c0096d036a694f86->getId());}public function renderOrderItems(order $v70a17ffa722a3985b86d30b034ad06d7, $v66f6181bcb4cff4cd38fbc804a036db6 = 'default') {$result = array();$vf1386a17eed513dff70798b0551dc170 = array();$v5891da2d64975cae48d175d1e001f5da = umiObjectsCollection::getInstance();list($v5ad10ccde9b1728f3d06c1eb0b05ab0f, $vbfc394470368b6ce33918f7bc788c2a5, $vaa7527a02d299074e1237f619db3d7f5, $v5a7a031cbea06121df860cb751380c8e) = def_module::loadTemplates("./tpls/emarket/{$v66f6181bcb4cff4cd38fbc804a036db6}.tpl",     'order_item', 'options_block', 'options_block_empty', 'options_item');$v125400e5879efb03f17ff21cd2697b9e = $v70a17ffa722a3985b86d30b034ad06d7->getItems();foreach($v125400e5879efb03f17ff21cd2697b9e as $v39b91a7e3e05f526a19899c65efe3675) {$vcb173b323074f9035b850b31afb196d6 = $v39b91a7e3e05f526a19899c65efe3675->getId();$ve253bed1357afcefc5fadfbc92f9eb97 = array(     'attribute:id'  => $vcb173b323074f9035b850b31afb196d6,     'attribute:name' => $v39b91a7e3e05f526a19899c65efe3675->getName(),     'xlink:href'  => ('uobject://' . $vcb173b323074f9035b850b31afb196d6),     'amount'   => $v39b91a7e3e05f526a19899c65efe3675->getAmount(),     'options'   => null    );$v8d485bdc9362dc147898e288cb1352ad = $v39b91a7e3e05f526a19899c65efe3675->getDiscount();$v9bddac9107b1a9e79b49bdd7d8fa0844 = $v39b91a7e3e05f526a19899c65efe3675->getItemPrice();$va6214b7dafa6ceb5bf07367e63455bca = $v8d485bdc9362dc147898e288cb1352ad ? $v8d485bdc9362dc147898e288cb1352ad->recalcPrice($v9bddac9107b1a9e79b49bdd7d8fa0844) : $v9bddac9107b1a9e79b49bdd7d8fa0844;$v99cb322995340cff022c319c3bbcc1ec = $v39b91a7e3e05f526a19899c65efe3675->getTotalOriginalPrice();$vfee9fca157c4ea43fcda3525bb916fe4 = $v39b91a7e3e05f526a19899c65efe3675->getTotalActualPrice();if($v9bddac9107b1a9e79b49bdd7d8fa0844 == $va6214b7dafa6ceb5bf07367e63455bca) {$v9bddac9107b1a9e79b49bdd7d8fa0844 = null;}if($v99cb322995340cff022c319c3bbcc1ec == $vfee9fca157c4ea43fcda3525bb916fe4) {$v99cb322995340cff022c319c3bbcc1ec = null;}$ve253bed1357afcefc5fadfbc92f9eb97['price'] = $this->formatCurrencyPrice(array(     'original' => $v9bddac9107b1a9e79b49bdd7d8fa0844,     'actual' => $va6214b7dafa6ceb5bf07367e63455bca    ));$ve253bed1357afcefc5fadfbc92f9eb97['total-price'] = $this->formatCurrencyPrice(array(     'original' => $v99cb322995340cff022c319c3bbcc1ec,     'actual' => $vfee9fca157c4ea43fcda3525bb916fe4    ));$ve253bed1357afcefc5fadfbc92f9eb97['price'] = $this->parsePriceTpl($v66f6181bcb4cff4cd38fbc804a036db6, $ve253bed1357afcefc5fadfbc92f9eb97['price']);$ve253bed1357afcefc5fadfbc92f9eb97['total-price'] = $this->parsePriceTpl($v66f6181bcb4cff4cd38fbc804a036db6, $ve253bed1357afcefc5fadfbc92f9eb97['total-price']);$v7552cd149af7495ee7d8225974e50f80 = false;$v8e2dcfd7e7e24b1ca76c1193f645902b = $v39b91a7e3e05f526a19899c65efe3675->getItemElement();if($v8e2dcfd7e7e24b1ca76c1193f645902b instanceof iUmiHierarchyElement) {$ve253bed1357afcefc5fadfbc92f9eb97['page'] = $v8e2dcfd7e7e24b1ca76c1193f645902b;$ve253bed1357afcefc5fadfbc92f9eb97['void:element_id'] = $v7552cd149af7495ee7d8225974e50f80;$ve253bed1357afcefc5fadfbc92f9eb97['void:link'] = $v8e2dcfd7e7e24b1ca76c1193f645902b->link;}$ve2dc6c48c56de466f6d13781796abf3d = $v39b91a7e3e05f526a19899c65efe3675->getDiscount();if($ve2dc6c48c56de466f6d13781796abf3d instanceof itemDiscount) {$ve253bed1357afcefc5fadfbc92f9eb97['discount'] = array(      'attribute:id' => $ve2dc6c48c56de466f6d13781796abf3d->id,      'attribute:name' => $ve2dc6c48c56de466f6d13781796abf3d->getName(),      'description' => $ve2dc6c48c56de466f6d13781796abf3d->getValue('description')     );$ve253bed1357afcefc5fadfbc92f9eb97['void:discount_id'] = $ve2dc6c48c56de466f6d13781796abf3d->id;}if($v39b91a7e3e05f526a19899c65efe3675 instanceof optionedOrderItem) {$v93da65a9fd0004d9477aeac024e08e15 = $v39b91a7e3e05f526a19899c65efe3675->getOptions();$v344a7f0ec5703444bf6b3918aad89b95 = array();foreach($v93da65a9fd0004d9477aeac024e08e15 as $v5ecf0a02e02bd528df985f4f51a5af41) {$v5f966ba427f81d4e3b5c4f1735f63499 = $v5ecf0a02e02bd528df985f4f51a5af41['option-id'];$v78a5eb43deef9a7b5b9ce157b9d52ac4 = $v5ecf0a02e02bd528df985f4f51a5af41['price'];$v972bf3f05d14ffbdb817bef60638ff00 = $v5ecf0a02e02bd528df985f4f51a5af41['field-name'];$vef3e30e070f70244fd6578d88a6b77ac = $v5891da2d64975cae48d175d1e001f5da->getObject($v5f966ba427f81d4e3b5c4f1735f63499);if($vef3e30e070f70244fd6578d88a6b77ac instanceof iUmiObject) {$v2cd651fd96e0ef13631bdb1bd7caf172 = array(        'attribute:id'   => $v5f966ba427f81d4e3b5c4f1735f63499,        'attribute:name'  => $vef3e30e070f70244fd6578d88a6b77ac->getName(),        'attribute:price'  => $v78a5eb43deef9a7b5b9ce157b9d52ac4,        'attribute:field-name' => $v972bf3f05d14ffbdb817bef60638ff00,        'xlink:href'   => ('uobject://' . $v5f966ba427f81d4e3b5c4f1735f63499)       );$v344a7f0ec5703444bf6b3918aad89b95[] = def_module::parseTemplate($v5a7a031cbea06121df860cb751380c8e, $v2cd651fd96e0ef13631bdb1bd7caf172, false, $v5f966ba427f81d4e3b5c4f1735f63499);}}$ve253bed1357afcefc5fadfbc92f9eb97['options'] = def_module::parseTemplate($vbfc394470368b6ce33918f7bc788c2a5, array(      'nodes:option' => $v344a7f0ec5703444bf6b3918aad89b95,      'void:items' => $v344a7f0ec5703444bf6b3918aad89b95     ));}$vf1386a17eed513dff70798b0551dc170[] = def_module::parseTemplate($v5ad10ccde9b1728f3d06c1eb0b05ab0f, $ve253bed1357afcefc5fadfbc92f9eb97);}$result['nodes:item'] = $vf1386a17eed513dff70798b0551dc170;return $result;}public function ordersList($v66f6181bcb4cff4cd38fbc804a036db6 = 'default') {list($v31912934b8f34be4364cc043cd8a0176, $vd268fd226c122b3da2fabee66e798225, $v5ad10ccde9b1728f3d06c1eb0b05ab0f) = def_module::loadTemplates("./tpls/emarket/{$v66f6181bcb4cff4cd38fbc804a036db6}.tpl", 'orders_block', 'orders_block_empty', 'orders_item');$permissions = permissionsCollection::getInstance();$v8e44f0089b076e18a718eb9ca3d94674 = $permissions->getUserId();$v8be74552df93e31bbdd6b36ed74bdb6a = new selector('objects');$v8be74552df93e31bbdd6b36ed74bdb6a->types('object-type')->name('emarket', 'order');$v8be74552df93e31bbdd6b36ed74bdb6a->where('customer_id')->equals(customer::get()->id);$v8be74552df93e31bbdd6b36ed74bdb6a->where('name')->isNull(false);if($v31912934b8f34be4364cc043cd8a0176) {if($v8be74552df93e31bbdd6b36ed74bdb6a->length == 0) return $vd268fd226c122b3da2fabee66e798225;$vf1386a17eed513dff70798b0551dc170 = array();foreach($v8be74552df93e31bbdd6b36ed74bdb6a->result as $v70a17ffa722a3985b86d30b034ad06d7) {$ve253bed1357afcefc5fadfbc92f9eb97 = array(      'id' => $v70a17ffa722a3985b86d30b034ad06d7->id,      'name' => $v70a17ffa722a3985b86d30b034ad06d7->name     );$vf1386a17eed513dff70798b0551dc170[] = def_module::parseTemplate($v5ad10ccde9b1728f3d06c1eb0b05ab0f, $ve253bed1357afcefc5fadfbc92f9eb97, false, $v70a17ffa722a3985b86d30b034ad06d7->id);}return def_module::parseTemplate($v31912934b8f34be4364cc043cd8a0176, array('items' => $vf1386a17eed513dff70798b0551dc170));}else {return array('items' => array('nodes:item' => $v8be74552df93e31bbdd6b36ed74bdb6a->result));}}private static function formatPrice($v26b9632b8ee118c32a553473c2e43969, itemDiscount $ve2dc6c48c56de466f6d13781796abf3d = null) {$v928419bc24fdb7d83103496423c71f5c = ($ve2dc6c48c56de466f6d13781796abf3d instanceof itemDiscount) ? $ve2dc6c48c56de466f6d13781796abf3d->recalcPrice($v26b9632b8ee118c32a553473c2e43969) : $v26b9632b8ee118c32a553473c2e43969;if($v26b9632b8ee118c32a553473c2e43969 == $v928419bc24fdb7d83103496423c71f5c) {$v26b9632b8ee118c32a553473c2e43969 = null;}return array(    'original' => $v26b9632b8ee118c32a553473c2e43969,    'actual' => $v928419bc24fdb7d83103496423c71f5c   );}private static function getStage($v9a8c2b9d518bc163e99611fbacea63b2) {$vb1444fb0c07653567ad325aa25d4e37a = regedit::getInstance();$vef6b04bd78870380712f03805068b872 = $vb1444fb0c07653567ad325aa25d4e37a->getVal('//modules/emarket/enable-delivery');$vfdea876efe26e403ffcfc45911f1fdd9 = $vb1444fb0c07653567ad325aa25d4e37a->getVal('//modules/emarket/enable-payment');if($v9a8c2b9d518bc163e99611fbacea63b2 == 'delivery' && !$vef6b04bd78870380712f03805068b872) {$v9a8c2b9d518bc163e99611fbacea63b2 = 'payment';}if($v9a8c2b9d518bc163e99611fbacea63b2 == 'payment' && !$vfdea876efe26e403ffcfc45911f1fdd9) {return null;}if(!$v9a8c2b9d518bc163e99611fbacea63b2 || !in_array($v9a8c2b9d518bc163e99611fbacea63b2, self::$purchaseSteps)) {$v91ec1f9324753048c0096d036a694f86 = customer::get();if(!$v91ec1f9324753048c0096d036a694f86->isUser() && !$v91ec1f9324753048c0096d036a694f86->isFilled()) {return "required";}return getArrayKey(self::$purchaseSteps, 1);}else {return $v9a8c2b9d518bc163e99611fbacea63b2;}}public function parsePriceTpl($v66f6181bcb4cff4cd38fbc804a036db6 = 'default', $v36c2eb853104fc7644aa11159b23550e = array()) {if(xslTemplater::getInstance()->getIsInited()) return $v36c2eb853104fc7644aa11159b23550e;list($vc1d0a80988d5ed8676e332d3e25aebba, $vc6f86229399b93d5b075d655e8886a1b) = def_module::loadTemplates("./tpls/emarket/{$v66f6181bcb4cff4cd38fbc804a036db6}.tpl",    'price_original', 'price_actual');$v26b9632b8ee118c32a553473c2e43969 = getArrayKey($v36c2eb853104fc7644aa11159b23550e, 'original');$v928419bc24fdb7d83103496423c71f5c = getArrayKey($v36c2eb853104fc7644aa11159b23550e, 'actual');$result = array();if($v26b9632b8ee118c32a553473c2e43969) $result['original'] = def_module::parseTemplate($vc1d0a80988d5ed8676e332d3e25aebba, $v36c2eb853104fc7644aa11159b23550e);if($v928419bc24fdb7d83103496423c71f5c) $result['actual'] = def_module::parseTemplate($vc6f86229399b93d5b075d655e8886a1b, $v36c2eb853104fc7644aa11159b23550e);return $result;}};?>