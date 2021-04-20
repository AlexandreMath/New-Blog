<?php
namespace App\HTML;

class Form
{
    private $data;

    private $errors;

    public function __construct($data, Array $errors)
    {
        $this->data = $data;
        $this->errors = $errors;
    }

    public function input(string $key, string $label): string
    {   
        return <<<HTML
             <div class="uw-section">
                <label class="uw-large" for="field{$key}">{$label}</label>
                <input type="text" name="{$key}" id="field{$key}" class="{$this->getInputClass($key)}" value="{$this->getValue($key)}" required>
            </div>
            {$this->getErrorFeedback($key)}   
HTML;
    }

    public function textarea(string $key, string $label): string
    {
        return <<<HTML
             <div class="uw-section">
                <label class="uw-large" for="field{$key}">{$label}</label>
                <textarea type="text" name="{$key}" id="field{$key}" class="{$this->getInputClass($key)}" >{$this->getValue($key)}</textarea>
            </div>
            {$this->getErrorFeedback($key)}   
HTML;
    }

    private function getValue(string $key): string
    {
        if(is_array($this->data)){
            return $this->data[$key] ?? NULL;
        }
        $method = 'get' . str_replace(' ', '', ucwords('_',' ',$key));
        $value = $this->data->$method();
        if($value instanceof \DateTimeInterface){
            return $value->format('Y-m-d H:i:s');
        }
        return $value;
    }

    private function getInputClass(string $key): string
    {
        $inputClass = "uw-input uw-border uw-round";
        if(isset($this->errors[$key])){
            $inputClass .= ' uw-border-red'; 
        }
        return $inputClass;
    }

    private function getErrorFeedback(string $key): string
    {
        if(isset($this->errors[$key])){
            return '<div class="invalid-feedback">' . implode('<br>', $this->errors[$key]) . '</div>';
        }
        return '';
    }
}
?>