<?php

namespace App\Http\Controllers;

use App\Event;
use App\Image;
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
                'images' => function ($query) {
                    $query->select(['id_product', 'name']);
                },
                'category' => function ($query) {
                    $query->select(['id', 'name']);
                }]
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

        $imageis = Product::with(['images' => function ($query) {
            $query->select(['id_product', 'name']);
        }])->get()->toArray();


        $image = $request->file;
        if (count($image) != 0) {
            $product = new Product();
            $product->name = $request->get('name');
            $product->description = $request->get('description');
            $product->unit_price = $request->get('unit_price');
            $product->id_category = $request->get('id_category');

            $product->id_event = $request->get('id_event');

            $mess = "";
            if ($product->save()) {
                foreach ($image as $k => $v) {
                    $images = new Image();

                    $filename = $v->getClientOriginalName();
                    $location = $v->move(public_path() . '/images/', $filename);

                    $images->name = $filename;
                    $images->id_product = $product->id;
                    $images->save();
                }
                $mess = "{{ __('Success add new') }}";
            }
            return view('products.add', compact('categories', 'events'))->with('mess', $mess);
        }
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

        $mess = "";

        $image = $request->file;
        if (count($image) != 0) {

            $product = Product::find($id);
            $product->name = $request->get('name');
            $product->description = $request->get('description');
            $product->unit_price = $request->get('unit_price');
            $product->id_category = $request->get('id_category');
            $product->id_event = $request->get('id_event');

            if ($product->save()) {

                $images = Image::where('id_product', $id)->delete();

                foreach ($image as $k => $v) {

                    $images = new Image();

                    $filename = $v->getClientOriginalName();
                    $location = $v->move(public_path() . '/images/', $filename);

                    $images->name = $filename;
                    $images->id_product = $product->id;
                    $images->save();
                    $mess = "{{ __('Success edit') }}";
                }

                return view('products.edit', compact('categories', 'product', 'events'))->with('mess', $mess);
            }
        }
    }

    public function delete(Request $request)
    {
        $product = Product::find($request->get('product_id'));
        if($product->delete()){
            $images = Image::where('id_product',$request->get('product_id'))->delete();
        }

        return redirect()->route('indexProduct')->with('mes_del', "{{ __('Delete success') }}");
    }


    public function ProductAllWelcome()
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

        return view('welcome', compact('products'));
    }
}

