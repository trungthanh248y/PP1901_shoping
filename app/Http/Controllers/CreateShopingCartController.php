<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Mail\SendEmail;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Bill;
Use App\Bill_Detail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CreateShopingCartController extends Controller
{
    //
    public function getAddtoCart(Request $request, $id)
    {
        DB::transaction(function (Request $request, $id){
            try{
                $product = Product::find($id);
                $oldCart = Session('cart') ? Session::get('cart') : null;
                $cart = new Cart($oldCart);
                $cart->add($product, $id);
                $request->session()->put('cart', $cart);
                DB::commit();
            }
            catch (\Exception $e){
                DB::rollback();
            }
        });
        return redirect()->back();
    }

    public function getDelItemCart($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->back();
    }

    public function getCheckout()
    {

        return view('ShoppingCart.order');
    }

    public function postCheckout(Request $request)
    {
        $cart = Session::get('cart');

        if (Auth::user()->id && count($cart->items)) {
            $bill = new Bill();
            $bill->id_user = Auth::user()->id;
            $bill->total = $cart->totalPrice;
            $bill->status = $request->status;
            $bill->payment = $request->payment;
            $bill->created_at = date('Y-m-d H:i:s');
            $bill->updated_at = date('Y-m-d H:i:s');
            if ($bill->save()) {
                $mess = "{{ __('Đặt hàng thành công') }}";
                foreach ($cart->items as $k => $v) {
                    $bill_detail = new Bill_Detail();
                    $bill_detail->id_bill = $bill->id;
                    $bill_detail->id_product = $k;
                    $bill_detail->quantity = $v['qty'];
                    $bill_detail->save();
                }
                Mail::to(Auth::user()->email)->send(new SendEmail($bill));
                Session::forget('cart');

                return redirect()->route('welcome')->with('mess',$mess);
            }
        }
    }
}
