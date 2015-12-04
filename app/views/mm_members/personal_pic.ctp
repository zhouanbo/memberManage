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

echo '<fieldset><legend>相片</legend>';

echo $html->image($pic['MmMember']['pic']."?".rand());

echo $form->create('MmMember',array('type'=>'file'));

echo $form->input('file',array('label'=>'新相片：','type'=>'file'));

echo $form->end('提交');

echo '</fieldset>';

?>