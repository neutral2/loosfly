<?php
 ### kcp ����� ����

	@include dirname(__FILE__)."/../../../../conf/pg.kcp.php";
	@include dirname(__FILE__)."/../../../../conf/pg_mobile.kcp.php";
	@include dirname(__FILE__)."/../../../../conf/pg.escrow.php";

	$page_type = $_GET['page_type'];

	if(is_array($pg_mobile)) {
		$pg_mobile = array_merge($pg_mobile, $pg);
	}
	else {
		$pg_mobile = $pg;
	}

	if(!preg_match('/mypage/',$_SERVER[SCRIPT_NAME])){
	$item = $cart -> item;
	}

	foreach($item as $v){
	$i++;
	if($i == 1) $ordnm = $v[goodsnm];
	$good_info .= "seq=".$i.chr(31);
	$good_info .= "ordr_numb=".$ordno.$i.chr(31);
	$good_info .= "good_name=".addslashes(substr($v[goodsnm],0,30)).chr(31);
	$good_info .= "good_cntx=".$v[ea].chr(31);
	$good_info .= "good_amtx=".$v[price].chr(30);
	}
	//��ǰ�� Ư������ �� �±� ����
	$ordnm	= pg_text_replace(strip_tags($ordnm));
	if($i > 1)$ordnm .= " ��".($i-1)."��";

	## ������ ������
	if( $pg_mobile[zerofee] == 'yes' ){ $pg_mobile[zerofeeFl] = 'Y'; }
	else if( $pg_mobile[zerofee] == 'admin' ) { $pg_mobile[zerofeeFl] = ''; }
	else { $pg_mobile[zerofeeFl] = 'N';}

?>
<?
    /* = -------------------------------------------------------------------------- = */
    /* =   ȯ�� ���� ���� Include END                                               = */
    /* ============================================================================== */

	$g_conf_home_dir  = $_SERVER['DOCUMENT_ROOT'].$cfg[rootDir]."/order/card/kcp/mobile/receipt";     // BIN ������ �Է� (bin������)
	$g_conf_gw_url    = "paygw.kcp.co.kr";
    $g_conf_site_cd   = $pg[id];
	$g_conf_site_key  = $pg[key];
	$g_conf_site_name = "KCP SHOP";
	$g_conf_gw_port   = "8090";        // ��Ʈ��ȣ(����Ұ�)
