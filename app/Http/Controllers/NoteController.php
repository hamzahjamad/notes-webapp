<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Note;

class NoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Auth::user()->notes()->paginate(5);
        return response()->json($notes);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //TODO handle the 'list' type note

        $request->validate([
            'title' => 'required|unique:notes|max:30',
            'content' => 'required',
            'type' => 'required',
        ]);

        $note = new Note;
        $note->title = $request->title;
        $note->slug = str_slug($request->title ,'-');
        $note->content = json_encode([$request->content]);
        $note->type = 'text';

        Auth::user()->notes()->save($note);

        return redirect('notes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $note = Note::with('contents')->find($id);

        if ($user->cannot('view', $note)) {
            return 'cannot view';
        }

        return response()->json($note);
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
        $request->validate([
            'title' => 'required',
            'content' => 'required|array',
        ]);

        $note = Note::find($id);
        $user = Auth::user();

        if ($user->cannot('update', $note)) {
            return 'cannot update';
        }

        foreach ($request->content as $content) {
            $c = \App\Content::find($content['id']);
            $c->content = $content['content'];
            $c->save();
        }

        $note->title = $request->title;
        $note->save();

        return response()->json($note);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Note::find($id);
        $user = Auth::user();

        if ($user->cannot('delete', $note)) {
            return 'cannot delete';
        }

        if ($note) {
            $note->delete();
        }

        return redirect('/');
    }
}
