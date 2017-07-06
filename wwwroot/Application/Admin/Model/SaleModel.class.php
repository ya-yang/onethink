<?php


namespace Admin\Model;


use Think\Model;

class SaleModel extends Model
{
    /* 自动验证规则 */
    protected $_validate = array(
        array('title', 'require', '标题必须填写'),
        array('tel', '/^1[3,4,5,7,8]\d{9}$/', '电话不合法'),
    );
    /* 自动完成规则 */
    protected $_auto = array(
        array('end_time',),
        array('create_time', NOW_TIME, self::MODEL_INSERT),
        array('status', '1', self::MODEL_INSERT),
    );

}