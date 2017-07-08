<?php


namespace Wechat\Controller;


use Think\Controller;
use EasyWeChat\Foundation\Application;


class WchatController extends Controller
{
      public function _initialize()
      {
          vendor('autoload');
          $options = C('WX_CONFIG');
          $app = new Application($options);
          $response = $app->server->serve();
// 将响应输出
          $response->send(); // Laravel 里请使用：return $response;
      }
      public function index(){
            echo $_GET['echostr'];
      }
}