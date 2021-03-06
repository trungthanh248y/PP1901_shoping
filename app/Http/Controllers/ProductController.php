<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with
        (
            [
                'event' => function ($query) {
                    $query->select(['id', 'name']);
                },
                'category' => function ($query) {
                    $query->select(['id', 'name']);
                }
            ]
        )->get()->toArray();

        return view('products.home', compact('products'));
    }

    public $categories;
    public $events;

    public function __construct()
    {
        $this->categories = Category::all();
        $this->events = Event::all();
    }

    public function create()
    {
        $categories = $this->categories;
        $events = $this->events;
        return view('products.add', compact('categories', 'events'));
    }

    public function store(Request $request)
    {
        $categories = $this->categories;
        $events = $this->events;
        $product = new Product();
        $product->name = $request->get('name');
        $product->description = $request->get('description');
        $product->unit_price = $request->get('unit_price');
        $product->id_category = $request->get('id_category');
        $product->id_category = $request->get('id_category');
        $product->id_category = $request->get('id_category');
        $product->id_event = $request->get('id_event');
        $mess = "";
        if ($product->save()) {
            $mess = "Success add new";
        }

        return view('products.add', compact('categories', 'events'))->with('mess', $mess);
    }

    public function edit($id)
    {
        $categories = $this->categories;
        $events = $this->events;
        $product = Product::find($id);
        return view('products.edit', compact('categories', 'product', 'events'));
    }

    public function update(Request $request, $id)
    {
        $categories = $this->categories;
        $events = $this->events;
        $product = Product::find($id);
        $product->name = $request->get('name');
        $product->description = $request->get('description');
        $product->unit_price = $request->get('unit_price');
        $product->id_category = $request->get('id_category');
        $product->id_event = $request->get('id_event');
        $mess = "";
        if ($product->save()) {
            $mess = "Success edit";
        }

        return view('products.edit', compact('categories', 'product', 'events'))->with('mess', $mess);
    }

    public function delete(Request $request)
    {
        $product = Product::find($request->get('product_id'));
        $product->delete();
        return redirect()->route('indexProduct')->with('mes_del', 'Delete success');
    }
}

