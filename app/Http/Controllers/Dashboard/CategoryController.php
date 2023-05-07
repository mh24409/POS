<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::when($request->search, function ($q) use ($request) {

            return $q->whereTranslationLike('name', '%' . $request->search . '%');
        })->latest()->paginate(25);
        return view('Dashboard.Categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Dashboard.Categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();

        $rules = [];
        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.name' => ['required ', 'unique:category_translations,name']];
        }
        $request->validate($rules);
        Category::create($request->all());
        session()->flash('success', _('site.added_success'));
        return redirect()->route('dashboard.categories.index');
    }


    public function edit(Category $category)
    {
        // return $category;
        return view('Dashboard.categories.edit', compact('category'));
    }
    public function update(Request $request, Category $category)
    {
        $rules = [];
        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.name' => ['required ',  Rule::unique('category_translations')->ignore($category->id, 'category_id')]];
        }
        $request->validate($rules);
        $category->update($request->all());
        session()->flash('success', __('site.updated_success'));
        return redirect()->route('dashboard.categories.index');
    }
    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('success', __('site.deleted_success'));
        return redirect()->route('dashboard.categories.index');
    }
}
