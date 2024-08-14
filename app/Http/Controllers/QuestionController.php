<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Closure;
use Illuminate\Http\{RedirectResponse, Request};

class QuestionController extends Controller
{
    public function store(): RedirectResponse
    {

        $atributes = request()->validate([
            'question' => [
                'required',
                'min:10',
                function (string $attribute, mixed $value, Closure $fail) {
                    // dd($value);
                    if ($value[strlen($value) - 1] != '?') {
                        $fail("Você tem certeza de que é uma pergunta? Pois está faltando interrogação no final.");
                    }
                },
            ],
        ]);

        // Question::query()->create(['question' => request()->question]);
        Question::query()->create($atributes);

        return to_route('dashboard');
    }
}
