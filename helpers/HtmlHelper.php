<?php
/**
 * Created by PhpStorm.
 * User: sui
 * Date: 2018/12/21
 * Time: 16:32
 */

namespace helpers;


use Exception;

class HtmlHelper
{
    
    public static function renderException(Exception $exception)
    {
        $html = <<<HTML
<h1>
Exception Occoured!
</h1>
<p>
  错误信息:
  <pre>
   {{$exception->getMessage()}}
</pre>
</p>
<p>
  错误文件:
  <pre>
   {{$exception->getFile()}}
</pre>
</p>
<p>
  错误行号:
  <pre>
   {{$exception->getLine()}}
</pre>
</p>
<p>
    <b>具体信息</b>
    <pre >
    {{$exception->getTraceAsString()}}
</pre>
</p>
HTML;
        
        echo $html;
        die();
    }
}