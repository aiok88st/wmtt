<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:62:"F:\wamp\www\wanmeinh\public/../app/admin\view\test\create.html";i:1517555378;}*/ ?>
<html>
<head>
    <meta charset="utf-8">
    <title>后台</title>
    <link rel="stylesheet" type="text/css" href="__STYLE__/qu/css/wenjuan_ht.css">
    <link rel="stylesheet" href="__STYLE__/lib/layui/css/layui.css" media="all" />
    <script src="http://www.jq22.com/jquery/jquery-1.7.1.js"></script>
    <script src="https://cdn.bootcss.com/layer/3.0.3/layer.min.js"></script>
    <script type="text/javascript" src="__STYLE__/lib/layui/layui.js"></script>
    <script src="__STYLE__/qu/js/index.js"></script>

    <style>
        #addquerstions{
            width: 30%;
            height: 36px;
            float: left;
            margin-right: 10px;
            border-color: #D2D2D2!important;
        }
        #type{
            width: 30%;
            height: 36px;
            float: left;
            margin-right: 10px;
            border-color: #D2D2D2!important;
        }
        .btu{
            display: inline-block;
            height: 38px;
            line-height: 37px;
            padding: 0 18px;
            background-color: #0099ff;
            color: #fff;
            white-space: nowrap;
            text-align: center;
            font-size: 14px;
            border: none;
            border-radius: 2px;
            cursor: pointer;
        }
        .btwen_text_tk_cos{
            width: 606px;
            height: 60px;
            padding-left: 8px;
            padding-top: 5px;
        }
        .layui-btn{
            margin-left: 10px;
            height: 33px;
            line-height: 33px;
        }
        .kzjxx_iteam{
            height:50px;
        }
        .img_webk{
            height: 33px;
            width: 85px;
            margin-left: 10px;
            border: none;
        }
        .wjdc_list li{
            line-height: 50px;
        }
        .input img{
            width:75%;
        }
    </style>
</head>
<body>
<div class="admin-main layui-anim layui-anim-upbit" ng-app="hd" ng-controller="ctrl">
    <div class="layui-form-item" style="margin-left: 50px;margin-top: 50px">
        <label class="layui-form-label">标题</label>
        <div class="layui-input-block">
            <input type="text" id="title" name="title" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input" style="width: 650px;">
        </div>
    </div>
    <div class="all_660" style="margin-left: 50px">
        <div id="content" class="yd_box" style="margin-left: 110px;margin-top: 20px;width: 700px"></div>
        <div class="but" style="padding-top: 20px">
            <label class="layui-form-label">请选择题型</label>
            <select id="addquerstions" class="addquerstions" name="type">
                <option value="-1">请选择</option>
                <option value="0">单选</option>
                <option value="1">多选</option>
                <option value="2">判断</option>
            </select>
            <button class="btu" id="addClick" >添加题目</button>
        </div>

        <!--选项卡区域  模板区域---------------------------------------------------------------------------------------------------------------------------------------->
        <div class="xxk_box">
            <div class="xxk_conn hide">
                <!--单选----------------------------------------------------------------------------------------------------------------------------------------->
                <div class="xxk_xzqh_box dxuan ">
                    <textarea name="subject" cols="" rows="" class="input_wenbk btwen_text btwen_text_dx" placeholder="单选题目"></textarea>
                    <div class="title_itram">
                        <div class="kzjxx_iteam">
                            <input name="answer" type="radio" value="1" class="dxk">
                            <input name="optiond" type="text" class="input_wenbk" value="" placeholder="选项">
                            <img src="" class="input_wenbk img_webk file_upload" style="display: none">
                            <button type="button" class="layui-btn layui-btn-primary file_upload"><i class="icon icon-upload3"></i>点击上传

                            </button>
                            <input type="hidden" name="upload_name" value="" class="upload_names">
                            <a href="javascript:void(0);" class="del_xm">删除</a>
                        </div>
                    </div>
                    <a href="javascript:void(0)" class="zjxx">增加选项</a>
                    <div style="margin-top: 10px">
                        <div style="float: left;width: 48%;">
                            <label>此题分数：</label>
                            <input name="score" type="number" class="input_wenbk score" value="0" placeholder="分数" style="width: 50%;">
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                    <!--完成编辑-->
                    <div class="bjqxwc_box">
                        <a href="javascript:void(0);" class="qxbj_but">取消编辑</a>
                        <a href="javascript:void(0);" class="swcbj_but"> 完成编辑</a>
                    </div>
                </div>
                <!--多选----------------------------------------------------------------------------------------------------------------------------------------->
                <div class="xxk_xzqh_box duoxuan hide">
                    <textarea name="subject" cols="" rows="" class="input_wenbk btwen_text btwen_text_duox" placeholder="多选题目"></textarea>
                    <div class="title_itram">
                        <div class="kzjxx_iteam">
                            <input name="answer" type="checkbox" value="1" class="dxk">
                            <input name="optiond" type="text" class="input_wenbk" value="" placeholder="选项">
                            <img src="" class="input_wenbk img_webk file_upload" style="display: none">
                            <button type="button" class="layui-btn layui-btn-primary file_upload"><i class="icon icon-upload3"></i>点击上传

                            </button>
                            <input type="hidden" name="upload_name" value="1" class="upload_names">
                            <a href="javascript:void(0);" class="del_xm">删除</a>
                        </div>
                    </div>
                    <a href="javascript:void(0)" class="zjxx">增加选项</a>
                    <div style="margin-top: 10px">
                        <div style="float: left;width: 48%;">
                            <label>此题分数：</label>
                            <input name="score" type="number" class="input_wenbk score" value="0" placeholder="分数" style="width: 50%;">
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                    <!--完成编辑-->
                    <div class="bjqxwc_box">
                        <a href="javascript:void(0);" class="qxbj_but">取消编辑</a>
                        <a href="javascript:void(0);" class="swcbj_but"> 完成编辑</a>
                    </div>
                </div>
                <!--判断----------------------------------------------------------------------------------------------------------------------------------------->
                <div class="xxk_xzqh_box dxuan ">
                    <textarea name="subject" cols="" rows="" class="input_wenbk btwen_text btwen_text_dx" placeholder="判断题目"></textarea>
                    <div class="title_itram">
                        <div class="kzjxx_iteam">
                            <input name="answer" type="radio" value="1" class="dxk">
                            <input name="optiond" type="text" class="input_wenbk" value="" placeholder="选项">
                            <img src="" class="input_wenbk img_webk file_upload" style="display: none">
                            <button type="button" class="layui-btn layui-btn-primary file_upload"><i class="icon icon-upload3"></i>点击上传
                            </button>
                            <input type="hidden" name="upload_name" value="" class="upload_names">
                            <a href="javascript:void(0);" class="del_xm">删除</a>
                        </div>
                    </div>
                    <a href="javascript:void(0)" class="zjxx">增加选项</a>
                    <div style="margin-top: 10px">
                        <div style="float: left;width: 48%;">
                            <label>此题分数：</label>
                            <input name="score" type="number" class="input_wenbk score" value="0" placeholder="分数" style="width: 50%;">
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                    <!--完成编辑-->
                    <div class="bjqxwc_box">
                        <a href="javascript:void(0);" class="qxbj_but">取消编辑</a>
                        <a href="javascript:void(0);" class="swcbj_but"> 完成编辑</a>
                    </div>
                </div>
                <!-- 填空----------------------------------------------------------------------------------------------------------------------------------------->
                <div class="xxk_xzqh_box tktm hide">
                    <textarea name="subject" cols="" rows="" class="input_wenbk btwen_text btwen_text_tk" placeholder="答题区"></textarea>
                    <div>
                        <div style="margin-top: 10px">
                            <label>此题分数：</label>
                            <input name="score" type="number" class="input_wenbk score" value="" placeholder="分数" style="width: 20%;">
                        </div>
                    </div>
                    <!--完成编辑-->
                    <div class="bjqxwc_box">
                        <a href="javascript:void(0);" class="qxbj_but">取消编辑</a>
                        <a href="javascript:void(0);" class="swcbj_but"> 完成编辑</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="clear: both;margin-top: 100px;"></div>

    <div class="layui-input-block" style="margin-left: 160px;margin-top: 20px;margin-bottom: 20px">
        <button class="btu" onclick="smit()">提交</button>
    </div>
    <form action="" enctype="multipart/form-data" style="display: none">
        <input type="file" name="file"  id="img_upload" >
    </form>
