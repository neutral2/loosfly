// JavaScript Document

	var cat_max = 0;
	var cat_num = 1;//Math.floor(Math.random() * cat_max)+1;
	po_left = new Array();
	var cat_width = 860;
	var rolling_int = 8000;
	var int;

	forth = function() {
		if(!$('*').is(':animated')){
			cat_num++;

			if(cat_num > cat_max){
				cat_num = 1;
			}
	
			cat_div = '#cat_div'+cat_num;
			$(cat_div).css({left:'860px'});
			for( i = 0; i < cat_max; i++ ) {
				po_left[i] += -cat_width;
				if(po_left[i] < -cat_width*(cat_max-1)) { po_left[i] = 0; }
				cat_div = '#cat_div'+(i+1);
				$(cat_div).animate({left:po_left[i] + 'px'}, 1000);
				if( i == (cat_num - 1) ) {
					$('.bxCatNav ul li').eq(i).removeClass('current').addClass('current');
				}
				else {
					$('.bxCatNav ul li').eq(i).removeClass('current');
				}
			}
		}
		return false;
	};

	$(document).ready(function() {
		cat_max = $('.catimg_box > div').length;

		for( i = 0; i < cat_max; i++ ) {
			cat_div = '#cat_div'+(i+1);
			w = cat_width*(i - cat_num + 1);
			$(cat_div).css('left',w + 'px');
			po_left[i] = parseFloat($(cat_div).css('left'));
		}
		
		if( cat_max > 1 ) {
			int = setInterval('forth()', rolling_int);

			$('.btn_catR').bind('click', function() {
				if(!$('*').is(':animated')){
					cat_num++;
					if(cat_num > cat_max){
						cat_num = 1;
					}
		
					cat_div = '#cat_div'+cat_num;
					$(cat_div).css({'left':'860px'});
					for( i = 0; i < cat_max; i++ ) {
						po_left[i] += -cat_width;
						if(po_left[i] < -cat_width*(cat_max-1)) { po_left[i] = 0; }
						cat_div = '#cat_div'+(i+1);
						$(cat_div).animate({left:po_left[i] + 'px'}, 1000);
						if( i == (cat_num - 1) ) 
							$('.bxCatNav ul li').eq(i).removeClass('current').addClass('current');
						else
							$('.bxCatNav ul li').eq(i).removeClass('current');
					}
				}
				return false;
			});
		
			$('.btn_catL').bind('click', function() {
				if(!$('*').is(':animated')){
					cat_num--;
					if(cat_num < 1){
						cat_num = cat_max;
					}
		
					cat_div = '#cat_div'+cat_num;
					$(cat_div).css({'left':'-860px'});
					for( i = 0; i < cat_max; i++ ) {
						po_left[i] += cat_width;
						if(po_left[i] > cat_width*(cat_max-1)) { po_left[i] = 0; }
						cat_div = '#cat_div'+(i+1);
						$(cat_div).animate({'left':po_left[i] + 'px'}, 1000);
						if( i == (cat_num - 1) ) 
							$('.bxCatNav ul li').eq(i).removeClass('current').addClass('current');
						else
							$('.bxCatNav ul li').eq(i).removeClass('current');
					}
				}
				return false;
			});
		}
	

		/* 사이트 버튼 */
		$('.btn_catL').hover(function() {
			$(this).css({'filter':'alpha(opacity=100)'});
			$(this).css({'-ms-filter':'progid:DXImageTransForm.Microsoft.Alpha(Opacity=100)'});
			$(this).css({'opacity':'1'});
		}, function() {
			$(this).css({'filter':'alpha(opacity=20)'});
			$(this).css({'-ms-filter':'progid:DXImageTransForm.Microsoft.Alpha(Opacity=20)'});
			$(this).css({'opacity':'0.2'});
		});
		$('.btn_catR').hover(function() {
			$(this).css({'filter':'alpha(opacity=100)'});
			$(this).css({'-ms-filter':'progid:DXImageTransForm.Microsoft.Alpha(Opacity=100)'});
			$(this).css({'opacity':'1'});
		}, function() {
			$(this).css({'filter':'alpha(opacity=20)'});
			$(this).css({'-ms-filter':'progid:DXImageTransForm.Microsoft.Alpha(Opacity=20)'});
			$(this).css({'opacity':'0.2'});
		});

		$('.cat_div').hover(function() {
			$('.btn_catL').css({'filter':'alpha(opacity=50)'});
			$('.btn_catL').css({'-ms-filter':'progid:DXImageTransForm.Microsoft.Alpha(Opacity=50)'});
			$('.btn_catL').css({'opacity':'0.5'});
			$('.btn_catR').css({'filter':'alpha(opacity=50)'});
			$('.btn_catR').css({'-ms-filter':'progid:DXImageTransForm.Microsoft.Alpha(Opacity=50)'});
			$('.btn_catR').css({'opacity':'0.5'});
			clearInterval(int);
		}, function() {
			$('.btn_catL').css({'filter':'alpha(opacity=20)'});
			$('.btn_catL').css({'-ms-filter':'progid:DXImageTransForm.Microsoft.Alpha(Opacity=20)'});
			$('.btn_catL').css({'opacity':'0.2'});
			$('.btn_catR').css({'filter':'alpha(opacity=20)'});
			$('.btn_catR').css({'-ms-filter':'progid:DXImageTransForm.Microsoft.Alpha(Opacity=20)'});
			$('.btn_catR').css({'opacity':'0.2'});
			if( cat_max > 1 ) {
				clearInterval(int);
				int = setInterval('forth()', rolling_int);
			}
		});

		$('.bxCatNav ul li').hover(function() {
			clearInterval(int);
		}, function() {
			if( cat_max > 1 ) {
				clearInterval(int);
				int = setInterval('forth()', rolling_int);
			}
		});
	});

	goto_pic = function(location) {
		for( i = 1; i <= cat_max; i++ ) {
			cat_div = '#cat_div'+i;
			po_left[i-1] = 860*(i -location);
			$(cat_div).css({'left':po_left[i-1]+'px'});
			if( i == location ) 
				$('.bxCatNav ul li').eq(i-1).removeClass('current').addClass('current');
			else
				$('.bxCatNav ul li').eq(i-1).removeClass('current');
		}
		cat_num = location;
	};