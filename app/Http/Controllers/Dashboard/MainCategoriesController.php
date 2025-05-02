<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class MainCategoriesController extends Controller
{
    public function index(){
        $categories = Category::parent()->orderBy('id','DESC')-> paginate(PAGINATION_COUNT);
        return view('dashboard.categories.index', compact('categories'));
    }

    public function create(){
        return view('dashboard.categories.create');
    }
    public function store(MainCategoryRequest $request){
        try {
            DB::beginTransaction();
            if(!$request->has('is_active')){
                $request->request->add(['is_active'=>0]);
            }
            $category = Category::create($request->except('_token'));
            $category->save();

            DB::commit();

            return redirect()->route('admin.mainCategories')->with(['success'=>'created successfully']);
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('admin.mainCategories.create')->with(['error'=>'failed create category']);
        }
    }

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
            $category->update($request->except('_token'));
            $category->save();
            return redirect()->route('admin.mainCategories')->with(['success'=>__('settings/categories.updated')]);
        }catch (\Exception $exception){
            return redirect()->route('admin.mainCategories')->with(['error'=>__('settings/categories.update_failed')]);
        }
    }
    public function destroy($id){
        try{
            $category = Category::find($id);

            if(!$category){
                return redirect()->route('admin.mainCategories')->with(['error'=>__('settings/categories.not_found')]);
            }


            $category->delete();
            return redirect()->route('admin.mainCategories')->with(['success'=>__('settings/categories.deleted')]);
        }catch (\Exception $exception){
            return redirect()->route('admin.mainCategories')->with(['error'=>__('settings/categories.delete_failed')]);
        }
    }



}
