<?php

namespace App\View\Components;

use Roots\Acorn\View\Component;

class Mailto extends Component
{
    public $mail;

    public function __construct($mail)
    {
        $this->mail = $this->stringToASCII($mail);
    }

    public function render()
    {
        return $this->view('components.mailto');
    }

    protected function stringToASCII($string)
    {
        $output = '';
        $length = strlen($string);

        for ($i = 0; $i < $length; $i++) {
            $output .= '&#' . ord($string[$i]) . ';';
        }

        return $output;
    }
}
