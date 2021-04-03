<?php

namespace App\Http\Controllers;

use App\devsnotes;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    private $vetor = ['error' => '', 'result' => []];

    public function all()
    {
        $notes = devsnotes::all();

        foreach ($notes as $note) {
            $this->array['result'][] = [
                'id' => $note->id,
                'title' => $note->title
            ];
        }

        return $this->array;

    }

    public function one($id)
    {
        $note = devsnotes::find($id);

        if($note) {
            $this->array['result'] = $note;
        } else {
            $this->array['error'] = 'ID não encontrado!';
        }
        return $this->array;
    }

    public function new(Request $request)
    {
        $title = $request->input('title');
        $text = $request->input('text');
        if($title && $text) {

            $note = new devsnotes();
            $note->title = $title;
            $note->text = $text;
            $note->save();

            $this->array['result'] = [
                'id' => $note->id,
                'title' => $title,
                'text' => $text
            ];
        } else {
            $this->array['error'] = 'Campos não enviados!';
        }

        return $this->array;
    }

    public function edit(Request $request, $id)
    {
        $title = $request->input('title');
        $text = $request->input('text');

        if($id && $title && $text) {

        $note = devsnotes::find($id);
        if($note) {
        $note->title = $title;
        $note->text = $text;
        $note->save();

        $this->array['result'] = [
            'id' => $id,
            'title' => $title,
            'text' => $text
        ];

        } else {
            $this->array['error'] = 'ID Inexistente!';
        }

        } else {
            $this->array['error'] = 'Campos não enviados!';
        }

        return $this->array;
    }

    public function delete($id)
    {
        $note = devsnotes::find($id);
        if($note) {
            $note->delete();
        } else {
            $this->array['error'] = 'ID Inexistente';
        }

        return $this->array;
    }
}
