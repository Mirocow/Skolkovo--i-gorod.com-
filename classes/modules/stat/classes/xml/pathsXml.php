<?php
class pathsXml extends xmlDecorator{protected function generate($vf1f713c9e000f5d3f280adbd124df4f5)    {$vdd988cfd769c9f7fbd795a0f5da8e751 = new DOMDocument('1.0', 'utf-8');$v8e2dcfd7e7e24b1ca76c1193f645902b = $vdd988cfd769c9f7fbd795a0f5da8e751->createElement('statistic');$v63a9f0ea7bb98050796b649e85481845 = $vdd988cfd769c9f7fbd795a0f5da8e751->appendChild($v8e2dcfd7e7e24b1ca76c1193f645902b);$v8e2dcfd7e7e24b1ca76c1193f645902b = $vdd988cfd769c9f7fbd795a0f5da8e751->createElement('details');$v27792947ed5d5da7c0d1f43327ed9dab = $v63a9f0ea7bb98050796b649e85481845->appendChild($v8e2dcfd7e7e24b1ca76c1193f645902b);foreach ($vf1f713c9e000f5d3f280adbd124df4f5['detail'] as $v3a6d0284e743dc4a9b86f97d6dd1a3bf) {$v951da6b7179a4f697cc89d36acf74e52 = $vdd988cfd769c9f7fbd795a0f5da8e751->createElement('detail');$this->bind($v951da6b7179a4f697cc89d36acf74e52, $v3a6d0284e743dc4a9b86f97d6dd1a3bf);$v27792947ed5d5da7c0d1f43327ed9dab->appendChild($v951da6b7179a4f697cc89d36acf74e52);}$v8e2dcfd7e7e24b1ca76c1193f645902b = $vdd988cfd769c9f7fbd795a0f5da8e751->createElement('paths');$v13872c0118a4316afd1e99295017d654 = $v63a9f0ea7bb98050796b649e85481845->appendChild($v8e2dcfd7e7e24b1ca76c1193f645902b);foreach ($vf1f713c9e000f5d3f280adbd124df4f5['path'] as $v3a6d0284e743dc4a9b86f97d6dd1a3bf) {$vd6fe1d0be6347b8ef2427fa629c04485 = $vdd988cfd769c9f7fbd795a0f5da8e751->createElement('path');$vd6fe1d0be6347b8ef2427fa629c04485->setAttribute('path', $v3a6d0284e743dc4a9b86f97d6dd1a3bf);$v13872c0118a4316afd1e99295017d654->appendChild($vd6fe1d0be6347b8ef2427fa629c04485);}return $vdd988cfd769c9f7fbd795a0f5da8e751->saveXML();}}?>