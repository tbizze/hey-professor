<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post};

it(
    'deve ser capaz de criar uma nova pergunta com mais de 255 caracteres',
    function () {
        // Arrange -> preparar
        $user = User::factory()->create();
        actingAs($user);

        // Act -> agir
        $request = post(route('question.store'), [
            'question' => str_repeat('*', 260) . '?',
        ]);

        // Assert -> verificar
        $request->assertRedirect(route('dashboard'));
        assertDatabaseCount('questions', 1);
        assertDatabaseHas('questions', ['question' => str_repeat('*', 260) . '?']);
    }
);

it(
    'deve verificar se termina com ponto de interrogação ?',
    function () {
        // expect(true)->toBeTrue();

        // Arrange -> preparar
        $user = User::factory()->create();
        actingAs($user);

        // Act -> agir
        $request = post(route('question.store'), [
            'question' => str_repeat('*', 10),
        ]);

        // Assert -> verificar
        $request->assertSessionHasErrors(['question' => 'Você tem certeza de que é uma pergunta? Pois está faltando interrogação no final.']);
        assertDatabaseCount('questions', 0);
    }
);

it(
    'deve ter pelo menos 10 caracteres',
    function () {
        // Arrange -> preparar
        $user = User::factory()->create();
        actingAs($user);

        // Act -> agir
        $request = post(route('question.store'), [
            'question' => str_repeat('*', 8) . '?',
        ]);

        // Assert -> verificar
        $request->assertSessionHasErrors(['question' => __('validation.min.string', ['min' => 10, 'attribute' => 'question'])]);
        assertDatabaseCount('questions', 0);
    }
);
