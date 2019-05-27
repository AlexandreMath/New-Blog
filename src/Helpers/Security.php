<?php
namespace App\Helpers;

class Security
{
    public static function formatInput(string $data): string
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlentities($data);
        return $data;
      }
}
