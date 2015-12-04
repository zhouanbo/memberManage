<?php
class MmDepartmentsController extends AppController{
	
	var $name='MmDepartments';
	var $helpers = array('Html','Form','Ajax','Javascript');
	
	function beforeFilter(){
		parent::beforeFilter();
	}
	
	function index(){
		if ($this->Auth->user('group') == 'superAdmin' || $this->Auth->user('group') =='admin'){
			$departments=$this->MmDepartment->find('all');
		}else{
			$departments=$this->MmDepartment->findById($this->Auth->user('mm_department_id'));
		}
		$this->set(compact('departments'));

	}
	
	function add(){
		if ($this->Auth->user('group') != 'superAdmin' && $this->Auth->user('group') !='admin'){
			$this->Session->setFlash('内容被禁止。');
			$this->redirect(array('controller'=>'MmDepartment','action'=>'index'));
			exit();
		}
		
		if(!empty($this->data)) {
			if($this->MmDepartment->save($this->data)){
				$this->Session->setFlash("已添加。");
			}else{
				$this->Session->setFlash("出现错误！");
			}
			$this->redirect(array('controller'=>'MmDepartments','action'=>'index'));
		}
	}
	
	function edit($id){

		if(!empty($this->data)) {
			if ($this->Auth->user('group') == 'superAdmin' || $this->Auth->user('group') =='admin'){
				$this->MmDepartment->id=$id;
				if($this->MmDepartment->save($this->data)){
					$this->Session->setFlash("已修改。");
				}else{
					$this->Session->setFlash("出现错误！");
				}
				$this->redirect(array('controller'=>'MmDepartments','action'=>'index'));
			}else if ($this->Auth->user('group') == 'minister'){
				$this->MmDepartment->id=$this->Auth->user('mm_department_id');
				if($this->MmDepartment->save($this->data)){
					$this->Session->setFlash("已修改。");
				}else{
					$this->Session->setFlash("出现错误！");
				}
				$this->redirect(array('controller'=>'MmDepartments','action'=>'index'));
			}else{
				$this->Session->setFlash('权限不足。');
				$this->redirect(array('controller'=>'MmDepartment','action'=>'index'));
				exit();
			}
		}
				
		$this->data=$this->MmDepartment->findById($id);
	}
	
	function delete($id){
		if ($this->Auth->user('group') != 'superAdmin' && $this->Auth->user('group') !='admin'){
			$this->Session->setFlash('权限不足。');
			$this->redirect(array('controller'=>'MmDepartment','action'=>'index'));
			exit();
		}
		
		$units=$this->MmDepartment->MmUnit->find('count');
		if($units!=0){
			$this->Session->setFlash('该部门下还有工作组，无法删除。');
			$this->redirect(array('controller'=>'MmDepartment','action'=>'index'));
			exit();
		}else{
			if($this->MmDepartment->delete($id,false)){
				$this->Session->setFlash("已删除。");
			}else{
				$this->Session->setFlash("出现错误！");
			}
		}
		$this->redirect(array('controller'=>'MmDepartments','action'=>'index'));
	}
	
}