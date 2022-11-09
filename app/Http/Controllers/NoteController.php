<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function UserNotes(){
        $notes = Note::where([ 'user_id' => 1, 'status' => true ])->get();
        return response()->json(["notes" => $notes]);
    }
    public function store(Request $request){
        $user = Auth::user();
        //$user = auth()->user();

        $note = new Note();
        $note->user_id = $user->id;
        $note->title = $request->title;
        $note->content = $request->content;
        $note->img_url = $request->img_url;
        $note->save();

        return response()->json([ "success" => true, "message"=> "El apunte se ha creado con exito" ]);
    }
    public function update(Request $request){

        $note = Note::find( $request->note_id );
        $user = auth()->user();

        if($note == null){
            return response()->json([ "success" => false, "message"=> "Apunte no encontrado" ]);
        }

        $note->user_id = $user->id;
        $note->title = $request->title;
        if( $request->content != null || $request->content != '' )  $note->content = $request->content;
        if( $request->img_url != null || $request->img_url != '' )  $note->img_url = $request->img_url;
        $note->save();

        return response()->json([ "success" => true, "message"=> "El apunte fue actualizado con exito" ]);
    }
    public function delete($id){

        $note = Note::find( $id );
        $user = auth()->user();

        if($note == null){
            return response()->json([ "success" => false, "message"=> "Apunte no encontrado" ]);
        }

        $note->status = false;
        $note->save();

        return response()->json([ "success" => true, "message"=> "El apunte fue eliminado con exito " ]);
    }
}
