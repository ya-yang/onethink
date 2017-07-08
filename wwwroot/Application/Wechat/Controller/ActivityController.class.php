<?php


namespace Wechat\Controller;


use Think\Controller;

class ActivityController extends Controller
{
    public function index($p = 1){
        $activities = D('Document  as  a')->Field('a.* ,b.path')->join('Picture as b  on b.id = a.cover_id')->where(['a.category_id'=>41,'a.status'=>1])->select();
        $count=count($activities);
        $PageSize=2;
        $page=$p;
        $start=($page-1)*$PageSize;
        $activities=array_slice($activities,$start,$PageSize);
        if(IS_AJAX){
            if($activities == null){
                $this->ajaxReturn(null);
            }
            $this->ajaxReturn($activities);
        }
        $this->assign('activities',$activities);// 赋值数据集
        $this->display();
    }
    public function detail($id){
//        $notice = M('Document')->find($id);
        $activity = M('Member  as  a')->join('document as b  on b.uid = a.uid')->where('b.id  = '.$id)->select();
//        dump($notice);die;
        $activity_article = M('DocumentArticle')->find($id);;
        $this->assign('activity',$activity);// 赋值数据集
        $this->assign('activity_article',$activity_article);// 赋值数据集
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