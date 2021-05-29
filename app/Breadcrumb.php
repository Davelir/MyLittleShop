<?php

namespace App;


class Breadcrumb
{
    public $items;

    public function addItem($name, $link = ''){
        $this->items[] = [
            'name' => $name,
            'link' => $link
        ];
    }
}
