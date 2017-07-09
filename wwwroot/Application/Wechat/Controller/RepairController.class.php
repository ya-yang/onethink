<?php


namespace Wechat\Controller;


use Think\Controller;

class RepairController extends Controller
{
    public function add(){
        if(IS_POST){
            $repair = D('Repair');
            $data = $repair->create();
            if ($data) {
                $data['order_id']=uniqid('order_');
                $id = $repair->data($data)->add();
                if ($id) {
                    $this->success('报修成功',U('Index/index'));
                } else {
                    $this->error('报修失败');
                }
            }else{
                $this->error($repair->getError());
            }
        }
        $this->display();
    }
}