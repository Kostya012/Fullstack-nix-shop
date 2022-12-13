<?php

//declare(strict_types=1);

//namespace App\Controllers;

//include_once ROOT . '/App/model/Category.php';
//include_once ROOT . '/App/model/Home.php';
//include_once ROOT . '/App/model/User.php';

use App\admin\model\Model;

//include_once ROOT . '/framework/Model/BaseModel.php';

//for header
$GLOBALS['hiconIndex'] = '';
$GLOBALS['hiconProducts'] = '';
$GLOBALS['hiconCart'] = '';
$GLOBALS['hiconSignIn'] = '';
$GLOBALS['hiconSignUp'] = '';
$GLOBALS['hiconUser'] = '';
$GLOBALS['article'] = 'Admin page';

class AdminController
{
//    public $data;

//    public function __construct()
//    {
//        $this->data = Db::getData('main');
//    }

    public function actionIndex()
    {
        global $hiconIndex;
        global $hiconProducts;
        global $hiconCart;
        global $hiconSignIn;
        global $hiconSignUp;
        global $hiconUser;
        global $article;

        $db = Model::instance();

//        add edit get delete
//        Create read update delete

        $table = 'categories';

//        $res = $db->get($table, [
//            'fields' => ['id', 'name'],
//            'where' => ['sale' => '1', 'new' => '0', 'id_category' => '1'],
//            'operand' => ['IN', '%LIKE', '<>'],
//            'condition' => ['AND', 'OR', 'AND'],
//            'order' => ['new', 'id_category'],
//            'order_direction' => ['ASC', 'DESC'],
//            'limit' => '1',
//        ]);
        // "WHERE id = (SELECT id FROM students"

//        $color = ['red', 'blue', 'yellow'];
//        $query = "(SELECT t1.name, t2.fio FROM t1 LEFT JOIN t2 ON t1.parent_id = t2.id WHERE t1.parent_id = 1)
//        UNION
//        (SELECT t1.name, t2.fio FROM t1 LEFT JOIN t2 ON t1.parent_id = t2.id WHERE t2.id = 1)
//        ORDER BY 1 ASC";// in here ORDER BY t1.name ASC -> will not worked, but will worked note: ORDER BY 1 ASC
        // тобто буде працювати сортування у полі у двох SELECT t1.name
//        $res = $db->get($table, set: [
//            'fields' => ['id', 'name'],
//            'where' => [
//                'color' => $color,
//                'name' => "O'Rail",
//                'category' => 'SELECT name_category FROM categories WHERE id_category = 1',
//                'category' => 'notebooks, bicycles, clothes, tv',
//                'sale' => '1',
//                'new' => '0',
//                'id_category' => '1',
//                'color' => $color
//            ],
//            'operand' => ['IN', '<>'],
//            'condition' => ['AND', 'OR'],
//            'order' => ['new', 'id_category'],
//            'order_direction' => ['ASC', 'DESC'],
//            'limit' => '1',
//            'join' => [
//                'join_table' => [
//                    'table' => 'join_table',
//                    'fields' => ['id as j_id', 'name as j_name'],
//                    'type' => 'left',
//                    'where' => ['name' => 'notebooks'],
//                    'operand' => ['='],
//                    'condition' => ['OR'],
//                    'on' => [
//                        'table' => 'products',
//                        'fields' => ['id', 'id_category']
//                    ]
//                ],
//                'join_table2' => [
//                    'table' => 'join_table2',
//                    'fields' => ['id as j2_id', 'name as j2_name'],
//                    'type' => 'left',
//                    'where' => ['name' => 'smartphones'],
//                    'operand' => ['<>'],
//                    'condition' => ['AND'],
//                    'on' => ['id', 'id_category']
//                ]
//            ]
//        ]);

//        $query = "SELECT name1 FROM users";

//        $res = $db->query($query);

        $res = $db->get($table, set: [
            'fields' => ['id_category', 'name_category'],
            'where' => ['status' => "1", 'id_category' => 1],
            'limit' => '1'
        ])[0];

//        echo '<pre>';
//        print_r($db);
//        echo '</pre>';
        exit('I am admin panel' . '</br>' . 'id = ' . $res['id_category'] . ' Name category = ' . $res['name_category']);

        $categories = array();
        $categories = Category::getCategories();

        $data = array();
        $latestProducts = array();
        $latestProducts = Home::getLatestProducts();

//        echo '</br>actionIndex->getPromotionalOffers</br>';
//        echo '<pre>';
//        print_r($latestProducts);
//        echo '</pre>';

        $data['latestProducts'] = $latestProducts;

        $promotionalOffers = array();
        $promotionalOffers = Home::getPromotionalOffers();

        $data['promotionalOffers'] = $promotionalOffers;

        $recommendedProducts = array();
        $recommendedProducts = Home::getRecommendedProducts();

        $data['recommendedProducts'] = $recommendedProducts;

//        require_once(ROOT . '/resources/views/index.php');
        return true;
    }
}

//require_once 'resources/views/layouts/footer.php';
