<?php
if (class_exists('SNS', false)) return;
class SNS
{
	var $snsCfg;
	var $snsPostCfg;
	var $clogCfg;
	var $mobileSkin = false;
	var $msg_kakao1 = "";
	var $msg_kakao2 = "";
	var $msg_kakao3 = "";

	function SNS(){
		GLOBAL $cfg;
		$cfgfile = dirname(__FILE__)."/../conf/config.php";
		if(file_exists($cfgfile)) @require_once $cfgfile;
		if($cfg) $this->cfg = $cfg;
		GLOBAL $snsCfg;
		$cfgfile = dirname(__FILE__)."/../conf/sns.cfg.php";
		if(file_exists($cfgfile)) @require_once $cfgfile;
		if($snsCfg)	$this->snsCfg = $snsCfg;
		$postcfgfile = dirname(__FILE__)."/../conf/snspost.cfg.php";
		if(file_exists($postcfgfile)) @require $postcfgfile;
		if($snsPostCfg) $this->snsPostCfg = $snsPostCfg;
	}

	/* 서비스 설정 저장 */
	function config_write($arr){
		$fn = dirname(__FILE__)."/../conf/sns.cfg.php";
		foreach ($arr as $k=>$v) {
			$arr[$k] = htmlspecialchars(stripslashes($v));
		}
		$this->snsCfg = array_merge($this->snsCfg, $arr);
		$this->snsCfg['updateDt'] = date('Y-m-d H:i:s',time());
		$qfile = new qfile();
		$qfile->open($fn);
		$qfile->write("<? \n");
		$qfile->write("\$snsCfg = array( \n");
		foreach ($this->snsCfg as $k=>$v) {
			$qfile->write("'$k'=>'".addslashes($v)."',\n");
		}
		$qfile->write("); \n");
		$qfile->write("?>");
		$qfile->close();
		@chmod($fn,0707);
	}

	/* SNS POST LIST 설정 등록/수정 */
	function postconfig_write($arr){
		$fn = dirname(__FILE__)."/../conf/snspost.cfg.php";
		$sno = $arr['sno'];
		unset($arr['sno']);
		foreach ($arr as $k=>$v) {
			$arr[$k] = htmlspecialchars(stripslashes($v));
		}
		if ($this->snsPostCfg) {
			if ($sno) {
				$this->snsPostCfg[$sno] = $arr;
			}
			else {
				$keys = array_keys($this->snsPostCfg);
				rsort($keys);
				$sno = $keys[0] + 1;
				$this->snsPostCfg[$sno] = $arr;
			}
		}
		else {
			$this->snsPostCfg[1] = $arr;
		}

		$qfile = new qfile();
		$qfile->open($fn);
		$qfile->write("<? \n");
		foreach ($this->snsPostCfg as $k=>$v) {
			$qfile->write("\$snsPostCfg[$k] = array( \n");
			foreach ($v as $k2=>$v2) {
				$qfile->write("'$k2'=>'".addslashes($v2)."',\n");
			}
			$qfile->write("); \n");
		}
		$qfile->write("?>");
		$qfile->close();
		@chmod($fn,0707);
	}

	/* SNS POST LIST 설정 삭제 */
	function postconfig_delete($arr){
		$fn = dirname(__FILE__)."/../conf/snspost.cfg.php";
		$sno = $arr['sno'];
		unset($arr['sno']);

		if ($this->snsPostCfg && $sno) unset($this->snsPostCfg[$sno]);
		else return;

		$qfile = new qfile();
		$qfile->open($fn);
		$qfile->write("<? \n");
		foreach ($this->snsPostCfg as $k=>$v) {
			$qfile->write("\$snsPostCfg[$k] = array( \n");
			foreach ($v as $k2=>$v2) {
				$qfile->write("'$k2'=>'".addslashes($v2)."',\n");
			}
			$qfile->write("); \n");
		}
		$qfile->write("?>");
		$qfile->close();
		@chmod($fn,0707);
	}

