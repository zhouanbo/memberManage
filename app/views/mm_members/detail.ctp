<script type="text/javascript">
$(document).ready(function(){
	$('#control2').show();
	$('#c2').html('<?php echo $html->link('返回',array('controller'=>'MmMembers','action'=>'view'),array('class'=>'button')); ?>');
});
</script>

<fieldset><legend>详情</legend>

<?php 
$group = $this->Session->read('Auth.MmMember.group');
?>

<table>
<tr><td><?php echo '学号'; ?></td><td><?php echo $members['MmMember']['num']; ?></td></tr>
<tr><td><?php echo '姓名'; ?></td><td><?php echo $members['MmMember']['name']; ?></td></tr>
<tr><td><?php echo '性别'; ?></td><td><?php echo ($members['MmMember']['sex'])?'男':'女'; ?></td></tr>
<tr><td><?php echo '籍贯'; ?></td><td> <?php echo $members['MmMember']['origo']; ?></td></tr>
<tr><td><?php echo '民族'; ?></td><td><?php echo $members['MmMember']['nation']; ?></td></tr>
<tr><td><?php echo '政治面貌'; ?></td><td><?php echo $members['MmMember']['politics']; ?></td></tr>
<tr><td><?php echo '职位'; ?></td><td><?php echo figureOutGroup($members['MmMember']['group']); ?></td></tr>
<tr><td><?php echo '照片'; ?></td><td><?php if(isset($members['MmMember']['pic'])){echo $html->image($members['MmMember']['pic']);}else{echo "未上传照片";} ?></td></tr>
<tr><td><?php echo '部门'; ?></td><td><?php echo $members['MmDepartment']['name']; ?></td></tr>
<tr><td><?php echo '手机'; ?></td><td><?php echo $members['MmMember']['mobile']; ?></td></tr>
<tr><td><?php echo '短号'; ?></td><td><?php echo $members['MmMember']['shortMobile']; ?></td></tr>
<tr><td><?php echo 'qq'; ?></td><td><?php echo $members['MmMember']['qq']; ?></td></tr>
<tr><td><?php echo '微博'; ?></td><td><?php echo $members['MmMember']['weibo']; ?></td></tr>
<tr><td><?php echo 'email'; ?></td><td><?php echo $members['MmMember']['email']; ?></td></tr>
<tr><td><?php echo '宿舍'; ?></td><td><?php echo $members['MmMember']['dormitory'].'-'.$members['MmMember']['room']; ?></td></tr>

<tr><td><?php echo '出生日期'; ?></td><td><?php echo $members['MmMember']['birth']; ?></td></tr>
<tr><td><?php echo '年级'; ?></td><td><?php echo $members['MmMember']['grade']; ?></td></tr>
<tr><td><?php echo '学院'; ?></td><td><?php echo $members['MmMember']['college'].'-'.$members['MmMember']['major'].'-'.$members['MmMember']['class'].'班'; ?></td></tr>

<tr><td><?php echo '评价'; ?></td><td><?php echo $members['MmMember']['remark']; ?></td></tr>
</table>

</fieldset>

<?php
function figureOutGroup($group){
	if($group=="clerk"){
		return "干事";
	}
	if($group=="minister"){
		return "部长";
	}
	if($group=="admin"){
		return "常委/总监";
	}
	if($group=="superAdmin"){
		return "超级管理员";
	}
}
?>