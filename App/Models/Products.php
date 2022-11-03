<?php

/**
 * return list products
 */
class Products
{
    /**
     * Retuns an array of Latest products
     *
     * @return array
     */
    public static function getCategoriesProducts():array
    {
        $db = Db::getConnection();
        $categoriesProducts = array();
        $result = $db->query('SELECT id_category, name_category '
            . 'FROM categories');
        $i = 0;
        while($row = $result->fetch()) {
            $categoriesProducts[$i]['id'] = $row['id_category'];
            $categoriesProducts[$i]['name'] = $row['name_category'];
            $i++;
        }
        return $categoriesProducts;
    }
    /**
     * Retuns single news item with specified id
     * @param $id int
     * @return void
     */
    public static function getProductById(int $id)
    {
        $db = Db::getConnection();
        $productById = array();
        $result = $db->query('SELECT id, name, price, sale, new, img, quantity, category, `describe`, `condition`, `manufacturer` '
            . 'FROM products '
            . 'WHERE id = '
            . $id);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $productById = $result->fetch();
        return $productById;
    }
    /**
     * Retuns an array of count products items
     * @return void
     */
    public static function getCountProducts($categoryId)
    {
        $db = Db::getConnection();
        $products = array();
        $result = $db->query('SELECT count(*) as count '
            . 'FROM products '
            . 'WHERE id_category = ' . $categoryId);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $products = $result->fetch();

        return $products;
    }

    /**
     * Retuns an array of products items
     * @return void
     */
    public static function getProducts($categoryId)
    {
        $db = Db::getConnection();
        $products = array();

        $result = $db->query('SELECT id, name, price, sale, new, img, quantity, category '
            . 'FROM products '
            . 'WHERE id_category = '
            . $categoryId . ' ORDER BY id DESC '
            . 'LIMIT 10');
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