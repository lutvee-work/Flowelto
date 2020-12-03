<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Products;
use App\Flowers;
use App\History;
use App\HistoryDetail;

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

    public function categories(){
        $products = Products::all();
        return view('manageCategories', compact('products'));
    }

    public function cart() {
        
        $carts = json_decode(request()->cookie('carts'), true);

        $subtotal = collect($carts)->sum(function($q) {
            return $q['quantity'] * $q['price']; 
        });
        
        return view('cart', compact('carts', 'subtotal'));
    }

    public function history() {
        $user = Auth::user()->id;

        $history = DB::table('histories')
                    ->where('user_id', $user)
                    ->orderBy('id', 'DESC')->get();
        
        return view('history', compact('history'));
    }

    public function changePasswordView(){
        return view('changePassword');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout()
    {
        $carts = json_decode(request()->cookie('carts'), true);

        $subtotal = collect($carts)->sum(function($q) {
            return $q['quantity'] * $q['price']; 
        });

        $user = Auth::user()->id;
        
        $history = new History();
        $history->user_id = $user;
        $history->total_price = $subtotal;
        $history->save();

        $historyId = $history->id;
        foreach($carts as $c => $val) {
            $historyDetail = new HistoryDetail();
            $historyDetail->history_id = $historyId;
            $historyDetail->flower_id = $val['id'];
            $historyDetail->quantity = $val['quantity'];
            $historyDetail->subtotal = $val['price'] * $val['quantity'];
            $historyDetail->save();
            unset($carts[$c]);
        }

        $carts = array_values($carts);

        $cookie = cookie('carts', json_encode($carts), 10080);

        return back()->cookie($cookie)->with('success', 'Checkout Successfully');
        
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

    public function addToCart(Request $request) {

        $this->validate($request, [
            'id' => 'required|exists:flowers,id',
            'quantity' => 'required|integer'
        ]);
        
        $carts = json_decode($request->cookie('carts'), true);
        
        if ($carts && array_key_exists($request->id, $carts)) {
            $carts[$request->id]['quantity'] += $request->quantity;
        } else {
        
            $flowers = Flowers::find($request->id);
            
            $carts[$request->id] = [
                'quantity' => $request->quantity,
                'id' => $flowers->id,
                'name' => $flowers->name,
                'price' => $flowers->price,
                'image' => $flowers->image
            ];
        }

        $cookie = cookie('carts', json_encode($carts), 10080);

        return redirect()->back()->cookie($cookie)->with('success', 'Flower Successfully Add to Cart');
    }

    public function updateCart(Request $request) {
        
        $carts = json_decode(request()->cookie('carts'), true);
        $id = $request->id;
        $quantity = $request->quantity;
        $quantity = implode("",$quantity);
        
        if($quantity == 0) {
            unset($carts[$id]);
        } else {
            $carts[$id]['quantity'] = $quantity;
        }
        
        $cookie = cookie('carts', json_encode($carts), 10080);
        
        return redirect()->back()->cookie($cookie)->with('success', 'Cart Successfully Updated');
    }

    public function changePassword(Request $request) {

        $check = Hash::check($request->your_password, auth()->user()->password);

        $this->validate($request, [
            'your_password' => 'required:$check',
            'new_password' => 'required|min:8',
            'new_confirm_password' => 'required|same:new_password',
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        return back()->with('success', 'Password Successfully Updated');

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

    public function search(Request $request, $id) {

        $products = Products::find($id);

        $search = $request->search;

        // belom pake filter name blabla
        
        $flowers = DB::table('flowers')
                        ->where('product_id', $id)
                        ->where('name','like',"%".$search."%")
                        ->paginate(8);
        
        $data = [
            'flowers' => $flowers,
            'products' => $products,
            'search' => $search
        ];
        return view('search', compact('data'));
    }

    public function detail($id)
    {
        $data = Flowers::find($id);
        return view('detail', compact('data'));
    }

    public function historyDetail($id) {

        $history = History::find($id);
        $totalPrice = $history->total_price;

        $historyDetail = DB::table('history_details')
                            ->join('flowers', 'history_details.flower_id', '=', 'flowers.id')
                            ->where('history_details.history_id',$id)
                            ->get();

        $data = [
            'totalPrice' => $totalPrice,
            'historyDetail' => $historyDetail
        ];

        return view('historyDetail', compact('data'));
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

    public function editCategories($id)
    {
        $data = Products::find($id);
        return view('editCategories', compact('data'));
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

        $this->validate($request, [
            'product_id' => 'required',
            'name' => 'required|unique:flowers|min:5',
            'price' => 'required|numeric|min:50000',
            'description' => 'required|min:20',
            'image' => 'nullable',
        ]);

        $flowers = Flowers::find($id);

        $flowers->product_id = $request->input('product_id');
        $flowers->name = $request->input('name');
        $flowers->price = $request->input('price');
        $flowers->description = $request->input('description');
        
        if (request()->hasFile('image')) {

            $image = $request->file('image');
            $source = 'images';
            $image->move($source,$image->getClientOriginalName());
            $flowers->image = $image->getClientOriginalName();
        }

        $flowers->save();
        
        return redirect('/manager')->with('success', 'Flower Updated!');
    }

    public function updateCategories(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required|unique:products|min:5',
            'image' => 'nullable',
        ]);

        $products = Products::find($id);

        $products->name = $request->input('name');
        
        if (request()->hasFile('image')) {
            $image = $request->file('image');
            $source = 'images';
            $image->move($source,$image->getClientOriginalName());
            $products->image = $image->getClientOriginalName();
        } else {
            $products->image = null;
        }

        $products->save();
        
        return back()->with('success', 'Category Updated!');
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
        return redirect('/manager')->with('success', 'Flower deleted!');
    }

    public function destroyCategories($id)
    {
        Products::destroy($id);
        return redirect('/categories')->with('success', 'Category deleted!');
    }

    public function destroyTransaction($id)
    {
        HistoryDetail::where('history_id',$id)->delete();
        History::destroy($id);
        return redirect('/history')->with('success', 'History deleted!');
    }
}
