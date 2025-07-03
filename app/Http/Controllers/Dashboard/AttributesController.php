<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributesRequest;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AttributesController extends Controller
{
    public function index(){
        $attrs = Attribute::orderBy('id','DESC')-> paginate(PAGINATION_COUNT);
        return view('dashboard.attributes.index', compact('attrs'));
    }

    public function create(){
        return view('dashboard.attributes.create');
    }
    public function store(AttributesRequest $request){
        try{

            DB::beginTransaction();

               $attr = Attribute::create();
               $attr->name = $request->name;
               $attr->save();
            DB::commit();

            return redirect()->route('admin.attributes')->with('success', 'Attributes added successfully');
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Failed create new Attributes']);
        }

    }

    public function edit($id){
        $attr = Attribute::orderBy('id' , 'DESC')->find($id);

        if(!$attr){
            return redirect()->route('admin.attributes')->with(['error'=>'Attributes not found']);
        }

        return view('dashboard.attributes.edit', compact('attr'));
    }

    public function update(AttributesRequest $request, $id){
        try{

            $attr = Attribute::find($id);
            DB::beginTransaction();
            if(!$attr){
                return redirect()->route('admin.attributes')->with(['error'=>'Attribute not found']);
            }

            $attr->update($request->except('_token', 'attr_id'));
            $attr->name = $request->name;
            $attr->save();

            DB::commit();
            return redirect()->route('admin.attributes')->with(['success'=>'updated successfully']);
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('admin.attributes')->with(['error'=>'failed update Attributes']);
        }
    }

    public function destroy($id){
        try{
            $attr = Attribute::find($id);

            if(!$attr){
                return redirect()->route('admin.attributes')->with(['error'=>'Attributes not found']);
            }
            $attr->translations()->delete();
            $attr->delete();
            return redirect()->route('admin.attributes')->with(['success'=>'deleted successfully']);
        }catch (\Exception $exception){
            return redirect()->route('admin.attributes')->with(['error'=>'failed delete attributes']);
        }
    }

}
