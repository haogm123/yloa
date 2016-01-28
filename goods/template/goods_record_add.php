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
    <td class="Big"><img src="template/default/content/images/notify_new.gif" align="absmiddle"><span class="big3"> 办公用品领用</span>&nbsp;&nbsp;&nbsp;&nbsp;
	<span style="font-size:12px;">
	
	<a href="admin.php?ac=goods_record&fileurl=<?php echo $fileurl?>" style="font-size:12px;">返回列表页</a><img src="template/default/content/images/f_ico.png" align="absmiddle"></span>
    </td>
  </tr>
</table>
<form name="save" method="post" action="?ac=goods_record_add&do=save&fileurl=goods">
	<input type="hidden" name="savetype" value="edit" />
	<input type="hidden" name="id" value="<?php echo $blog['id']?>" />
<table class="TableBlock" border="0" width="90%" align="center" style="border-bottom:#4686c6 solid 0px;">
    <tr>
      <td nowrap class="TableContent" width="15%"> 分类：</td>
      <td class="TableData">
	  <input type="hidden" name="goods_type" value="<?php echo $blog['goods_type']?>" />
        <?php echo get_reallists($blog['goods_type'])?>	</td>
    </tr>
    <tr>
      <td nowrap class="TableContent"> 编号：</td>
      <td class="TableData"><input type="hidden" name="number" value="<?php echo $blog['number']?>" />
<?php echo $blog['number']?></td>
    </tr>
	<tr>
      <td nowrap class="TableContent"> 名称：</td>
      <td class="TableData">
	  <input type="hidden" name="title" value="<?php echo $blog['title']?>" />
<?php echo $blog['title']?> </td>
    </tr>
	<tr>
      <td nowrap class="TableContent"> 规格：</td>
      <td class="TableData">
	  <input type="hidden" name="specification" value="<?php echo $blog['specification']?>" />
<?php echo $blog['specification']?></td>
    </tr>
	<tr>
      <td nowrap class="TableContent"> 单位：</td>
      <td class="TableData">
	  <input type="hidden" name="unit" value="<?php echo $blog['unit']?>" /><?php echo $blog['unit']?></td>
    </tr>
	<tr>
      <td nowrap class="TableContent"> 单价：</td>
      <td class="TableData">
	  <input type="hidden" name="price" value="<?php echo $blog['price']?>" />
<?php echo $blog['price']?>/元  </td>
    </tr>

	<tr>
      <td nowrap class="TableHeader" colspan="2"><b>&nbsp;领用信息</b></td>
    </tr>
	<tr>
      <td nowrap class="TableContent"> 领用部门：</td>
      <td class="TableData">
<select class="SelectStyle" name="department">
											<option value="0" ></option>
											<?php get_realdepalist(0,0)?>
										</select></td>
    </tr>
	
	<tr>
      <td nowrap class="TableContent"> 领用人：</td>
      <td class="TableData">
	  <?php
	  get_pubuser(1,"recorduser",get_realname($_USER->id),"+选择领用人",80,20)
	  ?>
	 </td>
    </tr>
	
	<tr>
      <td nowrap class="TableContent"> 领用数量：</td>
      <td class="TableData"><input name="recordnum" type="text" class="BigInput" id="recordnum" value="1"  style="width: 50px;" onKeyUp="value=value.replace(/[^0-9]/g,'');" />/<?php echo $blog['unit']?></td>
    </tr>
	
	<tr>
      <td nowrap class="TableContent"> 备注：</td>
      <td class="TableData">
<textarea name="content" cols="70" rows="5" class="BigInput"><?php echo $blog['content']?></textarea></td>
    </tr>
	
 
    <tr align="center" class="TableControl">
      <td colspan="2" nowrap height="35">

		<input type="submit" name="Submit" value="保存信息" class="BigButton">      </td>
    </tr>
  </table>
</form>
</body>
</html>
