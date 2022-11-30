<?php

namespace framework\Model;

use framework\Components\Singleton;
use framework\Config\exceptions\DbException;

class BaseModel
{
    use Singleton;

    protected \mysqli $db;

    /**
     * @throws DbException
     */
    private function __construct()
    {
        $paramsPath = ROOT . '/framework/Config/db_params.php';
        $params = include($paramsPath);

        mysqli_report(MYSQLI_REPORT_OFF); //Turn off irritating default messages

        $this->db = new \mysqli($params['host'], $params['user'], $params['password'], $params['dbname']);

//        echo '<pre>';
//        print_r($this->db);
//        echo '</pre>';

        // if connect error, then will create $this->db->connect_error and $this->db->connect_errno
        // $this->db->connect_errno - This code error
        if ($this->db->connect_errno) {
//            echo '</br>Error connect</br>';
            throw new DbException('Error connection to Db: '
                . $this->db->connect_errno . ' '
                . $this->db->connect_error);
            exit();
        }

        $this->db->query("SET NAMES UTF8");
        $this->db->close();
    }

    // final - не разрешаем дочерним классам переопределять и менять
    final public function query($query, $crud = 'r', $return_id = false)
    {
        $result = $this->db->query($query);

        // affected_rows is in properties mysqli, if -1 then errors, if 0 or string - all good
        if ($this->db->affected_rows === -1) {
            // db->errno - errno код ошибки при запросе к БД
            // db->error = error сообщение об ошибке при запросе к БД
            throw new DbException('Error in SQL request: '
                . $query . ' - '
                . $this->db->errno . ' '
                . $this->db->error);
        }

        switch ($crud) {
            case 'r':
                if ($result->num_rows) {
                    $res = [];
                    for ($i = 0; $i < $result->num_rows; $i++) {
                        $res[] = $result->fetch_assoc();
                    }
                    return $res;
                }
                return false;
                break;
            case 'c':
                if ($return_id) {
                    return $this->db->insert_id;
                }
                return true;
                break;
            default:
                return true;
                break;
        }
    }
}
