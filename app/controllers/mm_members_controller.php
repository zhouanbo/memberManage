<?php
class MmMembersController extends AppController{
	var $name='MmMembers';
	
	var $helpers = array('Html','Form','Ajax','Javascript');
	
	var $paginate = array(
        'limit' => 10,
    );


	
	function beforeFilter(){
		parent::beforeFilter();
	}
	
	function index(){
		$department=$this->MmMember->MmDepartment->findById($this->Session->read('Auth.MmMember.mm_department_id'));
		$this->set(compact('department'));
	}
	
	function add(){
		
		$group=$this->Auth->user('group');
		if( $group != 'admin' && $group != 'superAdmin' && $group != 'minister'){
			$this->Session->setFlash("权限不足。");
			$this->redirect(array('controller'=>'MmMembers','action'=>'view'));
			exit();
		}
		
		if(!empty($this->data)) {

			//hash password.
			if($this->data['MmMember']['password']!=$this->Auth->password($this->data['MmMember']['confirm_password'])){
				$this->Session->setFlash("确认密码不一致。");
				$this->redirect(array('controller'=>'MmMembers','action'=>'add'));
				exit();
			}
			
			//image upload.
			if (is_uploaded_file($this->data['MmMember']['file']['tmp_name'])) {		
				move_uploaded_file($this->data['MmMember']['file']['tmp_name'], 'img/members_pic/'.$this->data['MmMember']['num'].'.jpg');
				$this->data['MmMember']['pic']='members_pic/'.$this->data['MmMember']['num'].'.jpg';
			}
			
			//submit to database.
			if($this->MmMember->save($this->data)){
				$this->Session->setFlash("已提交。");
			}else{
				$this->Session->setFlash("出现错误！");
			}
		}
		
		$mmDepartments=$this->MmMember->MmDepartment->find('list');
		$this->set(compact('mmDepartments'));

	}
	
	function view(){
		
		$group=$this->Auth->user('group');

		$this->Session->write('group','');

		if(!empty($this->data)){
			(isset($this->data['MmMember']['group']))?
			$this->Session->write('group',$this->data['MmMember']['group']):
			$this->Session->write('group','%%');
			
			(isset($this->data['MmMember']['mm_department_id']))?
			$this->Session->write('mm_department_id',$this->data['MmMember']['mm_department_id']):
			$this->Session->write('mm_department_id',-1);
			
			(isset($this->data['MmMember']['sex']))?
			$this->Session->write('sex',$this->data['MmMember']['sex']):
			$this->Session->write('sex','%%');
			
			(isset($this->data['MmMember']['name']))?
			$this->Session->write('name',$this->data['MmMember']['name']):
			$this->Session->write('name','%%');
			
			(isset($this->data['MmMember']['num']))?
			$this->Session->write('num',$this->data['MmMember']['num']):
			$this->Session->write('num','%%');
			
			(isset($this->data['MmMember']['dormitory']))?
			$this->Session->write('dormitory',$this->data['MmMember']['dormitory']):
			$this->Session->write('dormitory','%%');
			
			(isset($this->data['MmMember']['college']))?
			$this->Session->write('college',$this->data['MmMember']['college']):
			$this->Session->write('college','%%');
			
		}
			(!$this->Session->check('mm_department_id'))?
			$this->Session->write('mm_department_id',$this->data['MmMember']['mm_department_id']):
			null;
	
		$members = $this->paginate('MmMember',array(
			  '`MmMember`.`active`' => 1, 		  
			  '`MmMember`.`group` LIKE' => '%'.$this->Session->read('group').'%',
			  '`MmMember`.`mm_department_id` BETWEEN ? AND ?' => array(
		$this->Session->read('mm_department_id')>0?$this->Session->read('mm_department_id'):0,
		$this->Session->read('mm_department_id')>0?$this->Session->read('mm_department_id'):1000000,
		),
			  '`MmMember`.`sex` LIKE' => '%'.$this->Session->read('sex').'%',
			  '`MmMember`.`name` LIKE' => '%'.$this->Session->read('name').'%',
			  '`MmMember`.`num` LIKE' => '%'.$this->Session->read('num').'%',
			  '`MmMember`.`dormitory` LIKE' => '%'.$this->Session->read('dormitory').'%',
			  '`MmMember`.`college` LIKE' => '%'.$this->Session->read('college').'%',
		  ));
		
		$this->set(compact('members'));
		$this->set('mmDepartments', $this->MmMember->MmDepartment->find('list'));
		
	}
	
