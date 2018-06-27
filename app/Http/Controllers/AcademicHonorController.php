<?php

namespace App\Http\Controllers;

use App\AcademicHonor;
use App\DataTables\AcademicHonorDataTable;
use Illuminate\Http\Request;

class AcademicHonorController extends Controller
{
    /**
     * AcademicHonorController constructor.
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
     * @param AcademicHonorDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(AcademicHonorDataTable $dataTable)
    {
        return $dataTable->render('academic-honor.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('academic-honor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AcademicHonor::create($request->all());

        return redirect()->route('academic-honor.index')->with('success', '紀錄已建立');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AcademicHonor $academicHonor
     * @return \Illuminate\Http\Response
     */
    public function edit(AcademicHonor $academicHonor)
    {
        return view('academic-honor.edit', compact('academicHonor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\AcademicHonor $academicHonor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AcademicHonor $academicHonor)
    {
        $academicHonor->update($request->all());

        return redirect()->route('academic-honor.index')->with('success', '紀錄已更新');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AcademicHonor $academicHonor
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(AcademicHonor $academicHonor)
    {
        $academicHonor->delete();

        return redirect()->route('academic-honor.index')->with('success', '紀錄已刪除');
    }
}
