<?
class cashreceipt
{
	var $cfg, $pg;
	var $r_status = array('RDY' => '발급요청', 'ACK' => '발급완료', 'CCR' => '발급취소', 'RFS' => '발급거절');
	var $r_useopt = array('0' => '소득공제용', '1' => '지출증빙용');
	var $autoCrno = array();

	function cashreceipt()
	{
		include dirname(__FILE__).'/../conf/config.php';
		include dirname(__FILE__).'/../conf/config.pay.php';
		if ($cfg['settlePg'] !== '' && file_exists(dirname(__FILE__).'/../conf/pg.'. $cfg['settlePg'] .'.php')){
			include dirname(__FILE__).'/../conf/pg.'. $cfg['settlePg'] .'.php';
		}

		$this->cfg = $cfg;
		$this->set = $set;
		$this->pg = $pg;
	}

	### 발급신청서저장
	function putReceipt($indata)
	{
		//상품명에 특수문자 및 태그 제거
		$indata['goodsnm'] = pg_text_replace(strip_tags($indata['goodsnm']));
		$indata['goodsnm'] = strcut($indata['goodsnm'],30);
		if ($indata['buyerphone'] == '--') $indata['buyerphone'] = '';

		if (strlen($indata['certno']) == 13)
		{
			$certno_encode = encode(substr($indata['certno'],6,7),1);
			$indata['certno'] = substr($indata['certno'],0,6);
		}

		$regdt = ($indata['regdt'] ? "'{$indata['regdt']}'" : "now()");

		$query = "
		insert into ".GD_CASHRECEIPT." set
			`ordno` = '{$indata['ordno']}',
			`goodsnm` = '{$indata['goodsnm']}',
			`buyername` = '{$indata['buyername']}',
			`buyeremail` = '{$indata['buyeremail']}',
			`buyerphone` = '{$indata['buyerphone']}',
			`useopt` = '{$indata['useopt']}',
			`certno` = '{$indata['certno']}',
			`certno_encode` = '{$certno_encode}',
			`amount` = '{$indata['amount']}',
			`supply` = '{$indata['supply']}',
			`surtax` = '{$indata['surtax']}',
			`ip` = '{$_SERVER['REMOTE_ADDR']}',
			`regdt` = {$regdt},
			`moddt` = {$regdt},
			`status` = 'RDY',
			`singly` = '{$indata['singly']}'
		";
		$GLOBALS['db']->query($query);

		return $GLOBALS['db']->lastID();
	}

	### 발급신청서저장(주문서/마이페이지)
	function putUserReceipt($rdata)
	{
		$indata = $this->getOrder($rdata['ordno']);
		$indata['useopt'] = $rdata['useopt'];
		$indata['certno'] =$rdata['certno'];
		return $resid = $this->putReceipt($indata);
	}

	### 발급필요 주문데이터
	function getOrder($ordno)
	{
		global $db;

		$query = "select * from ".GD_ORDER." where ordno='{$ordno}'";
		$data = $db->fetch($query);

		## 상품명
		list($icnt) = $db->fetch("select count(*) from ".GD_ORDER_ITEM." where istep < 40 and ordno='{$data['ordno']}'");
		list($goodsnm) = $db->fetch("select goodsnm from ".GD_ORDER_ITEM." where istep < 40 and ordno='{$data['ordno']}' order by sno");

		$cutLen = 30;
		if ($icnt > 1){
			$cntStr = ' 외 '.($icnt-1).'건';
			$cutLen -= strlen($cntStr) + 2;
		}
		$goodsnm = strcut($goodsnm,$cutLen) . $cntStr;

		$indata = array();
		$indata['ordno'] = $data['ordno'];
		$indata['goodsnm'] = $goodsnm;
		$indata['buyername'] = $data['nameOrder'];
		$indata['buyeremail'] = $data['email'];
		$indata['buyerphone'] = str_replace('-','',$data['mobileOrder']);
		$indata['amount'] = $data['prn_settleprice'];
		if ($this->set['receipt']['compType'] == '1'){ // 면세/간이사업자
			$indata['supply'] = $indata['amount'];
			$indata['surtax'] = 0;
		}
		else { // 과세사업자
			$indata['supply'] = round($indata['amount'] / 1.1);
			$indata['surtax'] = $indata['amount'] - $indata['supply'];
		}
		$indata['mobileOrder'] = $data['mobileOrder'];

		return $indata;
	}

