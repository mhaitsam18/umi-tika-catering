<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class FileController extends Controller
{
    public function tmpUpload(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $file_name = $image->getClientOriginalName();
            $file_name = $request->file('image')->store($request->input('folder'));
            $request->session()->put('file_name', $file_name);
            return $file_name;
        }
        return '';
    }
    public function dokumenUpload(Request $request)
    {
        if ($request->hasFile('dokumen')) {
            $image = $request->file('dokumen');

            // Check if the uploaded file is a PDF
            if ($image->getClientOriginalExtension() === 'pdf') {
                $file_name = $image->getClientOriginalName();
                $file_name = $request->file('dokumen')->store($request->input('folder'));
                $request->session()->put('file_name', $file_name);
                return $file_name;
            } else {
                return response()->json(['error' => 'File Harus PDF.'], 400);
            }
        }
        return '';
    }
    public function tmpDelete(Request $request)
    {
        $filePath = Session::get('file_name'); // Mendapatkan path file dari request
        if ($filePath) {
            // Hapus file dari storage
            Storage::delete($filePath);
            Session::forget('file_name');
            // Mengembalikan respon sesuai kebutuhan Anda, misalnya:
            return '';
        }
        // Mengembalikan respon sesuai kebutuhan Anda, misalnya:
        return $filePath;

    }
    public function dokumenDelete(Request $request)
    {
        $filePath = Session::get('file_name'); // Mendapatkan path file dari request
        if ($filePath) {
            // Hapus file dari storage
            Storage::delete($filePath);
            Session::forget('file_name');
            // Mengembalikan respon sesuai kebutuhan Anda, misalnya:
            return '';
        }
        // Mengembalikan respon sesuai kebutuhan Anda, misalnya:
        return $filePath;

    }
}
