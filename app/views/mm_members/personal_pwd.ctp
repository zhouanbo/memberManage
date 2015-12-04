<script type="text/javascript">
$(document).ready(function(){
	$('#control2').show();
$('#c2').html('<?php

echo $html->link('基本资料',array('controller'=>'MmMembers','action'=>'personal_edit'),array('class'=>'button')).'<br />';

echo $html->link('相片',array('controller'=>'MmMembers','action'=>'personal_pic'),array('class'=>'button')).'<br />';

echo $html->link('密码',array('controller'=>'MmMembers','action'=>'personal_pwd'),array('class'=>'button'));

?>');});
</script>

<?php

echo '<fieldset><legend>密码</legend>';

echo $form->create();

echo $form->input('old_password',array('type'=>'password','label'=>'原密码：'));

echo $form->input('new_password',array('type'=>'password','label'=>'新密码：'));

echo $form->input('confirm_password',array('type'=>'password','label'=>'确认新密码：'));

echo $form->end('提交');

echo '</fieldset>';

?>