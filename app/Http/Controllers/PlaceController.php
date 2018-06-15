<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlaceController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Place::orderBy('id', 'desc')->paginate(10);
        return view('places.index')->withPlaces($places);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('places.create')->withCategories($categories)->withTags($tags);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the data
        $this->validate($request, array(
            'title'         => 'required|max:255',
            'slug'          => 'required|alpha_dash|min:5|max:255|unique:places,slug',
            'category_id'   => 'required|integer',
            'body'          => 'required'
        ));

        // store in the database
        $place = new Place;

        $place->title = $request->title;
        $place->slug = $request->slug;
        $place->category_id = $request->category_id;
        $place->body = $request->body; // $request->body;
        //$place->body = Purifier::clean($request->body);

        if ($request->hasFile('featured_img')) {
            $image = $request->file('featured_img');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800, 400)->save($location);

            $place->image = $filename;
        }

        $place->save();

        //$place->tags()->sync($request->tags, false);

        Session::flash('success', 'The blog place was successfully save!');

        return redirect()->route('places.show', $place->id);
    }

    /**
     * Display the spe
     */
}
