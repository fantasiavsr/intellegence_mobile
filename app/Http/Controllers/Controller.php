<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function test()
    {

        return view('test', [
            'title' => "test",
        ]);
    }

    public function dashboard_teacher()
    {
        $user = Auth::user();
        return view('pages.teacher.home', [
            'title' => "Dashboard",
            'user' => $user,
        ]);
    }

    public function teacher_input_question()
    {
        $user = Auth::user();
        $test = \App\Models\Test::where('id', '1')->first();
        $questions = \App\Models\Question::where('test_id', $test->id)->get();

        /* dd($questions); */
        return view('pages.teacher.debug.input_question', [
            'title' => "Input Question",
            'user' => $user,
            'list_item' => $questions,
        ]);
    }

    public function teacher_add_question()
    {
        $user = Auth::user();
        $test = \App\Models\Test::where('user_id', $user->id)->get();
        return view('pages.teacher.debug.add_question', [
            'title' => "Add Question",
            'user' => $user,
            'test' => $test,
        ]);
    }

    public function teacher_store_question()
    {
        $data = request()->validate([
            'test_id' => 'required',
            'question' => 'required',
            'key_answer' => 'nullable',
        ]);

        /* dd ($data); */

        $flight = new \App\Models\Question();
        $flight->test_id = $data['test_id'];
        $flight->question = $data['question'];
        $flight->save();

        // Membuat nama file yang unik
        $fileName = 'question_' . $flight->id . '_' . now()->format('Ymd_His') . '.dart';
        /*  dd($data['key_answer']); */
        // Menyimpan teks ke dalam file
        $filePath = public_path('flutter_application_1/lib/' . $fileName);
        $keyAnswer = request()->input('key_answer'); // Mendapatkan nilai teks mentah dari input
        file_put_contents($filePath, $keyAnswer); // Menyimpan teks ke dalam file


        /* Ganti key_answer pada question yang barusan dibuat menjadi nama file */
        $flight->key_answer = $fileName;
        $flight->save();

        return redirect()->route('teacher.debug.input_question');
    }

    public function teacher_delete_question(Request $request)
    {
        $question = \App\Models\Question::find($request->id);
        $question->delete();

        /* delete juga file key_answer yang ada di public */
        $filePath = public_path('flutter_application_1/lib/' . $question->key_answer);
        unlink($filePath);

        return redirect()->route('teacher.debug.input_question');
    }

    public function teacher_answer_question()
    {
        $user = Auth::user();
        $test = \App\Models\Test::where('id', '1')->first();
        $questions = \App\Models\Question::where('test_id', $test->id)->get();

        return view('pages.teacher.debug.answer_question', [
            'title' => "Answer Question",
            'user' => $user,
            'list_item' => $questions,
        ]);
    }

    public function teacher_fill_question($id){
        $user = Auth::user();
        $question = \App\Models\Question::where('id', $id)->first();
        //dd($question);

        return view('pages.teacher.debug.fill_question', [
            'title' => "Fill Question",
            'question' => $question,
            'user' => $user,
        ]);
    }

    public function teacher_store_answer(){
        $data = request()->validate([
            'question_id' => 'required',
            'answer' => 'required',
        ]);

        dd($data);

        $flight = new \App\Models\Answer();
        $flight->question_id = $data['question_id'];
        $flight->answer = $data['answer'];
        $flight->save();

        return redirect()->route('teacher.debug.answer_question');
    }

    public function executePythonScript()
    {
        $pythonScriptPath = 'python/code2.py';
        $command = 'python ' . $pythonScriptPath;

        // Eksekusi skrip Python menggunakan exec
        exec($command . ' 2>&1', $output, $returnCode);

        // $output berisi hasil eksekusi (output skrip Python)
        // $returnCode berisi kode keluaran dari skrip Python

        // Mengonsumsi output sebagai JSON
        $jsonOutput = implode("\n", $output);
        $outputData = json_decode($jsonOutput, true);

        // Memeriksa apakah penguraian JSON berhasil
        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json([
                'error' => 'Error decoding JSON: ' . json_last_error_msg(),
                'output' => $jsonOutput,
                'return_code' => $returnCode,
            ]);
        }

        return response()->json([
            'output' => $outputData,
            'return_code' => $returnCode,
        ]);
    }
}
