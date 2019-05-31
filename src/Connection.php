<?php
namespace App;

use \PDO;
use App\Model\{Category, Images, Post, User};

class Connection 
{
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost; dbname=php-blog', 'root','root', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        return $this->pdo;
    }
    
    public static function getPDO(): PDO
    {
        return new PDO('mysql:host=localhost; dbname=php-blog', 'root','root', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }

    public function loadUser(String $username, String $password)
    {
        $query = $this->pdo->prepare('SELECT * FROM user WHERE username=:username');
        $query->bindValue(':username', $username);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, User::class);
        return $query->fetch();
    }

    public function loadImages(Int $postId)
    {
        $query = $this->pdo->prepare('SELECT name, src FROM images WHERE post_id=:postId');
        $query->bindValue(':postId', $postId);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, Images::class);
        return $query->fetch();
    }
    /**
     * Recover multiple categories
     * @param Int $postId
     * @return void
     */
    public function loadCategories(Int $postId)
    {
        $query = $this->pdo->prepare('SELECT c.id, c.name, c.slug FROM post_category pc JOIN category c ON pc.category_id = c.id WHERE pc.post_id=:id');
        $query->bindValue(':id', $postId);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, Category::class);
        return $query->fetchAll();
    }
    public function loadPost(Int $id)
    {
        $query = $this->pdo->prepare('SELECT * FROM post WHERE id=:id');
        $query->execute(['id' => $id]);
        $query->setFetchMode(PDO::FETCH_CLASS, Post::class);
        /** @var POST|FALSE */
        return $query->fetch();
    }
    /**
     * Recover only one category
     * @param Int $id
     * @return void
     */
    public function loadCategory(Int $id)
    {
        $query = $this->pdo->prepare('SELECT * FROM category WHERE id=:id');
        $query->execute(['id' => $id]);
        $query->setFetchMode(PDO::FETCH_CLASS, Category::class);
        /** @var POST|FALSE */
        return $query->fetch();
    }
}
?>