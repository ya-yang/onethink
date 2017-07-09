<?php


namespace Wechat\Controller;


use Think\Controller;

/**
 * Class ShopController
 * @package Wechat\Controller
 * 小区周围店铺商家活动信息的公布。
    1.添加商家活动信息
    2.设置活动的起始时间，过期后自动删除
    3.活动的编辑、发布/未发布、删除
    4.未发布的不能在前台显示
    5.实现ajax分页
 */
class ShopController extends Controller
{
    public function index($p = 1){

        $shops = D('Document  as  a')->Field('a.* ,b.path')->join('Picture as b  on b.id = a.cover_id')->where(['a.category_id'=>40,'a.status'=>1])->select();
        $count=count($shops);
        $PageSize=2;
        $page=$p;
        $start=($page-1)*$PageSize;
        $shops=array_slice($shops,$start,$PageSize);
        if(IS_AJAX){
            if($shops == null){
                $this->ajaxReturn(null);
            }
            $this->ajaxReturn($shops);
        }
        $this->assign('shops',$shops);// 赋值数据集
        $this->display();
    }
    public function detail($id){
//        $notice = M('Document')->find($id);
        $shop = M('Member  as  a')->join('document as b  on b.uid = a.uid')->where('b.id  = '.$id)->select();
//        dump($notice);die;
        $shop_article = M('DocumentArticle')->find($id);;
        $this->assign('shop',$shop);// 赋值数据集
        $this->assign('shop_article',$shop_article);// 赋值数据集
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