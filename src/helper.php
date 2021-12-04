<?php
declare (strict_types = 1);

use think\helper\Str;

if (!function_exists('validate')) {
    /**
     * 生成验证对象
     * @param string|array $validate      验证器类名或者验证规则数组
     * @param array        $message       错误提示信息
     * @param bool         $batch         是否批量验证
     * @param bool         $failException 是否抛出异常
     * @return Validate
     */
    function validate($validate = '', array $message = [], bool $batch = false, bool $failException = true): Validate
    {
        if (is_array($validate) || '' === $validate) {
            $v = new Validate();
            if (is_array($validate)) {
                $v->rule($validate);
            }
        } else {
            if (strpos($validate, '.')) {
                // 支持场景
                [$validate, $scene] = explode('.', $validate);
            }

            $class = false !== strpos($validate, '\\') ? $validate : $this->parseClass('validate', $validate);

            $v = new $class();

            if (!empty($scene)) {
                $v->scene($scene);
            }
        }

        return $v->message($message)->batch($batch)->failException($failException);
    }
}
	
	 /**
     * 解析应用类的类名
     * @access public
     * @param string $layer 层名 controller model ...
     * @param string $name  类名
     * @return string
     */
    public function parseClass(string $layer, string $name): string
    {
        $name  = str_replace(['/', '.'], '\\', $name);
        $array = explode('\\', $name);
        $class = Str::studly(array_pop($array));
        $path  = $array ? implode('\\', $array) . '\\' : '';

        return $this->namespace . '\\' . $layer . '\\' . $path . $class;
    }
	
