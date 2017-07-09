<?php


namespace Admin\Controller;

/**
 * Class CenterController
 * @package Admin\Controller
 * 报修管理
 */
class CenterController extends AdminController
{
    //首页
    public function index(){
        /* 获取列表 */
        $list = M('Repair')->order('id asc')->select();
        $count=count($list);
        $Page=new \Think\Page($count,10);
        $show       = $Page->show();
        $list=array_slice($list,$Page->firstRow,$Page->listRows);
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
    //详情页
    public function detail($id){
        $info = M('Repair')->field(true)->find($id);
        if(!$info){
            $this->error('没有');
        }
        $this->assign('info', $info);
        $this->display();
    }
    //处理
    public function deal($id){
        $repair = D('Repair');
        $data = D('Repair')->where(['id'=>$id])->select();
        if ($data) {
            $data['status']=1;
            $res = D('Repair')->where(['id'=>$id])->data($data)->save();
            if($res){
                $this->success('更新成功',U('index'));
            } else {
                $this->error('更新失败');
            }
        }else {
            $this->error($repair->getError());
        }
    }


}