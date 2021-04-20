<?php
namespace App\Model;

use App\Helper\Security;

class FormRequest
{
    /**
     * [GET, POST, DELETE]
     * @var String
     */
    private $method;

    private $name;

    private $content;

    private $categories;

    private $type;

    private $created_at; 
    
    public function __construct(String $method = 'POST') {
        $this->method = $method;
        $this->created_at = new DateTime();
    }

    public function formBuilder()
    {
       $formatedForm = formData();
    }

    public function formData(String $name, String $content, Array $categories, DateTime $created_at, $type): Array
    {
        $this->name =formatInput($name);
        $this->content =formatInput($content);
        foreach($categories as $category){
            $this->categories[] .= formatInput($category);
        };
        $this->created_at =formatInput($created_at);
        return $data;
    }
    
    private function deleteToken(): Bool
    {
        if($this->method === 'DELETE'){
            //Check if the token exist
            return TRUE;
        }
        return FALSE;
    }
}