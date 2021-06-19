<?php

namespace Tests\Feature;

use App\Company;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function testAuth()
    {
        $company = Company::create([
            'name' => 'Перцы',
            'code' => Str::random(50),
        ]);

        User::create([
            'name' => 'test',
            'email' => 'test@test.com',
            'phone' => '89527452060',
            'company_id' => $company->id,
            'password' => Hash::make('testtest'),
            'admin' => 1,
        ]);

        $response = $this->call('POST','/login',[
            'email'=>'test@test.com',
            'password'=>'testtest',
        ]);
        $response->assertLocation('/');
    }
}
