<?php

namespace App\Http\Controllers\Api;

use App\Models\Sclass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class SclassController extends Controller
{
    //
    public function index()
    {
        $sclass = Sclass::latest()->get();
        return response()->json($sclass);
    }

    public function store(Request $request)
    {
        try {
            $validateData = $request->validate([
                'class_name' => 'required|unique:sclasses|max:25'
            ]);
    
            Sclass::create([
                'class_name' => $request->class_name,
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
            $class = Sclass::findOrFail($id);
            return response()->json($class);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Class not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        Sclass::findOrFail($id)->update([
            'class_name' => $request->class_name,
        ]);
        return response('Data Classname Berhasil di Update');
    }
    
    public function delete($id)
    {
        Sclass::findOrFail($id)->delete();
        return response('Data Berhasil Di Hapus');
    }

}
