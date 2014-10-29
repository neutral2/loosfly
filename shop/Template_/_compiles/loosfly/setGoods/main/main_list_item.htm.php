<?php /* Template_ 2.2.7 2013/04/16 10:58:59 /www/loosfly_godo_co_kr/shop/data/skin/loosfly/setGoods/main/main_list_item.htm 000002243 */ 
if (is_array($TPL_VAR["obj"])) $TPL_obj_1=count($TPL_VAR["obj"]); else if (is_object($TPL_VAR["obj"]) && in_array("Countable", class_implements($TPL_VAR["obj"]))) $TPL_obj_1=$TPL_VAR["obj"]->count();else $TPL_obj_1=0;?>
<?php if($TPL_VAR["count"]< 1&&$TPL_VAR["pg"]== 1){?>	
		<div style="width:100%;margin:150px 0 150px 0;font:24px arial;color:#0077b5;">진열된 코디(Set) 상품이 없습니다.</div>
<?php }else{?>	
<?php if($TPL_obj_1){foreach($TPL_VAR["obj"] as $TPL_V1){?>				
			<div class="codyDiv" >			
				<div class="codiBox">
					<div class="codiBox-area">
						<div class="ImageDiv"><a href="<?php echo url("setGoods/content.php?")?>&idx=<?php echo $TPL_V1["idx"]?>" ><img class="Image" src="../setGoods/data/Tnail/300/300_<?php echo $TPL_V1["thumnail_name"]?>" /></a></div>
						<div class="codiInfo" ><?php echo $TPL_V1["cody_name"]?></div>
						<div class="codiInfo" >￦<?php echo number_format($TPL_V1["setCost"])?></div>
						<div class="codiLine" ></div>
						<div class="codiMemo"><?php echo nl2br($TPL_V1["memo"])?></div>
						<div class="codiSymbol">
							<span class="icon"><img src='/shop/data/skin/loosfly/setGoods/img/front/icon_comment.gif' style="vertical-align:text-bottom;" /><?php echo $TPL_V1["recody_cnt"]?></span>
							<span class="icon"><img src='/shop/data/skin/loosfly/setGoods/img/front/icon_likeit.gif' style="vertical-align:text-bottom;" /><?php echo $TPL_V1["like_cnt"]?></span>
						</div> 
					</div>
					<div class="codiComment">
						<table width="100%" border=0 cellspacing=0 cellpadding=0 class="tblComment" >
<?php if((is_array($TPL_R2=$TPL_V1["comment_nickname"])&&!empty($TPL_R2)) || (is_object($TPL_R2) && in_array("Countable", class_implements($TPL_R2)) && $TPL_R2->count() > 0)) {$TPL_I2=-1;foreach($TPL_R2 as $TPL_V2){$TPL_I2++;?>
							<tr>
								<td class="td1"><b><?php echo $TPL_V1["comment_nickname"][$TPL_I2]?></b>님</td>
								<td class="td2"><?php echo $TPL_V1["comment_memo"][$TPL_I2]?></td>
							</tr>
<?php }}?>								 
						</table>
					</div>
				</div>		
			</div>		
<?php }}?>
<?php }?>