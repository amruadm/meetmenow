<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
use Session;
use App\CustomStaff\Authorization\VkAuthorization;


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

        $this->getLogin($request);
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

        $place->save();

        //$place->tags()->sync($request->tags, false);

        Session::flash('success', 'Место успешно добавлено в карты!');

        return redirect()->route('main');
    }

    public function getLogin(Request $request) {
        $vkAthorization = new VkAuthorization();

//
//        $curl = $vkAthorization->getAccessToken($request);
//
//        print_r($curl);
//        die;
        $mainUserInfo = $vkAthorization->getMainUserInfo();

        print_r($mainUserInfo);
        die;

//        $mainUser = $mainUserInfo->response[0];
//
//        $UserFriendsInfo = $vkAthorization->getUserFriendsInfo($request_access_token, $access_token);
//        $friends = $UserFriendsInfo->response->items;
//
//        return view('todo.login')->withMainUser($mainUser)->withFriends($friends);
    }

    /**
     * Display the spe
     */
}
