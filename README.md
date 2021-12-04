# webman-validate

The webman validate Package。
基于thinkphp6修改的可用于webman等php框架的通用validate数据验证器，

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

更多用法可以参考6.0完全开发手册的[验证](https://www.kancloud.cn/manual/thinkphp6_0/1037623)章节


## 特别说明

基于thinkphp6 validate修改webman-validate,可用于其它框架。
感谢 ThinkPHP
