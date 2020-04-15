# 一、PSR-5 PHPDoc

- 代码注释
- 技术文档

# 二、标签

## 1.变量
    @var [变量类型] [变量名] [注释]

## 2.方法/函数
    /**
     * [描述]
     * @param [参数类型] [参数名] [注释]
     * @return [返回类型]
     */

# 三、实例

## 1.变量
    /** @var int $int 这是一个计数器 */
    $int = 0;

## 2.类
    /**
     * 这是一个Foo类.
     */
    class Foo
    {
        /** @var string|null $title 标题 */
        protected $title = null;

        /**
         * 设置单行标题。
         * @param string $title 标题文本.
         * @return void
         */
        public function setTitle($title)
        {
            // there should be no docblock here
            $this->title = $title;
        }
    }