	### 발급
	function pgApproval()
	{
		global $db;

		$crdata = $db->fetch("select * from ".GD_CASHRECEIPT." where crno='{$_GET['crno']}'");

		if ($this->cfg['settlePg'] == '')
		{
			$this->errMsg = '쇼핑몰기본관리" 에서 전자지불(PG)를 먼저 신청/설정하세요.';
			return false;
		}
		else if ($this->pg['receipt'] != 'Y')
		{
			$this->errMsg = '"현금영수증 발급설정" 에서 현금영수증 사용여부를 먼저 설정하세요.';
			return false;
		}
		else if ($crdata['status'] != 'RDY')
		{
			$this->errMsg = '발급신청내역의 처리상태가 [발급요청] 경우에만 발급할 수 있습니다.';
			return false;
		}

		### 인증정보
		if ($crdata['certno_encode']){
			$crdata['certno'].= decode($crdata['certno_encode'],1);
		}

		### 발급전문
		if ($this->cfg['settlePg'] == 'allat' && $_POST['allat_enc_data'] !='')
		{
			include dirname(__FILE__).'/../order/card/allat/allat_cashapproval.php';
		}
		else if ($this->cfg['settlePg'] == 'allat')
		{
			$type = 'NBANK';

			$query = "select settlekind, settlelog from ".GD_ORDER." where ordno='{$crdata['ordno']}'";
			$odata = $db->fetch($query);
			if($odata['settlekind'] == 'o' && preg_match('/거래번호 : (.*)/', $odata['settlelog'], $matched)){
				$tno = $matched[1];
				$type = 'ABANK';
			}

			echo '
			<script language="javascript" src="https://tx.allatpay.com/common/AllatPayRE.js"></script>
			<script language="javascript">
			function ftn_cashapp(dfm)
			{
				var ret;
				ret = invisible_CashApp(dfm);//Function 내부에서 submit을 하게 되어있음.
				if( ret.substring(0,4)!="0000" && ret.substring(0,4)!="9999"){ // 오류 코드 : 0001~9998 의 오류에 대해서 적절한 처리를 해주시기 바랍니다.
					alert(ret.substring(4,ret.length));     // Message 가져오기
				}
				if( ret.substring(0,4)=="9999" ){ // 오류 코드 : 9999 의 오류에 대해서 적절한 처리를 해주시기 바랍니다.
					alert(ret.substring(8,ret.length));     // Message 가져오기
				}
			}
			window.onload = function(){ftn_cashapp(document.fm);}
			</script>
			<form name="fm" method="POST" style="display:block">
			<input type="hidden" name="crno" value="'.$_GET['crno'].'">
			<input type="hidden" name="ordno" value="'.$crdata['ordno'].'">
			<input type="hidden" name="allat_shop_id" value="'.$this->pg['id'].'">
			<input type="hidden" name="allat_apply_ymdhms" value="'.date('YmdHis').'">
			<input type="hidden" name="allat_shop_member_id" value="'.$crdata['buyername'].'">
			<input type="hidden" name="allat_cert_no" value="'.$crdata['certno'].'">
			<input type="hidden" name="allat_supply_amt" value="'.$crdata['supply'].'">
			<input type="hidden" name="allat_vat_amt" value="'.$crdata['surtax'].'">
			<input type="hidden" name="allat_product_nm" value="'.$crdata['goodsnm'].'">
			<input type="hidden" name="allat_receipt_type" value="'.$type.'">
			<!-- 올앳거래 일련번호 : 현금영수증구분 계좌이체(allat_receipt_type=ABANK)일 때 필수 필드임 -->
			<input type="hidden" name="allat_seq_no" value="'.$tno.'">
			<input type="hidden" name="allat_enc_data" value="">
			<input type="hidden" name="allat_opt_pin" value="NOVIEW">
			<input type="hidden" name="allat_opt_mod" value="WEB">
			<input type="hidden" name="allat_reg_business_no" value="">
			<input type="hidden" name="allat_test_yn" value="N">
			</form>
			';
		}
		else if ($this->cfg['settlePg'] == 'allatbasic' && $_POST['allat_enc_data'] !='')
		{
			include dirname(__FILE__).'/../order/card/allatbasic/allat_cashapproval.php';
		}
		else if ($this->cfg['settlePg'] == 'allatbasic')
		{
			$type = 'NBANK';

			$query = "select settlekind, settlelog from ".GD_ORDER." where ordno='{$crdata['ordno']}'";
			$odata = $db->fetch($query);
			if($odata['settlekind'] == 'o' && preg_match('/거래번호 : (.*)/', $odata['settlelog'], $matched)){
				$tno = $matched[1];
				$type = 'ABANK';
			}

			echo '
			<script language="javascript" src="https://tx.allatpay.com/common/AllatPayRE.js"></script>
			<script language="javascript">
			function ftn_cashapp(dfm)
			{
				var ret;
				ret = invisible_CashApp(dfm);//Function 내부에서 submit을 하게 되어있음.
				if( ret.substring(0,4)!="0000" && ret.substring(0,4)!="9999"){ // 오류 코드 : 0001~9998 의 오류에 대해서 적절한 처리를 해주시기 바랍니다.
					alert(ret.substring(4,ret.length));     // Message 가져오기
				}
				if( ret.substring(0,4)=="9999" ){ // 오류 코드 : 9999 의 오류에 대해서 적절한 처리를 해주시기 바랍니다.
					alert(ret.substring(8,ret.length));     // Message 가져오기
				}
			}
			window.onload = function(){ftn_cashapp(document.fm);}
			</script>
			<form name="fm" method="POST" style="display:block">
			<input type="hidden" name="crno" value="'.$_GET['crno'].'">
			<input type="hidden" name="ordno" value="'.$crdata['ordno'].'">
			<input type="hidden" name="allat_shop_id" value="'.$this->pg['id'].'">
			<input type="hidden" name="allat_apply_ymdhms" value="'.date('YmdHis').'">
			<input type="hidden" name="allat_shop_member_id" value="'.$crdata['buyername'].'">
			<input type="hidden" name="allat_cert_no" value="'.$crdata['certno'].'">
			<input type="hidden" name="allat_supply_amt" value="'.$crdata['supply'].'">
			<input type="hidden" name="allat_vat_amt" value="'.$crdata['surtax'].'">
			<input type="hidden" name="allat_product_nm" value="'.$crdata['goodsnm'].'">
			<input type="hidden" name="allat_receipt_type" value="'.$type.'">
			<!-- 올앳거래 일련번호 : 현금영수증구분 계좌이체(allat_receipt_type=ABANK)일 때 필수 필드임 -->
			<input type="hidden" name="allat_seq_no" value="'.$tno.'">
			<input type="hidden" name="allat_enc_data" value="">
			<input type="hidden" name="allat_opt_pin" value="NOVIEW">
			<input type="hidden" name="allat_opt_mod" value="WEB">
			<input type="hidden" name="allat_reg_business_no" value="">
			<input type="hidden" name="allat_test_yn" value="N">
			</form>
			';
		}
		else if ($this->cfg['settlePg'] == 'inicis')
		{
			include dirname(__FILE__).'/../order/card/inicis/sample/INIreceipt.php';
		}
		else if ($this->cfg['settlePg'] == 'inipay')
		{
			include dirname(__FILE__).'/../order/card/inipay/INIreceipt.php';
		}
		else if ($this->cfg['settlePg'] == 'dacom')
		{
			$crdata['method'] = 'auth';
			include dirname(__FILE__).'/../order/card/dacom/cashreceipt.php';
		}
		else if ($this->cfg['settlePg'] == 'lgdacom')
		{
			$crdata['method'] = 'auth';
			include dirname(__FILE__).'/../order/card/lgdacom/CashReceipt.php';
		}
		else if ($this->cfg['settlePg'] == 'kcp')
		{
			$crdata['req_tx'] = 'pay';
			include dirname(__FILE__).'/../order/card/kcp/receipt/request/cash/pp_cli_hub.php';
		}
		else if ($this->cfg['settlePg'] == 'agspay')
		{
			$crdata['Pay_kind'] = 'cash-appr';
			include dirname(__FILE__).'/../order/card/agspay/AGSCash_ing.php';
		}
		else if ($this->cfg['settlePg'] == 'settlebank')
		{
			$crdata['Pay_kind'] = 'cash-appr';
			include dirname(__FILE__).'/../order/card/settlebank/settleCash_ing.php';
		}
		else if ($this->cfg['settlePg'] == 'easypay')
		{
			//--------어드민에서 현글영수증 발급-----------------
			$crdata['EP_tr_cd'] = '00201050';	//어드민 현금영수증 발급정보
			$crdata['pay_type'] = 'cash';
			$crdata['EP_req_type'] = 'issue';
			include dirname(__FILE__).'/../order/card/easypay/cash_receipt.php';
		}

	}

