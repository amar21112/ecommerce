<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;


class MainCategoriesController extends Controller
{
    public function index(){
        $categories = Category::parent()->paginate(PAGINATION_COUNT);
        return view('dashboard.categories.index', compact('categories'));
    }

    public function create(){}
    public function store(Request $request){}

    public function edit($id){
        $category = Category::orderBy('id' , 'DESC')->find($id);

        if(!$category){
            return redirect()->route('admin.mainCategories')->with(['error'=>__('settings/categories.not_found')]);
        }

        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(MainCategoryRequest $request, $id){
        try{

            if(!$request->has('is_active')){
                $request->request->add(['is_active'=>0]);
            }


            $category = Category::find($id);
            if(!$category){
                return redirect()->route('admin.mainCategories')->with(['error'=>__('settings/categories.not_found')]);
            }
            $category->update($request->only('name' , 'is_active', 'slug'));
            $category->save();
            return redirect()->route('admin.mainCategories')->with(['success'=>__('settings/categories.updated')]);
        }catch (\Exception $exception){
            return redirect()->route('admin.mainCategories')->with(['error'=>__('settings/categories.update_failed')]);
        }
    }
    public function destroy($id){}



}
