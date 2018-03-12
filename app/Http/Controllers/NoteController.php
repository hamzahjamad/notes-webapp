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
        //return view('notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notes.create');
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
            return back();
        }

        return response()->json($note);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $note = Note::find($id);

        if ($user->cannot('view', $note)) {
            return back();
        }

        return view('notes.edit', compact('note'));
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
            'content' => 'required',
        ]);

        $note = Note::find($id);
        $user = Auth::user();

        if ($user->cannot('update', $note)) {
            return back();
        }

 
        $note->title = $request->title;
        $note->content = json_encode([$request->content]);
        $note->save();

        
        return redirect('notes/'.$id);
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

        if ($user->cannot('update', $note)) {
            return back();
        }

        if ($note) {
            $note->delete();
        }

        return redirect('notes');
    }
}
