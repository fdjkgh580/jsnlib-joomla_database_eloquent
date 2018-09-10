<?php
namespace Jsnlib\Joomla\Database\Eloquent;

/**
 * 輔助 Eloquent 在 Model 中的使用
 */
class Helper
{
    protected static $dbConnection;

    /**
     * 連線 Eloquent
     * @param  \Illuminate\Database\MySqlConnection $connection 
     */
    public static function connectionEloquent(\Illuminate\Database\MySqlConnection $connection)
    {
        self::$dbConnection = $connection;
        return true;
    }

    /**
     * 因為 Eloquent 在 Debug 需要較多參數設置，所以]包圍運行 DB 的外層，
     * 可控制是否啟用 Debug
     *
     * @param  boolean    $isDebug  *false|true 是否啟用 debug
     * @param  callable   $callback 運行的主程序
     * @return \Jsnlib\Ao 取得 debug 結果或是運行 $callback() 的數據
     */
    public static function proccess($isDebug = false, $callback)
    {
        $dbConnection = self::$dbConnection;

        if ($isDebug === true)
        {
            $dbConnection->enableQueryLog();
            $result  = $callback($dbConnection);
            $queries = $dbConnection->getQueryLog();
            print_r($queries);
            die;
        }
        else
        {
            $result = $callback($dbConnection);

            // 直接返回數字
            if (is_int($result))
            {
                return $result;
            }
        }

        return new \Jsnlib\Ao($result);
    }

    /**
     * 自動判斷查詢的複數或單數
     * @param  \Jsnlib\Ao $result              由 self::proccess() 取得的 result
     * @param  string     $info_list           list 取得複數 | info 取得單數
     * @return \Jsnlib\Ao 返回查詢結果
     */
    public static function selectResult($result, $info_list)
    {
        if ($info_list == "info")
        {
            if (count($result) == 0)
            {
                return $result;
            }

            return $result[0];
        }
        else if ($info_list == "list")
        {
            return $result;
        }
        else
        {
            throw new \Exception('需要指定 list | info');
        }
    }
}
