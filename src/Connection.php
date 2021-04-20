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
    public function loadCategories(array $ids)
    {
        $query = $this->pdo->prepare('SELECT * FROM post_category pc JOIN category c ON c.id = pc.category_id WHERE pc.post_id IN (' . implode(',', $ids) .')');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, Category::class);
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
    public function loadCategoryByName(String $name)
    {
        $query = $this->pdo->prepare('SELECT * FROM category WHERE name=:name');
        $query->execute(['name' => $name]);
        $query->setFetchMode(PDO::FETCH_CLASS, Category::class);
        return $query->fetch();
    }

    public function findAllCategory()
    {
        $query = $this->pdo->prepare("SELECT * FROM category");
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, Category::class);
        return $query->fetch();
    }

    public function findAllPost()
    {
        $query = $this->pdo->prepare("SELECT * FROM post ORDER BY created_at");
        $query->execute();
        return $query->fetchAll();
    }
    
    public function countAllEntry(string $field, string $table)
    {
        $query = $this->pdo->prepare("SELECT COUNT($field) FROM $table");
        $query->execute();
        return $query->fetch();
    }
    public function editPost(int $id, String $name, String $slug, String $content, DateTime $created_at)
    {
        $query = $this->pdo->prepare(' UPDATE post  SET name = :name, slug = :slug, content =:content, created_at = :created_at  WHERE id=:id');
        $query->bindValue(':name', $name, $slug,':slug',':content', $content,':created_at', $created_at,':id', $id);
        return $query->execute();
    }

    public function editCategory(String $name, Int $idPost)
    {
        $query = $this->pdo->prepare("UPDATE category JOIN post_category ON post_category.category_id = category.id SET name = :name,  WHERE post_category.post_id=:idPost");
        $query->bindValue(':name', $name, ':idPost', $idPost);
        return $query->execute();
    }
    
    public function addPost(String $name, string $slug, String $content, DateTime $created_at)
    {
        //ADD SLUG !
        $query = $this->pdo->prepare('INSERT INTO post (name, content, created_at) VALUE (:name, :content, :created_at)');
        $query->bindValue(':name', $name,':content', $content,':created_at', $created_at);
        $query->execute();
        $result = $this->pdo->lastInsertId();
        return $result;
    }

    public function addPostCategory(Int $categoryId, Int $postId)
    {
        $query = $this->pdo->prepare('INSERT INTO post_category (post_id, category_id) VALUE (:postId, :categoryId)');
        $query->bindValue(':postId', $postId,':categoryId', $categoryId);
        return $query->execute();
    }

    public function addCategory(String $name, string $slug, Int $postId): bool
    {
     //TODO : Insert in the category table and then get the id of the insert
        $query = $this->pdo->prepare(' INSERT INTO category (name,  slug) VALUE (:name, :slug)');
        $query->bindValue(':name', $name, ':slug', $slug);
        $query->execute();
        $categoryId = $this->pdo->lastInsertId();

        $query = $this->pdo->prepare('INSERT INTO post_category (post_id, category_id) VALUE (:postId, :categoryId)');
        $query->bindValue(':postId', $postId,':categoryId', $categoryId);
        return $query->execute();
     //After that insert the id in the post_category table 
    }

    public function insertImages($name, $src, $postId)
    {
        $query = $this->pdo->prepare(' INSERT INTO images (name,  src, post_id) VALUE (:name, :src, :postId)');
        $query->bindValue(':name', $name, ':src', $src, ':post_id', $postId);
        $result = $query->execute();
        if($result === FALSE){
            throw new Exception('Impossible de supprimer l\'enregistrement' . $id);
        }
        return $result;
    }

    public function delete(string $NameTable, Int $id)
    {
        $query = $this->pdo->prepare('DELETE FROM :NameTable WHERE id = :id');
        $query->bindValue(':id', $id, ':NameTable', $NameTable);
        $result = $query->execute();
        if($result === FALSE){
            throw new Exception('Impossible de supprimer l\'enregistrement' . $id);
        }
        return $result;
    }
}
?>