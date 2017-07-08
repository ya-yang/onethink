<?php


namespace Wechat\Controller;


use Think\Controller;

class NoticeController extends Controller
{
    public function index($p = 1){
        $notices = D('Document  as  a')->Field('a.* ,b.path')->join('Picture as b  on b.id = a.cover_id')->where(['a.category_id'=>2,'a.status'=>1])->select();
        $count=count($notices);
        $PageSize=2;
        $page=$p;
        $start=($page-1)*$PageSize;
        $notices=array_slice($notices,$start,$PageSize);
        if(IS_AJAX){
            if($notices == null){
                $this->ajaxReturn(null);
            }
            $this->ajaxReturn($notices);
        }
        $this->assign('notices',$notices);// 赋值数据集
        $this->display();
    }
    public function detail($id){
//        $notice = M('Document')->find($id);
        $notice = M('Member  as  a')->join('document as b  on b.uid = a.uid')->where('b.id  = '.$id)->select();
//        dump($notice);die;
        $notice_article = M('DocumentArticle')->find($id);;
        $this->assign('notice',$notice);// 赋值数据集
        $this->assign('notice_article',$notice_article);// 赋值数据集
        $this->display();
    }
    public function view($id)
    {
        if($id){
            $document=D('Document')->where(['id'=>$id])->select();
            $view=$document[0]['view'];
            $data['view']=$view+1;
            D('Document')->where(['id'=>$id])->data($data)->save();
        }
    }

}