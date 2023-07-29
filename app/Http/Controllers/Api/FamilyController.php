<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Family;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $families = Family::all();
    return response()->json([
      'data' => $families,
    ]);
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

    $data = Family::create($request->all());
    return response()->json([
      'status' => 200,
      'message' => 'Berhasil MEMBUAT data anggota Keluarga',
      'data' => $data,
    ]);
  }

  /**
   * Display the specified resource.
   */
  public function show(Family $family)
  {
    return response()->json([
      'status' => 200,
      'message' => 'Berhasil MENAMPILKAN detail data anggota Keluarga',
      'data' => $family,
    ]);
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
    return response()->json([
      'status' => 200,
      'message' => 'Berhasil MENGUBAH data anggota Keluarga',
      'data' => $family,
    ]);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Family $family)
  {
    Family::destroy($family->id);
    return response()->json([
      'status' => 200,
      'message' => 'Berhasil MENGHAPUS data anggota Keluarga',
    ]);
  }
}
