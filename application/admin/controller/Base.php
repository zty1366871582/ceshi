<?php
namespace app\admin\controller;
use think\App;
use think\facade\Session;
use think\Controller;
class Base extends Controller{
    public function __construct(App $app = null)
    {
        parent::__construct($app);
        if (!Session::has('username')){
            $this->redirect('Index/login');
        }
    }
}
