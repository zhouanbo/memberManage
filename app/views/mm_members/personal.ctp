<fieldset><legend>个人</legend>
	<?php echo $this->Session->read('Auth.MmMember.name'); ?>
    ，欢迎进入个人选单，您可以在这里修改您的个人资料。<br /><br />
    <?php
    echo $html->link('基本资料',array('controller'=>'MmMembers','action'=>'personal_edit'),array('class'=>'button')).'<br />';

	echo $html->link('相片',array('controller'=>'MmMembers','action'=>'personal_pic'),array('class'=>'button')).'<br />';

	echo $html->link('密码',array('controller'=>'MmMembers','action'=>'personal_pwd'),array('class'=>'button'));
	?>
</fieldset>
