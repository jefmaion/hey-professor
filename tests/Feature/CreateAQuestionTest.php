<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post};

it('should be able to create a new big question than 255 characters', function () {
    //Arrange: Preparar
    $user = User::factory()->create();
    actingAs($user);

    // Act: Agir
    $request = post(route('question.store'), [
        'question' => str_repeat("*", 260) . '?',
    ]);

    // Assert: Veriuficar
    $request->assertRedirect(route('dashboard'));
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', ['question' => str_repeat("*", 260) . '?']);

});

it('should check if end with question mark ?', function () {
    //Arrange: Preparar
    $user = User::factory()->create();
    actingAs($user);

    // Act: Agir
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 10),
    ]);

    // Assert: Veriuficar
    $request->assertSessionHasErrors([
        'question' => 'Are you sure that is a question? It is missing the question mark in the end',
    ]);

    assertDatabaseCount('questions', 0);
});

it('should have at least 10 characters', function () {

    //Arrange: Preparar
    $user = User::factory()->create();
    actingAs($user);

    // Act: Agir
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 8) . '?',
    ]);

    // Assert: Veriuficar
    $request->assertSessionHasErrors(['question' => __('validation.min.string', ['min' => 10, 'attribute' => 'question'])]);
    assertDatabaseCount('questions', 0);
});
