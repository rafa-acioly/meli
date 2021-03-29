<?php

namespace App\Http\Controllers;

use App\Adapters\MeliStorageAdapter;
use Dsc\MercadoLivre\AccessToken;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Auth::user()->products();
        $wooCredential = Auth::user()->credential;
        $meliCredential = (new MeliStorageAdapter(Auth::id()))->has(AccessToken::TOKEN);

        return view('products.index', [
            'products' => $products,
            'is_integrated' => ($wooCredential != null) && $wooCredential->isEnabled() && $meliCredential
        ]);
    }
}
