<?php
class MmMember extends AppModel{
	var $name='MmMember';
	var $belongsTo=array('MmDepartment');
	
	var $validate = array(
		'name'=>array(
			'maxLength'=>array(
				'rule'=>array('maxLength',8),
				'message'=>'用户名超长。'
			),
			'required'=>array(
				'rule'=>'notEmpty',
				'on' => 'create',
				'message'=>'用户名必须填写。'
			)
		),
		'sex'=>array(
			'boolean'=>array(
				'rule'=>'boolean',
				'message'=>'性别不是布尔值。'
			),
			'required'=>array(
				'rule'=>'notEmpty',
				'on' => 'create',
				'message'=>'性别必须填写。'
			)
		),
		'num'=>array(
			'unique'=>array(
				'rule'=>'isUnique',
				'message'=>'学号必须是唯一的。'
			),
			'between'=>array(
				'rule'=>array('between',12,12),
				'message'=>'学号必须是12位数。'
			),
			'required'=>array(
				'rule'=>'notEmpty',
				'on' => 'create',
				'message'=>'学号必须填写。'
			)
		),
		'password'=>array(
			'alphaNumeric'=>array(
				'rule'=>'alphaNumeric',
				'message'=>'密码只能包含英文和数字。'
			),
			'required'=>array(
				'rule'=>'notEmpty',
				'on' => 'create',
				'message'=>'密码必须填写。'
			)
		),
		'dormitory'=>array(
			'required'=>array(
				'rule'=>'notEmpty',
				'on' => 'create',
				'message'=>'宿舍必须填写。'
			)
		),
		'room'=>array(
			'numeric'=>array(
				'rule'=>'numeric',
				'message'=>'房间输入错误。'
			),
			'between'=>array(
				'rule'=>array('between',3,3),
				'message'=>'房间输入错误。'
			),
			'required'=>array(
				'rule'=>'notEmpty',
				'on' => 'create',
				'message'=>'房间必须填写。'
			)
		),
		'college'=>array(
			'maxLength'=>array(
				'rule'=>array('maxLength',40),
				'message'=>'您没有选择学院。'
			),
			'required'=>array(
				'rule'=>'notEmpty',
				'on' => 'create',
				'message'=>'学院必须填写。'
			)
		),
		'grade'=>array(
			'maxLength'=>array(
				'rule'=>array('maxLength',5),
				'message'=>'年级超长。'
			),
			'required'=>array(
				'rule'=>'notEmpty',
				'on' => 'create',
				'message'=>'年级必须填写。'
			)
		),
		'major'=>array(
			'maxLength'=>array(
				'rule'=>array('maxLength',40),
				'message'=>'您没有选择专业。'
			),
			'required'=>array(
				'rule'=>'notEmpty',
				'on' => 'create',
				'message'=>'专业必须填写。'
			)
		),
		'class'=>array(
			'required'=>array(
				'rule'=>'notEmpty',
				'on' => 'create',
				'message'=>'班级必须填写。'
			)
		),	
		'nation'=>array(
			'maxLength'=>array(
				'rule'=>array('maxLength',8),
				'message'=>'民族超长。'
			),
			'required'=>array(
				'rule'=>'notEmpty',
				'on' => 'create',
				'message'=>'民族必须填写。'
			)
		),
		'origo'=>array(
			'maxLength'=>array(
				'rule'=>array('maxLength',8),
				'message'=>'籍贯超长。'
			),
			'required'=>array(
				'rule'=>'notEmpty',
				'on' => 'create',
				'message'=>'籍贯必须填写。'
			)
		),
		'mobile'=>array(
			'numeric'=>array(
				'rule'=>'numeric',
				'message'=>'手机只能是数字。'
			),
			'required'=>array(
				'rule'=>'notEmpty',
				'on' => 'create',
				'message'=>'手机必须填写。'
			)
		),
		'email'=>array(
			'email'=>array(
				'rule'=>'email',
				'message'=>'email格式不正确。'
			),
			'required'=>array(
				'rule'=>'notEmpty',
				'on' => 'create',
				'message'=>'email必须填写。'
			)
		)
	);
	
}

?>