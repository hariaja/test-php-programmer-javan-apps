<?php

namespace App\Http\Controllers;

use App\DataTables\FamilyDataTable;
use App\Models\Family;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(FamilyDataTable $dataTable)
  {
    $families = Family::with('children')->whereNull('parent_id')->get();
    return $dataTable->render('families.index', compact('families'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $families = Family::all();
    return view('families.create', compact('families'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {

    $request->validate([
      'name' => 'required|string|max:255',
      'gender' => 'required|in:Male,Female',
      'parent_id' => 'nullable|exists:families,id',
    ]);

    Family::create($request->all());
    return redirect(route('families.index'))->withSuccess('Berhasil menambahkan data keluarga');
  }

  /**
   * Display the specified resource.
   */
  public function show(Family $family)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Family $family)
  {
    $families = Family::where('id', '!=', $family->id)->get();
    return view('families.edit', compact('family', 'families'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Family $family)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'gender' => 'required|in:Male,Female',
      'parent_id' => 'nullable|exists:families,id',
    ]);

    $family->update($request->all());

    return redirect(route('families.index'))->withSuccess('Data anggota keluarga berhasil diperbarui.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Family $family)
  {
    Family::destroy($family->id);
    return response()->json([
      'message' => 'Berhasil menghapus data keluarga'
    ]);
  }
}
