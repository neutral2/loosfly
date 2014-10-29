	var detail_max = 0;
	var detail_num = 1;//Math.floor(Math.random() * detail_max)+1;
	po_left = new Array();
	var detail_width = 1040;
	var int;

	$(document).ready(function() {	
		detail_max = $('.detailimg_box > div').length;	
		
		for( i = 0; i < detail_max; i++ ) {
			detail_div = '#detail_div'+(i+1);
			w = detail_width*(i - detail_num + 1);
			$(detail_div).css('left',w + 'px');
			po_left[i] = parseFloat($(detail_div).css('left'));
		}
		
		if( detail_max > 1 ) {	
			$('.btn_detailR').bind('click', function() {
				if(!$('*').is(':animated')){
					detail_div = '#detail_div'+detail_num;
					detail_dt = detail_div + '>dl>dt';
					$(detail_dt).css({'visibility':'hidden'});

					detail_num++;
					if(detail_num > detail_max){
						detail_num = 1;
					}
		
					detail_div = '#detail_div'+detail_num;
					$(detail_div).css({'left':'1040px'});
					detail_dt = detail_div + '>dl>dt';
					$(detail_dt).css({'visibility':'hidden'});
					for( i = 0; i < detail_max; i++ ) {
						po_left[i] += -detail_width;
						if(po_left[i] < -detail_width*(detail_max-1)) { po_left[i] = 0; }
						detail_div = '#detail_div'+(i+1);
						$(detail_div).animate({left:po_left[i] + 'px'}, 1000, function() {
							$(detail_dt).css({'visibility':'visible'});
						});
					}				
				}
				return false;
			});
		
			$('.btn_detailL').bind('click', function() {
				if(!$('*').is(':animated')){
					detail_div = '#detail_div'+detail_num;
					detail_dt = detail_div + '>dl>dt';
					$(detail_dt).css({'visibility':'hidden'});

					detail_num--;
					if(detail_num < 1){
						detail_num = detail_max;
					}
		
					detail_div = '#detail_div'+detail_num;
					$(detail_div).css({'left':'-1040px'});
					detail_dt = detail_div + '>dl>dt';
					$(detail_dt).css({'visibility':'hidden'});
					for( i = 0; i < detail_max; i++ ) {
						po_left[i] += detail_width;
						if(po_left[i] > detail_width*(detail_max-1)) { po_left[i] = 0; }
						detail_div = '#detail_div'+(i+1);
						$(detail_div).animate({'left':po_left[i] + 'px'}, 1000, function() {
							$(detail_dt).css({'visibility':'visible'});
						});
					}
				}
				return false;
			});
		}
	});
