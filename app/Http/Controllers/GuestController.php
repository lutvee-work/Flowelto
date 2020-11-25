<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Products;
use App\Flowers;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::all();
        return view('welcome', compact('products'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Products::find($id);
        $flowers = DB::table('flowers')->where('product_id', $id)->paginate(8);
        $data = [
            'flowers' => $flowers,
            'products' => $products
        ];
        // dd($data);
        return view('product', compact('data'));
    }

    public function detail($id)
    {
        $data = Flowers::find($id);
        return view('detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Flowers::find($id);
        $category = Products::all();
        return view('edit', compact('data','category'));
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
        $flowers = Flowers::find($id);
        $image = $request->file('image');
        $data = [
            'product_id' => $request->input('product_id'),
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'image' => $image->getClientOriginalName()
        ];
        // blom divalidasi 
        $flowers->update($data);
        $source = 'images';
        $image->move($source,$image->getClientOriginalName());
        return redirect('/manager');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Flowers::destroy($id);
        return redirect('/manager')->with('status', 'Flower deleted!');
    }
}
