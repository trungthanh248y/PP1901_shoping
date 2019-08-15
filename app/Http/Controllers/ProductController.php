<?php

namespace App\Http\Controllers;

use App\Contracts\ProductRepositoryInterface;
use App\Event;
use App\Image;
use Illuminate\Http\Request;
use App\Repositories\Eloquents\ProductRepositoryIn;
use App\Product;
use App\Category;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->getAll();

        return view('products.home', compact('products'));
    }

    public function create()
    {
        $categories = $this->productRepository->allCategory();
        $events = $this->productRepository->allEvent();

        return view('products.add', compact('categories', 'events'));

    }

    public function store(Request $request)
    {
        $categories = $this->productRepository->allCategory();
        $events = $this->productRepository->allEvent();

        $mess = "";
        $image = $request->file;
        if (count($image) != 0) {
            $arr['name'] = $request->get('name');
            $arr['description'] = $request->get('description');
            $arr['unit_price'] = $request->get('unit_price');
            $arr['id_category'] = $request->get('id_category');
            $arr['id_event'] = $request->get('id_event');
            $id = $this->productRepository->create($arr)->id;
            if ($id) {
                foreach ($image as $k => $v) {
                    $this->productRepository->storeProductImage($v, $id);
                }
                $mess = "{{ __('Success add new') }}";
            }
        }
        return view('products.add', compact('categories', 'events'))->with('mess', $mess);
    }

    public function edit($id)
    {
        $categories = $this->productRepository->allCategory();
        $events = $this->productRepository->allEvent();
        $product = $this->productRepository->find($id);

        return view('products.edit', compact('categories', 'product', 'events'));
    }

    public function update(Request $request, $id)
    {
        $categories = $this->productRepository->allCategory();
        $events = $this->productRepository->allEvent();
        $product = $this->productRepository->find($id);

        $mess = "";

        $image = $request->file;
        if (count($image) != 0) {
            $arr['name'] = $request->get('name');
            $arr['description'] = $request->get('description');
            $arr['unit_price'] = $request->get('unit_price');
            $arr['id_category'] = $request->get('id_category');
            $arr['id_event'] = $request->get('id_event');
            $product_id = $this->productRepository->update($id, $arr)->id;
            if ($product_id) {
                $this->productRepository->deleteProductImage($id);
                foreach ($image as $k => $v) {
                    $this->productRepository->storeProductImage($v, $product_id);
                    $mess = "{{ __('Success edit') }}";
                }

                return view('products.edit', compact('categories', 'product', 'events'))->with('mess', $mess);
            }
        }
    }

    public function delete(Request $request)
    {
        $product_id = $request->get('product_id');
        if($this->productRepository->delete($product_id))
        {
            $this->productRepository->deleteProductImage($product_id);
        }

        return redirect()->route('indexProduct')->with('mes_del', "{{ __('Delete success') }}");
    }
}