	function get_post_btn($args, $screen=''){
		if ($this->snsCfg['useBtn'] != 'y') return false;
		mb_internal_encoding('EUC-KR'); // 인코딩 EUC-KR 설정.

		// 트위터
		$msg = html_entity_decode(preg_replace('/\n/','', $this->snsCfg['msg_twitter']));
		$msg = preg_replace('/{shopnm}/i', $args['shopnm'], $msg);
		$msg = preg_replace('/{goodsurl}/i', $args['goodsurl'], $msg);
		$msg_length = mb_strlen(preg_replace('/{goodsnm}/i', '', $msg));
		$tw_goodsnm = $args['goodsnm'];
		if ($msg_length <= 140) $tw_goodsnm = mb_substr($args['goodsnm'], 0, 140 - $msg_length);
		$msg = preg_replace('/{goodsnm}/i', $tw_goodsnm, $msg);
		$encodedMsg = urlencode(@iconv('EUC-KR', 'UTF-8//IGNORE', $msg));
		$twitterurl = 'http://twitter.com/home?status='.$encodedMsg;

		if($screen = 'm') {
			$twitterurl = 'http://mobile.twitter.com/compose/tweet?status='.$encodedMsg;	//모바일 url은 다름
		}
		// 트위터

		// 페이스북
		$msg = html_entity_decode(preg_replace('/\n/','', $this->snsCfg['msg_facebook']));
		$msg = preg_replace('/{shopnm}/i', $args['shopnm'], $msg);
		$msg = preg_replace('/{goodsnm}/i', $args['goodsnm'], $msg);
		$msg = preg_replace('/{goodsurl}/i', $args['goodsurl'], $msg);
		$encodedMsg = urlencode(@iconv('EUC-KR', 'UTF-8//IGNORE', $msg));
		$facebookurl = 'http://www.facebook.com/sharer.php?u='.urlencode($args['goodsurl'].'&time='.time());
		// 페이스북

		// 미투데이
		$tmpmsg = html_entity_decode(preg_replace('/\n/','', $this->snsCfg['msg_me2day']));
		$tmpmsg = preg_replace('/{shopnm}/i', $args['shopnm'], $tmpmsg);
		$tmpmsg = preg_replace('/{goodsnm}/i', $args['goodsnm'], $tmpmsg);
		$tmpmsg = preg_replace('/{goodsurl}/i', $args['goodsurl'], $tmpmsg);
		$tmpmsg = preg_replace('/\"([^\"]*)\":http:\/\/[^\s]*/i', '$1', $tmpmsg);
		$msg_length = mb_strlen($tmpmsg);

		$msg = html_entity_decode(preg_replace('/\n/','', $this->snsCfg['msg_me2day']));
		$msg = preg_replace('/{shopnm}/i', $args['shopnm'], $msg);
		$me_goodsnm = $args['goodsnm'];
		if ($msg_length > 150) $me_goodsnm = mb_substr($args['goodsnm'], 0, 150 - $msg_length);
		$msg = preg_replace('/{goodsnm}/i', $me_goodsnm, $msg);
		$msg = preg_replace('/{goodsurl}/i', $args['goodsurl'], $msg);

		$encodedMsg = urlencode(@iconv('EUC-KR', 'UTF-8//IGNORE', $msg));
		$tag = ($args['tag'])? $args['tag'] : $args['shopnm'];
		$encodedTag = urlencode(@iconv('EUC-KR', 'UTF-8//IGNORE', $tag));
		$me2dayurl = 'http://me2day.net/posts/new?new_post[body]='.$encodedMsg.'&new_post[tags]='.$encodedTag;
		// 미투데이

		// 페이스북 메타 TAG
		$title_fb = html_entity_decode(preg_replace('/\n/','', $this->snsCfg['msg_facebook']));
		$title_fb = preg_replace('/{shopnm}/i', $args['shopnm'], $title_fb);
		$title_fb = preg_replace('/{goodsnm}/i', $args['goodsnm'], $title_fb);
		$title_fb = preg_replace('/{goodsurl}/i', $args['goodsurl'], $title_fb);
		$title_fb = htmlspecialchars($title_fb);
		$rtn['meta'] = '<meta property="og:title" content="'.$title_fb.'" />';
		$rtn['meta'] .= '<meta property="og:description" content="'.$title_fb.'" />';
		if (preg_match('/^http(s)?:\/\//',$args['img']))
			$rtn['meta'] .= '<meta property="og:image" content="'.$args['img'].'" />';
		else
			$rtn['meta'] .= '<meta property="og:image" content="http://'.$_SERVER['HTTP_HOST'].'/shop/data/goods/'.$args['img'].'" />';
		// 페이스북 메타 TAG

		// C공감
		$msg = html_entity_decode(preg_replace('/\n/','', $this->snsCfg['msg_cchoice']));
		$msg = preg_replace('/{shopnm}/i', $args['shopnm'], $msg);
		$msg = preg_replace('/{goodsurl}/i', $args['goodsurl'], $msg);
		$msg = preg_replace('/{goodsnm}/i', $args['goodsnm'], $msg);

		if(mb_strlen($msg) > 400)$msg= mb_strcut($msg, 0, 400); //400byte 제한
		$csummary		= urlencode(base64_encode(htmlspecialchars($msg,ENT_QUOTES)));

		if(mb_strlen($args['goodsnm']) > 50)$cchoiicTitle =mb_strcut($args['goodsnm'], 0, 50); //50byte 제한
		else $cchoiicTitle =$args['goodsnm']; //타이틀

		$cchoiicWriter = urlencode(htmlspecialchars($args['shopnm'],ENT_QUOTES)); //출처
		$cchoiicTitle	= urlencode(base64_encode(htmlspecialchars($cchoiicTitle,ENT_QUOTES)));//내용(base64 필수)

		$clogcfgfile = dirname(__FILE__)."/../conf/clog.cfg.php";
		if(file_exists($clogcfgfile)) @require_once $clogcfgfile;
		if($clogCfg) $this->clogCfg = $clogCfg;
		// C공감 - 브랜드 c로그 개설시
		if($clogCfg['useBrandCLog'] == 'y')$useBrandCLogID	.= '&corpid='.$clogCfg['useBrandCLogID'];

		$cchoiiceurl		= 'http://csp.cyworld.com/bi/bi_recommend_pop_euc.php?url='.urlencode($args['goodsurl']).'&title='.$cchoiicTitle.'&writer='.$cchoiicWriter.$useBrandCLogID.'&summary='.$csummary;
		// C공감

		// 카카오링크
			// 쇼핑몰 이름
			$this->msg_kakao1 = html_entity_decode($this->snsCfg['msg_kakao_shopnm']);
			$this->msg_kakao1 = preg_replace('/{shopnm}/i', $args['shopnm'], $this->msg_kakao1);
			$this->msg_kakao1 = preg_replace('/{goodsnm}/i', strip_tags($args['goodsnm']), $this->msg_kakao1);
			$this->msg_kakao1 = preg_replace('/{goodsurl}/i', $args['goodsurl'], $this->msg_kakao1);
			// 전송 내용
			$this->msg_kakao2 = html_entity_decode($this->snsCfg['msg_kakao_goodsnm']);
			$this->msg_kakao2 = preg_replace('/{shopnm}/i', $args['shopnm'], $this->msg_kakao2);
			$this->msg_kakao2 = preg_replace('/{goodsnm}/i', strip_tags($args['goodsnm']), $this->msg_kakao2);
			$this->msg_kakao2 = preg_replace('/{goodsurl}/i', $args['goodsurl'], $this->msg_kakao2);
			$this->msg_kakao2 = urlencode(iconv("EUC-KR", "UTF-8", $this->msg_kakao2));
			// 전송 URL
			$this->msg_kakao3 = html_entity_decode($this->snsCfg['msg_kakao_goodsurl']);
			$this->msg_kakao3 = preg_replace('/{shopnm}/i', $args['shopnm'], $this->msg_kakao3);
			$this->msg_kakao3 = preg_replace('/{goodsnm}/i', strip_tags($args['goodsnm']), $this->msg_kakao3);
			$this->msg_kakao3 = preg_replace('/{goodsurl}/i', $args['goodsurl'], $this->msg_kakao3);
		// 카카오링크

		$rtn['btn'] = "";

		// 버튼 TAG
		if($this->mobileSkin == false) {
			if($this->snsCfg['use_twitter'] == 'y') $rtn['btn'] = '<a href="'.$twitterurl.'" target="_blank" style="margin-right:5px;"><img src="../data/skin/'.$this->cfg['tplSkin'].'/img/sns/icon_twitter.png" /></a>';
			if($this->snsCfg['use_facebook'] == 'y') $rtn['btn'] .= '<a href="'.$facebookurl.'" target="_blank" style="margin-right:5px;"><img src="../data/skin/'.$this->cfg['tplSkin'].'/img/sns/icon_facebook.png" /></a>';
			if($this->snsCfg['use_me2day'] == 'y') $rtn['btn'] .= '<a href="'.$me2dayurl.'" target="_blank" style="margin-right:5px;"><img src="../data/skin/'.$this->cfg['tplSkin'].'/img/sns/icon_me2day.png" /></a>';
			if($this->snsCfg['use_cchoice'] == 'y') $rtn['btn'] .= '<a href="'.$cchoiiceurl.'" target="_blank" style="margin-right:5px;"><img src="../data/skin/'.$this->cfg['tplSkin'].'/img/sns/btn_c.png" /></a>';
		}
		else {
			if($this->snsCfg['use_kakao'] == 'y') $rtn['btn'] .= '<a href="javascript:;" id="kakao" style="margin-right:5px;"><img src="../../shop/data/skin_mobile/'.$this->cfg['tplSkinMobile'].'/common/img/sns/kakaotalk.png" width="25" height="25" /></a>';
			if($this->snsCfg['use_facebook'] == 'y') $rtn['btn'] .= '<a href="'.$facebookurl.'" target="_blank" style="margin-right:5px;"><img src="../../shop/data/skin_mobile/'.$this->cfg['tplSkinMobile'].'/common/img/sns/icon_facebook.png" /></a>';
			if($this->snsCfg['use_twitter'] == 'y') $rtn['btn'] .= '<a href="'.$twitterurl.'" target="_blank" style="margin-right:5px;"><img src="../../shop/data/skin_mobile/'.$this->cfg['tplSkinMobile'].'/common/img/sns/icon_twitter.png" /></a>';
			if($this->snsCfg['use_me2day'] == 'y') $rtn['btn'] .= '<a href="'.$me2dayurl.'" target="_blank" style="margin-right:5px;"><img src="../../shop/data/skin_mobile/'.$this->cfg['tplSkinMobile'].'/common/img/sns/icon_me2day.png" /></a>';
		}
		return $rtn;
	}

