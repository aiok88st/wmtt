<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"F:\wamp\www\wanmeinh\app\index/../../public/template/index\index\index.html";i:1518072400;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    <div>
        <div>
            <button>活动规则</button>
        </div>
        <div>
            <a href=""><button>开始游戏</button></a>
        </div>
        <div>
            <a href="<?php echo url('index/person'); ?>"><button>我的年货</button></a>
        </div>
    </div>
    <div style="margin-top: 30px">
        <button onclick="add()">带回家(<span><?php echo $m; ?></span>)</button>
    </div>
    <div style="margin-top: 30px">
        <a href="<?php echo url('index/test'); ?>"><button>答题</button></a>
    </div>
</body>
</html>
<script type="text/javascript">
    //添加积分
    function add(){
        var url = "<?php echo url('index/add'); ?>";
        var num = 12;
        $.get(url,{"num":num},function(res){
            if(res.code == 0){
                alert('网络错误');
            }else{
                window.location.href=res.link;
            }
        });
    }
</script>