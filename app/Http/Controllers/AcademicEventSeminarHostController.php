<?php

namespace App\Http\Controllers;

use App\AcademicEventSeminarHost;
use App\DataTables\AcademicEventSeminarHostDataTable;
use App\Http\Requests\AcademicEventSeminarHostRequest;

class AcademicEventSeminarHostController extends Controller
{
    /**
     * AcademicEventSeminarHostController constructor.
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
     * @param AcademicEventSeminarHostDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(AcademicEventSeminarHostDataTable $dataTable)
    {
        return $dataTable->render('academic-event-seminar-host.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('academic-event-seminar-host.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AcademicEventSeminarHostRequest $request)
    {
        AcademicEventSeminarHost::create($request->all());

        return redirect()->route('academic-event-seminar-host.index')->with('success', '紀錄已建立');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AcademicEventSeminarHost $academicEventSeminarHost
     * @return \Illuminate\Http\Response
     */
    public function edit(AcademicEventSeminarHost $academicEventSeminarHost)
    {
        return view('academic-event-seminar-host.edit', compact('academicEventSeminarHost'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\AcademicEventSeminarHost $academicEventSeminarHost
     * @return \Illuminate\Http\Response
     */
    public function update(AcademicEventSeminarHostRequest $request, AcademicEventSeminarHost $academicEventSeminarHost)
    {
        $academicEventSeminarHost->update($request->all());

        return redirect()->route('academic-event-seminar-host.index')->with('success', '紀錄已更新');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AcademicEventSeminarHost $academicEventSeminarHost
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(AcademicEventSeminarHost $academicEventSeminarHost)
    {
        $academicEventSeminarHost->delete();

        return redirect()->route('academic-event-seminar-host.index')->with('success', '紀錄已刪除');
    }
}