?>
<?
    /* kcp�� ����� kcp �������� ���۵Ǵ� ���� ��û ����*/
    $req_tx          = $_POST[ "req_tx"         ]; // ��û ����
    $res_cd          = $_POST[ "res_cd"         ]; // ���� �ڵ�
    $tran_cd         = $_POST[ "tran_cd"        ]; // Ʈ����� �ڵ�
    $ordr_idxx       = $_POST[ "ordno"      ]; // ���θ� �ֹ���ȣ
    $good_name       = $ordnm					; // ��ǰ��
    $good_mny        = $_POST[ "settleprice"       ]; // ���� �ѱݾ�
    $buyr_name       = $_POST[ "nameOrder"      ]; // �ֹ��ڸ�
    $buyr_tel1       = implode("-",$_POST['phoneOrder']); // �ֹ��� ��ȭ��ȣ
    $buyr_tel2       = implode("-",$_POST['mobileOrder']); // �ֹ��� �ڵ��� ��ȣ
    $buyr_mail       = $_POST[ "email"      ]; // �ֹ��� E-mail �ּ�
    $enc_info        = $_POST[ "enc_info"       ]; // ��ȣȭ ����
    $enc_data        = $_POST[ "enc_data"       ]; // ��ȣȭ ������

	/*
     * ��Ÿ �Ķ���� �߰� �κ� - Start -
     */
    $param_opt_1     = $_POST[ "param_opt_1"    ]; // ��Ÿ �Ķ���� �߰� �κ�
    $param_opt_2     = $_POST[ "param_opt_2"    ]; // ��Ÿ �Ķ���� �߰� �κ�
    $param_opt_3     = $_POST[ "param_opt_3"    ]; // ��Ÿ �Ķ���� �߰� �κ�
    /*
     * ��Ÿ �Ķ���� �߰� �κ� - End -
     */

	 ### �������� ���

	 $ipgm_date = date("Ymd",strtotime("now"."+3 days"));

	 switch ($_POST[settlekind]){	// ���� ���
		case "c":	// �ſ�ī��
			$use_pay_method		= "100000000000";
			$pay_method = "CARD";
			$paynm			= "�ſ�ī��";
			break;
//		case "o":	// ������ü
//			$use_pay_method		= "SC0030";
//			$pay_method = "";
//			$paynm			= "������ü";
//			break;
		case "v":	// �������
			$use_pay_method		= "001000000000";
			$pay_method = "VCNT";
			$paynm			= "�������";
			break;
		case "h":	// �ڵ���
			$use_pay_method		= "000010000000";
			$pay_method = "MOBX";
			$paynm			= "�ڵ���";
			break;
	}

	//ssl ���ȼ��� ���� �߰�
	if($_SERVER['SERVER_PORT'] == 80) {
		$Port = "";
	} elseif($_SERVER['SERVER_PORT'] == 443) {
		$Port = "";
	} else {
		$Port = $_SERVER['SERVER_PORT'];
	}

	if (strlen($Port)>0) $Port = ":".$Port;

	$Protocol = $_SERVER['HTTPS']=='on'?'https://':'http://';
	$host = parse_url($_SERVER['HTTP_HOST']);

	if ($host['path']) {
		$Host = $host['path'];
	} else {
		$Host = $host['host'];
	}

?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta http-equiv="Cache-Control" content="No-Cache">
<meta http-equiv="Pragma" content="No-Cache">
<meta name="viewport" content="user-scalable=0, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" />

<!-- �ŷ���� �ϴ� kcp ������ ����� ���� ��ũ��Ʈ-->
<script language="javascript" src="<?=$cfg[rootDir]?>/order/card/kcp/mobile/approval_key.js" type="text/javascript"></script>

