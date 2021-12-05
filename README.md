# webman-validate

The webman validate Package。
基于thinkphp6修改的可用于webman等php框架的通用validate数据验证器，
暂时不提供facede模式。

## 安装
~~~
composer require taoser/webman-validate
~~~

## 用法
>定义验证器
~~~php
namespace app\validate;

use taoser\Validate;

class User extends Validate
{
    protected $rule = [
        'name'  =>  'require|max:25',
        'email' =>  'email',
    ];

}
~~~

支持创建验证器进行数据验证
~~~php
<?php
namespace app\index\validate;

use taoser\Validate;

class User extends Validate
{
    protected $rule =   [
        'name'  => 'require|max:25',
        'age'   => 'number|between:1,120',
        'email' => 'email',    
    ];
    
    protected $message  =   [
        'name.require' => '名称必须',
        'name.max'     => '名称最多不能超过25个字符',
        'age.number'   => '年龄必须是数字',
        'age.between'  => '年龄只能在1-120之间',
        'email'        => '邮箱格式错误',    
    ];
    
}
~~~

验证器调用代码如下：
~~~php
<?php
namespace app\controller;

use app\validate\User;
use taoser\exception\ValidateException;

class Index
{
    public function index()
    {
        try {
            validate(User::class)->check([
                'name'  => 'thinkphp',
                'email' => 'thinkphp@qq.com',
            ]);
        } catch (ValidateException $e) {
            // 验证失败 输出错误信息
            dump($e->getError());
        }
    }
}
~~~

## 多语言

>多语言提示需要增加以下对应翻译文件：
resource/translations/zh_CN/messages.php

~~~
return[
	 // Validate Error Message
    ':attribute require'                                        => ':attribute不能为空',
    ':attribute must'                                           => ':attribute必须',
    ':attribute must be numeric'                                => ':attribute必须是数字',
    ':attribute must be integer'                                => ':attribute必须是整数',
    ':attribute must be float'                                  => ':attribute必须是浮点数',
    ':attribute must be bool'                                   => ':attribute必须是布尔值',
    ':attribute not a valid email address'                      => ':attribute格式不符',
    ':attribute not a valid mobile'                             => ':attribute格式不符',
    ':attribute must be a array'                                => ':attribute必须是数组',
    ':attribute must be yes,on or 1'                            => ':attribute必须是yes、on或者1',
    ':attribute not a valid datetime'                           => ':attribute不是一个有效的日期或时间格式',
    ':attribute not a valid file'                               => ':attribute不是有效的上传文件',
    ':attribute not a valid image'                              => ':attribute不是有效的图像文件',
    ':attribute must be alpha'                                  => ':attribute只能是字母',
    ':attribute must be alpha-numeric'                          => ':attribute只能是字母和数字',
    ':attribute must be alpha-numeric, dash, underscore'        => ':attribute只能是字母、数字和下划线_及破折号-',
    ':attribute not a valid domain or ip'                       => ':attribute不是有效的域名或者IP',
    ':attribute must be chinese'                                => ':attribute只能是汉字',
    ':attribute must be chinese or alpha'                       => ':attribute只能是汉字、字母',
    ':attribute must be chinese,alpha-numeric'                  => ':attribute只能是汉字、字母和数字',
    ':attribute must be chinese,alpha-numeric,underscore, dash' => ':attribute只能是汉字、字母、数字和下划线_及破折号-',
    ':attribute not a valid url'                                => ':attribute不是有效的URL地址',
    ':attribute not a valid ip'                                 => ':attribute不是有效的IP地址',
    ':attribute must be dateFormat of :rule'                    => ':attribute必须使用日期格式 :rule',
    ':attribute must be in :rule'                               => ':attribute必须在 :rule 范围内',
    ':attribute be notin :rule'                                 => ':attribute不能在 :rule 范围内',
    ':attribute must between :1 - :2'                           => ':attribute只能在 :1 - :2 之间',
    ':attribute not between :1 - :2'                            => ':attribute不能在 :1 - :2 之间',
    'size of :attribute must be :rule'                          => ':attribute长度不符合要求 :rule',
    'max size of :attribute must be :rule'                      => ':attribute长度不能超过 :rule',
    'min size of :attribute must be :rule'                      => ':attribute长度不能小于 :rule',
    ':attribute cannot be less than :rule'                      => ':attribute日期不能小于 :rule',
    ':attribute cannot exceed :rule'                            => ':attribute日期不能超过 :rule',
    ':attribute not within :rule'                               => '不在有效期内 :rule',
    'access IP is not allowed'                                  => '不允许的IP访问',
    'access IP denied'                                          => '禁止的IP访问',
    ':attribute out of accord with :2'                          => ':attribute和确认字段:2不一致',
    ':attribute cannot be same with :2'                         => ':attribute和比较字段:2不能相同',
    ':attribute must greater than or equal :rule'               => ':attribute必须大于等于 :rule',
    ':attribute must greater than :rule'                        => ':attribute必须大于 :rule',
    ':attribute must less than or equal :rule'                  => ':attribute必须小于等于 :rule',
    ':attribute must less than :rule'                           => ':attribute必须小于 :rule',
    ':attribute must equal :rule'                               => ':attribute必须等于 :rule',
    ':attribute has exists'                                     => ':attribute已存在',
    ':attribute not conform to the rules'                       => ':attribute不符合指定规则',
    'invalid Request method'                                    => '无效的请求类型',
    'invalid token'                                             => '令牌数据无效',
    'not conform to the rules'                                  => '规则错误',
	
];	
~~~

更多用法可以参考6.0完全开发手册的[验证](https://www.kancloud.cn/manual/thinkphp6_0/1037623)章节


## 特别说明

基于thinkphp6 validate修改webman-validate,可用于其它框架。
感谢 ThinkPHP
