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

  public function sameContent($base, $new): bool
  {
    if ($base !== $new) {
      return TRUE;
    }
    return FALSE;
  }
}