<style type="text/css">
	.LINE { background-color:#afc3ff }
	.HEAD { font-family:"����","����ü"; font-size:9pt; color:#065491; background-color:#eff5ff; text-align:left; padding:3px; }
	.TEXT { font-family:"����","����ü"; font-size:9pt; color:#000000; background-color:#FFFFFF; text-align:left; padding:3px; }
	    B { font-family:"����","����ü"; font-size:13pt; color:#065491;}
	INPUT { font-family:"����","����ü"; font-size:9pt; }
	SELECT{font-size:9pt;}
	.COMMENT { font-family:"����","����ü"; font-size:9pt; line-height:160% }
</style>
<script language="javascript">
	self.name = "tar_opener";

	/* �ֹ���ȣ ���� ���� */
    function init_orderid()
    {
        var today = new Date();
        var year  = today.getFullYear();
        var month = today.getMonth()+ 1;
        var date  = today.getDate();
        var time  = today.getTime();

        if(parseInt(month) < 10) {
            month = "0" + month;
        }

        var vOrderID = year + "" + month + "" + date + "" + time;
        var vDEL_YMD = year + "" + month + "" + date;

        document.forms[0].ordr_idxx.value = vOrderID;
        self.name = "tar_opener";
    }

	/* kcp web ����â ȣ�� (����Ұ�)*/
    function call_pay_form()
    {

       var v_frm = document.sm_form;

        layer_cont_obj   = document.getElementById("content");
        layer_card_obj = document.getElementById("layer_card");

        layer_cont_obj.style.display = "none";
        layer_card_obj.style.display = "block";

        v_frm.target = "frm_card";
        v_frm.action = PayUrl;

		if(v_frm.Ret_URL.value == "")
		{
			/* Ret_URL���� �� �������� URL �Դϴ�. */
			alert("������ Ret_URL�� �ݵ�� �����ϼž� �˴ϴ�.");
			return false;
		}
		else
        {
			v_frm.submit();
		}

        v_frm.submit();
    }


	/* kcp ����� ���� ���� ��ȣȭ ���� üũ �� ���� ��û*/
    function chk_pay()
    {
        /*kcp ������������ ������ �ֹ��������� ������ ���������� ����(����Ұ�)*/
        self.name = "tar_opener";

        var pay_form = document.pay_form;

        if (pay_form.res_cd.value == "3001" )
        {
            alert("����ڰ� ����Ͽ����ϴ�.");
            pay_form.res_cd.value = "";
            return false;
        }
        else if (pay_form.res_cd.value == "3000" )
        {
            alert("30���� �̻� ���� �Ҽ� �����ϴ�.");
            pay_form.res_cd.value = "";
            return false;
        }

        if (pay_form.enc_data.value != "" && pay_form.enc_info.value != "" && pay_form.tran_cd.value !="" )
        {
            jsf__show_progress(true);
            alert("������ �ϴ��� Ȯ�� ��ư�� ���� �ּ���.");
        }
        else
        {
             jsf__show_progress(false);
             return false;
        }
    }

	function  jsf__show_progress( show )
    {
        if ( show == true )
        {
            document.getElementById("show_pay_btn") .style.display  = 'inline';
            document.getElementById("show_progress").style.display = 'inline';
            document.getElementById("show_req_btn") .style.display = 'none';
        }
        else
        {
            document.getElementById("show_pay_btn") .style.display  = 'none';
            document.getElementById("show_progress").style.display = 'none';
            document.getElementById("show_req_btn") .style.display = 'inline';
        }
    }

    /* ���� ���� ��û*/
    function jsf__pay ()
    {
        var pay_form = document.pay_form;
        pay_form.submit();
    }

</script>

<div id="content">

<form name="sm_form" method="POST">

<table border="0" width="100%">
	<tr>
		<td align="center">
			<b style="color:blue">* ����Ʈ�� <?=$paynm?> ���� *</b>
		</td>
	</tr>
</table>
<BR>
<table width="50%" border="0" align="center">
<tr>
	<td width="50%" valign="top">
		<table border="0" width="90%" class="LINE" cellspacing="1" cellpadding="1" align="center">
      <tr>
          <td class="TEXT" colspan="2" style="text-align:center"><b>�ֹ� ����</b></td>
      </tr>
      <tr>
          <td class="HEAD">��&nbsp;&nbsp;ǰ&nbsp;&nbsp;��</td>
          <td class="TEXT"><input type="text" name='good_name' maxlength="100" value='<?=$good_name?>'></td>
      </tr>
      <tr>
          <td class="HEAD">��&nbsp;ǰ&nbsp;��&nbsp;��</td>
          <td class="TEXT"><input type="text" name='good_mny' size="9" maxlength="9" value='<?=$good_mny?>' ></td>
      </tr>
      <tr>
          <td class="HEAD">�ֹ���&nbsp;�̸�</td>
          <td class="TEXT"><input type="text" name='buyr_name' size="20" maxlength="20" value="<?=$buyr_name?>"></td>
      </tr>
      <tr>
          <td class="HEAD">�ֹ���&nbsp;����ó</td>
          <td class="TEXT"><input type="text" name='buyr_tel1' size="20" maxlength="20" value='<?=$buyr_tel1?>'></td>
      </tr>
      <tr>
          <td class="HEAD">�ֹ���&nbsp;�ڵ���&nbsp;��ȣ</td>
          <td class="TEXT"><input type="text" name='buyr_tel2' size="20" maxlength="20" value='<?=$buyr_tel2?>'></td>
      </tr>
      <tr>
          <td class="HEAD">�ֹ���&nbsp;E-mail</td>
          <td class="TEXT"><input type="text" name='buyr_mail' size="20" maxlength="30" value='<?=$buyr_mail?>'></td>
      </tr>
	  <?php
		if ($use_pay_method	== "001000000000"){
	  ?>
	  <tr>
          <td class="HEAD">��&nbsp;��&nbsp;��&nbsp;��</td>
          <td class="TEXT"><input type="text" name='ipgm_date' size="20" maxlength="30" value='<?=$ipgm_date?>'></td>
      </tr>
	  <?php	 } ?>
		</table>
	</td>
</tr>
</table>

<table width="100%" border="0">
      <tr id='show_req_btn' align="center">
          <td class="TEXT" colspan="2" style="text-align:center">
              <!-- <input type="submit" value="������� ��û��ư"> -->
              <input type="button" name="submitChecked" onClick="kcp_AJAX();" value="������Ͽ�û" />
              <input type="button" name="btn" value="Reload" onClick="javascript:location.reload()">
          </td>
      </tr>
      <tr id='show_progress' style='display:none;'>
          <td class="TEXT" colspan="2" style="text-align:center">�ݵ�� Ȯ�ι�ư�� Ŭ�� �ϼž߸� ������ ����˴ϴ�.</td>
      </tr>
      <tr id='show_pay_btn' align="center" style='display:none;'>
          <td class="TEXT" colspan="2" style="text-align:center">
              <!-- <input type="submit" value="������ư"> -->
              <input type="button" name="btn" onClick="jsf__pay();" value="Ȯ��" />
          </td>
      </tr>
</table>
<!-- �ʼ� ���� -->

<!-- ��û ���� -->
<input type='hidden' name='req_tx'       value='pay'>
<!-- ����Ʈ �ڵ� -->
<input type="hidden" name='site_cd'      value="<?=$g_conf_site_cd?>">
<!-- ����Ʈ Ű -->
<input type='hidden' name='site_key'     value='<?=$g_conf_site_key?>'>
 <!-- ����Ʈ �̸� -->
<input type="hidden" name='shop_name'    value="<?=$g_conf_site_name?>">
<!-- ��������-->
<input type="hidden" name='pay_method'   value="<?=$pay_method?>">
<!-- �ֹ���ȣ -->
<input type="hidden"   name='ordr_idxx'    value="<?=$_POST['ordno']?>">
<!-- �ִ� �Һΰ����� -->
<input type="hidden" name='quotaopt'     value="12">
<!-- ��ȭ �ڵ� -->
<input type="hidden" name='currency'     value="410">
<!-- ������� Ű -->
<input type="hidden" name='approval_key' id="approval">
<!-- ���� URL (kcp�� ����� ������ ��û�� �� �ִ� ��ȣȭ �����͸� ���� ���� �������� �ֹ������� URL) -->
<!-- �ݵ�� ������ �ֹ��������� URL�� �Է� ���ֽñ� �ٶ��ϴ�. -->
<input type="hidden" name='Ret_URL'      value="<?=$Protocol.$Host.$Port?><?=$cfg['rootDir']?>/order/card/kcp/mobile/nscreen_card_return.php?page_type=<?=$page_type?>">
<!-- ������ �ʿ��� �Ķ����(����Ұ�)-->
<input type='hidden' name='ActionResult' value='<?=strtolower($pay_method)?>'>
<!-- ������ �ʿ��� �Ķ����(����Ұ�)-->
<input type="hidden" name='escw_used'    value="N">

<input type="hidden" name='approval_url' value="<?=$cfg[rootDir]?>/order/card/kcp/mobile/order_approval.php"/>

<!-- ��Ÿ �Ķ���� �߰� �κ� - Start - -->
<input type="hidden" name='param_opt_1'	 value="<?=$param_opt_1?>"/>
<input type="hidden" name='param_opt_2'	 value="<?=$param_opt_2?>"/>
<input type="hidden" name='param_opt_3'	 value="<?=$param_opt_3?>"/>
<!-- ��Ÿ �Ķ���� �߰� �κ� - End - -->
<?php
	if ($use_pay_method	== "100000000000"){	// �ſ�ī�� �� ��
?>
<!-- ��� ī�� ���� //-->
<input type="hidden" name='used_card'    value="">

<!-- ������ �ɼ�
		�� �����Һ�    (������ ������ �������� ���� �� ������ ������ ������)                             - "" �� ����
		�� �Ϲ��Һ�    (KCP �̺�Ʈ �̿ܿ� ���� �� ��� ������ ������ �����Ѵ�)                           - "N" �� ����
		�� ������ �Һ� (������ ������ �������� ���� �� ������ �̺�Ʈ �� ���ϴ� ������ ������ �����Ѵ�)   - "Y" �� ���� //-->
<input type="hidden" name="kcp_noint"       value="<?=$pg_mobile['zerofeeFl']?>"/>

<!-- ������ ����
		�� ���� 1 : �Һδ� �����ݾ��� 50,000 �� �̻��� ��쿡�� ����
		�� ���� 2 : ������ �������� ������ �ɼ��� Y�� ��쿡�� ���� â�� ����
		��) �� ī�� 2,3,6���� ������(����,��,����,�Ｚ,����,����,�Ե�,��ȯ) : ALL-02:03:04
		BC 2,3,6����, ���� 3,6����, �Ｚ 6,9���� ������ : CCBC-02:03:06,CCKM-03:06,CCSS-03:06:04 //-->
<input type="hidden" name="kcp_noint_quota" value="<?=$pg_mobile['zerofee_period']?>"/>
<?php	 } ?>
</form>
</div>

<!-- ����Ʈ������ KCP ����â�� ���̾� ���·� ����-->
<div id="layer_card" style="position:absolute; left:1px; top:1px; width:310;height:400; z-index:1; display:none;">
    <table width="310" border="-" cellspacing="0" cellpadding="0" style="text-align:center">
        <tr>
            <td>
                <iframe name="frm_card" frameborder="0" border="0" width="310" height="400" scrolling="auto"></iframe>
            </td>
        </tr>
    </table>
</div>

<form name="pay_form" method="POST" action="<?=$cfg[rootDir]?>/order/card/kcp/mobile/nscreen_card_return.php?page_type=<?=$page_type?>">
    <input type="hidden" name="req_tx"         value="pay">      <!-- ��û ����          -->
    <input type="hidden" name="res_cd"         value="<?=$res_cd?>">      <!-- ��� �ڵ�          -->
    <input type="hidden" name="tran_cd"        value="<?=$tran_cd?>">     <!-- Ʈ����� �ڵ�      -->
    <input type="hidden" name="ordr_idxx"      value="<?=$ordr_idxx?>">   <!-- �ֹ���ȣ           -->
    <input type="hidden" name="good_mny"       value="<?=$good_mny?>">    <!-- �޴��� �����ݾ�    -->
    <input type="hidden" name="good_name"      value="<?=$good_name?>">   <!-- ��ǰ��             -->
    <input type="hidden" name="buyr_name"      value="<?=$buyr_name?>">   <!-- �ֹ��ڸ�           -->
    <input type="hidden" name="buyr_tel1"      value="<?=$buyr_tel1?>">   <!-- �ֹ��� ��ȭ��ȣ    -->
    <input type="hidden" name="buyr_tel2"      value="<?=$buyr_tel2?>">   <!-- �ֹ��� �޴�����ȣ  -->
    <input type="hidden" name="buyr_mail"      value="<?=$buyr_mail?>">   <!-- �ֹ��� E-mail      -->
    <input type="hidden" name="enc_info"       value="<?=$enc_info?>">    <!-- ��ȣȭ ����        -->
    <input type="hidden" name="enc_data"       value="<?=$enc_data?>">    <!-- ��ȣȭ ������      -->
    <input type="hidden" name="use_pay_method" value="<?=$use_pay_method?>">      <!-- ��û�� ���� ����   -->
	<input type="hidden" name="param_opt_1"	   value="<?=$param_opt_1?>">
	<input type="hidden" name="param_opt_2"	   value="<?=$param_opt_2?>">
	<input type="hidden" name="param_opt_3"	   value="<?=$param_opt_3?>">
</form>