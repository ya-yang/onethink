<?php


namespace Wechat\Controller;


use Think\Controller;

class SaleController extends Controller
{
    public function index(){
        //出租
        $sales = M('Sale')->where(['type'=>1])->order('id asc')->select();
        //出售
        $sale_shou = M('Sale')->where(['type'=>2])->order('id asc')->select();
        $this->assign('sales',$sales);// 赋值数据集
        $this->assign('sale_shou',$sale_shou);// 赋值数据集
        $this->display();
    }
    public function detail($id){
        $sale = M('Sale')->find($id);;
        $this->assign('sale',$sale);// 赋值数据集
        $this->display();
    }
}