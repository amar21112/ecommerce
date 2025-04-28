<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function editShippingMethods($type){

        $shipping_method =  Setting::where('key', $type.'_shipping_label')->firstOrFail();
        return view('dashboard.settings.shipping.edit', compact('shipping_method'));
    }

    public function updateShippingMethod(Request $request , $id){

    }
}
