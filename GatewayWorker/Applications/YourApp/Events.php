<?php
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * 用于检测业务代码死循环或者长时间阻塞等问题
 * 如果发现业务卡死，可以将下面declare打开（去掉//注释），并执行php start.php reload
 * 然后观察一段时间workerman.log看是否有process_timeout异常
 */
//declare(ticks=1);

use GatewayWorker\Lib\Context;
use \GatewayWorker\Lib\Gateway;
require __DIR__ . '/../../../vendor/autoload.php';

//// 2. 引入 Yii 框架核心文件
//require __DIR__ . '/../../../vendor/yiisoft/yii2/Yii.php';
/**
 * 主逻辑
 * 主要是处理 onConnect onMessage onClose 三个方法
 * onConnect 和 onClose 如果不需要可以不用实现并删除
 */
class Events
{
    public static $db = null;

    public static function onWorkerStart(){
//        self::$db = new \Workerman\MySQL\Connection('127.0.0.1', '3306', 'root', 'root','gayy');
        // self::$db = new \Workerman\MySQL\Connection('127.0.0.1', '3306', 'root', 'LiuYi19920705!','aysh');
    }

    /**
     * 当客户端连接时触发
     * 如果业务不需此回调可以删除onConnect
     *
     * @param int $client_id 连接id
     */
    public static function onConnect($client_id)
    {

        var_dump("用户$client_id-----连接成功");

    }


    public static function onWebSocketConnect($client_id, $data)
    {
        var_dump("用户$data-----连接成功");
    }



    /**
     * 当客户端发来消息时触发
     * @param int $client_id 连接id
     * @param mixed $message 具体消息
     */
    public static function onMessage($client_id, $message)
    {
        
        var_dump("用户$client_id-----发送了消息：$message");
    }




    /**
     * 当用户断开连接时触发
     * @param int $client_id 连接id
     */
    public static function onClose($client_id)
    {
        var_dump("用户$client_id-----断开了连接");

    }

}
