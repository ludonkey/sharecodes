<?php

namespace Entity;

use ludk\Utils\Serializer;

class Language
{
    public $id;
    public $code;

    use Serializer;
}
