<?php

// app/Models/Portfolio.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model {
    protected $fillable = ['title', 'description', 'image', 'link'];
}

// app/Models/Contact.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model {
    protected $fillable = ['name', 'email', 'message'];
}