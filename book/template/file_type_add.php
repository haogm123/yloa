<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<link rel="stylesheet" type="text/css" href="template/default/content/css/style.css">
<script language="javascript" type="text/javascript" src="DatePicker/WdatePicker.js"></script>
<script src="template/default/tree/js/admincp.js?SES" type="text/javascript"></script>
<script charset="utf-8" src="eweb/kindeditor.js"></script>

<title>Office 515158 2011 OA办公系统</title>
 
</head>
<body>
<table width="90%" border="0" align="center" cellpadding="3" cellspacing="0" class="small">
  <tr>
    <td class="Big"><img src="template/default/content/images/notify_new.gif" align="absmiddle"><span class="big3"> 图书类别发布</span>&nbsp;&nbsp;&nbsp;&nbsp;
	<span style="font-size:12px;">
	
	<a href="admin.php?ac=file_type&fileurl=<?php echo $fileurl?>" style="font-size:12px;">返回列表页</a><img src="template/default/content/images/f_ico.png" align="absmiddle"></span>
    </td>
  </tr>
</table>
<script Language="JavaScript"> 
function CheckForm()
{
   if(document.save.title.value=="")
   { alert("栏目名称不能为空！");
     document.save.title.focus();
     return (false);
   }
   if(document.save.keyuser.value=="")
   { alert("图书审批人员不能为空！");
     document.save.keyuser.focus();
     return (false);
   }
   return true;
}
function sendForm()
{
   if(CheckForm())
      document.save.submit();
}
</script>
<form name="save" method="post" action="?ac=file_type_add&do=save&fileurl=book">
	<input type="hidden" name="savetype" value="add" />
<table class="TableBlock" border="0" width="90%" align="center" style="border-bottom:#4686c6 solid 0px;">

    <tr>
      <td nowrap class="TableData" width="15%"> 栏目名称：<? get_helps()?></td>
      <td class="TableData">
	  <input maxlength="88" class="BigInput" style="width: 264px;" type="text" name="title" id="title" />
       	</td>
    </tr>
	   <tr>
      <td nowrap class="TableData" width="15%"> 图书审批人员：<? get_helps()?></td>
      <td class="TableData">
			<?php
	  get_pubuser(2,"keyuser","","+选择审批人员",60,4)
	  ?>
       	</td>
    </tr>
    <tr>
      <td nowrap class="TableData"> 选择上级栏目：</td>
      <td class="TableData">
<select class="BigStatic" name="father">
										<option value="0" >顶级栏目</option>
										<?php GET_FILE_PUBLIC_LIST()?>
										</select>
      </td>
    </tr>
	
	
 
    <tr align="center" class="TableControl">
      <td colspan="2" nowrap height="35">

		<input type="button" value="保存" class="BigButtonBHover" onClick="sendForm();"> 
        
      </td>
    </tr>
  </table>
</form>
</div>
</div>
 
 
</body>
</html>
