<?php
namespace App\Controller\Admin;

use App\Connection;
use App\Model\Post;

class PostAdminController
{
    private $pdo;


    public function __construct() {
        $this->pdo = new Connection();
    }

    public function index(): Array
    {
        return $this->pdo->findAll();
    }

    public function new(String $name, String $content, Array $categories, DateTime $created_at)
    {
        $name = formatInput($name);
        $content = formatInput($content);
        $created_at = formatInput($created_at);

        $id = $this->pdo->addPost($name, $content, $created_at);
        if(gettype($id) === 'integer'){
            foreach($categories as $category){
                $category = formatInput($category);
                $existCat = $this->pdo->loadCategoryByName($category);
                if(empty($existCat)){
                    $this->pdo->addCategory($category, $id);
                }
                $this->pdo->addPostCategory($category->id, $id);
            };
            return TRUE;
        }
        return FALSE;
    }

    public function edit(Int $id, String $name, String $content, Array $categories, DateTime $created_at)
    {
        //NE PAS OUBLIER DE TEST ID
        $name = formatInput($name);
        $content = formatInput($content);
        $created_at = formatInput($created_at);
        $slug = $name;
        $result = $this->pdo->editPost($id, $name, $slug, $content, $created_at);
        if($result){
            foreach($categories as $category){
                $category = formatInput($category);
                $this->pdo->editCategory($category, $id);
            };
            header('Location: index.php');
        }
        return FALSE;
    }

    public function delete(Int $id): Bool
    {
        //supprime un article
    }
}