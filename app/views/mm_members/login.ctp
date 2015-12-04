<script type="text/javascript">

$(document).ready(function(){
		$('#control').hide();
		$('#show').css('width',1000);
		$('#show fieldset').css('width',900);
		$('#show').css('float','none');
		$('#show').css('margin','auto');
});
</script>

<?php

echo '<fieldset><legend>登录</legend>';

echo $form->create();

echo $form->input('num',array('label'=>'学号：'));

echo $form->input('password',array('label'=>'密码：'));

echo $form->end('登录');

echo '</fieldset>';

?>