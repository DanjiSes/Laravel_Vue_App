<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoriesController extends Controller
{
  public function getTree(Request $request)
  {
    $categories = Category::all();

    if(boolval($request->input('list'))) {
      return response()->json($categories);
    }

    return response()->json($this->buildTreeArray($categories));
  }

  public function buildTreeArray($arItems) {
    $childs = [];

    foreach($arItems as &$item) {
      if(!$item->parent_id) {
        $item->parent_id = 0;
      }
      $childs[$item->parent_id][] = &$item;
    }
    unset($item);
    foreach($arItems as &$item) {
      if (isset($childs[$item->id])) {
        $item->childs = $childs[$item->id];
      }
    }
    return $childs[0];
  }

  public function add(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'parent_id' => 'integer|nullable'
    ]);

    $parent_id = $request->input('parent_id');
    $name = $request->input('name');

    if(boolval($parent_id)) {

      $category = Category::findOrFail($parent_id)->children()->create(['name' => $name]);
      return response()->json($category);

    }

    $category = Category::create(['name' => $name]);

    return response()->json($category);
  }
}
