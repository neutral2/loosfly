<?php /* Template_ 2.2.7 2013/11/13 16:04:00 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/board/gallery/view.htm 000003088 */ 
$TPL_loop_1=empty($TPL_VAR["loop"])||!is_array($TPL_VAR["loop"])?0:count($TPL_VAR["loop"]);?>
<?php $this->print_("header",$TPL_SCP,1);?> <?php echo $GLOBALS["bdHeader"]?>

<link rel="stylesheet" href="/shop/data/skin/loosfly/board/gallery/style.css" />
<script type="text/javascript" language="javascript" src="/shop/data/skin/loosfly/board/gallery/rolling.js"></script>

		<div style="width:1040px; margin:0 auto;font:normal 12px/20px  "³ª´®°íµñ", "Nanum Gothic", "AppleGothic", "¸¼Àº°íµñ", "Malgun Gothic", "µ¸¿ò", "Dotum", "Sans-serif"; font-color:#3f3f3f; letter-spacing:0;">
			<div style="height:2px;"></div>
			<div style="width:255px; height:40px; background:#f5f5f5; margin:0 auto;text-align:center;">
				<span style="color:#a4a4a4; letter-spacing:3px; font:normal 14px/40px 'Courier New', Courier, monospace;">loosfly's stories</span>
			</div>
			<div style="height:15px;border:#cfcfcf 0 solid; border-bottom-width:1px;"></div>
			<div style="height:10px;"></div>

<?php if($TPL_loop_1){foreach($TPL_VAR["loop"] as $TPL_V1){?>
			
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td height="200" valign="top" id="contents">
					<table width="100%" cellpadding="0" cellspacing="0" border="0" style="table-layout:fixed">
					<tr>
						<td style="word-wrap:break-word;word-break:break-all" id=contents_<?php echo $TPL_V1["no"]?> valign=top></td>
					</tr>
					</table>
				</td>
			</tr>
			<tr><td height="40"> </td></tr>
			<tr>
				<td>
<?PHP if(  $GLOBALS["sess"]["m_id"] == "loosshop" ) { ?>
					<table width="100%" cellpadding="0" cellspacing="0" border="0" style="table-layout:fixed">
					<tr>
						<td align="right" style="padding-top:10px">
<?php if($TPL_V1["link"]["modify"]){?><?php echo $TPL_V1["link"]["modify"]?><img src="/shop/data/skin/loosfly/board/gallery/img/modify_01.gif"><?php echo $TPL_VAR["link"]["end"]?> <?php }?>
<?php if($TPL_V1["link"]["delete"]){?><?php echo $TPL_V1["link"]["delete"]?><img src="/shop/data/skin/loosfly/board/gallery/img/delete_01.gif"><?php echo $TPL_VAR["link"]["end"]?> <?php }?>
						<?php echo $TPL_VAR["link"]["list"]?><img src="/shop/data/skin/loosfly/board/gallery/img/list_01.gif"><?php echo $TPL_VAR["link"]["end"]?>

<?php if($TPL_VAR["link"]["write"]){?><?php echo $TPL_VAR["link"]["write"]?><img src="/shop/data/skin/loosfly/board/gallery/img/write_01.gif"><?php echo $TPL_VAR["link"]["end"]?><?php }?>
						</td>
					</tr>
					</table>
<?PHP } ?>
				</td>
			</tr>
			<tr><td height="40"> </td></tr>
			</table>
			
			
			<textarea id=examC_<?php echo $TPL_V1["no"]?> style="display:none;width:100%;height:300px"><?php echo htmlspecialchars($TPL_V1["contents"])?></textarea>
<?php }}?>
			
<?php if($GLOBALS["bdTypeView"]== 2){?><?php $this->print_("list",$TPL_SCP,1);?><?php }?>
			</td></tr></table>
		</div>
<?php echo $GLOBALS["bdFooter"]?> <?php $this->print_("footer",$TPL_SCP,1);?>