<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\gloses;
use App\motsambigues;
use App\phrases;
use App\Contenir;
use Illuminate\Support\Facades\DB;

class CreatePhrase extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('createPhrase');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // inserer la phrase et mettre 
    public function store(Request $request)
    {
        $phrases = new phrases();
        $contenir = new Contenir();
        $mot = DB::table('motsambigues')->where('mot', $request->mot_ambiguD)->first();
        if($motId != null){
            $motId = $mot->idMot;
            $phrases->phrase = $request->phraseD;
            $phrases->nbrjouer = 1;
            $phrases->nbrlike = 0;
            $phrases->gain = 0;
            $phrases->dejajouer = 0;
            $phrases->save();
            $contenir->idPhrase = DB::table('phrases')->where('phrase', $phrases->phrase)->first()->idPhrase;
            $contenir->idMot = $motId;
            $contenir->save();
        }
        return $request->phraseD;
    }
    // ajouter la glose et le motAmbigu + association motAmbigu et glose
        public function ajouterGlose(Request $request){
        $glose = new gloses();
        $motAmbigu = new motsambigues();

        $glose->gloses = $request->glose;
        $motAmbigu->mot = $request->motAmbigu;

        $ExistMot = DB::table('motsambigues')->where('mot', $request->motAmbigu)->first();
        $ExistGlose = DB::table('gloses')->where('gloses', $request->gloses)->first();
        if($ExistMot === null)
            $motAmbigu->save();

        $glose->idMot = DB::table('motsambigues')->where('mot', $request->motAmbigu)->first()->idMot;
        $glose->save();

        return $request->all();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function recupererGloses(Request $data){
        $MotInstance = DB::table('motsambigues')->where('mot', $data->mot)->first();
        $GlosesData = null;
        if($MotInstance != null){
            $idMot = $MotInstance->idMot;
            $GlosesData = DB::table('gloses')->where('idMot', $idMot);
        }


        return $GlosesData;
    }



    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
} 
