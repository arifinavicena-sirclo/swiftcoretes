<?php
 namespace Swift\Core\Helper; use Magento\Framework\App\Helper\Context; class Data extends \Magento\Framework\App\Helper\AbstractHelper { public $VPce8; public $SWiZJ; public function __construct(Context $mibRg, \Magento\Framework\App\Config\ScopeConfigInterface $gRPMa, \Magento\Store\Model\StoreManagerInterface $Q4pms) { goto hkJ4z; YPr9v: $this->SWiZJ = $Q4pms; goto FYGsq; hkJ4z: parent::__construct($mibRg); goto QsJYb; QsJYb: $this->VPce8 = $gRPMa; goto YPr9v; FYGsq: } public function getLicense() { $OE2mv = $this->VPce8->getValue("\163\x77\x69\x66\x74\137\x63\157\x72\x65\57\x67\145\156\x65\162\141\154\57\154\x69\x63\x65\x6e\x73\145", \Magento\Store\Model\ScopeInterface::SCOPE_STORE); return $OE2mv; } public function getSecretKey() { return "\x49\143\x55\70\63\123\61\x72\103\61\x30"; } public function isLicenseValid($OE2mv) { goto HTsAX; YrAi2: return false; goto MyZ0x; neCdN: return true; goto d24El; hxMrh: $r6cy7 = date_format(date_create_from_format("\131\155\144", $wuQjb), "\131\155\144"); goto TKpGF; Oze00: if (!($MpvhH != $f5ZDP)) { goto Ct51I; } goto YrAi2; S0Z_l: $wuQjb = substr($C8G9c, -8); goto Ku00f; JrIDQ: $MpvhH = parse_url($MpvhH, PHP_URL_HOST); goto Oze00; WiW5X: AAKDn: goto neCdN; HTsAX: if (!($OE2mv == null)) { goto gU_NI; } goto YqAkb; TKpGF: $zSxvp = date("\x59\x6d\x64"); goto QaZLb; YqAkb: return false; goto DElAU; IOxxL: $C8G9c = $this->decrypt($OE2mv, $this->getSecretKey()); goto S0Z_l; G7V9q: return false; goto WiW5X; QaZLb: if (!($zSxvp > $r6cy7)) { goto AAKDn; } goto G7V9q; DElAU: gU_NI: goto IOxxL; Ku00f: $f5ZDP = str_replace(substr($C8G9c, -9), '', $C8G9c); goto wCz5o; MyZ0x: Ct51I: goto hxMrh; wCz5o: $MpvhH = $this->SWiZJ->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_WEB); goto JrIDQ; d24El: } public function decrypt($rHlJb, $X3ZEW) { goto mVPtP; XoqZ4: $aemWJ = mb_substr($rHlJb, 0, $YraLg, "\70\142\151\164"); goto i6vgb; yEPDJ: $DOfw1 = openssl_decrypt($fArjT, $fFpyI, $X3ZEW, 0, $aemWJ); goto FgH4o; OntTG: $YraLg = openssl_cipher_iv_length($fFpyI); goto XoqZ4; FgH4o: return $DOfw1; goto E630E; mVPtP: $rHlJb = base64_decode($rHlJb); goto uaQfp; uaQfp: $fFpyI = "\141\x65\x73\55\x31\x32\x38\55\143\x74\x72"; goto OntTG; i6vgb: $fArjT = mb_substr($rHlJb, $YraLg, null, "\70\x62\151\164"); goto yEPDJ; E630E: } }