	### 취소
	function pgCancel()
	{
		global $db;

		$crdata = $db->fetch("select * from ".GD_CASHRECEIPT." where crno='{$_GET['crno']}'");

		if ($this->cfg['settlePg'] == '')
		{
			$this->errMsg = '쇼핑몰기본관리" 에서 전자지불(PG)를 먼저 신청/설정하세요.';
			return false;
		}
		else if ($this->pg['receipt'] != 'Y')
		{
			$this->errMsg = '"현금영수증 발급설정" 에서 현금영수증 사용여부를 먼저 설정하세요.';
			return false;
		}
		else if ($crdata['status'] != 'ACK')
		{
			$this->errMsg = '발급신청내역의 처리상태가 [발급완료] 경우에만 취소할 수 있습니다.';
			return false;
		}

		### 인증정보
		if ($crdata['certno_encode']){
			$crdata['certno'].= decode($crdata['certno_encode'],1);
		}

		### 취소전문
		if ($this->cfg['settlePg'] == 'allat' && $_POST['allat_enc_data'] !='')
		{
			include dirname(__FILE__).'/../order/card/allat/allat_cashcancel.php';
		}
		else if ($this->cfg['settlePg'] == 'allat')
		{
			echo '
			<script language="javascript" src="https://tx.allatpay.com/common/AllatPayRE.js"></script>
			<script language="javascript">
			function ftn_cashcan(dfm)
			{
				var ret;
				ret = invisible_CashCan(dfm);//Function 내부에서 submit을 하게 되어있음.
				if( ret.substring(0,4)!="0000" && ret.substring(0,4)!="9999"){ // 오류 코드 : 0001~9998 의 오류에 대해서 적절한 처리를 해주시기 바랍니다.
					alert(ret.substring(4,ret.length));     // Message 가져오기
				}
				if( ret.substring(0,4)=="9999" ){ // 오류 코드 : 9999 의 오류에 대해서 적절한 처리를 해주시기 바랍니다.
					alert(ret.substring(8,ret.length));     // Message 가져오기
				}
			}
			window.onload = function(){ftn_cashcan(document.fm);}
			</script>
			<form name="fm" method="POST" style="display:block">
			<input type="hidden" name="crno" value="'.$_GET['crno'].'">
			<input type="hidden" name="ordno" value="'.$crdata['ordno'].'">
			<input type="hidden" name="allat_shop_id" value="'.$this->pg['id'].'">
			<input type="hidden" name="allat_cash_bill_no" value="'.$crdata['tid'].'">
			<input type="hidden" name="allat_supply_amt" value="'.$crdata['supply'].'">
			<input type="hidden" name="allat_vat_amt" value="'.$crdata['surtax'].'">
			<input type="hidden" name="allat_enc_data" value="">
			<input type="hidden" name="allat_opt_pin" value="NOVIEW">
			<input type="hidden" name="allat_opt_mod" value="WEB">
			<input type="hidden" name="allat_reg_business_no" value="">
			<input type="hidden" name="allat_test_yn" value="N">
			</form>
			';
		}
		else if ($this->cfg['settlePg'] == 'allatbasic' && $_POST['allat_enc_data'] !='')
		{
			include dirname(__FILE__).'/../order/card/allatbasic/allat_cashcancel.php';
		}
		else if ($this->cfg['settlePg'] == 'allatbasic')
		{
			echo '
			<script language="javascript" src="https://tx.allatpay.com/common/AllatPayRE.js"></script>
			<script language="javascript">
			function ftn_cashcan(dfm)
			{
				var ret;
				ret = invisible_CashCan(dfm);//Function 내부에서 submit을 하게 되어있음.
				if( ret.substring(0,4)!="0000" && ret.substring(0,4)!="9999"){ // 오류 코드 : 0001~9998 의 오류에 대해서 적절한 처리를 해주시기 바랍니다.
					alert(ret.substring(4,ret.length));     // Message 가져오기
				}
				if( ret.substring(0,4)=="9999" ){ // 오류 코드 : 9999 의 오류에 대해서 적절한 처리를 해주시기 바랍니다.
					alert(ret.substring(8,ret.length));     // Message 가져오기
				}
			}
			window.onload = function(){ftn_cashcan(document.fm);}
			</script>
			<form name="fm" method="POST" style="display:block">
			<input type="hidden" name="crno" value="'.$_GET['crno'].'">
			<input type="hidden" name="ordno" value="'.$crdata['ordno'].'">
			<input type="hidden" name="allat_shop_id" value="'.$this->pg['id'].'">
			<input type="hidden" name="allat_cash_bill_no" value="'.$crdata['tid'].'">
			<input type="hidden" name="allat_supply_amt" value="'.$crdata['supply'].'">
			<input type="hidden" name="allat_vat_amt" value="'.$crdata['surtax'].'">
			<input type="hidden" name="allat_enc_data" value="">
			<input type="hidden" name="allat_opt_pin" value="NOVIEW">
			<input type="hidden" name="allat_opt_mod" value="WEB">
			<input type="hidden" name="allat_reg_business_no" value="">
			<input type="hidden" name="allat_test_yn" value="N">
			</form>
			';
		}
		else if ($this->cfg['settlePg'] == 'inicis')
		{
			include dirname(__FILE__).'/../order/card/inicis/sample/INIcancel.php';
		}
		else if ($this->cfg['settlePg'] == 'inipay')
		{
			include dirname(__FILE__).'/../order/card/inipay/INIreceiptCancel.php';
		}
		else if ($this->cfg['settlePg'] == 'dacom')
		{
			$crdata['method'] = 'cancel';
			include dirname(__FILE__).'/../order/card/dacom/cashreceipt.php';
		}
		else if ($this->cfg['settlePg'] == 'lgdacom')
		{
			$crdata['method'] = 'cancel';
			include dirname(__FILE__).'/../order/card/lgdacom/CashReceipt.php';
		}
		else if ($this->cfg['settlePg'] == 'kcp')
		{
			$crdata['req_tx'] = 'mod';
			include dirname(__FILE__).'/../order/card/kcp/receipt/request/cash/pp_cli_hub.php';
		}
		else if ($this->cfg['settlePg'] == 'agspay')
		{
			$crdata['Pay_kind'] = 'cash-cncl';
			include dirname(__FILE__).'/../order/card/agspay/AGSCash_ing.php';
		}
		else if ($this->cfg['settlePg'] == 'settlebank')
		{
			$crdata['Pay_kind'] = 'cash-cncl';
			include dirname(__FILE__).'/../order/card/settlebank/settleCash_ing.php';
		}
		else if ($this->cfg['settlePg'] == 'easypay')
		{
			$crdata['Pay_kind'] = 'cash-cncl';
			include dirname(__FILE__).'/../order/card/easypay/cash_cancel.php';
		}
	}

