<?php

/**
 * return list category
 */
class Category
{
    /**
     * Retuns an array of categories
     *
     * @return array
     */
    public static function getCategories():array
    {
        $db = Db::getConnection();
        $categories = array();
        $result = $db->query('SELECT id_category, name_category '
        . 'FROM categories '
        . 'WHERE status = 1 '
        . 'ORDER BY sort_order ASC');

        $i = 0;
        while($row = $result->fetch()) {
            $categories[$i]['id'] = $row['id_category'];
            $categories[$i]['name'] = $row['name_category'];
            $i++;
        }
        return $categories;
    }
}