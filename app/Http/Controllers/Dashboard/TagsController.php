<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagsRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TagsController extends Controller
{
    public function index(){
        $tags = Tag::orderBy('id','DESC')-> paginate(PAGINATION_COUNT);
        return view('dashboard.tags.index', compact('tags'));
    }

    public function create(){
        return view('dashboard.tags.create');
    }
    public function store(TagsRequest $request){
        try{

            DB::beginTransaction();

               $tag = Tag::create(['slug' => $request-> slug]);
               $tag->name = $request->name;
                $tag->save();
            DB::commit();

            return redirect()->route('admin.tags')->with('success', 'Tag added successfully');
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Faild create new tag']);
        }

    }

    public function edit($id){
        $tag = Tag::orderBy('id' , 'DESC')->find($id);

        if(!$tag){
            return redirect()->route('admin.tags')->with(['error'=>'Tag not found']);
        }

        return view('dashboard.tags.edit', compact('tag'));
    }

    public function update(TagsRequest $request, $id){
        try{

            $tag = Tag::find($id);
            DB::beginTransaction();
            if(!$tag){
                return redirect()->route('admin.tags')->with(['error'=>'Tag not found']);
            }

            $tag->update($request->except('_token', 'id'));
            $tag->name = $request->name;
            $tag->save();

            DB::commit();
            return redirect()->route('admin.tags')->with(['success'=>'updated successfully']);
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('admin.tags')->with(['error'=>'failed update tag']);
        }
    }

    public function destroy($id){
        try{
            $tag = Tag::find($id);

            if(!$tag){
                return redirect()->route('admin.tags')->with(['error'=>'Tag not found']);
            }
            $tag->translations()->delete();
            $tag->delete();
            return redirect()->route('admin.tags')->with(['success'=>'deleted successfully']);
        }catch (\Exception $exception){
            return redirect()->route('admin.tags')->with(['error'=>'failed delete brand']);
        }
    }

}
