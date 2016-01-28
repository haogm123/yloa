<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<link rel="stylesheet" type="text/css" href="template/default/content/css/style.css">
<script language="javascript" type="text/javascript" src="template/default/js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="DatePicker/WdatePicker.js"></script>
<script type="text/javascript"> 
filenumber_show()
function filenumber_show()
{
   jQuery.ajax({
      type: 'GET',
      url: 'admin.php?ac=file&fileurl=public&officeid=<?php echo $_GET['fileid']?>&officetype=2&'+new Date(),
      success: function(data){
		  if(data!=''){
			  $("#filenumber").html(data);
		  }else{
			  $("#filenumber").html('还没有附件!');
		  }
      }
   });
}
fileoffice_show()
function fileoffice_show()
{
   jQuery.ajax({
      type: 'GET',
      url: 'admin.php?ac=file&do=office&fileurl=public&officeid=<?php echo $_GET['fileid']?>&officetype=2&'+new Date(),
      success: function(data){
		  if(data!=''){
			  $("#filenumberoffice").html(data);
		  }else{
			  $("#filenumberoffice").html('还没有文档!');
		  }
      }
   });
}
</script>
<title>OA办公系统</title>
 
</head>
<body class="bodycolor">
<table width="90%" border="0" align="center" cellpadding="3" cellspacing="0" class="small">
  <tr>
    <td class="Big"><img src="template/default/content/images/notify_new.gif" align="absmiddle"><span class="big3"> <?php echo $row['title']?></span>&nbsp;&nbsp;&nbsp;&nbsp;
	<span style="font-size:12px; float:right; margin-right:20px;">
	<a href="admin.php?ac=<?php echo $ac?>&fileurl=<?php echo $fileurl?>&type=2" style="font-size:12px;"><< 返回监控列表</a>&nbsp;|&nbsp;<a href="#" onClick="window.open('admin.php?ac=<?php echo $ac?>&fileurl=<?php echo $fileurl?>&do=appflow&fileid=<?php echo $_GET['fileid']?>&apptype=<?php echo $apptype?>&test=<?php echo $filenumber?>', 'newwindow', 'height=550, width=500, top=6, right=0, toolbar=no, menubar=no, scrollbars=yes, resizable=no,location=no, status=no')"><font color="red">查看审批记录</font>
</a></span>
    </td>
  </tr>
</table>

<script Language="JavaScript"> 
function CheckForm()
{   //判断缮印人是否选择
   if(document.save.zd_repairs.value==""){
	 alert("未选择指定缮印人");
     document.save.zd_repairs.focus();
     return (false);
	   }
   if(document.save.fileid.value=="")
   { alert("ID不能为空！");
     document.save.fileid.focus();
     return (false);
   }
   return true;
}
function sendForm()
{
   if(CheckForm())
      document.save.submit();
}
function toggle(targetid){
     if (document.getElementById){
         target=document.getElementById(targetid);
             if (target.style.display=="block"){
                 target.style.display="none";
             } else {
                 target.style.display="none";
             }
     }
}
function toggle2(targetid){
     if (document.getElementById){
         target=document.getElementById(targetid);
             if (target.style.display=="none"){
                 target.style.display="block";
             } else {
                 target.style.display="block";
             }
     }
}
</script>
<style type="text/css"> 
#div1{
display:none;}
</style>
<form name="save" method="post" action="admin.php?ac=<?php echo $ac?>&do=mana&fileurl=<?php echo $fileurl?>&apptype=<?php echo $apptype?>">
	<input type="hidden" name="view" value="edit" />
	<input type="hidden" name="fileid" value="<?php echo $row['id']?>" />
	<input type="hidden" name="perid" value="<?php echo $per['id']?>" />
<table class="TableBlock" border="0" width="90%" align="center">
	<tr>
      <td nowrap class="TableHeader" colspan="2"><b>&nbsp;监控操作</b></td>
    </tr>
	<tr>
      <td nowrap class="TableContent"> 操作类型：</td>
      <td class="TableData">
	  <input name="pkey" type="radio" style="border:0;" value="1" onClick="toggle2('div1')" />
	  变更审批人员
	  <input name="pkey" type="radio" style="border:0;" value="2" checked="checked" onClick="toggle('div1')"/>结束流程
	  </td>
    </tr>
	<span id="div1">
	<tr>
      <td nowrap class="TableContent"> 节点动作设定：</td>
      <td class="TableData">
	  <?php
		  $nodeid=explode(',',$nodeid);
		  $nodename=explode(',',$nodename);
		  for($i=0;$i<sizeof($nodeid);$i++){
			 echo '<input name="node" type="radio" value="'.$nodeid[$i].'" ';
			 if(trim($i)==1){
			    echo ' checked="checked"';
			 }
			 echo ' style="border:0;" />'.$nodename[$i];
		  }
	  ?>
	  </td>
    </tr>
	<tr>
      <td nowrap class="TableContent"> 下一步审批人员：</td>
      <td class="TableData">
	  <?php get_pubuser(2,"staff",$per['name'],"+选择审批人员",40,4);?>
	  </td>
    </tr><tr>
      <td nowrap class="TableContent"> 办结时间：</td>
      <td class="TableData">
	  <input style="width:172px;" class="inputdate" type="text" value="<? echo($row['end_time']); ?>" name="end_time" readonly="readonly" onclick="WdatePicker();">
	  <?php 
	  
	  ?>
	  </td>
    </tr>
	<tr>
      <td nowrap class="TableContent"> 指定缮印人：</td>
      <td class="TableData">
              <select name="zd_repairs" >
				<option value="">指定缮印人</option>
                <option <? if($row['zd_repairs']=="冷雪丽"){echo "selected";}?> value="冷雪丽">冷雪丽</option>
                <option <? if($row['zd_repairs']=="吴朗"){echo "selected";}?> value="吴朗">吴朗</option>
              </select>
	  </td>
    </tr>
	</span>
	<tr align="center" class="TableControl">
      <td colspan="2" nowrap height="35">
<input type="button" name="Submit" value="提 交" class="BigButtonBHover" onclick="sendForm();"> 	  </td>
    </tr>
</table>

</form>

</body>
</html>
