<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{

    public function index()
    {
        // with(subCategories) can call all level of category_id
        // with(categories) can call one level of category_id
        $categories = Category::whereNull('category_id')
            ->with('subCategories')
            ->get();

        return view('admin.category.category', compact('categories'));
    }

    public function create()
    {

        return view('admin.category.create');
    }

    public function store(CategoryRequest $request)
    {

        $logo = $request->logo;
            $logoName = time() . '_' . $logo->getClientOriginalName();
            $logo->storeAs('category', $logoName, 'public');


        $image = $request->image;
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('category', $imageName, 'public');

        Category::create([
            'logo' => $logoName,
            'image' => $imageName,
            'name' => $request->name,
        ]);
        return redirect(Route('category.index'))->with('success', 'Category Created Successful');
    }

    public function edit($id)
    {

        $category = Category::findOrfail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {

        $category = Category::findOrfail($id);

        $logo = $request->logo;

        if ($logo) {
            $logo = $request->logo;
            $logoName = time() . '_' . $logo->getClientOriginalName();
            $logo->storeAs('category', $logoName, 'public');
        } else {
            $logoName = $category->logo;

        }
        $image = $request->image;
        if ($image) {
            $image = $request->image;
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('category', $imageName, 'public');
        } else {
            $imageName = $category->image;
        }
        $category->update([
            'logo' => $logoName,
            'image' => $imageName,
            'name' => $request->name,
        ]);
        return redirect(Route('category.index'))->with('success', 'Updated Successful');
    }

    // public function subCategoryList()
    // {
    //     // with(subCategories) can call all level of category_id
    //     // with(categories) can call one level of category_id
    //     $categories = Category::whereNull('category_id')
    //         ->with('subCategories')
    //         ->get();

    //     return view('admin.category.view', compact('categories'));
    // }

    public function subCategoryIndex($id)
    {
        $categories = Category::all();
        $cat = $id;
        $data = Category::where('category_id', $id)
            ->with('categories')
            ->get();

        return view('admin.category.subcategory', compact('data', 'cat', 'categories'));
    }

    public function subCategoryCreate($id)
    {
        $cat = $id;
        return view('admin.category.subcategory_create', compact('cat'));
    }

    public function subCategoryStore(CategoryRequest $request, $id)
    {

        $cat = $id;



        $logo = $request->logo;
            $logoName = time() . '_' . $logo->getClientOriginalName();
            $logo->storeAs('subcategory', $logoName, 'public');



        $image = $request->image;
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('subcategory', $imageName, 'public');



        Category::create([
            'logo' => $logoName,
            'image' => $imageName,
            'category_id' => $cat,
            'name' => $request->name,
        ]);
        return redirect(Route('subcategory.index', $cat))->with('success', 'SubCategory Created Successful');

    }

    public function subCategoryEdit($category, $id)
    {
        $cat = $category;
        $subcategory = Category::findOrFail($id);
        return view('admin.category.subcategory_edit', compact('cat', 'subcategory'));

    }

    public function subCategoryUpdate(Request $request, $cat, $id)
    {
        $this->validate(request(), [
            'name' => 'required',
        ]);
        $category_id = $cat;
        $category = Category::findOrfail($id);

        $logo = $request->logo;

        if ($logo) {
            $logo = $request->logo;
            $logoName = time() . '_' . $logo->getClientOriginalName();
            $logo->storeAs('subcategory', $logoName, 'public');
        } else {
            $logoName = $category->logo;

        }
        $image = $request->image;
        if ($image) {
            $image = $request->image;
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('subcategory', $imageName, 'public');
        } else {
            $imageName = $category->image;
        }
        $category->update([
            'logo' => $logoName,
            'image' => $imageName,
            'category_id' => $category_id,
            'name' => $request->name,
        ]);
        return redirect(Route('subcategory.index', $category_id))->with('success', 'Updated Successful');
    }

    public function subCategoryList()
    {
        $subcategories = Category::whereNotNull('category_id')->get();
        // $subcategories = Category::whereNotNull('category_id')
        // ->with('categories')
        // ->get();
        $categories = Category::all();

        // dd($subcategories);

        return view('admin.category.subcategory_list', compact('subcategories', 'categories'));
    }

    public function subCategoryCreateFromList()
    {
        $categories = Category::whereNull('category_id')
            ->with('subCategories')
            ->get();
        return view('admin.category.subcategory_list_create', compact('categories'));
    }

    public function subCategoryStoreFromList(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required',
            'logo'=>'required',
            'image'=>'required',
            'category_id'=>'required'
        ]);

        $logo = $request->logo;
            $logoName = time() . '_' . $logo->getClientOriginalName();
            $logo->storeAs('subcategory', $logoName, 'public');



        $image = $request->image;
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('subcategory', $imageName, 'public');



        Category::create([
            'logo' => $logoName,
            'image' => $imageName,
            'category_id' => $request->category_id,
            'name' => $request->name,
        ]);
        return redirect(Route('subcategory.list'))->with('success', 'SubCategory Created Successful');
    }

    public function subCategoryEditFromList($id)
    {
        $subcategory = Category::findOrFail($id);
        $categories = Category::whereNull('category_id')
            ->with('subCategories')
            ->get();
        return view('admin.category.subcategory_list_edit', compact('subcategory', 'categories'));

    }

    public function subCategoryUpdateFromList(Request $request, $id)
    {

        $this->validate(request(), [
            'name' => 'required',
        ]);
        $category = Category::findOrfail($id);

        $logo = $request->logo;

        if ($logo) {
            $logo = $request->logo;
            $logoName = time() . '_' . $logo->getClientOriginalName();
            $logo->storeAs('subcategory', $logoName, 'public');
        } else {
            $logoName = $category->logo;

        }
        $image = $request->image;
        if ($image) {
            $image = $request->image;
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('subcategory', $imageName, 'public');
        } else {
            $imageName = $category->image;
        }
        $category->update([
            'logo' => $logoName,
            'image' => $imageName,
            'category_id' => $request->category_id,
            'name' => $request->name,
        ]);
        return redirect(Route('subcategory.list'))->with('success', 'Updated Successful');
    }

}
