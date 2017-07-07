<?php


namespace Admin\Model;


use Think\Model;

class SaleModel extends Model
{
    /* 自动验证规则 */
    protected $_validate = array(
        array('title', 'require', '标题必须填写'),
        array('name', 'require', '发布人必须填写'),
        array('price', 'require', '价格必须填写'),
        array('end_time', 'require', '截止时间必须填写'),
        array('description', 'require', '简单描述必须填写'),
        array('tel', '/^1[3,4,5,7,8]\d{9}$/', '电话不合法'),
    );
    /* 自动完成规则 */
    protected $_auto = array(
        array('create_time', NOW_TIME, self::MODEL_INSERT),
    );

}