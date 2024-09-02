<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class LoginControllerTest extends TestCase
{
    public function test_users_can_authenticate_using_the_login_screen()
{
    // Crear un usuario usando la factory
    $user = User::factory()->create([
        'password' => bcrypt('password'), // establece la contraseña que se usará en el test
    ]);

    // Realizar la solicitud de inicio de sesión
    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    // Verificar que se redirige a la página de productos después del inicio de sesión
    $response->assertRedirect('/products');

    // Verificar que el usuario está autenticado
    $this->assertAuthenticatedAs($user);
}

}





