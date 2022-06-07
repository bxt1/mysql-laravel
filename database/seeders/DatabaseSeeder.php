<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\BankAccount;
use App\Models\Transaction;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
		$alice_id = User::factory()->create([
             'email' => 'alice@mail.com',
             'name' => 'Alice'
         ])->id;

        $bob_id = User::factory()->create([
            'email' => 'bob@mail.com',
            'name' => 'Bob'
        ])->id;
		
		$alice_acc = BankAccount::create([
			'id' => "1234567-001",
            'user_id' => $alice_id,
            'balance' => 1000
        ])->id;
		
		$bob_acc = BankAccount::create([
			'id' => "1234567-002",
            'user_id' => $bob_id,
            'balance' => 500
        ])->id;

        Transaction::create([
            'payor_acc' => $alice_acc,
			'payee_acc' => $bob_acc,
            'amount' => 50,
            'description' => 'Initial deposit'
        ]);
    }
}
