<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $sclass = Student::latest()->get();
        return response()->json($sclass);
    }



    public function store(Request $request)
    {
        try {
            $validateData = $request->validate([
                'name'   => 'required|unique:students|max:25',
                'email'  => 'required|unique:students|max:25'
            ]);
            
            Student::create([
                'class_id'     => $request->class_id,
                'section_id'   => $request->section_id,
                'name'         => $request->name,
                'address'      => $request->address,
                'phone'        => $request->phone,
                'email'        => $request->email,
                'password'     => Hash::make($request->password),
                'photo'        => $request->photo,
                'gender'       => $request->gender,
                'created_at'   => Carbon::now(),
            ]);
    
            return response('Data Student Berhasil disimpan');
        } catch (ValidationException $e) {
            return response($e->errors(), 422); // Mengembalikan pesan validasi sebagai respons
        } catch (\Exception $e) {
            return response('Terjadi kesalahan: ' . $e->getMessage(), 500); // Mengembalikan pesan kesalahan umum
        }
    }


    public function edit($id)
    {
        try {
            $class = Student::findOrFail($id);
            return response()->json($class);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Class not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        Student::findOrFail($id)->update([
            'class_id'     => $request->class_id,
            'section_id'   => $request->section_id,
            'name'         => $request->name,
            'address'      => $request->address,
            'phone'        => $request->phone,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'photo'        => $request->photo,
            'gender'       => $request->gender,
        ]);
        return response('Data  Berhasil di Update');
    }

    public function delete($id)
    {
        Student::findOrFail($id)->delete();
        return response('Data Berhasil Di Hapus');
    }
    

}
