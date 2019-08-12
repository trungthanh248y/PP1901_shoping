<?php

namespace App\Repositories\Eloquents;


use App\Category;
use App\Contracts\ProductRepositoryInterface;
use App\Event;
use App\Image;
use App\Product;
use App\Repositories\Eloquents\ElequentRepository;

class ProductRepositoryIn extends ElequentRepository implements ProductRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return Product::class;
    }

    public function allEvent()
    {
        return Event::all();
    }

    public function allCategory()
    {
        return Category::all();
    }

//    public function storeProduct($arr)
//    {
//        if (count($arr) != 0) {
//            $product = new Product();
//            $product->name = $arr['name'];
//            $product->description = $arr['description'];
//            $product->unit_price = $arr['unit_price'];
//            $product->id_category = $arr['id_category'];
//            $product->id_event = $arr['id_event'];
//
//            if ($product->save()) {
//                return $product->id;
//            } else {
//                return false;
//            }
//        } else {
//            return false;
//        }
//    }

    public function storeProductImage($v, $product_id)
    {
        $images = new Image();//phải tạo ảnh ở đây vì với mỗi ảnh cần lưu vào hàng, nếu k có thì nó sẽ ghi đè lên

        $filename = $v->getClientOriginalName();
        $location = $v->move(public_path() . '/images/', $filename);

        $images->name = $filename;
        $images->id_product = $product_id;
        return $images->save();
    }

//    public function updateProduct($arr, $id)
//    {
//        if (count($arr) != 0) {
//            $product = Product::find($id);
//            $product->name = $arr['name'];
//            $product->description = $arr['description'];
//            $product->unit_price = $arr['unit_price'];
//            $product->id_category = $arr['id_category'];
//            $product->id_event = $arr['id_event'];
//            if ($product->save()) {
//                return $product->id;
//            } else {
//                return false;
//            }
//        } else {
//            return false;
//        }
//    }



    public function deleteProductImage($id)
    {
        return Image::where('id_product', $id)->delete();
    }
}
