<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\OptionsRequest;
use App\Models\Attribute;
use App\Models\Option;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OptionsController extends Controller
{
    public function index(){
           $options = Option::with(['product'=>function ($query) {

             $query->select('id');
         } , 'attribute'=>function($query){

             $query->select('id');
         }
         ])->select('id','product_id' , 'attribute_id' , 'price')-> paginate(PAGINATION_COUNT);
        return view('dashboard.options.index', compact('options'));
    }

    public function create(){
        $data =[];
        $data['products'] = Product::active()->select('id'  )->get();
        $data['attributes'] = Attribute::select('id')->get();

        return view('dashboard.options.create' , $data);
    }
    public function store(OptionsRequest $request){
        try{

            DB::beginTransaction();

               $option = Option::create([
                   'product_id' => $request->product_id,
                   'attribute_id' => $request->attribute_id,
                   'price' => $request->price,
               ]);
               $option->name = $request->name;
               $option->save();
            DB::commit();

            return redirect()->route('admin.options')->with('success', 'Options added successfully');
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Failed create new Option']);
        }

    }

    public function edit($optionId){
        $option = Option::find($optionId);

        if(!$optionId){
            return redirect()->route('admin.options')->with(['error'=>'Options not found']);
        }
        $data =[];
        $data['products'] = Product::active()->select('id')->get();
        $data['attributes'] = Attribute::select('id')->get();
        return view('dashboard.options.edit',$data, compact('option'));

    }

    public function update(OptionsRequest $request, $id){
        try{

            $option = Option::find($id);
            DB::beginTransaction();
            if(!$option){
                return redirect()->route('admin.options')->with(['error'=>'Option not found']);
            }

            $option->update($request->except('_token', 'option_id'));
            $option->name = $request->name;
            $option->save();

            DB::commit();
            return redirect()->route('admin.options')->with(['success'=>'updated successfully']);
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('admin.options')->with(['error'=>'failed update Options']);
        }
    }

    public function destroy($id){
        try{
            $option = Option::find($id);

            if(!$option){
                return redirect()->route('admin.options')->with(['error'=>'Attributes not found']);
            }

            $option->translations()->delete();
            $option->delete();
            return redirect()->route('admin.options')->with(['success'=>'deleted successfully']);
        }catch (\Exception $exception){
            return redirect()->route('admin.options')->with(['error'=>'failed delete option']);
        }
    }
}
