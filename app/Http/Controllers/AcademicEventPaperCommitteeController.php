<?php

namespace App\Http\Controllers;

use App\AcademicEventPaperCommittee;
use App\DataTables\AcademicEventPaperCommitteeDataTable;
use App\Http\Requests\AcademicEventPaperCommitteeRequest;

class AcademicEventPaperCommitteeController extends Controller
{
    /**
     * AcademicEventPaperCommitteeController constructor.
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
     * @param AcademicEventPaperCommitteeDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(AcademicEventPaperCommitteeDataTable $dataTable)
    {
        return $dataTable->render('academic-event-paper-committee.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('academic-event-paper-committee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AcademicEventPaperCommitteeRequest $request)
    {
        AcademicEventPaperCommittee::create($request->all());

        return redirect()->route('academic-event-paper-committee.index')->with('success', '紀錄已建立');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AcademicEventPaperCommittee $academicEventPaperCommittee
     * @return \Illuminate\Http\Response
     */
    public function edit(AcademicEventPaperCommittee $academicEventPaperCommittee)
    {
        return view('academic-event-paper-committee.edit', compact('academicEventPaperCommittee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\AcademicEventPaperCommittee $academicEventPaperCommittee
     * @return \Illuminate\Http\Response
     */
    public function update(AcademicEventPaperCommitteeRequest $request, AcademicEventPaperCommittee $academicEventPaperCommittee)
    {
        $academicEventPaperCommittee->update($request->all());

        return redirect()->route('academic-event-paper-committee.index')->with('success', '紀錄已更新');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AcademicEventPaperCommittee $academicEventPaperCommittee
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(AcademicEventPaperCommittee $academicEventPaperCommittee)
    {
        $academicEventPaperCommittee->delete();

        return redirect()->route('academic-event-paper-committee.index')->with('success', '紀錄已刪除');
    }
}
