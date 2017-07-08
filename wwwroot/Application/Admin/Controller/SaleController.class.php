<?php


namespace Admin\Controller;


class SaleController extends AdminController
{
    //列表
    public function index(){
        /* 获取列表 */
        $list = M('Sale')->order('id asc')->select();
        $count=count($list);
        $Page=new \Think\Page($count,4);
        $show       = $Page->show();
        $list=array_slice($list,$Page->firstRow,$Page->listRows);
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
    //新增
    public function add()
    {
        if (IS_POST) {
            $sale = D('Sale');
            $data = $sale->create();
            if ($data) {
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



    //上传类
    public function uploadify(){
        if (!empty($_FILES)) {
            import("@.Think.UploadFile");
            $upload = new \Think\Upload();
            $upload->rootPath  = './Uploads/images/';//根路径
            $upload->savePath = date('Y-m-d').'/';//子路径，文件夹自动分级好点，不然文件太多了数量大了以后不好找图片
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg', 'bmp', 'doc', 'xls', 'mp4', 'avi', 'docx', 'xlsx');//可以上传的文件类型
            $upload->autoSub = false;
            $upload->saveRule = uniqid; //上传规则，文件名会自动重新获取，这样保证文件不会被覆盖
            $info = $upload->upload();
            if(!$info){
                echo $this->error($upload->getError());//获取失败信息
            } else {
                //成功
                $fileArray = "";
                foreach ($info as $file) {
                    //返回文件在服务器上的路径
                    $fileArray =$file['savepath'] . $file['savename'];

                }
                echo trim($fileArray);
            }
        }
    }

}