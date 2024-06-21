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
            'key_answer' => 'nullable|string', // Mengubah validasi untuk memastikan key_answer adalah string
            'code_path' => 'nullable',
            'key_word' => 'nullable',
        ]);

        $flight = new \App\Models\Question();
        $flight->test_id = $data['test_id'];
        $flight->question = $data['question'];
        /*  dd($flight); */
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
        /* dd($flight); */
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
        $questions = \App\Models\Question::get();

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

        /* dd($data); */

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

        /* return response()->json([
            'output' => $outputData,
            'return_code' => $returnCode,
        ]); */

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
        /* dd($flight); */

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

        // Set flag di session setelah operasi selesai
        session()->put('reload_once', true);

        return view('pages.teacher.debug.evaluations', [
            'title' => "Evaluations",
            'user' => $user,
            'evaluations' => $evaluations,
        ]);
    }

    public function teacher_evaluation_detail($id)
    {
        $user = Auth::user();
        $evaluation = \App\Models\Analyze::where('id', $id)->first();
        $question = \App\Models\Question::where('id', $evaluation->question_id)->first();
        $answer = \App\Models\Answer::where('id', $evaluation->answer_id)->first();
        $test = \App\Models\Test::where('id', $evaluation->test_id)->first();

        /* dd($evaluation, $question, $answer, $test); */

        return view('pages.teacher.debug.evaluation_detail', [
            'title' => "Evaluation Detail",
            'user' => $user,
            'evaluation' => $evaluation,
            'question' => $question,
            'answer' => $answer,
            'test' => $test,
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

    /* beta */

    /* classroom page */
    public function teacher_classroom()
    {
        $user = Auth::user();
        $classroom = \App\Models\Classroom::where('user_id', $user->id)->get();

        return view('pages.teacher.classroom', [
            'title' => "Classroom",
            'user' => $user,
            'classroom' => $classroom,
        ]);
    }

    /* delete classroom */
    public function teacher_classroom_delete(Request $request)
    {
        $classroom = \App\Models\Classroom::find($request->id);
        /* dd($classroom);  */

        $classroom->delete();

        return redirect()->route('teacher.classroom');
    }

    /* classroom add page */
    public function teacher_classroom_add()
    {
        $user = Auth::user();
        return view('pages.teacher.classroom_add', [
            'title' => "Add Classroom",
            'user' => $user,
        ]);
    }

    /* classroom store */
    public function teacher_classroom_store()
    {
        $data = request()->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $user = Auth::user();

        $flight = new \App\Models\Classroom();
        $flight->name = $data['name'];
        $flight->description = $data['description'];
        $flight->user_id = $user->id;
        $flight->save();

        return redirect()->route('teacher.classroom');
    }

    /* classroom edit page */
    public function teacher_classroom_edit($id)
    {
        $user = Auth::user();
        $classroom = \App\Models\Classroom::where('id', $id)->first();
        /* dd($classroom); */
        $classroom_member = \App\Models\Classroom_member::where('classroom_id', $id)->get();
        /* get student where user_id in clasrrom_member */
        $student = \App\Models\User::whereIn('id', $classroom_member->pluck('user_id'))->get();
        return view('pages.teacher.classroom_edit', [
            'title' => "Edit Classroom",
            'user' => $user,
            'classroom' => $classroom,
            'classroom_member' => $classroom_member,
            'student' => $student,
        ]);
    }

    /* classroom update */
    public function teacher_classroom_update(Request $request)
    {
        $data = request()->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $classroom = \App\Models\Classroom::find($request->id);
        $classroom->name = $data['name'];
        $classroom->description = $data['description'];
        $classroom->save();

        /* return redirect()->route('teacher.classroom'); */
        /* reload this page */
        return redirect()->route('teacher.classroom.edit', ['id' => $request->id]);
    }

    /* classroom add student page */
    public function teacher_classroom_add_student($id)
    {
        $user = Auth::user();
        $classroom = \App\Models\Classroom::where('id', $id)->first();
        $student = \App\Models\User::where('level', 'student')->get();

        /* dd ($student); */
        /* $classroom_member = \App\Models\Classroom_member::where('classroom_id', $id)->get(); */
        $classroom_member = \App\Models\Classroom_member::where('classroom_id', $id)->pluck('user_id')->toArray();

        return view('pages.teacher.classroom_add_student', [
            'title' => "Add Student",
            'user' => $user,
            'classroom' => $classroom,
            'student' => $student,
            'classroom_member' => $classroom_member,
        ]);
    }

    /* classroom update student */
    public function teacher_classroom_update_student(Request $request, $id)
    {
        $classroom = \App\Models\Classroom::findOrFail($id);
        $selectedStudents = $request->input('students', []);

        // Hapus semua member sebelumnya dari classroom
        \App\Models\Classroom_member::where('classroom_id', $id)->delete();

        // Tambahkan member yang dipilih ke classroom
        foreach ($selectedStudents as $studentId) {
            \App\Models\Classroom_member::create([
                'classroom_id' => $id,
                'user_id' => $studentId,
            ]);
        }

        return redirect()->route('teacher.classroom.edit', ['id' => $classroom->id])->with('success', 'Classroom updated successfully.');
    }

    /* classroom delete student in classrom_member*/
    public function teacher_classroom_delete_student(Request $request)
    {
        /* dd ($request['classroom_id']); */
        /* dd ($request['id']); */
        /* $classroom = \App\Models\Classroom::findOrFail($request->classroom_id); */
        $classroom_member = \App\Models\Classroom_member::where('classroom_id', $request->classroom_id)->where('user_id', $request->id)->first();
        /* dd($classroom_member); */

        $classroom_member->delete();

        return redirect()->route('teacher.classroom.edit', ['id' => $request->classroom_id]);
    }

    /* student list page */
    public function teacher_students()
    {
        $user = Auth::user();
        $student = \App\Models\User::where('level', 'student')->get();

        return view('pages.teacher.students', [
            'title' => "Students",
            'user' => $user,
            'student' => $student,
        ]);
    }

    /* test page */
    public function teacher_tests()
    {
        $user = Auth::user();
        $test = \App\Models\Test::where('user_id', $user->id)->get();
        $classroom = \App\Models\Classroom::where('user_id', $user->id)->get();

        return view('pages.teacher.test', [
            'title' => "Test",
            'user' => $user,
            'test' => $test,
            'classroom' => $classroom,
        ]);
    }

    /* test add */
    public function teacher_tests_add()
    {
        $user = Auth::user();
        $classroom = \App\Models\Classroom::where('user_id', $user->id)->get();
        /* dd($classroom); */

        return view('pages.teacher.add_test', [
            'title' => "Add Test",
            'user' => $user,
            'classroom' => $classroom,
        ]);
    }

    /* test store */
    public function teacher_tests_store()
    {
        $data = request()->validate([
            'name' => 'required',
            'classroom_id' => 'required',
        ]);

        $user = Auth::user();

        $flight = new \App\Models\Test();
        $flight->name = $data['name'];
        $flight->user_id = $user->id;
        $flight->classroom_id = $data['classroom_id'];
        $flight->save();

        return redirect()->route('teacher.tests');
    }

    /* test delete */
    public function teacher_tests_delete(Request $request)
    {
        $test = \App\Models\Test::find($request->id);
        /* dd($test);  */

        $test->delete();

        return redirect()->route('teacher.tests');
    }

    /* teacher_tests_edit */
    public function teacher_tests_edit($id)
    {
        $user = Auth::user();
        $test = \App\Models\Test::where('id', $id)->first();
        $classroom = \App\Models\Classroom::where('user_id', $user->id)->get();
        $question = \App\Models\Question::where('test_id', $test->id)->get();
        /* dd($test); */

        return view('pages.teacher.edit_test', [
            'title' => "Edit Test",
            'user' => $user,
            'test' => $test,
            'classroom' => $classroom,
            'question' => $question,
        ]);
    }

    /* teacher_tests_update */
    public function teacher_tests_update(Request $request)
    {
        $data = request()->validate([
            'name' => 'required',
            'classroom_id' => 'required',
        ]);

        $test = \App\Models\Test::find($request->id);
        $test->name = $data['name'];
        $test->classroom_id = $data['classroom_id'];
        $test->save();

        /* return to teacher_test_edit($id) */
        return redirect()->route('teacher.tests.edit', ['id' => $request->id]);
    }

    /* teacher_test_delete_question */
    public function teacher_test_delete_question (Request $request)
    {
        $question = \App\Models\Question::find($request->id);
        /* dd($question);  */
        /* dd($question->test_id); */


        /* delete juga file key_answer yang ada di public */
        $filePath = public_path('flutter_application_1/lib/' . $question->code_path);
        /* dd($filePath); */

        /* if FilePath not exist no need unlink */
        if (file_exists($filePath) && $question->code_path == 'empty') {
            unlink($filePath);
        }
        $question->delete();

        /* return redirect()->route('teacher.debug.input_question'); */

        /* return to teacher_test_edit($id) */
        return redirect()->route('teacher.tests.edit', ['id' => $question->test_id]);
    }

    /* teacher_tests_add_question */
    public function teacher_tests_add_question($id)
    {
        $user = Auth::user();
        $thistest = \App\Models\Test::where('id', $id)->first();
        $test = \App\Models\Test::where('user_id', $user->id)->get();
        /* dd($test); */
        return view('pages.teacher.add_question', [
            'title' => "Add Question",
            'user' => $user,
            'thistest' => $thistest,
            'test' => $test,
        ]);
    }

    /* teacher_tests_store_question */
    public function teacher_tests_store_question(Request $request)
    {
        $data = request()->validate([
            'test_id' => 'required',
            'question' => 'required',
            'key_answer' => 'nullable|string', // Mengubah validasi untuk memastikan key_answer adalah string
            'code_path' => 'nullable',
            'key_word' => 'nullable',
        ]);

        $flight = new \App\Models\Question();
        $flight->test_id = $data['test_id'];
        $flight->question = $data['question'];
        /*  dd($flight); */
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
        /* dd($flight); */
        $flight->save();

        $question = \App\Models\Question::where('id', $flight->id)->first();

        return redirect()->route('teacher.tests.edit', ['id' => $question->test_id]);
    }

    /* teacher_tests_evaluation */
    public function teacher_tests_evaluation($id)
    {
        $user = Auth::user();
        $test = \App\Models\Test::where('id', $id)->first();
        $evaluations = \App\Models\Analyze::where('test_id', $id)->get();

        return view('pages.teacher.evaluation', [
            'title' => "Evaluation",
            'user' => $user,
            'test' => $test,
            'evaluations' => $evaluations,
        ]);
    }
}
