<?php


namespace Admin\Controller;


class SaleController extends AdminController
{
    //列表
    public function index(){
        /* 获取频道列表 */
        $list = M('Sale')->order('id asc')->select();

        $this->assign('list', $list);
        $this->display();
    }
    //新增
    public function add()
    {
        if (IS_POST) {
            $sale = D('Sale');
            $data = $sale->create();
            if ($data) {
                $sale->end_time=strtotime($sale->end_time);
                $id = $sale->add();
                if ($id) {
                    $this->success('新增成功',U('index'));
                } else {
                    $this->error('新增失败');
                }
            }
        }
            $this->display();

    }
    //修改
    public function edit($id)
    {
        if (IS_POST) {
            $sale = D('Sale');
            $data = $sale->create();
            if ($data) {
                if($sale->save()!== false){
                    $this->success('更新成功',U('index'));
                } else {
                    $this->error('更新失败');
                }
            }else {
                $this->error($sale->getError());
            }
        }
        $info = M('Sale')->field(true)->find($id);
        if(false === $info){
            $this->error('没有');
        }
        $this->assign('info', $info);
        $this->display('add');

    }
    //删除
    public function del()
    {
        $id = array_unique((array)I('id',0));
        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }
        $map = array('id' => array('in', $id) );
        if(M('Sale')->where($map)->delete()){
            $this->success('删除成功',U('index'));
        } else {
            $this->error('删除失败！');
        }

    }

}