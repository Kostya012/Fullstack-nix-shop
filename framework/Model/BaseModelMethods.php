<?php

namespace framework\Model;

abstract class BaseModelMethods
{
    /**
     * @param array $set
     * @param mixed $table
     * @return string
     */
    protected function createFields(array $set, mixed $table = false): string
    {
        $set['fields'] = (is_array($set['fields']) && !empty($set['fields']))
            ? $set['fields'] : [' * '];
        $table = $table ? $table . '.' : '';
        $fields = '';

        foreach ($set['fields'] as $field) {
            $fields .= $table . $field . ', ';
        }
        return $fields;
    }

    /**
     * @param array $set
     * @param mixed $table
     * @param string $instruction
     * @return string
     */
    protected function createWhere(array $set, mixed $table = false, string $instruction = 'WHERE'): string
    {
//        echo '<pre>';
//        print_r($set);
//        echo '</pre>';

        $table = $table ? $table . '.' : '';
        $where = '';
        if (is_array($set['where']) && !empty($set['where'])) {
            $set['operand'] = (is_array($set['operand']) && !empty($set['operand'])) ? $set['operand'] : [' = '];
            $set['condition'] = (is_array($set['condition']) && !empty($set['condition']))
                ? $set['condition']
                : [' AND '];

            $where = $instruction;

            $o_count = 0;
            $c_count = 0;

            foreach ($set['where'] as $key => $item) {
                $where .= ' ';

                if ($set['operand'][$o_count]) {
                    $operand = $set['operand'][$o_count];
                    $o_count++;
                } else {
                    $operand = $set['operand'][$o_count - 1];
                }

                if ($set['condition'][$c_count]) {
                    $condition = $set['condition'][$c_count];
                    $c_count++;
                } else {
                    $condition = $set['condition'][$c_count - 1];
                }

                if ($operand === 'IN' || $operand === 'NOT IN') {
                    // check $item have word 'SELECT' strpos() function looked word 'SELECT'
                    if (is_string($item) && strpos($item, 'SELECT') === 0) {
                        $in_str = $item;
                    } else {
                        if (is_array($item)) {
                            $temp_item = $item;
                        } else {
                            $temp_item = explode(',', $item);
                        }
                        $in_str = '';
                        foreach ($temp_item as $value) {
                            // trim delete space around $value = ' word'
                            // example string must have "'": "where id = '1', name <> 'Masha', pos > 2"
                            // addslashes() - ekronirue string з апострофами example 'Mar\'yam'
                            $in_str .= "'" . addslashes(trim($value)) . "', ";
                        }
                        // delete with rtrim() in end ', '
                        $in_str = rtrim($in_str, ', ');
                    }

                    $where .= $table . $key . ' ' . $operand . ' (' . $in_str . ') ' . $condition;
                } elseif (strpos($operand, 'LIKE') !== false) {
                    $like_template = explode('%', $operand);

                    foreach ($like_template as $lt_key => $lt) {
                        if (!$lt) {
                            if (!$lt_key) {
                                $item = '%' . $item;
                            } else {
                                $item .= '%';
                            }
                        }
                    }
                    $where .= $table . $key . ' LIKE ' . "'" . addslashes($item) . "' $condition";
                } else {
                    if (strpos($item, 'SELECT') === 0) {
                        $where .= $table . $key . ' ' . $operand . ' ' . '(' . $item . ") $condition";
                    } else {
                        $where .= $table . $key . ' ' . $operand . ' ' . "'" . addslashes($item) . "' $condition";
                    }
                }
//                $where .= $table . $key . $operand . '(' . $in_str . ')' . $condition;
            }
            // substr() clear string and return (where, from position, to position)
            // strrpos() return position in string what search
            // we must string $where clear without last $condition
            $where = substr($where, 0, strrpos($where, $condition));
        }
        return $where;
    }

