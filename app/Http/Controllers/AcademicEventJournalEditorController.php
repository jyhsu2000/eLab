<?php

namespace App\Http\Controllers;

use App\AcademicEventJournalEditor;
use App\DataTables\AcademicEventJournalEditorDataTable;
use App\Http\Requests\AcademicEventJournalEditorRequest;

class AcademicEventJournalEditorController extends Controller
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
     * @param AcademicEventJournalEditorDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(AcademicEventJournalEditorDataTable $dataTable)
    {
        return $dataTable->render('academic-event-journal-editor.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('academic-event-journal-editor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AcademicEventJournalEditorRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AcademicEventJournalEditorRequest $request)
    {
        AcademicEventJournalEditor::create($request->all());

        return redirect()->route('academic-event-journal-editor.index')->with('success', '紀錄已建立');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AcademicEventJournalEditor $academicEventJournalEditor
     * @return \Illuminate\Http\Response
     */
    public function edit(AcademicEventJournalEditor $academicEventJournalEditor)
    {
        return view('academic-event-journal-editor.edit', compact('academicEventJournalEditor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AcademicEventJournalEditorRequest $request
     * @param  \App\AcademicEventJournalEditor $academicEventJournalEditor
     * @return \Illuminate\Http\Response
     */
    public function update(AcademicEventJournalEditorRequest $request, AcademicEventJournalEditor $academicEventJournalEditor)
    {
        $academicEventJournalEditor->update($request->all());

        return redirect()->route('academic-event-journal-editor.index')->with('success', '紀錄已更新');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AcademicEventJournalEditor $academicEventJournalEditor
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(AcademicEventJournalEditor $academicEventJournalEditor)
    {
        $academicEventJournalEditor->delete();

        return redirect()->route('academic-event-journal-editor.index')->with('success', '紀錄已刪除');
    }
}
