<?php


namespace Wechat\Model;


use Think\Model;

class RepairModel extends Model
{
    /* 自动验证规则 */
    protected $_validate = array(
        array('name', 'require', '姓名必填'),
        array('tel', '/^1[34578]\d{9}$/', '电话不合法'),
        array('address', 'require', '地址必填'),
        array('question', 'require', '问题必填'),
        array('description', 'require', '内容必填'),
    );
    /* 自动完成规则 */
    protected $_auto = array(
        array('create_time', NOW_TIME, self::MODEL_INSERT),
        array('status', 0, self::MODEL_INSERT),

    );
}