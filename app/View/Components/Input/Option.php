<?php

namespace App\View\Components\Input;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Option extends Component
{
    public function __construct(
        public $id       = '',
        public $class    = '',
        public $index    = '',
        public $col      = 'col-md-6',
        public $name     = '',
        public $type     = 'text',
        public $value    = '',
        public $label    = '',
        public $required = false,
        public $disabled = false,
        public $hidden   = false,
        public $multiple = false,
        public $readonly = false,
        public $choose   = true,
        public $all      = false,
        public $invalid  = '',
        public $lists    = [],
        public $old      = [],
        public $keywords = '',
        public $placeholder = '',
    ) {
        $this->id      = $this->id ? $id : $this->convertToDotNotation($name, $index);
        $this->invalid = $this->invalidCheck($name, $index);
        $this->old     = $this->invalidCheck($name, $index);
    }

    public function render(): View | Closure | string
    {
        //dd(request()->old());
        if (old('meta_keywords')) {
            
            //dd(old('meta_keywords'), $this->old, old($this->old));
        }
            
            //dd($this->old, old($this->old), old('meta_keywords'));

        return view('components.input.option');

    }//end of render

    public function containsBrackets(string $string) 
    {
        return strpos($string, '[') !== false && strpos($string, ']') !== false;

    }//end of render

    public function invalidCheck(string $name, string | int | bool $index = false)
    {
        if ($this->containsBrackets($name)) {

            $name = str_replace(['[', ']'], ['.',''], $name) . $index;
            $name = rtrim($name, '.');
        } 

        return $name;

    }//end of fun

    public function convertToDotNotation(string $name, $index = false)
    {
        $name = str_replace(['[', ']'], ['-',''], $name) . $index;
        $name = str_replace('_', '-', $name) . $index;
        $name = rtrim($name, '-');

        return $name;

    }//end of fun

}//end of class