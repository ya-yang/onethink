<?php


namespace Wechat\Controller;


use Think\Controller;

class ServiceController extends Controller
{
    public function index($p = 1){
        $services = D('Document  as  a')->Field('a.* ,b.path')->join('Picture as b  on b.id = a.cover_id')->where(['a.category_id'=>39,'a.status'=>1])->select();
        $count=count($services);
        $PageSize=2;
        $page=$p;
        $start=($page-1)*$PageSize;
        $services=array_slice($services,$start,$PageSize);
        if(IS_AJAX){
            if($services == null){
                $this->ajaxReturn(null);
            }
            $this->ajaxReturn($services);
        }
        $this->assign('services',$services);// 赋值数据集
        $this->display();
    }
    public function detail($id){
        $service = M('Member  as  a')->join('document as b  on b.uid = a.uid')->where('b.id  = '.$id)->select();
//        dump($notice);die;
        $service_article = M('DocumentArticle')->find($id);;
        $this->assign('service',$service);// 赋值数据集
        $this->assign('service_article',$service_article);// 赋值数据集
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
