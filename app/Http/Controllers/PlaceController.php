<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
use Session;
use App\CustomStaff\Authorization\GoogleYandexCoordinates;


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
        return view('places.create');
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
            'description'          => 'required'
        ));

        // store in the database
        $place = new Place();
        $place->setTable('main_places');

        $place->title = $request->title;
        $place->whatsapp = $request->whatsapp;
        $place->telegram = $request->telegram;
        $place->description = $request->description; // $request->body;

        $googleCoordinate = $this->getGoogleCoordinates();

        /*get google coordinates for point on map / получение гугл координат для установки точки на карте*/
        $place->google_latitude = $googleCoordinate->getLat();
        $place->google_longitude = $googleCoordinate->getLng();

        $place->save();

        Session::flash('success', 'Место успешно добавлено в карты!');

        return redirect()->route('main');
    }

    public function getGoogleCoordinates() {
        $googleYandexCoordinates = new GoogleYandexCoordinates();
        $googleCoordinate = $googleYandexCoordinates->getGoogleCoordinates();

        return $googleCoordinate;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $place = Place::find($id);
        $path  = public_path();
        $full_url =\Request::url();
        $url =\Request::path();

        $base_url = str_replace($url,"",$full_url);
        return view('places.show')->with('place', $place)->with('data', $base_url);;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find the Place in the database and save as a var
        $place = Place::find($id);
//        $categories = Category::all();
//        $cats = array();
//        foreach ($categories as $category) {
//            $cats[$category->id] = $category->name;
//        }

        return view('places.edit')->withPlace($place); //->withCategories($cats);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        // Validate the data
        $this->validate($request, array(
            'title'         => 'required|max:255',
            'description'          => 'required'
        ));

        // Save the data to the database
        $place = Place::find($id);

        // validate the data
        $this->validate($request, array(
            'title'         => 'required|max:255',
            'description'          => 'required'
        ));

        $place->title = $request->title;
        $place->whatsapp = $request->whatsapp;
        $place->telegram = $request->telegram;
        $place->description = $request->description; // $request->body;

        $googleCoordinate = $this->getGoogleCoordinates();

        /*get google coordinates for point on map / получение гугл координат для установки точки на карте*/
        $place->google_latitude = $googleCoordinate->getLat();
        $place->google_longitude = $googleCoordinate->getLng();

        $place->save();

        Session::flash('success', 'Место успешно обновлено!');

        return redirect()->route('main');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $place = Place::find($id);
        $place->delete();

        Session::flash('success', 'Место успешно удалено.');
        return redirect()->route('main');
    }
}
