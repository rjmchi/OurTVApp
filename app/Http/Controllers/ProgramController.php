<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Program::orderBy('program')->get();
        return Inertia::render('Dashboard',  ['programs'=> $programs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'program'=>'required',
            'app'=>'required',
            'season'=>'required | integer',
            'episode'=>'required | integer',
            'use_vpn'=>'boolean',
        ]);

        Program::create($data);
        return redirect(route('dashboard'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        //
    }

    public function nextSeason(Program $program){
        $program->season += 1;
        $program->episode = 1;
        $program->save();
        return redirect(route('dashboard'));
    }

    public function nextEpisode(Program $program){
        $program->episode += 1;
        $program->save();
        return redirect(route('dashboard'));
    }

    public function toggleVPN(Program $program){
        $program->use_vpn = !$program->use_vpn;
        info($program->program);
        info(" in toggle use_vpn = ");
        info($program->use_vpn);
        $program->save();
        return redirect(route('dashboard'));

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        $program->delete();
        return redirect(route('dashboard'));
    }
}
