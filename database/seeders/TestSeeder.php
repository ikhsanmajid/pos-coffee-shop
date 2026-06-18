<?php

namespace Database\Seeders;

use App\Models\TestTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            ['nama' => 'nama1', 'is_active' => true],
            ['nama' => 'nama2', 'is_active' => false],
            ['nama' => 'nama3', 'is_active' => true],
            ['nama' => 'nama4', 'is_active' => false],
            ['nama' => 'nama5', 'is_active' => true],
            ['nama' => 'nama6', 'is_active' => false],
            ['nama' => 'nama7', 'is_active' => true],
            ['nama' => 'nama8', 'is_active' => false],
            ['nama' => 'nama9', 'is_active' => true],
            ['nama' => 'nama10', 'is_active' => false],
            ['nama' => 'nama11', 'is_active' => true],
            ['nama' => 'nama12', 'is_active' => false],
            ['nama' => 'nama13', 'is_active' => true],
            ['nama' => 'nama14', 'is_active' => false],
            ['nama' => 'nama15', 'is_active' => true],
            ['nama' => 'nama16', 'is_active' => false],
            ['nama' => 'nama17', 'is_active' => true],
            ['nama' => 'nama18', 'is_active' => false],
            ['nama' => 'nama19', 'is_active' => true],
            ['nama' => 'nama20', 'is_active' => false],
            ['nama' => 'nama21', 'is_active' => true],
            ['nama' => 'nama22', 'is_active' => false],
            ['nama' => 'nama23', 'is_active' => true],
            ['nama' => 'nama24', 'is_active' => false],
            ['nama' => 'nama25', 'is_active' => true],
            ['nama' => 'nama26', 'is_active' => false],
            ['nama' => 'nama27', 'is_active' => true],
            ['nama' => 'nama28', 'is_active' => false],
            ['nama' => 'nama29', 'is_active' => true],
            ['nama' => 'nama30', 'is_active' => false],
            ['nama' => 'nama31', 'is_active' => true],
            ['nama' => 'nama32', 'is_active' => false],
            ['nama' => 'nama33', 'is_active' => true],
            ['nama' => 'nama34', 'is_active' => false],
            ['nama' => 'nama35', 'is_active' => true],
            ['nama' => 'nama36', 'is_active' => false],
        ];

        foreach ($data as $item) {
            TestTable::create($item);
        }
    }
}
