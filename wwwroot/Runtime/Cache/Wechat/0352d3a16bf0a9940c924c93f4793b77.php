<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="/Public/Wechat/static/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/Public/Wechat/static/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .main{margin-bottom: 60px;}
        .indexLabel{padding: 10px 0; margin: 10px 0 0; color: #fff;}
    </style>
</head>
<body>
<div class="main">
    <!--导航部分-->
    <nav class="navbar navbar-default navbar-fixed-bottom">
        <div class="container-fluid text-center">
            <div class="col-xs-3">
                <p class="navbar-text"><a href="index.html" class="navbar-link">首页</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a href="#" class="navbar-link">服务</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a href="#" class="navbar-link">发现</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a href="#" class="navbar-link">我的</a></p>
            </div>
        </div>
    </nav>
    <!--导航结束-->

    <div class="container-fluid">
        <?php foreach($notices as $notice): ?>
        <div class="row noticeList">
            <a href="<?php echo U('Notice/detail?id='.$notice['id']);?>">
                <div class="col-xs-2">
                    <img class="noticeImg" src="<?php echo get_cover($notice['cover_id'],$field = path);?>
" />
                </div>
                <div class="col-xs-10">
                    <p class="title"><?php echo $notice['title'];?></p>
                    <p class="intro"><?php echo $notice['description'];?></p>
                    <p class="info">浏览: <?php echo $notice['view']?> <span class="pull-right"><?php echo date('Y-m-d H:i:s',$notice['update_time']); ?></span> </p>
                </div>
            </a>
        </div>
        <?php endforeach;?>
    </div>
</div>
<script src="/Public/Wechat/static/jquery-1.11.2.min.js"></script>
<script src="/Public/Wechat/static/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>