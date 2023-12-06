<?php

namespace App\Http\Controllers\Api;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubjectController extends Controller
{
    public function index()
    {
        $sclass = Subject::latest()->get();
        return response()->json($sclass);
    }

    public function store(Request $request)
    {
        try {
            $validateData = $request->validate([
                'class_id'      => 'required',
                'subject_name'  => 'required|unique:subjects|max:25'
            ]);
            
            Subject::create([
                'class_id'     => $request->class_id,
                'subject_name' => $request->subject_name,
                'subject_code' => $request->subject_code,
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
            $class = Subject::findOrFail($id);
            return response()->json($class);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Class not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        Subject::findOrFail($id)->update([
            'class_id'     => $request->class_id,
            'subject_name' => $request->subject_name,
            'subject_code' => $request->subject_code,
        ]);
        return response('Data  Berhasil di Update');
    }

    public function delete($id)
    {
        Subject::findOrFail($id)->delete();
        return response('Data Berhasil Di Hapus');
    }
    

}
 