<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:76:"F:\wamp\www\wanmeinh\app\index/../../public/template/index\index\person.html";i:1518072448;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    <button>返回</button>
    <div>
        <p>我的年货：<span id="n"><?php echo $mr['user_sum']; ?></span></p>
    </div>
    <div>
        兑奖者名单
    </div>
    <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $k = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
    <div class="p" >
        <p>
            <img src="__IMGS__<?php echo $vo['img']; ?>" width="30px"/>
        </p>
        <p><?php echo $vo['title']; ?></p>
        <p>需要年货数：<?php echo $vo['integral']; ?></p>
        <p>剩余：<span class="s_<?php echo $vo['id']; ?>"><?php echo $vo['number']; ?></span></p>
        <div>
            <button id="<?php echo $vo['id']; ?>" it="<?php echo $vo['integral']; ?>">兑换</button>
        </div>
    </div>
    <?php endforeach; endif; else: echo "" ;endif; ?>

    <div>
        <p>个人信息</p>
        <div>
            姓名：<input type="text" id="name">
        </div>
        <div>
            电话：<input type="text" id="phone">
        </div>
        <div>
            地址：<input type="text" id="addr">
        </div>
        <div>
            <button onclick="addU()">确认</button>
        </div>
    </div>
</body>
</html>
<script type="text/javascript">
    //兑换年货
    $(".p button").on('click',function(){
        var url = "<?php echo url('index/add_prize'); ?>";
        var n = $("#n").text();
        var it = $(this).attr('it');
        var id = $(this).attr('id');
        if(parseInt(n) < parseInt(it)){
            console.log('您的年货数不够');
        }
        $.post(url,{"id":id},function(res){
            if(res.code == 1){
                $("#n").text(res.su);
                $(".s_"+id).text(res.sy);
            }else{
                alert('提交失败');
            }
        });
    })

    //个人信息
    function addU(){
        var url = "<?php echo url('index/add_user'); ?>";
        var name = $('#name').val();
        var phone = $('#phone').val();
        var addr = $('#addr').val();
        $.post(url,{"name":name,"phone":phone,"addr":addr},function(res){
            if(res.code == 1){
                alert('提交成功');
            }else{
                alert('提交失败');
            }
        });
    }
</script>