	### 자동발급
	function autoApproval($ordno)
	{
		global $db;

		if ($this->set['receipt']['publisher'] != 'seller') return;
		if ($this->set['receipt']['auto'] != 'Y') return;

		list($crno) = $db->fetch("select crno from ".GD_CASHRECEIPT." where ordno='{$ordno}' and status='RDY' order by crno desc limit 1");
		if ($crno != '') $this->autoCrno[] = $crno;
	}

	### 자동취소
	function autoCancel($ordno)
	{
		global $db;

		if ($this->set['receipt']['publisher'] != 'seller') return;
		if ($this->set['receipt']['auto'] != 'Y') return;

		list($cashreceipt) = $db->fetch("select cashreceipt from ".GD_ORDER." where ordno='{$ordno}'");
		list($crno) = $db->fetch("select crno from ".GD_CASHRECEIPT." where ordno='{$ordno}' and cashreceipt='{$cashreceipt}' and status='ACK' order by crno desc limit 1");
		if ($crno != ''){
			$this->autoCrno[] = $crno;
		}
		else {
			$db->query("update ".GD_CASHRECEIPT." set moddt=now(),status='RFS' where ordno='{$ordno}'");
		}
	}

	### 자동실행
	function autoAction($mode)
	{
		if (count($this->autoCrno) == 0) return;
		echo '<form name="cashfm" method="POST" style="display:none">'."\n";
		foreach ($this->autoCrno as $crno){
			echo '<input type="hidden" name="crno[]" value="'.$crno.'">'."\n";
		}
		echo '</form>
		<script language="javascript">
		function autoAct(dfm)
		{
			var win = window.open("about:blank", "autoCash", "width=400,height=400,scrollbars=1");
			win.focus();
			dfm.action = "../order/cashreceipt.pg.php?mode='.$mode.'";
			dfm.target = "autoCash";
			dfm.submit();
		}
		autoAct(document.cashfm);
		</script>
		';
	}

