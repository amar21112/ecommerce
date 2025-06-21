<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralProductRequest;
use App\Http\Requests\PriceProductRequest;
use App\Http\Requests\ProductImagesRequest;
use App\Http\Requests\StockProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index(){
        $products = Product::select('id' , 'price'  ,'slug','created_at')->paginate(PAGINATION_COUNT);
        return view('dashboard.products.general.index', compact('products'));
    }
    public function create()
    {
        $data = [];
        $data['brands'] = Brand::active()->select('id')->get();
        $data['tags'] = Tag::select('id')->get();
        $data['categories'] = Category::active()->select('id')->get();
        return view('dashboard.products.general.create', $data);
    }

    public function store(GeneralProductRequest $request)
    {
        try {
            DB::beginTransaction();
            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);


            $product = Product::create($request->except('_token'));
            //save translations
            $product->name = $request->name;
            $product->description = $request->description;
            $product->short_description = $request->short_description;
            $product->save();

            //save product categories and tags

            $product->categories()->attach($request->categories);
            $product->tags()->attach($request->tags);

            DB::commit();
            return redirect()->route('admin.products')->with('success','Product created successfully');
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function editPrice($id){
        $product = Product::whereId($id)->select('id' , 'price'  ,'special_price','special_price_type' ,'special_price_start' ,'special_price_end')->first();
        if(!$product){
            return redirect()->route('admin.products')->with('error' , 'Product not found');
        }

        return view('dashboard.products.general.editPrice', compact('product'));
    }

    public function updatePrice(PriceProductRequest $request,$id){
        try{
            $product = Product::find($id);
            DB::beginTransaction();
            if(!$product){
                return redirect()->route('admin.products')->with('error' , 'Product not found');
            }

            $product->update($request->except('_token' , 'id'));
            $product->save();
            DB::commit();
            return redirect()->route('admin.products')->with('success' , 'Product updated successfully');
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('admin.products')->with('error', 'Product not updated');
        }
    }

    public function editStock($id){
        $product = Product::whereId($id)->select('id' , 'sku' ,'qty' ,'manage_stock' , 'in_stock')->first();
        if(!$product){
            return redirect()->route('admin.products')->with('error' , 'Product not found');
        }

        return view('dashboard.products.general.editStock', compact('product'));
    }

    public function updateStock(StockProductRequest $request){
        try{
            $product = Product::find($request->id);
            DB::beginTransaction();
            if(!$product){
                return redirect()->route('admin.products')->with('error' , 'Product not found');
            }

            $product->update($request->except('_token' , 'id'));
            $product->save();
            DB::commit();
            return redirect()->route('admin.products')->with('success' , 'Product updated successfully');
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('admin.products')->with('error', 'Product not updated');
        }
    }

    public function addImage($id){
        $product = Product::find($id);
        if(!$product){
            return redirect()->route('admin.products')->with('error' , 'Product not found');
        }
        return view('dashboard.products.general.imageCreate', compact('product'));
    }

    // store image in folder
    public function storeImage(Request $request)
    {
        $file =  $request->file('dzfile');
        $fileName='';
        if($file != null){
            $fileName = saveImage('products' , $file);
        }

        return response()->json([
            'name' => $fileName,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function storeImageDb(ProductImagesRequest $request)
    {
        try{

            if($request->has('document') &&  count($request->document) > 0){

                foreach ($request->document as $image){
                    Image::create([
                        'product_id'=>$request->product_id,
                        'photo'=>$image,
                    ]);
                }
            }

          return redirect()->route('admin.products')->with('success' , 'Product image created successfully');
        } catch (\Exception $exception) {
            return redirect()->route('admin.products')->with('error', 'Product image failed');
        }
    }
}
