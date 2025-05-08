<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandsRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BrandsController extends Controller
{
    public function index(){
        $brands = Brand::orderBy('id','DESC')-> paginate(PAGINATION_COUNT);
        return view('dashboard.brands.index', compact('brands'));
    }

    public function create(){
        return view('dashboard.brands.create');
    }
    public function store(BrandsRequest $request){
        try{


        DB::beginTransaction();
            if (!$request->has('active')) {
                $request->request->add(['active' => 0]);
            }

            $fileName = "";
            if ($request->has('photo')) {
                $fileName = saveImage('images/brands', $request->photo);
            }
            $brand = Brand::create($request->except('_token', 'photo'));
            $brand->name = $request->name;
            $brand->photo = $fileName;
            $brand->save();

            DB::commit();

            return redirect()->route('admin.brands')->with('success', 'Brand added successfully');
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Faild create new brand']);
        }

    }

    public function edit($id){
        $brand = Brand::orderBy('id' , 'DESC')->find($id);

        if(!$brand){
            return redirect()->route('admin.brands')->with(['error'=>'Brand not found']);
        }

        return view('dashboard.brands.edit', compact('brand'));
    }

    public function update(BrandsRequest $request, $id){
        try{

            if(!$request->has('active')){
                $request->request->add(['active'=>0]);
            }


            $brand = Brand::find($id);
            DB::beginTransaction();
            if(!$brand){
                return redirect()->route('admin.brands')->with(['error'=>'Brand not found']);
            }

            $brand->update($request->except('_token','photo' , 'id'));
            $brand->name = $request->name;

            $fileName = "";
            if ($request->has('photo') && !empty($request->photo)) {
                $fileName = saveImage('images/brands', $request->photo);
                $brand->photo = $fileName;
            }

            $brand->save();
            DB::commit();
            return redirect()->route('admin.brands')->with(['success'=>'updated successfully']);
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('admin.brands')->with(['error'=>'failed update brand']);
        }
    }

    public function destroy($id){
        try{
            $brand = Brand::find($id);

            if(!$brand){
                return redirect()->route('admin.brands')->with(['error'=>'Brand not found']);
            }

            $photo = $brand->photo;

            deleteImage($photo);

            $brand->delete();
            return redirect()->route('admin.brands')->with(['success'=>'deleted successfully']);
        }catch (\Exception $exception){
            return redirect()->route('admin.brands')->with(['error'=>'failed delete brand']);
        }
    }
    
}
