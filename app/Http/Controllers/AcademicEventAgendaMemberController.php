<?php

namespace App\Http\Controllers;

use App\AcademicEventAgendaMember;
use App\DataTables\AcademicEventAgendaMemberDataTable;
use App\Http\Requests\AcademicEventAgendaMemberRequest;

class AcademicEventAgendaMemberController extends Controller
{
    /**
     * AcademicEventAgendaMemberController constructor.
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
     * @param AcademicEventAgendaMemberDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(AcademicEventAgendaMemberDataTable $dataTable)
    {
        return $dataTable->render('academic-event-agenda-member.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('academic-event-agenda-member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AcademicEventAgendaMemberRequest $request)
    {
        AcademicEventAgendaMember::create($request->all());

        return redirect()->route('academic-event-agenda-member.index')->with('success', '紀錄已建立');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AcademicEventAgendaMember $academicEventAgendaMember
     * @return \Illuminate\Http\Response
     */
    public function edit(AcademicEventAgendaMember $academicEventAgendaMember)
    {
        return view('academic-event-agenda-member.edit', compact($academicEventAgendaMember));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\AcademicEventAgendaMember $academicEventAgendaMember
     * @return \Illuminate\Http\Response
     */
    public function update(AcademicEventAgendaMemberRequest $request, AcademicEventAgendaMember $academicEventAgendaMember)
    {
        $academicEventAgendaMember->update($request->all());

        return redirect()->route('academic-event-agenda-member.index')->with('success', '紀錄已更新');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AcademicEventAgendaMember $academicEventAgendaMember
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(AcademicEventAgendaMember $academicEventAgendaMember)
    {
        $academicEventAgendaMember->delete();

        return redirect()->route('academic-event-agenda-member.index')->with('success', '紀錄已刪除');
    }
}
