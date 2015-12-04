<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset('utf-8'); ?>
	<title>
		<?php __('百步梯人员管理系统'); ?>
		<?php //echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		//echo $this->Html->css('cake.generic');
		
		echo $this->Html->css('style');
		
		//echo $this->Html->script('prototype');
		
		echo $this->Html->script('jquery-1.4.2');

		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<?php echo $html->image('header.jpg'); ?>
		</div>
        
		<div id="content">
        	<?php echo $this->Session->flash('auth'); ?>
        	<?php echo $this->Session->flash(); ?>
			<?php $group = $this->Session->read('Auth.MmMember.group'); ?>
			<div id='control'>		
			<?php	
			echo '<fieldset><legend>主选单</legend>';
			echo $html->link('首页',array('controller'=>'mm_members','action'=>'index'),array('class'=>'button')).'<br />';	
			echo $html->link('成员',array('controller'=>'mm_members','action'=>'view'),array('class'=>'button')).'<br />';		
			echo $html->link('部门',array('controller'=>'MmDepartments'),array('class'=>'button')).'<br />';	
			echo $html->link('个人',array('controller'=>'MmMembers','action'=>'personal'),array('class'=>'button')).'<br />';
			if ( $group == 'superAdmin' ||  $group == 'admin' || $group == 'minister')
			echo $html->link('回收站',array('controller'=>'MmMembers','action'=>'recycle'),array('class'=>'button')).'<br />';	
			echo '</fieldset>';
			?>
            <script>
			$(document).ready(function(){
				$('#control2').hide();
			});
			</script>
            	<div id='control2'>
            	<fieldset><legend>次选单</legend>
            		<div id='c2'>
            		</div>
            	</fieldset>
            	</div>
			</div> 

            <div id='show'>
			<?php echo $content_for_layout; ?>
            </div>
		</div>
		<div id="footer">
			<?php echo $html->image('bottom.jpg'); ?>
		</div>
	</div>
</body>
</html>