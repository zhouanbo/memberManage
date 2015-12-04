<?php
class MmDepartment extends AppModel{
	var $name='MmDepartment';
	var $hasMany=array('MmMember');
}

?>