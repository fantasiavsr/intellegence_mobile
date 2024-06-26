<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class ChatGPTController extends Controller
{
    protected $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client([
            'base_uri' => 'https://api.openai.com/v1/',
            'headers' => [
                'Authorization' => 'Bearer ' . env('CHATGPT_API_KEY'),
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function askToChatGpt()
    {
        $message = "what is flutter";
        $response = $this->httpClient->post('chat/completions', [
            'json' => [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are'],
                    ['role' => 'user', 'content' => $message],
                ],
            ],
        ]);

        /* return json_decode($response->getBody(), true)['choices'][0]['message']['content']; */

        /* save $answer */

        $answer = json_decode($response->getBody(), true)['choices'][0]['message']['content'];

        /* dd($answer); */
    }

    /* answer_evaluate */
    public function answer_evaluate()
    {
        $data = request()->validate([
            'test_id' => 'required',
            'question_id' => 'required',
            'answer_id' => 'required',
            'analyze_id' => 'required',
        ]);

        $test = \App\Models\Test::find($data['test_id']);
        $question = \App\Models\Question::find($data['question_id']);
        $answer = \App\Models\Answer::find($data['answer_id']);
        $evaluation = \App\Models\Analyze::find($data['analyze_id']);
        $user = \App\Models\User::find($answer->user_id);
        /* dd($user); */

        /* check if exist update */
        $flight = \App\Models\Feedback::where('user_id', $user->id)
            ->where('test_id', $test->id)
            ->where('question_id', $question->id)
            ->where('answer_id', $answer->id)
            ->where('analyze_id', $evaluation->id)
            ->first();

        if ($flight) {

            $thisanswer = $answer->answer;
            $thisquestion = $question->question;
            $thisanalyze_stdout = $evaluation->analyze_stdout;

            $content = <<<EOT
            soal:
            $thisquestion

            jawaban:
            $thisanswer

            error:
            $thisanalyze_stdout

            berikan saran perbaikan dari jawaban terhadap soal dan error yang diberikan
            EOT;

            /* dd($content); */

            $response = $this->httpClient->post('chat/completions', [
                'json' => [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                        ['role' => 'user', 'content' => $content],
                    ],
                ],
            ]);

            $feedback = json_decode($response->getBody(), true)['choices'][0]['message']['content'];

            /* dd($feedback); */

            $flight->feedback = $feedback;
            $flight->save();

            return redirect()->route('teacher.debug.evaluation.detail', ['id' => $data['analyze_id']]);
        }

        $flight = new \App\Models\Feedback();
        $flight->user_id = $user->id;
        $flight->test_id = $test->id;
        $flight->question_id = $question->id;
        $flight->answer_id = $answer->id;
        $flight->analyze_id = $evaluation->id;

        $thisanswer = $answer->answer;
        $thisquestion = $question->question;
        $thisanalyze_stdout = $evaluation->analyze_stdout;

        $content = <<<EOT
        soal:
        $thisquestion

        jawaban:
        $thisanswer

        error:
        $thisanalyze_stdout

        berikan saran perbaikan dari jawaban terhadap soal dan error yang diberikan
        EOT;

        /* dd($content); */

        $response = $this->httpClient->post('chat/completions', [
            'json' => [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                    ['role' => 'user', 'content' => $content],
                ],
            ],
        ]);

        $feedback = json_decode($response->getBody(), true)['choices'][0]['message']['content'];

        /* dd($feedback); */

        $flight->feedback = $feedback;
        $flight->save();

        return redirect()->route('teacher.debug.evaluation.detail', ['id' => $data['analyze_id']]);
    }
}
