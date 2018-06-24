<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comment;
use App\Place;
use Session;
use Purifier;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'store']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $place_id)
    {
        $this->validate($request, array(
            'name'      =>  'required|max:255',
            'email'     =>  'required|email|max:255',
            'comment'   =>  'required|min:5|max:2000'
            ));

        $place = Place::find($place_id);

        $comment = new Comment();
        $comment->name = Purifier::clean($request->name);
        $comment->email = Purifier::clean($request->email);
        //$place->body = Purifier::clean($request->body);
        $comment->comment = Purifier::clean($request->comment);
        $comment->approved = true;
        $comment->place()->associate($place);

        $comment->save();

        Session::flash('success', 'Комментарий добавлен');

        return redirect()->route('blog.single', [$place->slug]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('comments.edit')->withComment($comment);
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
        $comment = Comment::find($id);

        $this->validate($request, array('comment' => 'required'));

        $comment->comment = Purifier::clean($request->comment); //I have changed it
        $comment->save();

        Session::flash('success', 'Comment updated');

        return redirect()->route('places.show', $comment->place->id);
    }

    public function delete($id)
    {
        $comment = Comment::find($id);
        return view('comments.delete')->withComment($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $place_id = $comment->place->id;
        $comment->delete();

        Session::flash('success', 'Комментарий удален');

        return redirect()->route('places.show', $place_id);
    }
}
