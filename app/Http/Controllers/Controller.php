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
            'code_path' => 'nullable',
            'key_word' => 'nullable',
        ]);

        /* dd ($data); */

        $flight = new \App\Models\Question();
        $flight->test_id = $data['test_id'];
        $flight->question = $data['question'];
        $flight->save();

        // Membuat nama file yang unik
        /*  $fileName = 'question_' . $flight->id . '_' . now()->format('Ymd_His') . '.dart';
        $filePath = public_path('flutter_application_1/lib/' . $fileName);
        $keyAnswer = request()->input('key_answer'); // Mendapatkan nilai teks mentah dari input
        file_put_contents($filePath, $keyAnswer); // Menyimpan teks ke dalam file */
        /* check if key_answer empty, key_answer = 'empty' and dont create file */
        if ($data['key_answer']) {
            $fileName = 'question_' . $flight->id . '_' . now()->format('Ymd_His') . '.dart';
            $filePath = public_path('flutter_application_1/lib/' . $fileName);
            $keyAnswer = request()->input('key_answer'); // Mendapatkan nilai teks mentah dari input
            file_put_contents($filePath, $keyAnswer); // Menyimpan teks ke dalam file
        } else {
            $fileName = 'empty';
        }


        $flight->key_answer = $data['key_answer'];
        $flight->code_path = $fileName;
        $flight->key_word = $data['key_word'];
        //dd($flight);
        $flight->save();

        return redirect()->route('teacher.debug.input_question');
    }

    public function teacher_delete_question(Request $request)
    {
        $question = \App\Models\Question::find($request->id);
        /* dd($question);  */


        /* delete juga file key_answer yang ada di public */
        $filePath = public_path('flutter_application_1/lib/' . $question->code_path);
        /* dd($filePath); */

        /* if FilePath not exist no need unlink */
        if (file_exists($filePath) && $question->code_path == 'empty') {
            unlink($filePath);
        }
        $question->delete();

        return redirect()->route('teacher.debug.input_question');
    }

    public function teacher_answer_question()
    {
        $user = Auth::user();
        $test = \App\Models\Test::where('id', '1')->first();
        $questions = \App\Models\Question::where('test_id', $test->id)->get();

        /* check if question answered for this user */
        $answered = \App\Models\Answer::where('user_id', $user->id)->get();

        return view('pages.teacher.debug.answer_question', [
            'title' => "Answer Question",
            'user' => $user,
            'question' => $questions,
            'answered' => $answered,
        ]);
    }

    public function teacher_fill_question($id)
    {
        $user = Auth::user();
        $question = \App\Models\Question::where('id', $id)->first();
        //dd($question);

        return view('pages.teacher.debug.fill_question', [
            'title' => "Fill Question",
            'question' => $question,
            'user' => $user,
        ]);
    }

    public function teacher_store_answer()
    {
        $user = Auth::user();

        $data = request()->validate([
            'question_id' => 'required',
            'answer' => 'required',
            'code_path' => 'nullable',
        ]);

        // dd($data);

        $flight = new \App\Models\Answer();
        $flight->question_id = $data['question_id'];
        $flight->user_id = $user->id;
        $flight->answer = $data['answer'];

        $question = \App\Models\Question::where('id', $data['question_id'])->first();
        $test_id = $question->test_id;

        $flight->test_id = $test_id;

        // Membuat nama file yang unik
        $fileName = 'answer_' . $flight->id . '_' . now()->format('Ymd_His') . '.dart';
        // Menyimpan teks ke dalam file
        $filePath = public_path('flutter_application_1/lib/' . $fileName);
        $keyAnswer = request()->input('answer'); // Mendapatkan nilai teks mentah dari input
        file_put_contents($filePath, $keyAnswer); // Menyimpan teks ke dalam file
        $flight->code_path = $fileName;

        //dd($flight);

        /* udpate if this user already answered */
        $answered = \App\Models\Answer::where('user_id', $user->id)->where('question_id', $data['question_id'])->first();
        if ($answered) {
            $answered->answer = $data['answer'];
            $answered->code_path = $fileName;
            $answered->save();
            return redirect()->route('teacher.debug.answer_question');
        }

        $flight->save();

        return redirect()->route('teacher.debug.answer_question');
    }

    public function teacher_evaluation()
    {
        $user = Auth::user();
        $evaluations = \App\Models\Analyze::where('user_id', $user->id)->get();

        return view('pages.teacher.debug.evaluations', [
            'title' => "Evaluations",
            'user' => $user,
            'evaluations' => $evaluations,
        ]);
    }

    public function teacher_store_evaluation(Request $request)
    {
        /* dd($request); */
        $user = Auth::user();
        $evaluations = \App\Models\Analyze::where('user_id', $user->id)->get();

        $question = \App\Models\Question::where('id', $request->question_id)->first();
        $answer = \App\Models\Answer::where('id', $request->answer_id)->first();
        /* dd($question, $answer); */

        /* $question_path_code = $question->code_path ?? '';
        $answer_path_code = $answer->code_path ?? '';
        $key_word = $question->key_word ?? ''; */
        if ($question->code_path) {
            $question_path_code = $question->code_path;
        } else {
            $question_path_code = '';
        }

        if ($answer->code_path) {
            $answer_path_code = $answer->code_path;
        } else {
            $answer_path_code = '';
        }

        if ($question->key_word) {
            $key_word = $question->key_word;
        } else {
            $key_word = '';
        }

        /* dd($question_path_code, $answer_path_code, $key_word); */


        // Jalankan skrip Python
        $pythonScriptPath = public_path('python/code2.py');
        $command = escapeshellcmd("python $pythonScriptPath $question_path_code $answer_path_code \"$key_word\"");

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

        // Mendapatkan nilai dari output JSON
        $analyze_returncode = $outputData['analyze_returncode'] ?? null;
        $analyze_stdout = $outputData['analyze_stdout'] ?? null;
        $analyze_stderr = $outputData['analyze_stderr'] ?? null;
        $analyze_error_count = $outputData['analyze_error_count'] ?? null;
        $analyze_penalty = $outputData['analyze_penalty'] ?? null;
        $differences = $outputData['differences'] ?? null;
        $differences_total = $outputData['differences_total'] ?? null;
        $differences_penalty = $outputData['differences_penalty'] ?? null;
        $missing_keywords = $outputData['missing_keywords'] ?? null;
        $keyword_penalty = $outputData['keyword_penalty'] ?? null;
        $total_penalty = $outputData['total_penalty'] ?? null;
        $score = $outputData['score'] ?? null;

        $flight = new \App\Models\Analyze();
        $flight->question_id = $request->question_id;
        $flight->user_id = $user->id;
        $flight->test_id = $question->test_id;
        $flight->question_id = $request->question_id;
        $flight->answer_id = $request->answer_id;
        $flight->analyze_returncode = $analyze_returncode;
        $flight->analyze_stdout = $analyze_stdout;
        $flight->analyze_stderr = $analyze_stderr;
        $flight->analyze_error_count = $analyze_error_count;
        $flight->analyze_penalty = $analyze_penalty;
        $flight->differences_penalty = $differences_penalty;
        /* convert missing keyword to keyowd1, keyword2,... */
        /* missing_keywords = implode(", ", $missing_keywords); */
        /* check if empty */
        if ($missing_keywords) {
            $missing_keywords = implode(", ", $missing_keywords);
        } else {
            $missing_keywords = '';
        }
        /* dd($missing_keywords); */
        $flight->missing_keywords = $missing_keywords;
        $flight->keyword_penalty = $keyword_penalty;
        $flight->total_penalty = $total_penalty;
        $flight->score = $score;
        dd($flight);

        /* check if already exist */
        $exist = \App\Models\Analyze::where('user_id', $user->id)->where('question_id', $request->question_id)->where('answer_id', $request->answer_id)->first();
        if ($exist) {
            $exist->analyze_returncode = $analyze_returncode;
            $exist->analyze_stdout = $analyze_stdout;
            $exist->analyze_stderr = $analyze_stderr;
            $exist->analyze_error_count = $analyze_error_count;
            $exist->analyze_penalty = $analyze_penalty;
            $exist->differences_penalty = $differences_penalty;
            $exist->missing_keywords = $missing_keywords;
            $exist->keyword_penalty = $keyword_penalty;
            $exist->total_penalty = $total_penalty;
            $exist->score = $score;
            $exist->save();
            return redirect()->route('teacher.debug.evaluation');
        } else {
            $flight->save();
        }

        return view('pages.teacher.debug.evaluations', [
            'title' => "Evaluations",
            'user' => $user,
            'evaluations' => $evaluations,
        ]);
    }

    public function executePythonScript()
    {
        $pythonScriptPath = 'python/code3.py';
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
