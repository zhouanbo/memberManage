<script type="text/javascript">
$(document).ready(function(){
	$('#control2').show();
	$('#c2').html('<?php

echo $html->link('基本资料',array('controller'=>'MmMembers','action'=>'personal_edit'),array('class'=>'button')).'<br />';

echo $html->link('相片',array('controller'=>'MmMembers','action'=>'personal_pic'),array('class'=>'button')).'<br />';

echo $html->link('密码',array('controller'=>'MmMembers','action'=>'personal_pwd'),array('class'=>'button'));

?>');
});
</script>

<?php

echo '<fieldset><legend>基本</legend>';

echo $form->create();

echo $form->input('name',array('label'=>'姓名：'));

echo $form->input('sex',array('label'=>'性别：','options'=>array('女','男')));

echo $form->input('birth',array('type'=>'date','minYear'=>'1970','maxYear'=>'2000','label'=>'出生年月：'));

echo $form->input('dormitory',array('label'=>'宿舍：'));

echo $form->input('room',array('label'=>'房间：'));

echo $form->input('college',array('label'=>'学院：'));

echo $form->input('major',array('label'=>'专业：'));

echo $form->input('class',array('label'=>'班级：'));

echo $form->input('politics',array('label'=>'政治面貌：'));

echo $form->input('origo',array('label'=>'籍贯：'));

echo $form->input('mobile',array('label'=>'手机：'));

echo $form->input('qq',array('label'=>'qq：'));

echo $form->input('email',array('label'=>'email：'));

echo $form->end('提交');

echo '</fieldset>';

?>