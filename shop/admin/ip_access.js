function cl_use() {
	document.getElementById('IP_list').disabled = false;
	document.getElementById('IP_regist').disabled = false;
	document.getElementById('class0').disabled = false;
	document.getElementById('class1').disabled = false;
	document.getElementById('class2').disabled = false;
	document.getElementById('class3').disabled = false;
	document.getElementById('b1').disabled = false;
	document.getElementById('b2').disabled = false;

	var j = document.getElementById("IP_list").childNodes.length;
	for(i=0; i<j; i++) {
		document.getElementById('bb'+i).disabled = false;
	}
}
function cl_none() {
	document.getElementById('IP_list').disabled = true;
	document.getElementById('IP_regist').disabled = true;
	document.getElementById('class0').disabled = true;
	document.getElementById('class1').disabled = true;
	document.getElementById('class2').disabled = true;
	document.getElementById('class3').disabled = true;
	document.getElementById('b1').disabled = true;
	document.getElementById('b2').disabled = true;

	var j = document.getElementById("IP_list").childNodes.length;
	for(i=0; i<j; i++) {
		document.getElementById('bb'+i).disabled = true;
	}

	//입력값 초기화
	document.getElementById('class0').value = "";
	document.getElementById('class1').value = "";
	document.getElementById('class2').value = "";
	document.getElementById('class3').value = "";
	document.getElementById('class4').value = "";
	document.getElementById('chkbox').checked = "";

}

function fnAdd(it, box) { //대역추가하기
	var vis = (box.checked) ? "block" : "none";
	document.getElementById(it).style.display = vis;
}

function onlyNumber(i){ //숫자만 입력 가능.
   if((event.keyCode<48)||(event.keyCode>57)) event.returnValue=false; //숫자만입력가능
   if(parseInt(i.value)>255) { 
	   alert("0~255 이내의 숫자만 입력이 가능합니다."); 
	   i.value = "";
	   i.focus();
	}
}

function fnApply(){
	var c0 = document.getElementsByName('accessIP')[0].value;
	var c1 = document.getElementsByName('accessIP')[1].value;
	var c2 = document.getElementsByName('accessIP')[2].value;
	var c3 = document.getElementsByName('accessIP')[3].value;

	document.getElementById('class0').value = c0;
	document.getElementById('class1').value = c1;
	document.getElementById('class2').value = c2;
	document.getElementById('class3').value = c3;
}

function fnRegist(){ 

  var Aclass = document.getElementById('class0').value;
  var Bclass = document.getElementById('class1').value;
  var Cclass = document.getElementById('class2').value;
  var Dclass = document.getElementById('class3').value;
  var Dclass_add = document.getElementById('class4').value;
  
  if(!Aclass || !Bclass || !Cclass) {
	  alert("정확한 IP를 입력해주세요");
	  if (!Aclass) {
		  document.getElementById('class0').focus();
	  } else if (!Bclass) {
		  document.getElementById('class1').focus();
	  } else if (!Cclass) {
		  document.getElementById('class2').focus();
	  }

	  return false;
  }  

  Aclass = Number(Aclass);
  Bclass = Number(Bclass);
  Cclass = Number(Cclass);

  if(!Dclass) {
	  Dclass = "0~255";
  } else {
	  Dclass = Number(Dclass);
  }

  Dclass_add = Number(Dclass_add);

  if(Dclass_add) {

	  if (eval(Dclass) > eval(Dclass_add)) {
		  alert("정확한 IP대역대를 입력해주세요");
		  document.getElementById('class4').value = "";
		  document.getElementById('class4').focus();
		  return false;
	  }
	  Dclass = Dclass+"~"+Dclass_add;
  }

  var registIP = Aclass+"."+Bclass+"."+Cclass+"."+Dclass;
  var i = document.getElementById("IP_list").childNodes.length;
  
  if (i > 9)
  {
	  alert("최대 10개까지만 등록이 가능 합니다.");
	  return;
  } 

  var div = document.createElement('div');
  div.id = "regip_"+i;
  div.style.padding = "4px 0px";
  div.innerHTML = "<span id='ip_addr_"+i+"' style='width:100px;'>"+registIP+"</span>&nbsp;&nbsp;&nbsp;<input type='hidden' id='regist_ip"+i+"' name='regist_ip[]' value='"+registIP+"' /><input type='image' src='../img/i_del.gif' id='bb"+i+"' onclick='javascript:delDIV("+i+");return false;' value='삭제' style='border:0;vertical-align:top;cursor:pointer;' />";

  document.getElementById('IP_list').appendChild(div);
} 

function delDIV(i){
	 var deldiv = document.getElementById("regip_"+i);
	 var deladdr = document.getElementById("ip_addr_"+i);
	 
	 deladdr.style.textDecoration = "line-through";
	 document.getElementById("regist_ip"+i).value="";
}
