<?php

namespace App\Http\Controllers\Api;

use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SectionController extends Controller
{
    //
    public function index()
    {
        $sclass = Section::latest()->get();
        return response()->json($sclass);
    }

    public function store(Request $request)
    {
        try {
            $validateData = $request->validate([
                'class_id'      => 'required',
                'section_name'  => 'required|unique:sections|max:25'
            ]);
            
            Section::create([
                'class_id'     => $request->class_id,
                'section_name' => $request->section_name,
              
            ]);
    
            return response('Data Classname Berhasil disimpan');
        } catch (ValidationException $e) {
            return response($e->errors(), 422); // Mengembalikan pesan validasi sebagai respons
        } catch (\Exception $e) {
            return response('Terjadi kesalahan: ' . $e->getMessage(), 500); // Mengembalikan pesan kesalahan umum
        }
    }

    public function edit($id)
    {
        try {
            $class = Section::findOrFail($id);
            return response()->json($class);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Class not found'], 404);
        }
    }
    public function update(Request $request, $id)
    {
        Section::findOrFail($id)->update([
            'class_id'     => $request->class_id,
            'section_name' => $request->section_name,
        ]);
        return response('Data  Berhasil di Update');
    }

    public function delete($id)
    {
        Section::findOrFail($id)->delete();
        return response('Data Berhasil Di Hapus');
    }

}
