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

//        $res = $db->get($table, set: [
//            'fields' => ['id_category', 'name_category'],
//            'where' => ['status' => "1", 'id_category' => 1],
//            'limit' => '1'
//        ])[0];

        $table = 'cars';
//        $files['description'] = ["new_red.jpg", 'blue.jpg', 'black.jpg'];
//        $files['color'] = 'black';
//        $res = $db->add($table, set: [
////            'fields' => ['description' => 'Ford', 'title' => 'Mers', 'color' => 'green', 'type' => 'passenger', 'price' => 1200, 'updated_at' => '2022.12.26'],
//        ]);

//        $res = $db->showColumns($table);

        $files['description'] = ["new_red.jpg"];
        $files['color'] = 'white';

//        $res = $db->edit($table, [
//            'fields' => ['id' => 2, 'type' => 'passenger'],
//            'where' => ['id' => 1],
//            'files' => $files
//        ]);

//        $_POST['id'] = 3;
//        $_POST['title'] = 'Mazda';
//        $_POST['description'] = "<p>New' car</p>";

//        $query1 = "DELETE FROM cars WHERE id = 1";

//        $query2 = "DELETE category, products FROM cars
//                   LEFT JOIN products ON category.id = products.parent_id
//                   WHERE id = 1";

//        $res = $db->edit($table);

//        $res = $db->delete($table, [
//            'fields' => ['id', 'price'],
//            'where' => ['id' => 7]
//        ]);
//        $res = $db->edit($table, [
//            'fields' => ['price' => 1500],
//            'where' => ['id' => 7]
//        ]);

//        for ($i = 0; $i < 8; $i++) {
//            $s_id = $db->add('car', [
//                'fields' => ['title' => 'Auto-' . $i, 'description' => 'desc-' . $i],
//                'return_id' => true
//            ]);
//
//            $db->add('categories', [
//                'fields' => ['name_category' => 'Auto-' . $i, 'sort' => 'desc-' . $i]
//            ]);
//        }
//        for ($i = 0; $i < 8; $i++) {
//            $s_id = $db->add('cars', [
//                'fields' => [
//                    'title' => 'Auto-' . $i,
//                    'description' => 'desc-' . $i,
//                    'type' => 'passenger',
//                    'color' => 'white',
//                    'price' => $i + 1500
//                ]
//            ]);
//        }
        $res = $db->delete($table, [
            'where' => ['id' => 8]
        ]);
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
