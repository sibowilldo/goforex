<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemFormRequest;
use App\Item;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Unglued\LavaImage\Facades\LavaImage;

class ItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['boss','auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all items
        $items = Item::all();
        return view('backend.items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Create new item
        $image=null;
        return view('backend.items.create', compact('image'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemFormRequest $request)
    {
        // Save the new item
        if($request->hasFile('image')) {
            $fileHash = LavaImage::save($request->file('image'));
            $request['image']=$fileHash;
        }

        $request['password']=bcrypt($request['password']);
        $request['verified']=0;
        $request['code']=str_random(6);

        $item = Item::create($request->except(['image']));

        // Save image string if upload was successful
        if(isset($fileHash)) {
            $item->update(['image'=>$fileHash]);
        }

        flash('New item has been added!', 'success');
        return redirect('/admin/items');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        // Show item of $id
        return view('backend.items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        // Edit existing item
        $image = null;

        if(!is_null($item->image)) {
            $image = LavaImage::getImage($item->image);
        }

        return view('backend.items.edit', compact('item','image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemFormRequest $request, Item $item)
    {
        // Update the existing item
        if(strlen($request['password'])>6) {
            $request['password']=bcrypt($request['password']);
        } else {
            $request['password']=$item->password;
        }

        if($request->hasFile('image')) {
            $fileHash = LavaImage::save($request->file('image'));
            $request['image']=$fileHash;
        }

        // Update other data except image
        $item->update($request->except(['image']));

        // Save image string if upload was successful
        if(isset($fileHash)) {
            $item->update(['image'=>$fileHash]);
        }

        flash('Item has been successfully updated!', 'success');
        return redirect('/admin/items');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        // Delete a item
        $item->delete();
        flash('Item has been deleted!', 'success');
        return redirect('/admin/items');
    }

    // Delete a item file
    public function deleteItemFile($id)
    {
        $item = Item::where('image',$id)->first();
        $item->update(['image'=>null]);
        return redirect()->back();
    }
}
