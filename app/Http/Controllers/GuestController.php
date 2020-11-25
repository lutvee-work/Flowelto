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

    public function add() {
        $category = Products::all();
        return view('addFlower', compact('category'));
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
        $this->validate($request, [
            'product_id' => 'required',
            'name' => 'required|unique:flowers|min:5',
            'price' => 'required|numeric|min:50000',
            'description' => 'required|min:20',
            'image' => 'required',
        ]);

        $image = $request->file('image');
        $source = 'images';
        $image->move($source,$image->getClientOriginalName());

        $flower = new Flowers();
        $flower->product_id = $request->product_id;
        $flower->name = $request->name;
        $flower->price = $request->price;
        $flower->description = $request->description;
        $flower->image = $image->getClientOriginalName();
        $flower->save();

        return back()->with('success', 'Flower Uploaded Successfully');
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

        $this->validate($request, [
            'product_id' => 'required',
            'name' => 'required|unique:flowers|min:5',
            'price' => 'required|numeric|min:50000',
            'description' => 'required|min:20',
            'image' => 'nullable',
        ]);

        $data = [
            'product_id' => $request->input('product_id'),
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
        ];
        
        if(isset($image)) {
            $source = 'images';
            $image->move($source,$image->getClientOriginalName());
            $image->save();
        }

        $flowers->update($data);
        
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
