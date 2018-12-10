<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductsController extends Controller
{
  public function get(Request $request)
  {
    $request->validate([
      'category_id' => 'integer|nullable'
    ]);

    $id = $request->input('category_id');

    if(boolval($id)) {
      $products = Product::where('category_id', $id)->orderBy('id', 'desc')->get();
    } else {
      $products = Product::orderBy('id', 'desc')->get();
    }

    return response()->json($products);
  }

  public function add(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'descript' => 'required',
      'category_id' => 'integer|required',
      'image' => 'image|required'
    ]);

    $image = $request->file('image');
    $filename = str_random(10) . '.' . $image->extension();
    $data = $request->all();

    $image->storeAs('uploads/p/', $filename);

    $product = Product::create([
      'name' => $data['name'],
      'descript' => $data['descript'],
      'category_id' => $data['category_id'],
      'image' => 'uploads/p/' . $filename
    ]);

    return response()->json($product);
  }
}