	function edit($id){
		
		$target=$this->MmMember->findById($id);
		$group=$this->Auth->user('group');
		if($group!='admin' && $group!='superAdmin' && ( $group != 'minister' || $target['MmMember']['mm_department_id'] != $this->Auth->user('mm_department_id' ) ) ){
			$this->Session->setFlash("权限不足。");
			$this->redirect(array('controller'=>'MmMembers','action'=>'view'));
			exit();
		}
		
		if(!empty($this->data)) {
			
			$this->MmMember->id=$id;
			$this->Session->setFlash($id);
			if( $group != 'superAdmin' && $this->data['MmMember']['mm_department_id']!=$target['MmMember']['mm_department_id']){
				$this->data['MmMember']['mm_department_id']=$target['MmMember']['mm_department_id'];
				$this->Session->setFlash("部长不能修改部门。");
				$this->redirect(array('controller'=>'MmMembers','action'=>'edit'),$id);
				exit();
			}	
			
			if($this->MmMember->save($this->data)){
				$this->Session->setFlash("已修改。");
			}else{
				$this->Session->setFlash("出现错误！");
			}
			$this->redirect(array('controller'=>'MmMembers','action'=>'view'));
		}
		
		$mmDepartments=$this->MmMember->MmDepartment->find('list');
		$this->set(compact('mmDepartments'));
		$this->data=$this->MmMember->findById($id);
	}
	
		function detail($id){
		
		$members = $this->MmMember->findById($id);
		
		$group=$this->Auth->user('group');
		if($group!='admin' && $group!='superAdmin' && ( $group != 'minister' || $members['MmMember']['mm_department_id'] != $this->Auth->user('mm_department_id' ) ) ){
			$this->Session->setFlash("权限不足。");
			$this->redirect(array('controller'=>'MmMembers','action'=>'view'));
			exit();
		}
		
		$this->set(compact('members'));
	}
	
	function delete($id){
		
		$target=$this->MmMember->findById($id);
		$group=$this->Auth->user('group');
		if($group!='admin' && $group!='superAdmin' && ( $group != 'minister' || $target['MmMember']['mm_department_id'] != $this->Auth->user('mm_department_id' ) ) ){
			$this->Session->setFlash("权限不足。");
			$this->redirect(array('controller'=>'MmMembers','action'=>'recycle'));
			exit();
		}
		
		$this->MmMember->id=$id;
		$this->data['MmMember']['active']=0;
		if($this->MmMember->save($this->data)){
			$this->Session->setFlash("已删除。");
		}else{
			$this->Session->setFlash("出现错误！");
		}
		$this->redirect(array('controller'=>'MmMembers','action'=>'view'));
	}
	
	function recycle(){
		
		$group=$this->Auth->user('group');
		if($group!='admin' && $group!='superAdmin' && $group != 'minister' ){
			$this->Session->setFlash("权限不足。");
			$this->redirect(array('controller'=>'MmMembers','action'=>'recycle'));
			exit();
		}
		
		$this->Session->write('group','');
		$this->Session->write('mm_department_id',$this->Auth->user('mm_department_id'));

		if(!empty($this->data)){
			
			(isset($this->data['MmMember']['group']))?
			$this->Session->write('group',$this->data['MmMember']['group']):
			$this->Session->write('group','');
			
			(isset($this->data['MmMember']['sex']))?
			$this->Session->write('sex',$this->data['MmMember']['sex']):
			$this->Session->write('sex','');
			
			(isset($this->data['MmMember']['name']))?
			$this->Session->write('name',$this->data['MmMember']['name']):
			$this->Session->write('name','');
			
			(isset($this->data['MmMember']['mm_department_id']))?
			$this->Session->write('mm_department_id',$this->data['MmMember']['mm_department_id']):
			null;
			
			(isset($this->data['MmMember']['num']))?
			$this->Session->write('num',$this->data['MmMember']['num']):
			$this->Session->write('num','');
			
			(isset($this->data['MmMember']['dormitory']))?
			$this->Session->write('dormitory',$this->data['MmMember']['dormitory']):
			$this->Session->write('dormitory','');
			
			(isset($this->data['MmMember']['college']))?
			$this->Session->write('college',$this->data['MmMember']['college']):
			$this->Session->write('college','');
		}
	
		$members = $this->paginate('MmMember',array(
			  '`MmMember`.`active`' => 0, 		  
			  '`MmMember`.`group` LIKE' => '%'.$this->Session->read('group').'%',
			  '`MmMember`.`mm_department_id` BETWEEN ? AND ?' => array(
		$this->Session->read('mm_department_id')>0?$this->Session->read('mm_department_id'):0,
		$this->Session->read('mm_department_id')>0?$this->Session->read('mm_department_id'):1000000,
		),
			  '`MmMember`.`sex` LIKE' => '%'.$this->Session->read('sex').'%',
			  '`MmMember`.`name` LIKE' => '%'.$this->Session->read('name').'%',
			  '`MmMember`.`num` LIKE' => '%'.$this->Session->read('num').'%',
			  '`MmMember`.`dormitory` LIKE' => '%'.$this->Session->read('dormitory').'%',
			  '`MmMember`.`college` LIKE' => '%'.$this->Session->read('college').'%',
		  ));
		
		$this->set(compact('members'));
		$this->set('mmDepartments', $this->MmMember->MmDepartment->find('list'));
		
	}
	
