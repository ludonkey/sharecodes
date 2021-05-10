<?php

namespace Entity;

class Code
{
    public $id;
    public $title;
    public $desc;
    public $content;
    public $created_at;
    public Language $language;
    public User $user;
}
