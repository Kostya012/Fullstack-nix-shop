<?php

/**
 * return list products
 */
class Home
{
    /**
     * Retuns an array of Latest products
     *
     * @return array
     */
    public static function getLatestProducts():array
    {
        $db = Db::getConnection();
        $latestProducts = array();
        $result = $db->query('SELECT id, name, price, sale, new, img, quantity, category '
        . 'FROM products '
        . 'ORDER BY id DESC '
        . 'LIMIT 10');
        $i = 0;
        while($row = $result->fetch()) {
            $latestProducts[$i]['id'] = $row['id'];
            $latestProducts[$i]['name'] = $row['name'];
            $latestProducts[$i]['price'] = $row['price'];
            $latestProducts[$i]['sale'] = $row['sale'];
            $latestProducts[$i]['new'] = $row['new'];
            $latestProducts[$i]['img'] = $row['img'];
            $latestProducts[$i]['quantity'] = $row['quantity'];
            $latestProducts[$i]['category'] = $row['category'];
            $i++;
        }
        return $latestProducts;
    }

    /**
     * Retuns an array of Promotional offers
     * @return array
     */
    public static function getPromotionalOffers():array
    {
        $db = Db::getConnection();
        $promotionalOffers = array();
        $result = $db->query('SELECT id, name, price, sale, new, img, quantity, category '
            . 'FROM products '
            . 'ORDER BY id DESC '
            . 'LIMIT 10');
        $i = 0;
        while($row = $result->fetch()) {
            $promotionalOffers[$i]['id'] = $row['id'];
            $promotionalOffers[$i]['name'] = $row['name'];
            $promotionalOffers[$i]['price'] = $row['price'];
            $promotionalOffers[$i]['sale'] = $row['sale'];
            $promotionalOffers[$i]['new'] = $row['new'];
            $promotionalOffers[$i]['img'] = $row['img'];
            $promotionalOffers[$i]['quantity'] = $row['quantity'];
            $promotionalOffers[$i]['category'] = $row['category'];
            $i++;
        }
        return $promotionalOffers;
    }

    /**
     * Retuns an array of Recommended products
     * @return array
     */
    public static function getRecommendedProducts():array
    {
        $db = Db::getConnection();
        $recommendedProducts = array();
        $result = $db->query('SELECT id, name, price, sale, new, img, quantity, category '
            . 'FROM products '
            . 'ORDER BY id DESC '
            . 'LIMIT 10');
        $i = 0;
        while($row = $result->fetch()) {
            $recommendedProducts[$i]['id'] = $row['id'];
            $recommendedProducts[$i]['name'] = $row['name'];
            $recommendedProducts[$i]['price'] = $row['price'];
            $recommendedProducts[$i]['sale'] = $row['sale'];
            $recommendedProducts[$i]['new'] = $row['new'];
            $recommendedProducts[$i]['img'] = $row['img'];
            $recommendedProducts[$i]['quantity'] = $row['quantity'];
            $recommendedProducts[$i]['category'] = $row['category'];
            $i++;
        }
        return $recommendedProducts;
    }
}