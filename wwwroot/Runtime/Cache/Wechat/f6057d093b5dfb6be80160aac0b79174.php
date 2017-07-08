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

    <div class="container-fluid" id="list">
        <?php foreach($shops as $shop): ?>
        <div class="row noticeList">
            <a class="detail_view" data-id="<?php echo $shop['id'];?>" href="<?php echo U('Shop/detail?id='.$shop['id']);?>">
                <div class="col-xs-2">
                    <img class="noticeImg" src="<?php echo get_cover($shop['cover_id'],$field = path);?>" />
                </div>
                <div class="col-xs-10">
                    <p class="title"><?php echo $shop['title'];?></p>
                    <p class="intro"><?php echo $shop['description'];?></p>
                    <p class="info">浏览: <span class="view"><?php echo $shop['view']?></span> <span class="pull-right"><?php echo date('Y-m-d H:i:s',$shop['update_time']); ?></span> </p>
                </div>
            </a>
        </div>
        <?php endforeach;?>
    </div>
    <div class="text-center">
        <button type="button" class="btn btn-info ajax-page">获取跟多~~~</button>
    </div>
</div>
<script src="/Public/Wechat/static/jquery-1.11.2.min.js"></script>
<script src="/Public/Wechat/static/bootstrap/js/bootstrap.min.js"></script>







<script type="text/javascript">
    var p = 1;
    var url = '/Shop/index';
    var view_url = '/Shop/view';
    var inner_url = '/Shop/detail';
    $(function () {
        $('.ajax-page').click(function () {
            p=p+1;
            $.getJSON(url+'/p/'+p,function (data) {
                console.debug(data);
                if(data == null){
                    $('.ajax-page').html("没有跟多数据了！！").removeClass('ajax-page')
                }else{
                    var html="";
                    $(data).each(function (i,v) {
                        html += '<div class="row noticeList">\
                    <a class="detail_view" data-id="'+v.id+'"  href="'+inner_url+'/id/'+v.id+'.html">\
                        <div class="col-xs-2">\
                            <img class="img-rounded img-responsive" src="'+v.path+'" />\
                        </div>\
                        <div class="col-xs-10">\
                            <p class="title">'+v.title+'</p>\
                            <p class="intro">'+v.description+'</p>\
                            <p class="info">浏览:<span class="view"> '+v.view+'</span> <span class="pull-right">'+new Date(parseInt(v.create_time) * 1000).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ")+'</span> </p>\
                        </div>\
                    </a>\
                </div>';

                    })

                    $('#list').append(html);
                }

            })

        })
    })
    $('#list').on('click','.detail_view',function () {
        var id = $(this).attr('data-id');
//        console.debug(id);
        $.getJSON(view_url+'/id/'+id,function (data) {

        })
    })



</script>

</body>
</html>