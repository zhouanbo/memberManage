<script type="text/javascript">
$(document).ready(function(){
	$('#control2').show();
	$('#c2').html('<?php echo $html->link('返回',array('controller'=>'MmMembers','action'=>'view'),array('class'=>'button')); ?>');
});
</script>


<?php

echo '<fieldset><legend>编辑</legend>';

echo $form->create();

echo $form->input('mm_department_id',array('label'=>'部门：','empty'=>'请选择'));

if($this->Session->read('Auth.MmMember.group')=='admin'){
echo $form->input('group',array('label'=>'用户组：','options'=>array('clerk'=>'干事','minister'=>'部长','admin'=>'管理员')));
}else if($this->Session->read('Auth.MmMember.group')=='superAdmin'){
echo $form->input('group',array('label'=>'用户组：','options'=>array('clerk'=>'干事','minister'=>'部长','admin'=>'管理员','superAdmin'=>'超级管理员')));
}else{
echo $form->input('group',array('label'=>'用户组：','options'=>array('clerk'=>'干事','minister'=>'部长')));
}

echo $form->input('remark',array('label'=>'评价：'));

echo $form->input('name',array('label'=>'姓名：'));

echo $form->input('sex',array('label'=>'性别：','options'=>array('女','男')));

echo $form->input('num',array('label'=>'学号：'));

echo $form->input('birth',array('type'=>'date','minYear'=>'1970','maxYear'=>'2000','label'=>'出生年月：'));

echo $form->input('dormitory',array('label'=>'宿舍：'));

echo $form->input('room',array('label'=>'房间：'));

echo $form->input('college',array('label'=>'学院：','empty'=>'请选择','options'=>array(
                    "机械与汽车工程学院"=>"机械与汽车工程学院",
                    "建筑学院"=>"建筑学院",
                    "土木与交通学院"=>"土木与交通学院",
                    "电子与信息学院"=>"电子与信息学院",
                    "材料科学与工程学院"=>"材料科学与工程学院",
                    "化学与化工学院"=>"化学与化工学院",
                    "轻工与食品学院"=>"轻工与食品学院",
                    "理学院"=>"理学院",
                    "经济与贸易学院"=>"经济与贸易学院",
                    "自动化科学与工程学院"=>"自动化科学与工程学院",
                    "计算机科学与工程学院"=>"计算机科学与工程学院",
                    "电力学院"=>"电力学院",
                    "生物科学与工程学院"=>"生物科学与工程学院",
                    "环境科学与工程学院"=>"环境科学与工程学院",
                    "软件学院"=>"软件学院",
                    "工商管理学院"=>"工商管理学院",
                    "公共管理学院"=>"公共管理学院", 
                    "外国语学院"=>"外国语学院",
                    "法学院"=>"法学院",
                    "知识产权学院"=>"知识产权学院",
                    "新闻与传播学院"=>"新闻与传播学院",
                    "艺术学院"=>"艺术学院",
                    "体育学院"=>"体育学院",
                    "设计学院"=>"设计学院"
)));

echo $form->input('grade',array('label'=>'年级：'));

echo $form->input('major',array('label'=>'专业：'));

echo $form->input('class',array('label'=>'班级：'));

echo $form->input('politics',array('label'=>'政治面貌：'));

echo $form->input('nation',array('label'=>'民族：'));

echo $form->input('origo',array('label'=>'籍贯：'));

echo $form->input('mobile',array('label'=>'手机：'));

echo $form->input('shortMobile',array('label'=>'短号：'));

echo $form->input('qq',array('label'=>'qq：'));

echo $form->input('weibo',array('label'=>'微博（请填写网址）：'));

echo $form->input('email',array('label'=>'email：'));

echo $form->end('提交');

echo '</fieldset>';

?>