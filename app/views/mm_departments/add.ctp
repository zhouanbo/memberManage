<script type="text/javascript">
$(document).ready(function(){
	$('#control2').show();
	$('#c2').html('<?php echo $html->link('返回',array('controller'=>'MmDepartments','action'=>'index'),array('class'=>'button')); ?>');
});
</script>

<?php

echo '<fieldset><legend>增加</legend>';

echo $form->create();

echo $form->input('name',array('label'=>'部门名称：'));

echo $form->input('intro',array('label'=>'介绍：'));

echo $form->input('message',array('label'=>'通知：'));

echo $form->end('提交');

?>