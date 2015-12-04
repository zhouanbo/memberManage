
<fieldset><legend>首页</legend>

<?php 

echo '<span class="button">您好，'.$this->Session->read('Auth.MmMember.name').' </span>';

echo $html->link('登出',array('controller'=>'MmMembers','action'=>'logout'),array('class'=>'button')).'<br /><br />';

echo '部门：'.$department['MmDepartment']['name'].' <br />';

echo '用户组：'.$this->Session->read('Auth.MmMember.group').' <br />';

echo '学院：'.$this->Session->read('Auth.MmMember.college').' <br />';

echo '注册时间：'.$this->Session->read('Auth.MmMember.created').' <br />';

echo '<br /><br />';

?>

</fieldset>