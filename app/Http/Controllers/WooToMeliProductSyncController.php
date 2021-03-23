<?php

namespace App\Http\Controllers;

use App\Adapters\MeliEnvironmentAdapter;
use App\Http\Requests\WoocommerceProductRequest;
use App\Jobs\WooToMeliProductSync;
use Dsc\MercadoLivre\Meli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WooToMeliProductSyncController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param WoocommerceProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(WoocommerceProductRequest $request)
    {
        /**
         * TODO: Definir como sera efetuado o recebimento da requisicao (o usuario precisa ser autenticado)
         */
        $meli = new Meli(
            env('MELI_ID'),
            env('MELI_SECRET'),
            new MeliEnvironmentAdapter(Auth::id())
        );

        WooToMeliProductSync::dispatch($meli, $request)->delay(now()->addMinutes(5));

        return response(null);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