</div>
</body>
</html>
<div id="pop" class="hide" style="display: none">
    <img src=""/>
</div>
<script type="text/javascript">
    $('img').bind('click',function(){
        var src=$(this).attr('src');
        $('#pop').find('img').attr('src',src);
        layer.open({
            type: 1,
            title: false,
            closeBtn: 0,
            area: '600px',
            skin: 'layui-layer-nobg', //没有背景色
            shadeClose: true,
            content: $('#pop')
        });
    })
</script>
<script type="text/javascript" src="__STYLE__/js/common.js"></script>
<script type="text/javascript">

    $('body').on('click','.file_upload',function(){
        $('#img_upload').trigger('click');
        $_this=$(this);
        layui.use([ 'layer','upload'], function () {
            var upload = layui.upload,$ = layui.jquery;
            upload.render({
                elem: '#img_upload'
                ,url: '<?php echo url("UpFiles/upload"); ?>'
                ,accept: 'images' //普通文件
                ,exts: 'jpg|png|gif' //只允许上传压缩文件
                ,done: function(res){
                    if(res.code==1){
                        $_this.hide();
                        $_this.siblings(".img_webk").show();
                        $_this.siblings(".img_webk").attr('src',"__PUBLIC__"+res.url);
                        $_this.siblings(".upload_names").attr('value',res.url);
                    }else{
                        layer.msg(res.msg,{icon: 2, time: 1000});
                    }
                }
            });
        });

    });

    function smit(){
        layui.use('layer', function(){
            var layer = layui.layer;
            layer.load(1);
        });
        var type_id = $('#type option:selected').val();
        var titles = $('#title').val();
        var number = $('#number').val();
        var content = getTest();
        $.ajax({
            url:"<?php echo url('save'); ?>",
            type:'post',
            data:{"title":titles,"content":content,"number":number,"type_id":type_id},
            success:function(res){
                layer.closeAll();
                if (res.code > 0) {
                    layer.msg(res.msg, {time: 1800, icon: 1},function(){
                        location.reload();
                    });
                } else {
                    layer.msg(res.msg, {time: 1800, icon: 2});
                }
            }
        });
    }
</script>
