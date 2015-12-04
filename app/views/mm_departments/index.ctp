<?php $group = $this->Session->read('Auth.MmMember.group'); ?>

<script type="text/javascript">
$(document).ready(function(){

	$('#c2').html('<?php if($group=='admin' || $group=='superAdmin'){ ?>
	$('#control2').show();
	 <?php echo $html->link('增加',array('controller'=>'MmDepartments','action'=>'add'),array('class'=>'button'));} ?>');
});
</script>
<fieldset><legend>部门</legend>
<?php if($group=='admin' || $group=='superAdmin'){ ?>
    <table>
    <tr> 
    <th>ID</th>
    <th>名称</th> 
    <th>部门介绍</th>
    <th>通知</th>  
    </tr> 
    <?php foreach ($departments as $department):?>
    <tr>
    <td><?php echo $department['MmDepartment']['id']; ?></td>
    <td><?php echo $department['MmDepartment']['name']; ?></td>
    <td><?php echo $department['MmDepartment']['intro']; ?></td>
    <td><?php echo $department['MmDepartment']['message']; ?></td>
    <td><?php echo $html->link('编辑',array('controller'=>'MmDepartments','action'=>'edit',$department['MmDepartment']['id'])); ?></td>
    <td><?php echo $html->link('删除',array('controller'=>'MmDepartments','action'=>'delete',$department['MmDepartment']['id']),null,"确认删除吗？"); ?></td>
    </tr>
    <?php endforeach;?>
    </table>
<?php }else if($group=='minister'){ ?>
		<table>
		<tr> 
    	<th>ID</th>
    	<th>名称</th> 
   		<th>部门介绍</th>
    	<th>通知</th>  
    	</tr> 
		<td><?php echo $departments['MmDepartment']['id']; ?></td>
   		<td><?php echo $departments['MmDepartment']['name']; ?></td>
    	<td><?php echo $departments['MmDepartment']['intro']; ?></td>
    	<td><?php echo $departments['MmDepartment']['message']; ?></td>
    	<td><?php echo $html->link('编辑',array('controller'=>'MmDepartments','action'=>'edit',$departments['MmDepartment']['id'])); ?></td>
        </table>
<?php }else{ ?>
		<table>
		<tr><td><?php echo '部门'; ?></td><td><?php echo $departments['MmDepartment']['name']; ?></td></tr>
		<tr><td><?php echo '通知'; ?></td><td><?php echo $departments['MmDepartment']['message']; ?></td></tr>
        </table>
<?php } ?>

</fieldset>