    /**
     * @param mixed $set
     * @param string $table
     * @param bool $new_where
     * @return array
     */
    protected function createJoin(mixed $set, string $table, bool $new_where = false): array
    {
        $fields = '';
        $join = '';
        $where = '';

        if ($set['join']) {
            $join_table = $table;

            foreach ($set['join'] as $key => $item) {
                // перевірка на 'join' => [
                //                  'join_table1' => ['table' => 'join_table1'],
                //                  'join_table2' => ['table' => 'join_table2']
                //               ];
                // або: 'join' => [
                //                  ['table' => 'join_table'],
                //                  ['table' => 'join_table'],
                //                ];
                if (is_int($key)) {
                    if (!$item['table']) {
                        continue;
                    } else {
                        $key = $item['table'];
                    }
                }
                if ($join) {
                    $join .= ' ';
                }

                if ($item['on']) {
                    $join_fields = [];

                    if ($item['on']['fields'] && count($item['on']['fields']) === 2) {
                        $join_fields = $item['on']['fields'];
                    } elseif (count($item['on']) === 2) {
                        $join_fields = $item['on'];
                    } else {
                        continue;
                    }

//                    switch (2) {
//                        case count($item['on']['fields']):
//                            $join_fields = $item['on']['fields'];
//                            break;
//                        case count($item['on']):
//                            $join_fields = $item['on'];
//                            break;
//                        default:
//                            // continue 2 - this is next iteration foreach, which is up
//                            continue 2;
//                            break;
//                    }
                    if (!$item['type']) {
                        $join .= 'LEFT JOIN ';
                    } else {
                        $join .= trim(strtoupper($item['type'])) . ' JOIN ';
                    }
                    $join .= $key . ' ON ';

                    if ($item['on']['table']) {
                        $join .= $item['on']['table'];
                    } else {
                        $join .= $join_table;
                    }
                    // $join_fields[0] - before field, $join_fields[1] - next field
                    // konkoteniruem 2 table
                    $join .= '.' . $join_fields[0] . ' = ' . $key . '.' . $join_fields[1];
                    $join_table = $key;

                    if ($new_where) {
                        if ($item['where']) {
                            $new_where = false;
                        }
                        $group_condition = 'WHERE';
                    } else {
                        $group_condition = $item['group_condition'] ? strtoupper($item['group_condition']) : 'AND';
                    }
                    // $key - table name, $item - array additional info
                    $fields .= $this->createFields($item, $key);
                    $where .= $this->createWhere($item, $key, $group_condition);
                }
            }
        }
        return compact('fields', 'join', 'where');
    }

    /**
     * @param array $set
     * @param mixed $table
     * @return string
     */
    protected function createOrder(array $set, mixed $table = false): string
    {
        $table = $table ? $table . '.' : '';
        $order_by = '';
        if (is_array($set['order']) && !empty($set['order'])) {
            $set['order_direction'] = (is_array($set['order_direction']) && !empty($set['order_direction']))
                ? $set['order_direction'] : ['ASC'];

            $order_by = 'ORDER BY ';
            $direct_count = 0;

            foreach ($set['order'] as $order) {
                if ($set['order_direction'][$direct_count]) {
                    $order_direction = strtoupper($set['order_direction'][$direct_count]);
                    $direct_count++;
                } else {
                    $order_direction = strtoupper($set['order_direction'][$direct_count - 1]);
                }
                if (is_int($order)) {
                    $order_by .= $order . ' ' . $order_direction . ', ';
                } else {
                    // "ORDER BY id ASC, name DESC"
                    $order_by .= $table . $order . ' ' . $order_direction . ', ';
                }
            }
            $order_by = rtrim($order_by, ', ');
        }

        return $order_by;
    }

    protected function createInsert(mixed $fields, mixed $files, mixed $except): mixed
    {
        if (!$fields) {
            $fields = $_POST;
        }

        if ($fields) {
            $sql_func = ['NOW()'];
        }
        return false;
    }
}
