
<script type="text/javascript">
$(document).ready(function(){
	$('#control2').show();
	$('#c2').html('<?php echo $html->link('增加',array('controller'=>'MmMembers','action'=>'add'),array('class'=>'button')).'<br />'; ?><a href="#" id="filter" class="button">筛选</a>');
	
	$('#filters').hide();
	$('#filter').click(function(){
		$('#filters').slideToggle('fast');	
	});
	
});
</script>

<?php

$group = $this->Session->read('Auth.MmMember.group');

echo '<fieldset><legend>查看</legend>';

?>

<div id="filters">

<?php
echo $form->create('MmMember');
echo '<table>';
echo '<tr>';
if($group=='admin' || $group=='superAdmin')
	echo '<td>'.$form->input('group',array('label'=>'用户组：','empty'=>'无','options'=>array('clerk'=>'干事','minister'=>'部长','admin'=>'常委/总监'))).'</td>';
echo '<td>'.$form->input('num',array('label'=>'学号：')).'</td>';
echo '<td>'.$form->input('name',array('label'=>'姓名：')).'</td>';
echo '<td>'.$form->input('sex',array('label'=>'性别：','options'=>array('女','男'),'empty'=>'无')).'</td>';
echo '</tr>';
echo '<tr>';
echo '<td>'.$form->input('mm_department_id',array('label'=>'部门：','empty'=>'无','default'=>$this->Session->read('Auth.MmMember.mm_department_id'))).'</td>';
echo '<td>'.$form->input('dormitory',array('label'=>'宿舍：')).'</td>';
echo '<td>'.$form->input('college',array('label'=>'学院：','empty'=>'无','options'=>array(
                    "机械与汽车工程学院"=>"机械与汽车工程学院",
                    "建筑学院"=>"建筑学院",
                    "土木与交通学院"=>"土木与交通学院",
                    "电子与信息学院"=>"电子与信息学院",
                    "材料科学与工程学院"=>"材料科学与工程学院",
                    "化学与化工学院"=>"化学与化工学院",
                    "轻工与食品学院"=>"轻工与食品学院",
                    "理学院"=>"理学院",
                    "经济与贸易学院"=>"经济与贸易学院",
                    "自动化科学与工程学院"=>"自动化科学与工程学院",
                    "计算机科学与工程学院"=>"计算机科学与工程学院",
                    "电力学院"=>"电力学院",
                    "生物科学与工程学院"=>"生物科学与工程学院",
                    "环境科学与工程学院"=>"环境科学与工程学院",
                    "软件学院"=>"软件学院",
                    "工商管理学院"=>"工商管理学院",
                    "公共管理学院"=>"公共管理学院", 
                    "外国语学院"=>"外国语学院",
                    "法学院"=>"法学院",
                    "知识产权学院"=>"知识产权学院",
                    "新闻与传播学院"=>"新闻与传播学院",
                    "艺术学院"=>"艺术学院",
                    "体育学院"=>"体育学院",
                    "设计学院"=>"设计学院"
))).'</td>';
echo '</tr>';
echo '</table>';
echo $form->end('查询');
?>
</div>

<table>
<tr> 
<th><?php echo $paginator->sort('姓名', 'name'); ?></th> 
<th><?php echo $paginator->sort('性别', 'sex'); ?></th> 
<th><?php echo $paginator->sort('手机', 'mobile'); ?></th> 
<th><?php echo $paginator->sort('qq', 'qq'); ?></th> 
<th><?php echo $paginator->sort('email', 'email'); ?></th> 
<th><?php echo $paginator->sort('出生日期', 'birth'); ?></th> 
<th><?php echo $paginator->sort('学院', 'college'); ?></th> 
<th><?php echo $paginator->sort('部门', 'birth'); ?></th> 
</tr> 
<?php foreach ($members as $member):?>
<tr>
<td><?php echo $member['MmMember']['name']; ?></td>
<td><?php echo ($member['MmMember']['sex'])?'男':'女'; ?></td>
<td><?php echo $member['MmMember']['mobile']; ?></td>
<td><?php echo $member['MmMember']['qq']; ?></td>
<td><?php echo $member['MmMember']['email']; ?></td>
<td><?php echo $member['MmMember']['birth']; ?></td>
<td><?php echo $member['MmMember']['college']; ?></td>
<td><?php echo $member['MmDepartment']['name']; ?></td>
<?php if($group=='admin' || $group=='superAdmin' || $group=='minister'){ ?>
<td><?php echo $html->link('详情',array('controller'=>'MmMembers','action'=>'detail',$member['MmMember']['id'])); ?></td>
<td><?php echo $html->link('编辑',array('controller'=>'MmMembers','action'=>'edit',$member['MmMember']['id'])); ?></td>
<td><?php echo $html->link('删除',array('controller'=>'MmMembers','action'=>'delete',$member['MmMember']['id']),null,"确认删除吗？"); ?></td>
<?php } ?>
</tr>
<?php endforeach;?>
</table>

<?php 
echo $paginator->prev('上一页 ', null, null, array('class' => 'disabled'));
echo $paginator->next('下一页 ', null, null, array('class' => 'disabled'));
echo $paginator->counter(array(
    'format' => '第 %page% 页，共 %pages% 页。显示当前 %current% 人，共有 %count% 人。本页显示第 %start% 人到第 %end% 人。'
));

echo '</fieldset>';

?>

