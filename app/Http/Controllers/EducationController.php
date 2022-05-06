<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\CategorieEducation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class EducationController extends Controller
{

    public function filter()
    {

        $education = Education::select('video')->groupBy('video')->get();
        return view('education.filter',compact('education'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->admin == 1) {

               $educations = Education::orderBy('id', 'desc')->get();
           
            return view('education.index', compact('educations'));
        } else {
             
             $educations = CategorieEducation::orderBy('id', 'desc')->get();
            return view('education.componentUser.index', compact('educations'));
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorie = CategorieEducation::all();
        return view('education.create', compact('categorie'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $education = request()->validate([
            'title' => 'required',
            'categorie' => 'required',
            'video' => 'required',
        ]);

        $education = new Education();
        $education->title = $request->title;
        $education->categorie_id = $request->categorie;

        $video = $request->file('video');
        $name = time() . "." . $video->extension();
        $video->move(public_path('storage') . '/education', $name);
        $education->video = '' . $name;


        $education->save();

        return redirect()->back()->with('msj-success', 'La Educacion Fue Creada Con Exito');
    }

    public function CreateCategorie(Request $request)
    {

        $categorie = request()->validate([
            'name' => 'required',
        ]);

        $categorie = new CategorieEducation();
        $categorie->name = $request->name;
        $categorie->save();

        return redirect()->back()->with('msj-success', 'La categoria fue creada con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function show(Education $education)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function edit(Education $education)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Education $education)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function destroy(Education $education)
    {
        //
    }
}
