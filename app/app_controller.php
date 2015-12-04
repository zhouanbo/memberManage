<?php class AppController extends Controller {                    
              
	var $components = array('Auth','Session','Cookie');

	function beforeFilter(){

		$this->Cookie->name = 'memberManage';
		$this->Cookie->time =  3600;
		$this->Cookie->path = '/memberManage/filterHistory/'; 
		$this->Cookie->domain = '100steps.net';   
		$this->Cookie->secure = true;
 		$this->Cookie->key = 'asdfIOAWE*(EW';

		$this->Auth->userModel = 'MmMember';
		$this->Auth->fields = array('username'=>'num','password'=>'password');
		$this->Auth->loginRedirect = array('controller' => 'MmMembers', 'action' => 'index');
		$this->Auth->logoutRedirect = array('controller' => 'MmMembers', 'action' => 'index');
		$this->Auth->userScope = array('MmMember.active' => 1);
		$this->Auth->loginError = "登录失败。";
		$this->Auth->authError = "内容被禁止。";

		$this->Auth->allow('apply','enter','see','see_login','flash_xml','home','wap','wap_intro','wap_apply','wap_see','wap_seelogin');
	}
		
	function login(){
		
	}
	
	function logout(){
		$this->Session->destroy();
		$this->redirect($this->Auth->logout());
	}
}
?>