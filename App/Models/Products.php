<?php

/**
 * return list products
 */
class Products
{
    //count products
    const SHOW_BY_DEFAULT = 6;

    /**
     * Retuns single news item with specified id
     * @param $id int
     * @return array
     */
    public static function getProductById(int $id): array
    {
        $db = Db::getConnection();
        $productById = array();
        $result = $db->query('SELECT id, name, price, sale, new, img, quantity, category, `describe`, `condition`, `manufacturer` '
            . 'FROM products '
            . 'WHERE id = '
            . $id . ' AND status = 1');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $productById = $result->fetch();
        return $productById;
    }

    public static function getCountProducts($categoryId)
    {
        $db = Db::getConnection();
        $products = array();
        $result = $db->query('SELECT count(*) as count '
            . 'FROM products '
            . 'WHERE id_category = ' . $categoryId. ' AND status = 1');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $products = $result->fetch();

        return $products['count'];
    }

    /**
     * Retuns an array of products items
     * @return void
     */
    public static function getProductsByCategory($categoryId = false, $page = 1)
    {
        if ($categoryId) {
            $page = intval($page);
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

            $db = Db::getConnection();
            $products = array();

            $result = $db->query('SELECT id, name, price, sale, new, img, quantity, category '
                . 'FROM products '
                . 'WHERE id_category = '
                . $categoryId . ' AND status = 1 '
                . 'ORDER BY id DESC '
                . 'LIMIT ' . self::SHOW_BY_DEFAULT
                . ' OFFSET ' . $offset);
//        $result = $db->query('SELECT products.id as id, name, price, sale, new, img, quantity, category '
//            . 'FROM products '
//            . 'RIGHT JOIN home_recommended_products '
//            . 'ON products.id = home_recommended_products.id_products');
            $i = 0;
            while($row = $result->fetch()) {
                $products[$i]['id'] = $row['id'];
                $products[$i]['name'] = $row['name'];
                $products[$i]['price'] = $row['price'];
                $products[$i]['sale'] = $row['sale'];
                $products[$i]['new'] = $row['new'];
                $products[$i]['img'] = $row['img'];
                $products[$i]['quantity'] = $row['quantity'];
                $products[$i]['category'] = $row['category'];
                $i++;
            }
            return $products;
        }
    }
}