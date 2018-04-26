<?php

namespace App\Http\Controllers;

use App\AcademicEventCommitteeMember;
use App\DataTables\AcademicEventCommitteeMemberDataTable;
use App\Http\Requests\AcademicEventCommitteeMemberRequest;

class AcademicEventCommitteeMemberController extends Controller
{
    /**
     * AcademicEventCommitteeMemberController constructor.
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
     * @param AcademicEventCommitteeMemberDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(AcademicEventCommitteeMemberDataTable $dataTable)
    {
        return $dataTable->render('academic-event-committee-member.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('academic-event-committee-member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AcademicEventCommitteeMemberRequest $request)
    {
        AcademicEventCommitteeMember::create($request->all());

        return redirect()->route('academic-event-committee-member.index')->with('success', '紀錄已建立');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AcademicEventCommitteeMember $academicEventCommitteeMember
     * @return \Illuminate\Http\Response
     */
    public function edit(AcademicEventCommitteeMember $academicEventCommitteeMember)
    {
        return view('academic-event-committee-member.edit', compact($academicEventCommitteeMember));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\AcademicEventCommitteeMember $academicEventCommitteeMember
     * @return \Illuminate\Http\Response
     */
    public function update(AcademicEventCommitteeMemberRequest $request, AcademicEventCommitteeMember $academicEventCommitteeMember)
    {
        $academicEventCommitteeMember->update($request->all());

        return redirect()->route('academic-event-committee-member.edit.index')->with('success', '紀錄已更新');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AcademicEventCommitteeMember $academicEventCommitteeMember
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(AcademicEventCommitteeMember $academicEventCommitteeMember)
    {
        $academicEventCommitteeMember->delete();

        return redirect()->route('academic-event-committee-member.index')->with('success', '紀錄已刪除');
    }
}