	### 영수증주소
	function getReceipturl($crno, $mode='')
	{
		global $db;

		if ($mode == 'ordno')
		{
			$ordno = $crno;
			list($cashreceipt, $mobileOrder, $settlekind, $cdt) = $db->fetch("select cashreceipt, mobileOrder, settlekind from ".GD_ORDER." where ordno='{$ordno}'");
			if ($cashreceipt != '') $where = "or (cashreceipt='{$cashreceipt}' and status='ACK')";
			$data = $db->fetch("select crno, pg, tid, certno, ordno, receiptnumber, moddt from ".GD_CASHRECEIPT." where ordno='{$ordno}' {$where} order by crno desc limit 1");
			if ($data['crno'] == ''){
				$data['pg'] = $this->cfg['settlePg'];
				$data['tid'] = $cashreceipt;
				$data['certno'] = str_replace('-','',$mobileOrder);
				$data['ordno'] = $ordno;
				$data['receiptnumber'] = $cashreceipt;
				$data['moddt'] = $cdt;
			}
		}
		else {
			$data = $db->fetch("select crno, pg, tid, certno, ordno, receiptnumber, moddt from ".GD_CASHRECEIPT." where crno='{$crno}'");
		}

		if ($data['pg'] == 'allat' && $data['tid'] && $data['certno'])
		{
			if ($data['crno'] == '' && ($settlekind == 'o' || $settlekind == 'v'));
			else {
				$url = 'https://www.allatpay.com/servlet/AllatBizPop/member/pop_cash_receipt.jsp?receipt_seq_no='.$data['tid'].'&cert_no='.$data['certno'];
			}
		}
		else if ($data['pg'] == 'allatbasic' && $data['tid'] && $data['certno'])
		{
			if ($data['crno'] == '' && ($settlekind == 'o' || $settlekind == 'v'));
			else {
				$url = 'https://www.allatpay.com/servlet/AllatBizPop/member/pop_cash_receipt.jsp?receipt_seq_no='.$data['tid'].'&cert_no='.$data['certno'];
			}
		}
		else if ($data['pg'] == 'inicis' && $data['tid'])
		{
			$url = 'https://iniweb.inicis.com/DefaultWebApp/mall/cr/cm/Cash_mCmReceipt.jsp?noTid='.$data['tid'].'&clpaymethod=22';
		}
		else if ($data['pg'] == 'inipay' && $data['tid'])
		{
			$url = 'https://iniweb.inicis.com/DefaultWebApp/mall/cr/cm/Cash_mCmReceipt.jsp?noTid='.$data['tid'].'&clpaymethod=22';
		}
		else if ($data['pg'] == 'dacom'||$data['pg'] == 'lgdacom')
		{
			// 요청 URL
			// 서비스용 : http://pg.dacom.net/transfer/cashreceipt.jsp
			// 테스트용 : http://pg.dacom.net:7080/transfer/cashreceipt.jsp

			if (file_exists(dirname(__FILE__).'/../conf/pg.dacom.php')) include dirname(__FILE__).'/../conf/pg.dacom.php';
			$paramStr = 'orderid='.$data['ordno'].'&mid='.$this->pg['id'];

			if ($data['crno'] == '' && $settlekind == 'o') $paramStr .= '&servicetype=SC0030'; // 계좌이체
			else if ($data['crno'] == '' && $settlekind == 'v') $paramStr .= '&servicetype=SC0040&seqno=001'; // 무통장입금(가상계좌)
			else $paramStr .= '&servicetype=SC0100'; // 자체 무통장입금

			$url = 'http://pg.dacom.net/transfer/cashreceipt.jsp?'.$paramStr;
		}
		else if ($data['pg'] == 'kcp' && $data['tid'])
		{
			if ($data['crno'] == '' && ($settlekind == 'o' || $settlekind == 'v'));
			else {
				$url = 'http://admin.kcp.co.kr/Modules/Service/Cash/Cash_Bill_Common_View.jsp?cash_no='.$data['tid'];
			}
		}
		else if ($data['pg'] == 'agspay' && $data['receiptnumber'])
		{
			if ($data['crno'] == '' && ($settlekind == 'o' || $settlekind == 'v'));
			else {
				$send_dt = str_replace('-','',substr($data['moddt'],0,10));
				$url = 'http://www.allthegate.com/receipt/receipt_cash.jsp?service_id='.$this->pg['id'].'&send_dt='.$send_dt.'&adm_no='.$data['receiptnumber'];
			}
		}
		else if ($data['pg'] == 'easypay' && $data['receiptnumber'])
		{
			if ($data['crno'] == '' && ($settlekind == 'o' || $settlekind == 'v'));
			else {
				$send_dt = str_replace('-','',substr($data['moddt'],0,10));
				$url = "http://office.easypay.co.kr/receipt/ReceiptBranch.jsp?controlNo=".$data[tid]."&payment=현금영수증";
			}
		}
		else if ($data['pg'] == 'settlebank' && $data['ordno'])
		{
			if ($data['crno'] == '' && ($settlekind == 'o' || $settlekind == 'v')) {
			} else {
				$url = "http://pg.settlebank.co.kr/common/CommonMultiAction.do?_method=RcptView&mid=".$this->pg['id']."&ordNo=".$data['ordno']."&svcCd=CSH";
			}
		}
	
	
		return $url;
	}

