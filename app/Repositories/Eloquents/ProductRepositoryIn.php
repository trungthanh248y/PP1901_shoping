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

    public function storeProductImage($v, $product_id)
    {
        $images = new Image();//phải tạo ảnh ở đây vì với mỗi ảnh cần lưu vào hàng, nếu k có thì nó sẽ ghi đè lên

        $filename = $v->getClientOriginalName();
        $location = $v->move(public_path() . '/images/', $filename);

        $images->name = $filename;
        $images->id_product = $product_id;
        return $images->save();
    }

    public function deleteProductImage($id)
    {
        return Image::where('id_product', $id)->delete();
    }
}
