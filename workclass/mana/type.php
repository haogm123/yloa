<html>
<head>
<title>信息添加编辑</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="template/default/content/css/style.css">
<script language="javascript" type="text/javascript" src="DatePicker/WdatePicker.js"></script>
<script src="template/default/tree/js/admincp.js?SES" type="text/javascript"></script>
<script src="template/default/js/jquery-1.4.2.min.js" type="text/javascript"></script>

</head>
<body class="bodycolor">
<table width="90%" border="0" align="center" cellpadding="3" cellspacing="0" class="small">
  <tr>
    <td class="Big"><img src="template/default/content/images/notify_new.gif" align="absmiddle"><span class="big3"> 工作流类别管理</span>&nbsp;&nbsp;&nbsp;&nbsp;
	
    </td>
  </tr>
</table>
<script Language="JavaScript"> 
function CheckForm()
{
   if(document.save.title.value=="")
   { alert("主题不能为空！");
     document.save.title.focus();
     return (false);
   }
   
   return true;
}
function sendForm()
{
   if(CheckForm())
      document.save.submit();
}

var rowtypedata = [
	[ [5, '<div>名称：<input name="newname[]" type="text" class="BigInput" value="" size="40" />  <a href="javascript:;" style="font-size:12px;" onClick="deleterow(this)">删除此项</a></div>']],
];
</script>

<form name="save" method="post" action="?ac=<?php echo $ac?>&fileurl=<?php echo $fileurl?>">
	<input type="hidden" name="view" value="save" />
	 <table class="TableBlock" border="0" width="90%" align="center">
		<tr>
		<td width="60" align="center" nowrap class="TableHeader">排序</td>
		  <td nowrap class="TableHeader">名称</td>
			<td width="90" align="center" nowrap class="TableHeader">发布人</td>
			  <td width="60" align="center" class="TableHeader">操作</td>  	  	
		</tr>
<?foreach ($result as $row) {?>
	<input type="hidden" name="id[]" value="<?php echo $row['tid']?>" />	
		<tr>
		<td align="center" class="TableContent"><input name="typenum[<?php echo $row['tid']?>]" type="text" class="BigInput" value="<?php echo $row['typenum']?>" style="width:40px;" /></td>
		  <td nowrap class="TableData"><input name="name[<?php echo $row['tid']?>]" type="text" class="BigInput" value="<?php echo $row['typename']?>" size="40" /></td>
			<td align="center" nowrap class="TableData"><?php echo get_realname($row['uid'])?></td>
		  <td align="center" class="TableData">
		  <?php
		  $dnum=$db->result("SELECT COUNT(*) AS dnum FROM ".DB_TABLEPRE."workclass_template where typeid='".$row['tid']."'");
		  if($dnum<1){
		  ?>
<a href="admin.php?ac=<?php echo $ac?>&fileurl=<?php echo $fileurl?>&id=<?php echo $row['tid']?>" title="您确定要删除吗？删除类别将删除该类下的所有数据，包括己完成的工作流">删除</a>
		  <?php }?>		
		  
		   </td>	  	
		</tr>
<?}?>
<tr>
		  <td colspan="5" nowrap class="TableData">
		  
		  <table width="100%">
		   
	
				<tr><td colspan="7"><div><a href="#" onClick="addrow(this, 0)" class="addtr">+增加新项</a></div></td></tr>
			</table>
		  
		  
      </td>
	    </tr>
		<tr align="center" class="TableControl">
			<td colspan="5" nowrap>
			<input type="button" value="保存" class="BigButtonBHover" onClick="sendForm();">&nbsp;	    </td>
	  </tr>
	 </table>
  
</form>

 
</body>

</html>






















