<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    public function index(Request $request)
    {

        $products = Product::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('name', '%' . $request->search . '%');
        })->when($request->category_id, function ($query) use ($request) {
            return $query->where('category_id', $request->category_id);
        })->paginate(5);

        $categories = Category::all();
        return view('Dashboard.Product.index', compact('products', 'categories'));
    }


    public function filter(Request $request)
    {
        return $products = Product::when($request->name, function ($q) use ($request) {
            return $q->whereTranslationLike('name', '%' . $request->name . '%');
        })->when($request->category_id, function ($query) use ($request) {
            return $query->where('category_id', $request->category_id);
        })->when($request->desc, function ($q) use ($request) {
            return $q->whereTranslationLike('description', '%' . $request->desc . '%');
        })->get();
    }

    public function create()
    {
        $categories = Category::all();
        return view('Dashboard.Product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        //return $request->all();

        $rules = [
            'category_id' => 'required',
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.name' => ['required ', 'unique:product_translations,name']];
            $rules += [$locale . '.description' => ['required ', 'unique:product_translations,description']];
        }

        $request->validate($rules);
        Product::create($request->all());
        session()->flash('success', _('site.added_success'));
        return redirect()->route('dashboard.products.index');
    }


    public function edit(Product $product)
    {
        // return $product;
        $categories = Category::all();
        return view('Dashboard.Product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        $rules = [
            'category_id' => 'required',
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.name' => ['required ',  Rule::unique('product_translations', 'name')->ignore($product->id, 'product_id')]];
            $rules += [$locale . '.description' => ['required ', Rule::unique('product_translations', 'description')->ignore($product->id, 'product_id')]];
        }

        $request->validate($rules);
        $product->update($request->all());
        session()->flash('success', _('site.updated_success'));
        return redirect()->route('dashboard.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {

        $product->delete();
        session()->flash('success', __('site.deleted_success'));
        return redirect()->route('dashboard.products.index');
    }
}