	function recover($id){
		$target=$this->MmMember->findById($id);
		$group=$this->Auth->user('group');
		if($group!='admin' && $group!='superAdmin' && ( $group != 'minister' || $target['MmMember']['mm_department_id'] != $this->Auth->user('mm_department_id' ) ) ){
			$this->Session->setFlash("权限不足。");
			$this->redirect(array('controller'=>'MmMembers','action'=>'recycle'));
			exit();
		}
		
		$this->MmMembers->id=$id;
		$this->data['MmMember']['active']=1;
		if($this->MmMember->save($this->data)){
			$this->Session->setFlash("已恢复。");
		}else{
			$this->Session->setFlash("出现错误！");
		}
		$this->redirect(array('controller'=>'MmMembers','action'=>'recycle'));
	}
	
	function clear($id){
		$target=$this->MmMember->findById($id);
		$group=$this->Auth->user('group');
		if($group!='admin' && $group!='superAdmin' && ( $group != 'minister' || $target['MmMember']['mm_department_id'] != $this->Auth->user('mm_department_id' ) ) ){
			$this->Session->setFlash("权限不足。");
			$this->redirect(array('controller'=>'MmMembers','action'=>'recycle'));
			exit();
		}
		
		$this->MmMembers->id=$id;
		if($this->MmMember->delete($this->data)){
			$this->Session->setFlash("已彻底删除。");
		}else{
			$this->Session->setFlash("出现错误！");
		}
		$this->redirect(array('controller'=>'MmMembers','action'=>'recycle'));
	}
	
	function personal(){
		
	}
	
	function personal_edit(){
		
		$id=$this->Auth->user('id');
		
		if(!empty($this->data)) {
			$this->MmMember->id=$id;
			if($this->MmMember->save($this->data)){
				$this->Session->setFlash("已修改。");
			}else{
				$this->Session->setFlash("出现错误！");
			}
			$this->redirect(array('controller'=>'MmMembers','action'=>'view'));
		}
		
		$this->data=$this->MmMember->findById($id);
	}
	
	function personal_pic(){
		
		$num=$this->Auth->user('num');
		
		if(!empty($this->data)) {
			if (is_uploaded_file($this->data['MmMember']['file']['tmp_name'])) {	
				unlink('img/members_pic/'.$num.'.jpg');	
				move_uploaded_file($this->data['MmMember']['file']['tmp_name'], 'img/members_pic/'.$num.'.jpg');
				$this->data['MmMember']['pic']='members_pic/'.$num.'.jpg';
				$this->Session->setFlash("图片上传成功。");
			}else{
				$this->Session->setFlash("图片上传失败。");
			}
		}
		
		$pic=$this->MmMember->findByNum($num);
		$this->set(compact('pic'));
		
	}
	
	function personal_pwd(){
		
		$id=$this->Auth->user('id');
		
		if(!empty($this->data)) {
			$this->MmMember->id=$id;
			$password=$this->MmMember->findById($id);
			if($this->Auth->password($this->data['MmMember']['old_password'])==$password['MmMember']['password']){
				if($this->data['MmMember']['new_password']==$this->data['MmMember']['confirm_password']){
					$this->data['MmMember']['password']=$this->Auth->password($this->data['MmMember']['new_password']);
					$this->MmMember->save($this->data);
					$this->Session->setFlash("密码修改成功。");
				}else{
					$this->Session->setFlash("确认密码不一致。");
				}
			}else{
				$this->Session->setFlash("密码错误。");
			}
		}
		
	}
	
}