<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    public function show($id)
    {
        // Cari task berdasarkan ID
        $task = \App\Models\Task::find($id);

        // Jika task tidak ditemukan, tampilkan error 404
        if (!$task) {
            abort(404, 'Task not found');
        }

        // Ambil path dari task
        $pdf = $task->task_path;

        // Buat jalur absolut ke file PDF di direktori 'public/topic'
        $path = public_path('topic/' . $pdf);

        // Periksa apakah file ada
        if (!file_exists($path)) {
            abort(404, 'File not found');
        }

        // Kembalikan file sebagai respons dengan header yang sesuai
        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . basename($path) . '"'
        ]);
    }
}
