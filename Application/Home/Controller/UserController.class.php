<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
	public function login($username=null, $password=null, $level=3){
	   if(IS_POST){
	        if(empty($_POST['username'])) {
                $this->error('帐号错误！');
            }elseif (empty($_POST['password'])){
                $this->error('密码必须！');
            }
                        
            $user = M("user"); // 实例化User对象
            $condition['username'] = $username;
            $condition['password'] = $password;
            $condition['level'] = array('elt',$level);
            // $condition['level'] = $level;
            // 把查询条件传入查询方法
            $cur=$user->where($condition)->select();
            
            //var_dump($cur[0]); 
            
            if ($cur[0]['username'] == $username and $cur[0]['password'] == $password) {
                $_SESSION['userid'] =  md5($username);
                $_SESSION['level'] =  $level;
                //var_dump($_SESSION['userid'] );
                //var_dump($_SESSION['level'] ) ;
		            if ($_SESSION['level'] == 1)
		                //$this->show("enter main page with admin");
		                redirect('/Admin/Index/index',1, 'jump to admin main page');
		            elseif ($_SESSION['level'] == 2)
		                redirect('/Develop/Index/index',1, 'jump to product main page');
		            else 
		                redirect('/Service/Index/index',1, 'jump to service main page');
            }else{
                $this->display();
            }
        }else{
            $this->display();
        }
    }
    public function logout(){
            $_SESSION['userid'] =  null;
            $this->display(T('User/login'));
            //$this->success('退出', '/User/login', 3);
        }
	public function register($username='null', $password='null', $email=null, $phone=null, $level=3){
	    if(IS_POST){
            if(empty($_POST['username'])) {
                $this->error('帐号错误！');
            }elseif (empty($_POST['password'])){
                $this->error('密码必须！');
            }elseif (empty($_POST['email'])){
                $this->error('邮箱必须！');
            }elseif (empty($_POST['phone'])){
                $this->error('电话必须！');
            }elseif (empty($_POST['level'])){
                $this->error('级别必须！');
            }
            
            $user = M("user"); // 实例化User对象
            $reg['username'] = $username;
            $reg['password'] = $password;
            $reg['email'] = $email;
            $reg['phone'] = $phone;
            $reg['level'] = $level;
            $result= $user->add($reg);
            
            if($result){
                $_SESSION['userid'] =  md5($username);
                $_SESSION['level'] =  $level;
            
            if ($_SESSION['level'] == 1)
                //$this->show("enter main page with admin");
                redirect('/Admin/Index/index',1, 'jump to admin main page');
            elseif ($_SESSION['level'] == 2)
                redirect('/Develop/Index/index',1, 'jump to product main page');
            else 
                redirect('/Service/Index/index',1, 'jump to service main page');
            }
            else{
                $this->display();
            }
        }
        else{
            $this->display();
        }
    }
}