<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function _empty($name){
        //�����г��еĲ���������city����
         $this->display(T('Index/help'));
    }
    public function index(){
        if (empty($_SESSION['userid']))
            $this->display(T('User/login'));
        else{
            if ($_SESSION['level'] == 1)
                $this->show("enter main page with admin");
            elseif ($_SESSION['level'] == 2)
                $this->show("enter main page with develop");
            else 
                $this->show("enter main page with service");
        }
                  
    }
}