<?
  $site_cd       = $_GET[ "site_cd"      ];
  $ordr_idxx     = $_GET[ "ordr_idxx"    ];
  $good_mny      = $_GET[ "good_mny"     ];
  $pay_method    = $_GET[ "pay_method"   ];
  $escw_used     = $_GET[ "escw_used"    ];    
  $good_name     = $_GET[ "good_name"    ];
  $Ret_URL       = $_GET[ "Ret_URL"      ];
  $Ret_URL       = $_GET[ "Ret_URL"      ];

  $rm_mark	= array(',','&',';','\n','\\','|','\'','"','/');
  $good_name = substr($good_name,0,30);
  $good_name = str_replace($rm_mark,"",$good_name);
	
	//���󺯰�� pggw.kcp.co.kr ����
	$host = 'pggw.kcp.co.kr';
	//���󺯰�� http://pggw.kcp.co.kr/jsp/php4/php4.jsp ����
	$service_uri = "http://pggw.kcp.co.kr/jsp/php4/php4.jsp?site_cd=".$site_cd."&ordr_idxx=".$ordr_idxx."&good_mny=".$good_mny."&pay_method=".$pay_method."&escw_used=".$escw_used."&good_name=".urlencode($good_name)."&Ret_URL=".urlencode($Ret_URL)."&Agent=".urlencode($_SERVER['HTTP_USER_AGENT']);
	$fp = fsockopen ($host, 80, $errno, $errstr, 30);
	if (!$fp) {
	    echo "$errstr ($errno)
	\n";
	} else {
	    fputs ($fp, "GET $service_uri HTTP/1.0\r\n\r\n");
	    while (!feof($fp)) {
	        $source .= fgets($fp, 128);
	    }
	    fclose ($fp);
	}
	$split   = explode("\r\n\r\n", $source);
	
	echo $split[4];
?>