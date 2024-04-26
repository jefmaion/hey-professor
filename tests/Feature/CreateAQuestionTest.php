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

});

it('should have at least 10 characters', function () {

});
