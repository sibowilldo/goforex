<?php

namespace App\Http\Controllers;

use App\Http\Requests\MentorsFormRequest;
use Illuminate\Http\Request;
use App\Mentor;
use Illuminate\Support\Facades\Storage;
use Image;

class MentorsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'profile']);
        $this->middleware('boss', ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $mentors = Mentor::where('status_is', 'Active')->get();
        return view('mentors.index', compact('mentors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = Mentor::$statuses;
        $branches = Mentor::$branches;
        return view('mentors.create',compact('statuses', 'branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MentorsFormRequest $request)
    {
        $directory = 'img/mentors/';
        $mentor = $request->all();
        $mentor['status_is'] = 'Active';
        $mentor['branch'] = serialize($request['branch']);
        $mentor['image_path'] = $directory;
        $mentor['image'] = $this->add_images($directory, $file = $request->file('image'));

        Mentor::create($mentor);
        flash('You have successfully added a new Mentor.', 'success');

        return redirect('mentors');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mentor = Mentor::findOrFail($id);
        $statuses = Mentor::$statuses;
        $branches = Mentor::$branches;
        return view('mentors.edit', compact('mentor', 'statuses', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MentorsFormRequest $request;
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MentorsFormRequest $request, $id)
    {
        $mentor = Mentor::findOrFail($id);

        $directory = 'img/mentors/';
        $_request = $request->all();
        $_request['status_is'] = 'Active';
        $_request['image_path'] = $directory;
        $_request['branch'] = serialize($request['branch']);
        $_request['image'] = $request->file('image') == null ? $mentor->image :  $this->add_images($directory, $file = $request->file('image'));

        $mentor->update($_request);
        flash('Mentor has been updated!', 'success');
        return redirect('mentors');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mentor = Mentor::findOrFail($id);
        $mentor->delete();
        flash('Mentor has been deleted!', 'success');
        return redirect('mentors');
    }


    /**
     * Upload images to filesystem, updates $images of the specified product.
     * @param  $directory
     * @param  $file
     * @return string
     */
    private function  add_images($directory, $file)
    {
        $filename = '';
        if(!empty($file)){
                $filename = preg_replace('/[^A-Za-z0-9 .]/u', '', $file->getClientOriginalName());
                $filename = time(). substr($filename, strpos($filename, '.'));
                while(Storage::disk('public')->exists($directory.$filename)){
                    $filename = $filename = time(). substr($filename, strpos($filename, '.'));
                }
                Storage::disk('public')->put($directory .$filename, file_get_contents($file));

                $img = Image::make(public_path($directory.$filename));
                $img->fit(500, 500, function ($constraint) {
                    $constraint->upsize();
                });
                $img->save(public_path($directory.'/thumb_'.$filename));
        }

        return $filename;
    }
}