	### 관리모드 주문상세내역 현금영수증 출력
	function prnAdminReceipt($ordno)
	{
		global $db;

		$prn = array();
		list($cashreceipt, $cashreceipt_ectway) = $db->fetch("select cashreceipt, cashreceipt_ectway from ".GD_ORDER." where ordno='{$ordno}'");

		if ($cashreceipt != '') $where = "or (cashreceipt='{$cashreceipt}' and status='ACK')";
		$crdata = $db->fetch("select * from ".GD_CASHRECEIPT." where ordno='{$ordno}' {$where} order by crno desc limit 1");
		if ($crdata['crno']) // 신청내역있다
		{
			$prn[] = '<font class="small1">'.$this->r_status[ $crdata['status'] ].'</font>';

			if (in_array($crdata['status'], array('ACK','CCR')))
			{
				if ($cashreceipt != '') $prn[] = $cashreceipt;
				else if ($crdata['tid'] != '') $prn[] = $crdata['tid'];
				else if ($crdata['receiptnumber'] != '') $prn[] = $crdata['receiptnumber'];

				$receipturl =  $this->getReceipturl($crdata['crno']);
				if ($receipturl == '')
					$prn[] = '<span class="hand" onclick="alert(\'영수증 출력을 지원하지 않습니다.\');"><img src="../img/i_receipt_off.gif"></span>';
				else
					$prn[] = '<span class="hand" onclick="window.open(\''.$receipturl.'\',\'\',\'width=400,height=600,scrollbars=0\');"><img src="../img/i_receipt_on.gif"></span>';
			}
		}
		else if ($cashreceipt != '') // 신청내역없고 영수증번호있다
		{
			$prn[] = $cashreceipt;

			$receipturl =  $this->getReceipturl($ordno, 'ordno');
			if ($receipturl != '')
				$prn[] = '<span class="hand" onclick="window.open(\''.$receipturl.'\',\'\',\'width=400,height=600,scrollbars=0\');"><img src="../img/i_receipt_on.gif"></span>';
		}

		if ($crdata['crno'] == '' && $cashreceipt == '' && $this->pg['receipt'] == 'Y' && $cashreceipt_ectway != 'Y'){
			$prn[] = '<a href="javascript:popupLayer(\'./popup.cashreceiptOrder.php?ordno='.$ordno.'\', 650, 500)"><img src="../img/btn_cashreceipt_app.gif"></a>';
		}
		else if (in_array($crdata['status'], array('CCR','RFS')) && $this->pg['receipt'] == 'Y' && $cashreceipt_ectway != 'Y')
		{
			$prn[] = '<a href="javascript:popupLayer(\'./popup.cashreceiptOrder.php?ordno='.$ordno.'\', 650, 500)"><img src="../img/btn_cashreceipt_reapp.gif"></a>';
		}

		if ($crdata['crno'])
		{
			$prn[] = '<a href="../order/cashreceipt.list.php?skey=ordno&sword='.$ordno.'"><img src="../img/btn_more.gif"></a>';
		}

		return implode(' ', $prn);
	}

	### 유저모드 주문내역상세
	function prnUserReceipt($ordno)
	{
		global $db;

		list($cashreceipt) = $db->fetch("select cashreceipt from ".GD_ORDER." where ordno='{$ordno}'");
		$query = "select crno,useopt,moddt,receiptnumber,tid,status from ".GD_CASHRECEIPT." where ordno='{$ordno}' order by crno desc";
		$res = $db->query($query);
		$cnt = $db->count_($res);
		while ($sub=$db->fetch($res,1))
		{
			# 발급용도
			$sub['useoptStr'] = $this->r_useopt[ $sub['useopt'] ];
			# 처리상태
			$sub['statusStr'] = $this->r_status[ $sub['status'] ];
			# 영수증
			if ($sub['receiptnumber'] != '' && $this->getReceipturl($sub['crno']) != '') $sub['printable'] = 'crno='.$sub['crno'];

			$this->list[] = $sub;
			if ($sub['status']=='RDY' || $sub['status']=='ACK') $doCnt++;
		}

		if (($cnt && $doCnt <= 0) || ($cnt == 0 && $cashreceipt == '')) $this->writeable = true;
		if ($this->getReceipturl($ordno, 'ordno')) $this->printable = 'ordno='.$ordno;
	}
}

?>
