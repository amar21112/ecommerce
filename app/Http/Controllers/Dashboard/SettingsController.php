<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function editShippingMethods($type){

         $shipping_method =  Setting::where('key', $type.'_shipping_label')->firstOrFail();
        return view('dashboard.settings.shipping.edit', compact('shipping_method'));
    }

    public function updateShippingMethods(ShippingRequest $request , $id){
        try{
            $shipping_method = Setting::find($id);

            DB::beginTransaction();
            $shipping_method->update(['plain_value' => $request->plain_value ]);
            $shipping_method->value = $request->value;
            $shipping_method->save();
            DB::commit();

            return redirect()->back()->with('success', 'Settings updated successfully!');
        }
        catch (\Exception $exception){
            DB::rollBack();
          return redirect()->back()->with(['error' , 'Something went wrong!']);
        }
    }
}
