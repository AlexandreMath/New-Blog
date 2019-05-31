<?php
namespace App\Controller;

use App\Connection;
use App\URL;
use \PDO;

class PaginatedQuery
{
    private $query;
    private $nbResult;
    private $pdo;
    private $elements;
    private $nbPost;
    private $items;

    public function __construct(String $query, String $nbResult, ?\PDO $pdo = null, Int $elements = 12) {
        $this->query = $query;
        $this->nbResult = $nbResult;
        $this->pdo = $pdo ?: Connection::getPDO();
        $this->elements = $elements;
    }

    public function getItems(string $classMapping): array
    {
        if($this->items === NULL){
            $currentPage = $this->getCurrentPage();
            $pages = $this->getPages();
            if($currentPage > $pages){
                throw new \Exception('Cette page n\'existe pas');
            }
            $offset = $this->elements * ($currentPage - 1);

            $this->items = $this->pdo->query($this->query . " DESC LIMIT {$this->elements} OFFSET $offset")
                    ->fetchAll(PDO::FETCH_CLASS, $classMapping);
        }
        return $this->items;
    }

    public function previousLink(string $link): ?string
    {
        $currentPage = $this->getCurrentPage();
        if($currentPage <= 1){return NULL;}
        if($currentPage > 2){$link .= '?page=' . ($currentPage - 1);}
        return  "<a href=" . $link . " class='uw-button'>&laquo;</a>";
    }
    public function nextLink(string $link): ?string
    {
        $currentPage = $this->getCurrentPage();
        $pages = $this->getPages();
        if($currentPage >= $pages){return NULL;}
        $link .= '?page=' . ($currentPage + 1);
        return "<a href=". $link . " class='uw-button'>&raquo;</a>";
    }

    private function getCurrentPage(): int
    {
        return URL::getPositiveInt('page', 1);
    }
    private function getPages(): int
    {
        if($this->nbPost === NULL){
            $this->nbPost = (int)$this->pdo->query($this->nbResult)->fetch(PDO::FETCH_NUM)[0];
        }
        return ceil($this->nbPost / $this->elements);
    }     
}