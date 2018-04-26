<?php

namespace App\Http\Controllers;

use App\DataTables\ResearchProjectDataTable;
use App\Http\Requests\ResearchProjectRequest;
use App\ResearchProject;

class ResearchProjectController extends Controller
{
    /**
     * ResearchProjectController constructor.
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
     * @param ResearchProjectDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(ResearchProjectDataTable $dataTable)
    {
        return $dataTable->render('research-project.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('research-project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ResearchProjectRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResearchProjectRequest $request)
    {
        ResearchProject::create($request->all());

        return redirect()->route('research-project.index')->with('success', '研究計畫已建立');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResearchProject $researchProject
     * @return \Illuminate\Http\Response
     */
    public function edit(ResearchProject $researchProject)
    {
        return view('research-project.edit', compact('researchProject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ResearchProjectRequest $request
     * @param  \App\ResearchProject $researchProject
     * @return \Illuminate\Http\Response
     */
    public function update(ResearchProjectRequest $request, ResearchProject $researchProject)
    {
        $researchProject->update($request->all());

        return redirect()->route('research-project.index')->with('success', '研究計畫已更新');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResearchProject $researchProject
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(ResearchProject $researchProject)
    {
        $researchProject->delete();

        return redirect()->route('research-project.index')->with('success', '研究計畫已刪除');
    }
}
