<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    protected function &getSharedVar()
    {
        static $token = null;
        return $token;
    }


    /** @test */
    public function it_should_return_status_code_200()
    {
        $response = $this->get('/api/v1');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_should_return_text()
    {
        $response = $this->get('/api/v1');

        $this->assertEquals('Api running guess', (string) $response->getContent());
    }

    /** @test */
    public function it_should_perform_login()
    {
        $token = &$this->getSharedVar();

        $data = [
            'email' => 'leandro@teste.com',
            'password' => 'teste123'
        ];

        $response = $this->postJson('api/v1/login', $data);

        $token = $response->headers->get('Authorization');

        $response
            ->assertStatus(200)
            ->assertHeader('Authorization');
    }

    /** @test */
    public function it_should_return_authenticated_text()
    {
        $token = &$this->getSharedVar();

        $response = $this->withHeaders([
            'Authorization' => $token
        ])->get('api/v1/auth');

        $response->assertStatus(200);

        $this->assertEquals('Api running authenticated', (string) $response->getContent());;
    }

    /** @test */
    public function it_should_perform_logout()
    {
        $token = &$this->getSharedVar();

        $response = $this->withHeaders([
            'Authorization' => $token
        ])->get('api/v1/logout');

        // dd($response->getContent());;

        $response
            ->assertStatus(200)
            ->assertExactJson([
                "messsage" => "Logout successful"
            ]);
    }
}
