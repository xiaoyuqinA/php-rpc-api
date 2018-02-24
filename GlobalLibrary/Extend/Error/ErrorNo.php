<?php
// +--------------------------------------------------------------------------
// | ProjectName :interface
// +--------------------------------------------------------------------------
// | Description :ErrorNo.php 
//+--------------------------------------------------------------------------
// | Author: xiaoyuqin 
// +--------------------------------------------------------------------------
// | Version:0.0.1                Date:2018/1/11 下午2:45
// +--------------------------------------------------------------------------


namespace Extend\Error;


class ErrorNo {

    const  SUCCESS = 0;

    const  FAIL = 1;
    //没有登录
    const  NOT_LOGIN = 10001;
    //无权限,拒绝
    const  PERMISSION_DENY = 10002;

    //参数错误,必传参数没有传
    const  PARAM_ERROR = 10003;
    //方法不存在
    const METHOD_NOT_EXIT = 10004;

    //系统错误
    const  SYSTEM_ERROR = 99999;

    //用户已存在
    const USER_EXIT = 20006;
    //用户不存在
    const USER_NOT_EXIT = 20007;
    //密码错误
    const PASSWD_NOT_RIGHT = 20008;

    //无菜单清单
    const  NO_MENU = 30001;

    //未发布
    const GM_UN_SEND = 0;
    //发布成功
    const GM_SEND_SUCCESS_STATUS = 1;
    //发布失败
    const GM_SEND_FAIL_STATUS = 2;

    //数据为空
    const EMPTY_DATA = 40000;

    public static function getErrMsg( $errno ) {

        switch ( $errno ) {
            case 0:
                return "success";
            case 1:
                return "FAIL";
            case 10001:
                return "Not Login!";
            case 10002:
                return "Permission Deny!";
            case 10003:
                return "Parament Error!";
            case 10004:
                return "method not exit!";
            case 20006:
                return "User Exit!";
            case 20007:
                return "User Not Exit!";
            case 20008:
                return "Passwd Not Right!";
            case 30001:
                return "no menu!";
            case  99999:
                return "System Error!";
        }
    }


}