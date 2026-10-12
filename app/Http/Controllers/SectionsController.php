<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SectionsController extends Controller
{
    public function index() {

        $sections = Section::all();

        return view('sections/index', [ 'sections' => $sections ]);
    }

    public function create() {

        $sections = Section::all();

        return view('sections/create');
    }

    public function edit($id) {

        $section = Section::find($id);

        if (empty($section)) {

            Session::flash('message', [ 'content' => "La sección con id '$id' no existe.", 'type' => 'error' ]);
            return redirect()->back();
        }

        return view('sections/edit', [ 'section' => $section ]);
    }

    public function store(Request $request) {

        Validator::make($request->all(),
        [
            'name' => 'required|max:32'
        ],
        [
            'name.required' => 'El nombre es requerido',
            'name.max' => 'El nombre no puede ser mayor :max letras'
        ])->validate();

        try {

            $section = new Section();
            $section->name = $request->name;
            $section->save();

            Session::flash('message', [ 'content' => "Sección creada con éxito", 'type' => 'success' ]);
            return redirect()->route('sections.index');

        } catch(Exception $ex) {

            Log::error($ex);
            Session::flash('message', [ 'content' => "Ha ocurrido un error.", 'type' => 'error' ]);
            return redirect()->back();
        }
    }

    public function update(Request $request) {

        Validator::make($request->all(),
        [
            'name' => 'required|max:32',
            'section_id' => 'required|exists:sections,id'
        ],
        [
            'name.required' => 'El nombre es requerido',
            'name.max' => 'El nombre no puede ser mayor :max letras',

            'section_id.required' => 'La sección es requerida',
            'section_id.exists' => 'EL id dado no existe',
        ])->validate();

        try {

            $section = Section::find($request->section_id);
            $section->name = $request->name;
            $section->save();

            Session::flash('message', [ 'content' => "Sección actualizada con éxito", 'type' => 'success' ]);
            return redirect()->route('sections.index');

        } catch(Exception $ex) {

            Log::error($ex);
            Session::flash('message', [ 'content' => "Ha ocurrido un error.", 'type' => 'error' ]);
            return redirect()->back();
        }
    }

    public function delete($id) {

        try {

            $section = Section::find($id);

            if (empty($section)) {

                Session::flash('message', [ 'content' => "La sección con id '$id' no existe.", 'type' => 'error' ]);
                return redirect()->back();
            }

            $section->delete();

            Session::flash('message', [ 'content' => "Sección eliminada con éxito", 'type' => 'success' ]);
            return redirect()->route('sections.index');

        } catch(Exception $ex) {

            Log::error($ex);
            Session::flash('message', [ 'content' => "Ha ocurrido un error.", 'type' => 'error' ]);
            return redirect()->back();
        }
    }
}