	function get_post_listbox($sno, $previewData=null) {
		if (is_array($previewData) && empty($previewData) === false && $sno == null) $isPreview = 'y';
		else $isPreview = 'n';
		if ($isPreview == 'n' && $this->snsCfg['usePost'] != 'y') return;
		if (!$sno && ($isPreview == 'y' && (!is_array($previewData) || empty($previewData)))) return;
		if ($isPreview == 'y') {
			$itemno = 'preview';
			$boxWidth = $previewData['boxWidth'];
			$titleSize = $previewData['titleSize'];
			$titleClr = $previewData['titleClr'];
			$titleBgClr = $previewData['titleBgClr'];
			$fontClr = $previewData['fontClr'];
			$fontBgClr = $previewData['fontBgClr'];
			$bgClr = $previewData['bgClr'];
			$postCount = $previewData['postCount'];
			$sns = $previewData['sns'];
			$snsid = $previewData['snsid'];
			$adminpath = '../';
		}
		elseif ($sno) {
			if (!isset($this->snsPostCfg[$sno])) return;
			$itemno = 'sns'.preg_replace('/[^0-9]*/','',microtime());
			$boxWidth = $this->snsPostCfg[$sno]['boxWidth'];
			$titleSize = $this->snsPostCfg[$sno]['titleSize'];
			$titleClr = $this->snsPostCfg[$sno]['titleClr'];
			$titleBgClr = $this->snsPostCfg[$sno]['titleBgClr'];
			$fontClr = $this->snsPostCfg[$sno]['fontClr'];
			$fontBgClr = $this->snsPostCfg[$sno]['fontBgClr'];
			$bgClr = $this->snsPostCfg[$sno]['bgClr'];
			$postCount = $this->snsPostCfg[$sno]['postCount'];
			$sns = $this->snsPostCfg[$sno]['sns'];
			$snsid = $this->snsPostCfg[$sno]['snsid'];
		}

		$rtn = '<ul id="snsBox_'.$itemno.'" style="width:'.$boxWidth.'px; background-color:'.$bgClr.'; word-break:break-all; word-wrap:break-word; margin:0px; margin-bottom:10px; padding:0px; padding-bottom:10px; padding-top:10px;">';
		$rtn .= '<li style="margin:0px 8px 8px 8px; padding:0px; height:60px; overflow:hidden;">';
		$rtn .= '<div style="margin:0px; padding:0px; height:60px; background-color:'.$titleBgClr.'; display:inline-block; width:100%;">';
		$rtn .= '<div id="snsTitle_img_'.$itemno.'" style="float:left; margin:5px;"></div><div style="float:left; margin:5px;"><div id="snsTitle_id_'.$itemno.'" style="font-size:'.$titleSize.'px; font-weight:bold; font-family:verdana; text-align:left; color:'.$titleClr.'"></div><div id="snsTitle_name_'.$itemno.'" style="margin-top:3px; font-size:12px; font-family:verdana; text-align:left; color:'.$titleClr.'"></div></div>';
		$rtn .= '</div>';
		$rtn .= '</li>';
		for($i = 0; $i < $postCount; $i++) {
			$borderBtm = '';
			if ($i != 0) $borderBtm = ' border-top:dashed 1px #ACACAC;';
			$rtn .= '<li id="snsPostBox_'.$itemno.'_'.$i.'" style="margin:0px 8px 0px 8px; padding:5px; background-color:'.$fontBgClr.';'.$borderBtm.'">';
			$rtn .= '<div id="snsPost_'.$itemno.'_'.$i.'" style="text-align:left; width:100%; word-break:break-all; word-wrap:break-word; color:'.$fontClr.';"></div>';
			$rtn .= '<div id="snsPostInfo_'.$itemno.'_'.$i.'" style="padding-top:5px; height:25px; font-size:9px; font-family:verdana; text-align:left; word-break:break-all; word-wrap:break-word;  color:'.$fontClr.'"></div>';
			$rtn .= '</li>';
		}
		$rtn .= '<li style="display:inline-block; width:100%;">';
		$rtn .= '<div style="float:left; margin-top:15px; margin-left:10px;">';
		$rtn .= '<a onclick="SNS.goPrevPage(\''.$itemno.'\')" style="cursor:pointer"><img src="'.$adminpath.'../data/skin/'.$this->cfg['tplSkin'].'/img/sns/page_prev.gif" /></a>';
		$rtn .= '<a onclick="SNS.goNextPage(\''.$itemno.'\')" style="cursor:pointer; margin-left:5px;"><img src="'.$adminpath.'../data/skin/'.$this->cfg['tplSkin'].'/img/sns/page_next.gif" /></a>';
		$rtn .= '</div>';
		$rtn .= '<div style="float:right; margin-top:15px; margin-right:10px;">';
		$rtn .= '<a id="snsLink_'.$itemno.'" target="_blank" style="cursor:pointer"><img src="'.$adminpath.'../data/skin/'.$this->cfg['tplSkin'].'/img/sns/logo_'.$sns.'.png" /></a>';
		$rtn .= '</div>';
		$rtn .= '</li>';
		$rtn .= '</ul>';
		if ($isPreview == 'n') $rtn .= '<script type="text/javascript" src="../lib/js/prototype.js"></script>';
		if ($isPreview == 'n') {
			$rtn .= '<script type="text/javascript">';
			$rtn .= 'var cfgdata = {};';
			$rtn .= 'cfgdata["sno"] = "'.$sno.'";';
			$rtn .= 'cfgdata["sns"] = "'.$sns.'";';
			$rtn .= 'cfgdata["snsid"] = "'.$snsid.'";';
			$rtn .= 'cfgdata["postCount"] = "'.$postCount.'";';
			$rtn .= 'cfgdata["fontClr"] = "'.$fontClr.'";';
			$rtn .= 'SNS.init("'.$itemno.'",cfgdata);';
			$rtn .= '</script>';
		}
		return $rtn;
	}


