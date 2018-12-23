<?php
/**
 * Created by PhpStorm.
 * User: sui
 * Date: 2018/12/21
 * Time: 16:32
 */

namespace helpers;


use Exception;
use yii\helpers\Html;

class HtmlHelper
{

    public static function renderException(Exception $exception)
    {
        $html = <<<HTML
        <div style="border: #524b4b 3px solid; padding: 20px;">
<h1> Exception Occoured! </h1>
<p> 错误信息: <pre> {{$exception->getMessage()}} </pre> </p>
<p> 错误文件: <pre> {{$exception->getFile()}} </pre> </p>
<p> 错误行号: <pre> {{$exception->getLine()}} </pre>
</p> <p> <b>具体信息</b> <pre > {{$exception->getTraceAsString()}} </pre> </p>
</div>
HTML;

        echo $html;
    }

    public static function renderMessage($__METHOD__, $dispatcher = null)
    {
        $dispatcher = var_export($dispatcher);
        $trace = self::getDebugTrace();
        $html       = <<<HTML
         <div style="border: #524b4b 3px solid; padding: 20px;">
         <p> <b> Calling Method: {$__METHOD__}</b> <pre> {$dispatcher} </pre> </p>
         <p> <b>Back Trace:{$trace} </p>
</div>
HTML;

        echo $html;
    }

    public static function getDebugTrace($exit= false)
    {
        try{
            $trace = debug_backtrace();
            array_shift($trace);
            $html = "";
            foreach ($trace as $frame) {
                $line ="<table style='border: grey 0.5px solid;
    padding: 15px;'><tbody>";
                foreach ($frame as $key => $value) {
                    $line.= "<tr>";
                    if(is_array($value)){
                        $value = json_encode($value);
                    }
                    if(is_object($value)){
                        $value = var_export($value);
                    }
                    $line.="<th> <b>{$key}:</b></th><td>{$value}</td>";
                    $line.="</tr>";
                }
                $line.="</tbody></table>";
                $html.=$line;

            }
            $html.="</tbody></table>";
        }
        catch (\Exception $exception){
//            die($exception);
        }
        if($exit){
            echo $html;die();
        }
        return $html;
    }
}