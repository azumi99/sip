<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use Illuminate\Contracts\Session\Session as SessionSession;
use Redirect;
use Session;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::get();
        $data = array(
            'category' => $category,
        );
        return view('category/index', $data);
    }
    public function create()
    {
        return view('category/create');
    }

    public function store(Request $request)
    {
        $rules = [
            'kategori' => 'required',
            'status' => 'required'
        ];

        $message = [
            'kategori.required'     => 'Nama kategori tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return redirect('category/create')->withErrors($validator);
        }

        $category   = new \App\Models\Category;
        $category->name   = $request->input('kategori');
        $category->status  = $request->input('status');
        $category->save();

        Session::flash('message', 'Kategori berhasil ditambahkan');
        return redirect('category');
    }

    public function show($id)
    {
        $category = Category::find($id);
        $data = array(
            'category' => $category,
        );
        return view('category/show', $data);
    }
    public function edit($id)
    {
        $category = Category::find($id);
        $data = array(
            'category' => $category,
        );
        return view('category/edit', $data);
    }
    public function update(Request $request, $id)
    {
        $rules = [
            'kategori' => 'required',
            'status' => 'required'
        ];

        $message = [
            'kategori.required'     => 'Nama kategori tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return redirect('category/create')->withErrors($validator);
        }

        $category   = Category::find($id);
        $category->name   = $request->input('kategori');
        $category->status  = $request->input('status');
        $category->save();

        Session::flash('message', 'Kategori berhasil di edit');
        return redirect('category');
    }
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        Session::flash('message', 'Kategori berhasil dihapus');
        return redirect('category');
    }
}
