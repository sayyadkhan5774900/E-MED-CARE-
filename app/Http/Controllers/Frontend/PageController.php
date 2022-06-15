<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function doctors()
    {
        return view('frontend.doctors');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function checkout()
    {
        return view('frontend.checkout');
    }

    public function shop()
    {
        return view('frontend.shop');
    }

    public function shopSingle()
    {
        return view('frontend.shop-single');
    }

    public function cart()
    {
        return view('frontend.cart');
    }

    public function thankyou()
    {
        return view('frontend.thankyou');
    }
}

