<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/12
 * Time: 22:03
 */

namespace Admin\Controller;


use Think\Controller;
use Think\Verify;

class CaptchaController extends Controller
{
    public function show(){
        //设置验证码样式
        $conf = [
            'fontSize'  =>  16,              // 验证码字体大小(px)
            'useCurve'  =>  false,            // 是否画混淆曲线
            'useNoise'  =>  true,            // 是否添加杂点
            'imageH'    =>  40,               // 验证码图片高度
            'imageW'    =>  145,               // 验证码图片宽度
            'length'    =>  4,               // 验证码位数
        ];
        //实例化验证码
        $verify = new Verify($conf);
        //生成验证码
        dump($verify ->entry());
    }
}