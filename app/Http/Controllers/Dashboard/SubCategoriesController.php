<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SubCategoriesController extends Controller
{
    public function index(){
        $categories = Category::child()->orderBy('id','DESC')-> paginate(PAGINATION_COUNT);
        return view('dashboard.subCategories.index', compact('categories'));
    }

    public function create(){
        $categories = Category::parent()->orderBy('id','DESC')->get();
        return view('dashboard.subCategories.create',compact('categories'));
    }
    public function store(SubCategoryRequest $request){
        try {
            DB::beginTransaction();
            if(!$request->has('is_active')){
                $request->request->add(['is_active'=>0]);
            }
            $category = Category::create($request->except('_token'));
            $category->name = $request->name;
            $category->save();

            DB::commit();

            return redirect()->route('admin.subCategories')->with(['success'=>'created successfully']);
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('admin.subCategories.create')->with(['error'=>'failed create category']);
        }
    }

    public function edit($id){

        $category = Category::orderBy('id' , 'DESC')->find($id);

        if(!$category){
            return redirect()->route('admin.subCategories')->with(['error'=>__('settings/categories.not_found')]);
        }
        $categories = Category::parent()->orderBy('id','DESC')->get();
        return view('dashboard.subCategories.edit', compact('category','categories'));
    }

    public function update(SubCategoryRequest $request, $id){
        try{

            if(!$request->has('is_active')){
                $request->request->add(['is_active'=>0]);
            }


            $category = Category::find($id);
            if(!$category){
                return redirect()->route('admin.subCategories')->with(['error'=>__('settings/categories.not_found')]);
            }
            $category->update($request->except('_token'));
            $category->name = $request->name;
            $category->save();
            return redirect()->route('admin.subCategories')->with(['success'=>__('settings/categories.updated')]);
        }catch (\Exception $exception){
            return redirect()->route('admin.subCategories')->with(['error'=>__('settings/categories.update_failed')]);
        }
    }
    public function destroy($id){
        try{
            $category = Category::find($id);

            if(!$category){
                return redirect()->route('admin.subCategories')->with(['error'=>__('settings/categories.not_found')]);
            }
            $category->translations()->delete();
            $category->delete();
             return redirect()->route('admin.subCategories')->with(['success'=>__('settings/categories.deleted')]);
        }catch (\Exception $exception){
            return redirect()->route('admin.subCategories')->with(['error'=>__('settings/categories.delete_failed')]);
        }
    }



}
