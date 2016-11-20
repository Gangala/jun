<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/11/5
 * Time: 21:59
 */

namespace Admin\Controller;


use Think\Controller;
use Think\Image;
use Think\Upload;

class UploadController extends  Controller
{

    /**
     * 文件上传
     */
    public function upload(){
        //收集数据
        $config = [
            'mimes'         =>  array('image/jpeg','image/png','image/gif'), //允许上传的文件MiMe类型
            'maxSize'       =>  0, //上传的文件大小限制 (0-不做限制)
            'exts'          =>  array('jpg','jpeg','jpe','png','gif'), //允许上传的文件后缀
            'autoSub'       =>  true, //自动子目录保存文件
            'subName'       =>  array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
            'rootPath'      =>  './', //保存根路径
            'savePath'      =>  'Uploads/images/', //保存路径
            'saveName'      =>  array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
            'saveExt'       =>  '', //文件保存后缀，空则使用原后缀
            'replace'       =>  false, //存在同名是否覆盖
            'hash'          =>  true, //是否生成hash编码
            'callback'      =>  false, //检测文件是否存在回调，如果存在返回文件信息数组
//            'driver'        =>  'Qiniu', // 文件上传驱动
//           'driverConfig'  =>  array(
//                'secretKey'      => 'yFSDFtfBxnv4Wf6qGLX0Yw8Uo1SApnoJeW1cwXmp', //七牛服务器
//                'accessKey'      => '_QI0v52__cUlCaTX59IVAOOsjTGjJ8z_5Tg129yy', //七牛用户
//                'domain'         => 'og79mdtod.bkt.clouddn.com', //七牛域名
//                'bucket'         => 'shop-admin', //空间名称
//                'timeout'        => 300, //超时时间
//            ), // 上传驱动配置
        ];
        //保存结果
        $upload = new Upload($config);
         $fileinfo = $upload -> upload();
        //获取一个二维数组的元素
        $fileinfo = array_pop($fileinfo);
        //返回结果
        if (!$fileinfo) {
            $data=[
                'status' => false,
                'msg' => $upload ->getError(),
                'url' => ''
            ];

        }else{
            //判断文件上传驱动是否为七牛云
            if($upload->driver == 'Qiniu'){

                $data = [
                    'status' => true,
                    'msg' => '上传成功',
                    'url' => $fileinfo['url']
                ];
            }else{
                $data = [
                    'status' => true,
                    'msg' => '上传成功',
                    'url' =>ROOT_PATH.$upload->rootPath.$fileinfo['savepath'].$fileinfo['savename']
                ];
            }
        }
        $this ->ajaxReturn($data);
    }
}