<?php

namespace App\Http\Controllers;

use App\AcademicSpeech;
use App\DataTables\AcademicSpeechDataTable;
use Illuminate\Http\Request;

class AcademicSpeechController extends Controller
{
    /**
     * AcademicSpeechController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:setting.manage')->except([
            'index',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param AcademicSpeechDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(AcademicSpeechDataTable $dataTable)
    {
        return $dataTable->render('academic-speech.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('academic-speech.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AcademicSpeech::create($request->all());

        return redirect()->route('academic-speech.index')->with('success', '紀錄已建立');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AcademicSpeech $academicSpeech
     * @return \Illuminate\Http\Response
     */
    public function edit(AcademicSpeech $academicSpeech)
    {
        return view('academic-speech.edit', compact('academicSpeech'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\AcademicSpeech $academicSpeech
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AcademicSpeech $academicSpeech)
    {
        $academicSpeech->update($request->all());

        return redirect()->route('academic-speech.index')->with('success', '紀錄已更新');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AcademicSpeech $academicSpeech
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(AcademicSpeech $academicSpeech)
    {
        $academicSpeech->delete();

        return redirect()->route('academic-speech.index')->with('success', '紀錄已刪除');
    }
}
