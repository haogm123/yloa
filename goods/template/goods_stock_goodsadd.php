<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<link rel="stylesheet" type="text/css" href="template/default/content/css/style.css">
<script language="javascript" type="text/javascript" src="DatePicker/WdatePicker.js"></script>
<script src="template/default/tree/js/admincp.js?SES" type="text/javascript"></script>
<script charset="utf-8" src="eweb/kindeditor.js"></script>

<title>OA办公系统</title>
 
</head>
<body>
<table width="90%" border="0" align="center" cellpadding="3" cellspacing="0" class="small">
  <tr>
    <td class="Big"><img src="template/default/content/images/notify_new.gif" align="absmiddle"><span class="big3"> 办公用品入库</span>&nbsp;&nbsp;&nbsp;&nbsp;
	<span style="font-size:12px;">
	
	<a href="admin.php?ac=goods_stock&fileurl=<?php echo $fileurl?>" style="font-size:12px;">返回列表页</a><img src="template/default/content/images/f_ico.png" align="absmiddle"></span>
    </td>
  </tr>
</table>
<form name="save" method="post" action="?ac=goods_stock_add&fileurl=goods">
<table class="TableBlock" border="0" width="90%" align="center" style="border-bottom:#4686c6 solid 0px;">
    <tr>
      <td width="15%" valign="top" nowrap class="TableContent"> 入库物品：</td>
      <td height="300" align="center" valign="top" class="TableData">
	  <div style="float:left; width:100%; background-color:#FFFFFF; border:1px solid #999999; height:260px;overflow:hidden;overflow-y:scroll;">
	  
	  <table width="95%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="6%" height="30" align="center" bgcolor="#CCCCCC">选项</td>
          <td width="49%" height="30" align="center" bgcolor="#CCCCCC">名称</td>
          <td width="21%" height="30" align="center" bgcolor="#CCCCCC">规格</td>
          <td width="11%" height="30" align="center" bgcolor="#CCCCCC">单位</td>
          <td width="13%" height="30" align="center" bgcolor="#CCCCCC">单价</td>
        </tr>
		<?foreach ($result as $row) {?>
        <tr>
          <td height="20" align="center"><input type="checkbox" name="id[]" value="<?php echo $row['id']?>" class="checkbox" /></td>
          <td height="20"><?php echo $row['title']?></td>
          <td height="20"><?php echo $row['specification']?></td>
          <td height="20"><?php echo $row['unit']?></td>
          <td height="20"><?php echo $row['price']?>RMB</td>
        </tr>
		<?}?>
        <tr>
          <td height="30" colspan="5"><?php echo showpage($num,$pagesize,$page,$url)?></td>
          </tr>
      </table>
	  </div>
	  
	  
	  </td>
    </tr>
   
 
    <tr align="center" class="TableControl">
      <td colspan="2" nowrap height="35">

		<input type="submit" name="Submit" value="确认选择" class="BigButton">      </td>
    </tr>
  </table>
</form>
 
</body>
</html>
