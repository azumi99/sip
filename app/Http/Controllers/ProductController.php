<?php

namespace App\Http\Controllers;

use App\Models\Pruduct;

use App\Models\Category;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Redirect;
use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('status', 'active')->pluck('name', 'id');
        $paginate = 5;
        $product = new Pruduct;

        $product = $product
            ->select('category.name as category_name', 'pruducts.*')
            ->join('category', 'pruducts.category_id', '=', 'category.id');
        if (!empty(request('category_id'))) {
            $product = $product->where('category_id', request('category_id'));
        }
        if (!empty(request('keyword'))) {
            $product = $product->orWhere('pruducts.name', 'LIKE', "%" . request('keyword') . "%");
        }

        $product = $product->paginate($paginate);
        return view('product.index', compact('product', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        $data = array(
            'categories' => $categories,
        );
        return view('product.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'category_id'   => 'required',
            'name'          => 'required',
            'price'         => 'required',
            'sku'           => 'required',
            'status'        => 'required',
            'description'   => 'required',
            'image'         => 'required|mimes:jpg,png,jpeg,gif'
        ];
        $messege = [
            'category_id.required'   => 'Kategori wajib di isi',
            'name.required'          => 'Nama wajib di isi',
            'price.required'         => 'Price wajib di isi',
            'sku.required'           => 'SKU wajib di isi',
            'status.required'        => 'Status wajib di isi',
            'description.required'   => 'Description wajib di isi',
            'image.required'         => 'Gambar wajib di isi jpg,png,jpeg,gif',
            'image.mimes'             => 'Gambar wajib di isi jpg,png,jpeg,gif'
        ];
        $validator = Validator::make($request->all(), $rules, $messege);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $product                = new \App\Models\Pruduct;
        $product->category_id   = $request->category_id;
        $product->name          = $request->name;
        $product->price         = $request->price;
        $product->sku           = $request->sku;
        $product->status        = $request->status;
        $product->description   = $request->description;

        $image = $request->file('image')->store('uplouds', 'public');

        $product->image         = $image;
        $product->save();

        Session::flash('messege', 'Data produk behasil disimpan');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Pruduct::select('category.name as category_name', 'pruducts.*')
            ->join('category', 'pruducts.category_id', "=", 'category.id')
            ->where('pruducts.id', $id)->first();

        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Pruduct::select('category.name as category_name', 'pruducts.*')
            ->join('category', 'pruducts.category_id', "=", 'category.id')
            ->where('pruducts.id', $id)->first();

        $categories = Category::pluck('name', 'id');

        return view('product.edit', compact('product', 'categories'));
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
        $rules = [
            'category_id'   => 'required',
            'name'          => 'required',
            'price'         => 'required',
            'sku'           => 'required',
            'status'        => 'required',
            'description'   => 'required',
            'image'         => 'mimes:jpg,png,jpeg,gif'
        ];
        $messege = [
            'category_id.required'   => 'Kategori wajib di isi',
            'name.required'          => 'Nama wajib di isi',
            'price.required'         => 'Price wajib di isi',
            'sku.required'           => 'SKU wajib di isi',
            'status.required'        => 'Status wajib di isi',
            'description.required'   => 'Description wajib di isi',
            'image.required'         => 'Gambar wajib di isi jpg,png,jpeg,gif',
            'image.mimes'             => 'Gambar wajib di isi jpg,png,jpeg,gif'
        ];
        $validator = Validator::make($request->all(), $rules, $messege);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $product                = Pruduct::find($id);
        $product->category_id   = $request->category_id;
        $product->name          = $request->name;
        $product->price         = $request->price;
        $product->sku           = $request->sku;
        $product->status        = $request->status;
        $product->description   = $request->description;

        if (!empty($request->file('image'))) {
            $image = $request->file('image')->store('uplouds', 'public');

            $product->image         = $image;
        }

        $product->save();

        Session::flash('messege', 'Data produk behasil disimpan');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Pruduct::where('id', $id)->first();
        unlink('storage/' . $product->image);

        $product->delete();
        Session::flash('messege', 'Data berhasil di hapus.');
        return redirect()->back();
    }
}