	function get_post_btn_mobile($args){
		if ($this->snsCfg['useBtn'] != 'y') return false;
		mb_internal_encoding('EUC-KR'); // 인코딩 EUC-KR 설정.

		// 트위터
		$msg = html_entity_decode(preg_replace('/\n/','', $this->snsCfg['msg_twitter']));
		$msg = preg_replace('/{shopnm}/i', $args['shopnm'], $msg);
		$msg = preg_replace('/{goodsurl}/i', $args['goodsurl'], $msg);
		$msg_length = mb_strlen(preg_replace('/{goodsnm}/i', '', $msg));
		$tw_goodsnm = $args['goodsnm'];
		if ($msg_length <= 140) $tw_goodsnm = mb_substr($args['goodsnm'], 0, 140 - $msg_length);
		$msg = preg_replace('/{goodsnm}/i', $tw_goodsnm, $msg);
		$encodedMsg = urlencode(@iconv('EUC-KR', 'UTF-8//IGNORE', $msg));
		$twitterurl = 'http://mobile.twitter.com/compose/tweet?status='.$encodedMsg;	//모바일 url은 다름
		// 트위터

		// 페이스북
		$msg = html_entity_decode(preg_replace('/\n/','', $this->snsCfg['msg_facebook']));
		$msg = preg_replace('/{shopnm}/i', $args['shopnm'], $msg);
		$msg = preg_replace('/{goodsnm}/i', $args['goodsnm'], $msg);
		$msg = preg_replace('/{goodsurl}/i', $args['goodsurl'], $msg);
		$encodedMsg = urlencode(@iconv('EUC-KR', 'UTF-8//IGNORE', $msg));
		$facebookurl = 'http://m.facebook.com/sharer.php?u='.urlencode($args['goodsurl'].'&time='.time());
		// 페이스북

		// 페이스북 메타 TAG
		$title_fb = html_entity_decode(preg_replace('/\n/','', $this->snsCfg['msg_facebook']));
		$title_fb = preg_replace('/{shopnm}/i', $args['shopnm'], $title_fb);
		$title_fb = preg_replace('/{goodsnm}/i', $args['goodsnm'], $title_fb);
		$title_fb = preg_replace('/{goodsurl}/i', $args['goodsurl'], $title_fb);
		$title_fb = htmlspecialchars($title_fb);
		$rtn['meta'] = '<meta property="og:title" content="'.$title_fb.'" />';
		$rtn['meta'] .= '<meta property="og:description" content="'.$title_fb.'" />';
		if (preg_match('/^http(s)?:\/\//',$args['img']))
			$rtn['meta'] .= '<meta property="og:image" content="'.$args['img'].'" />';
		else
			$rtn['meta'] .= '<meta property="og:image" content="http://'.$_SERVER['HTTP_HOST'].'/shop/data/goods/'.$args['img'].'" />';
		// 페이스북 메타 TAG

		// 카카오링크
			// 쇼핑몰 이름
			$this->msg_kakao1 = html_entity_decode($this->snsCfg['msg_kakao_shopnm']);
			$this->msg_kakao1 = preg_replace('/{shopnm}/i', $args['shopnm'], $this->msg_kakao1);
			$this->msg_kakao1 = preg_replace('/{goodsnm}/i', strip_tags($args['goodsnm']), $this->msg_kakao1);
			$this->msg_kakao1 = preg_replace('/{goodsurl}/i', $args['goodsurl'], $this->msg_kakao1);
			// 전송 내용
			$this->msg_kakao2 = html_entity_decode($this->snsCfg['msg_kakao_goodsnm']);
			$this->msg_kakao2 = preg_replace('/{shopnm}/i', $args['shopnm'], $this->msg_kakao2);
			$this->msg_kakao2 = preg_replace('/{goodsnm}/i', strip_tags($args['goodsnm']), $this->msg_kakao2);
			$this->msg_kakao2 = preg_replace('/{goodsurl}/i', $args['goodsurl'], $this->msg_kakao2);
			$this->msg_kakao2 = urlencode(iconv("EUC-KR", "UTF-8", $this->msg_kakao2));
			// 전송 URL
			$this->msg_kakao3 = html_entity_decode($this->snsCfg['msg_kakao_goodsurl']);
			$this->msg_kakao3 = preg_replace('/{shopnm}/i', $args['shopnm'], $this->msg_kakao3);
			$this->msg_kakao3 = preg_replace('/{goodsnm}/i', strip_tags($args['goodsnm']), $this->msg_kakao3);
			$this->msg_kakao3 = preg_replace('/{goodsurl}/i', $args['goodsurl'], $this->msg_kakao3);
		// 카카오링크

		// 미투데이
		$tmpmsg = html_entity_decode(preg_replace('/\n/','', $this->snsCfg['msg_me2day']));
		$tmpmsg = preg_replace('/{shopnm}/i', $args['shopnm'], $tmpmsg);
		$tmpmsg = preg_replace('/{goodsnm}/i', $args['goodsnm'], $tmpmsg);
		$tmpmsg = preg_replace('/{goodsurl}/i', $args['goodsurl'], $tmpmsg);
		$tmpmsg = preg_replace('/\"([^\"]*)\":http:\/\/[^\s]*/i', '$1', $tmpmsg);
		$msg_length = mb_strlen($tmpmsg);

		$msg = html_entity_decode(preg_replace('/\n/','', $this->snsCfg['msg_me2day']));
		$msg = preg_replace('/{shopnm}/i', $args['shopnm'], $msg);
		$me_goodsnm = $args['goodsnm'];
		if ($msg_length > 150) $me_goodsnm = mb_substr($args['goodsnm'], 0, 150 - $msg_length);
		$msg = preg_replace('/{goodsnm}/i', $me_goodsnm, $msg);
		$msg = preg_replace('/{goodsurl}/i', $args['goodsurl'], $msg);

		$encodedMsg = urlencode(@iconv('EUC-KR', 'UTF-8//IGNORE', $msg));
		$tag = ($args['tag'])? $args['tag'] : $args['shopnm'];
		$encodedTag = urlencode(@iconv('EUC-KR', 'UTF-8//IGNORE', $tag));
		$me2dayurl = 'http://me2day.net/posts/new?new_post[body]='.$encodedMsg.'&new_post[tags]='.$encodedTag;
		// 미투데이

		// C공감
		$msg = html_entity_decode(preg_replace('/\n/','', $this->snsCfg['msg_cchoice']));
		$msg = preg_replace('/{shopnm}/i', $args['shopnm'], $msg);
		$msg = preg_replace('/{goodsurl}/i', $args['goodsurl'], $msg);
		$msg = preg_replace('/{goodsnm}/i', $args['goodsnm'], $msg);

		$msg = iconv('euc-kr', 'utf-8', $msg);	//c공감 bi_m_recommend_pop_euc 페이지가 인코딩이 깨지는 현상 발생하여 utf로 인코딩 하여 보냄

		if(mb_strlen($msg) > 400)$msg= mb_strcut($msg, 0, 400); //400byte 제한
		$csummary		= urlencode(base64_encode(htmlspecialchars($msg,ENT_QUOTES)));

		if(mb_strlen($args['goodsnm']) > 50)$cchoiicTitle =mb_strcut($args['goodsnm'], 0, 50); //50byte 제한
		else $cchoiicTitle =$args['goodsnm']; //타이틀

		$cchoiicWriter = urlencode(htmlspecialchars($args['shopnm'],ENT_QUOTES)); //출처
		$cchoiicTitle	= urlencode(base64_encode(htmlspecialchars($cchoiicTitle,ENT_QUOTES)));//내용(base64 필수)

		$clogcfgfile = dirname(__FILE__)."/../conf/clog.cfg.php";
		if(file_exists($clogcfgfile)) @require_once $clogcfgfile;
		if($clogCfg) $this->clogCfg = $clogCfg;
		// C공감 - 브랜드 c로그 개설시
		if($clogCfg['useBrandCLog'] == 'y')$useBrandCLogID	.= '&corpid='.$clogCfg['useBrandCLogID'];

		$cchoiiceurl		= 'http://csp.cyworld.com/bi/bi_m_recommend_pop.php?url='.urlencode($args['goodsurl']).'&title='.$cchoiicTitle.'&writer='.$cchoiicWriter.$useBrandCLogID.'&summary='.$csummary;
		// C공감

		$rtn['btn'] = "";
		if($this->snsCfg['use_kakao'] == 'y') $rtn['btn'] .= '<a href="javascript:;" id="kakao" style="margin-right:5px;"><div class="sns03"><div class="sns03_effect"><div class="sns03_object"></div></div></div></a>';
		if($this->snsCfg['use_facebook'] == 'y') $rtn['btn'] .= '<a href="'.$facebookurl.'" target="_blank" ><div class="sns02"><div class="sns02_effect"><div class="sns02_object"></div></div></div></a>';
		if($this->snsCfg['use_twitter'] == 'y') $rtn['btn'] .= '<a href="'.$twitterurl.'" target="_blank" ><div class="sns01"><div class="sns01_effect"><div class="sns01_object"></div></div></div></a>';
		if($this->snsCfg['use_me2day'] == 'y') $rtn['btn'] .= '<a href="'.$me2dayurl.'" target="_blank" ><div class="sns04"><div class="sns04_effect"><div class="sns04_object"></div></div></div></a>';
		if($this->snsCfg['use_cchoice'] == 'y') $rtn['btn'] .= '<a href="'.$cchoiiceurl.'" target="_blank" ><div class="sns05"><div class="sns05_effect"><div class="sns05_object"></div></div></div></a>';

		return $rtn;
	}
}

?>
