<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Baum\Node;

class Category extends Node
{
  protected $fillable = ['name'];

  public function products()
  {
    return $this->hasMany(Product::class);
  }
}
