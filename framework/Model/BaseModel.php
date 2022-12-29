<?php

namespace framework\Model;

use framework\Components\Singleton;
use framework\Config\exceptions\DbException;

class BaseModel extends BaseModelMethods
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
//        $this->db->close();
    }

    // final - не разрешаем дочерним классам переопределять и менять

    /**
     * @param string $query
     * @param string $crud = r - SELECT / c - INSERT / u - UPDATE / d - DELETE
     * @param bool $return_id
     * @return string|array|bool|int
     * @throws DbException
     */
    final public function query(string $query, string $crud = 'r', bool $return_id = false): string|array|bool|int
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

    /**
     * @param string $table
     * @param array $set
     * @return array|bool|int|string
     *'fields' => ['id', 'name'],
     *'where' => [
     *    'category' => 'notebooks, bicycles, clothes, tv',
     *    'sale' => '1',
     *    'new' => '0',
     *    'id_category' => '1',
     *    'color' => $color
     *],
     *'operand' => ['IN', 'LIKE%', '<>', '=', 'NOT IN'],
     *'condition' => ['AND', 'OR'],
     *'order' => ['new', 'id_category'],
     *'order_direction' => ['ASC', 'DESC'],
     *'limit' => '1',
     *'join' => [
     *    [
     *        'table' => 'join_table',
     *        'fields' => ['id as j_id', 'name as j_name'],
     *        'type' => 'left',
     *        'where' => ['name' => 'notebooks'],
     *        'operand' => ['='],
     *        'condition' => ['OR'],
     *        'on' => ['id', 'id_category'],
     *        'group_condition' => 'AND'
     *    ],
     *    [
     *        'table' => 'join_table2',
     *        'fields' => ['id as j2_id', 'name as j2_name'],
     *        'type' => 'left',
     *        'where' => ['name' => 'smartphones'],
     *        'operand' => ['<>'],
     *        'condition' => ['AND'],
     *        'on' => [
     *            'table' => 'products',
     *            'fields' => ['id', 'id_category']
     *        ]
     *    ]
     *]
     * @throws DbException
     */
    final public function get(string $table, array $set = []): array|bool|int|string
    {
        $fields = $this->createFields($set, $table);
        $where = $this->createWhere($set, $table);

        if (!$where) {
            $new_where = true;
        } else {
            $new_where = false;
        }

        $join_arr = $this->createJoin($set, $table, $new_where);

        $fields .= $join_arr['fields'];
        $join = $join_arr['join'];
        $where .= $join_arr['where'];

        // delete last ',' in string fields
        $fields = rtrim($fields, ', ');

        $order = $this->createOrder($set, $table);

        $limit = $set['limit'] ? 'LIMIT ' . $set['limit'] : '';

        $query = "SELECT $fields FROM $table $join $where $order $limit";
        return $this->query($query);
    }

    /**
     * @param string $table - table for insert data
     * @param array $set - array params:
     * fields => [field => properties], якщо не указан, то обробляєм $_POST [field => properties]
     * дозволена передача наприклад NOW() у якості MySQL функції, зазвичай строка
     * files => [field => properties]; можна подати array як [поле => [array значень]]
     * except => ['виключення 1', 'виключення 2'] - виключає дані елементи масива з добавлення у запроса
     * return_id => true|false- повертає або ні ідентифікатор встановленого запису
     * @return string|int|bool|array
     * @throws DbException
     */
    final public function add(string $table, array $set = []): string|int|bool|array
    {
        $set['fields'] = (is_array($set['fields']) && !empty($set['fields'])) ? $set['fields'] : $_POST;

        $set['files'] = (is_array($set['files']) && !empty($set['files'])) ? $set['files'] : false;

        if (!$set['fields'] && !$set['files']) {
            return false;
        }

        $set['return_id'] = (bool)$set['return_id'];
        $set['except'] = (is_array($set['except']) && !empty($set['except']))
            ? $set['except'] : false;

        $insert_arr = $this->createInsert($set['fields'], $set['files'], $set['except']);

        if ($insert_arr) {
            $query = "INSERT INTO $table ({$insert_arr['fields']}) VALUES ({$insert_arr['values']})";

//            exit($query);

            return $this->query($query, 'c', $set['return_id']);
        }

        return false;
    }

    /**
     * @param string $table
     * @param array $set
     * @return mixed
     * @throws DbException
     */
    final public function edit(string $table, array $set = []): mixed
    {
        $set['fields'] = (is_array($set['fields']) && !empty($set['fields']))
            ? $set['fields'] : $_POST;
        $set['files'] = (is_array($set['files']) && !empty($set['files']))
            ? $set['files'] : false;

        if (!$set['fields'] && !$set['files']) {
            return false;
        }

        $set['except'] = (is_array($set['except']) && !empty($set['except']))
            ? $set['except'] : false;

        $where = '';

        if (!$set['all_rows']) {
            if ($set['where']) {
                $where = $this->createWhere($set, $table);
            } else {
                $columns = $this->showColumns($table);
                if (!$columns) {
                    return false;
                }
                if ($columns['id_row'] && $set['fields'][$columns['id_row']]) {
                    $where = 'WHERE ' . $columns['id_row'] . ' = ' . $set['fields'][$columns['id_row']];
                    unset($set['fields'][$columns['id_row']]);
                }
            }
        }
        $update = $this->createUpdate($set['fields'], $set['files'], $set['except']);
//        $query = "UPDATE $table SET name = 'Alex', surname = 'Ivanovich' WHERE id = 1";
        $query = "UPDATE $table SET $update $where";
        return $this->query($query, 'u');
    }

    /**
     * @param string $table
     * @param array $set
     * @return bool
     * @throws DbException
     *'fields' => ['id', 'name'],
     *'where' => [
     *    'category' => 'notebooks, bicycles, clothes, tv',
     *    'sale' => '1',
     *    'new' => '0',
     *    'id_category' => '1',
     *    'color' => $color
     *],
     *'operand' => ['IN', 'LIKE%', '<>', '=', 'NOT IN'],
     *'condition' => ['AND', 'OR'],
     *'join' => [
     *    [
     *        'table' => 'join_table',
     *        'fields' => ['id as j_id', 'name as j_name'],
     *        'type' => 'left',
     *        'where' => ['name' => 'notebooks'],
     *        'operand' => ['='],
     *        'condition' => ['OR'],
     *        'on' => ['id', 'id_category'],
     *        'group_condition' => 'AND'
     *    ],
     *    [
     *        'table' => 'join_table2',
     *        'fields' => ['id as j2_id', 'name as j2_name'],
     *        'type' => 'left',
     *        'where' => ['name' => 'smartphones'],
     *        'operand' => ['<>'],
     *        'condition' => ['AND'],
     *        'on' => [
     *            'table' => 'products',
     *            'fields' => ['id', 'id_category']
     *        ]
     *    ]
     *]
     */
    final public function delete(string $table, array $set = []): bool
    {
        $table = trim($table);
        $where = $this->createWhere($set, $table);
        $columns = $this->showColumns($table);
        if (!$columns) {
            return false;
        }
        $query = '';
        if (is_array($set['fields']) && !empty($set['fields'])) {
            // we must check have we in $set['fields'] an 'id' in field and then there will be a error
            // we must check have we an 'id' in field oder not. if yes, then delete 'id' in fields.
            // Example:
            // $res = $db->delete($table, [
            //        'fields' => ['id', 'name']
            // ]);
            // if we mistakenly sent the 'id' field, then check:
            if ($columns['id_row']) {
                // array_search(1-what search, 2-where search): return key(number or associative string) or false
                $key = array_search($columns['id_row'], $set['fields']);
                if ($key !== false) {
                    unset($set['fields'][$key]);
                }
                $fields = [];
                foreach ($set['fields'] as $field) {
                    $fields[$field] = $columns[$field]['Default'];
                }
                $update = $this->createUpdate($fields, false, false);
                $query = "UPDATE $table SET $update $where";
            } else {
                $join_arr = $this->createJoin($set, $table);
                $join = $join_arr['join'];
                $join_tables = $join_arr['tables'];

                $query = 'DELETE ' . $table . $join_tables . ' FROM ' . $table . ' ' . $join . ' ' . $where;
            }
        }
        return $this->query($query, 'u');
    }

    /**
     * @param string $table
     * @return array
     * @throws DbException
     */
    final public function showColumns(string $table): array
    {
        $query = "SHOW COLUMNS FROM $table";
        $res = $this->query($query);

        $columns = [];

        if ($res) {
            foreach ($res as $row) {
                $columns[$row['Field']] = $row;
                if ($row['Key'] === 'PRI') {
                    $columns['id_row'] = $row['Field'];
                }
            }
        }
        return $columns;
    }
}
