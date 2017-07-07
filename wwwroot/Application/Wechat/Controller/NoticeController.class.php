<?php


namespace Wechat\Controller;


use Think\Controller;

class NoticeController extends Controller
{
    public function index(){
        $notices=D('Document')->where(['category_id'=>2,'status'=>1])->select();
        $this->assign('notices',$notices);
        $this->display();
    }
    public function detail($id){
        $notice = M('Document')->find($id);;
        $notice_article = M('DocumentArticle')->find($id);;
        $this->assign('notice',$notice);// 赋值数据集
        $this->assign('notice_article',$notice_article);// 赋值数据集
        $this->display();
    }

}