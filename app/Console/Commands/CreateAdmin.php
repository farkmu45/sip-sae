<?php

namespace App\Console\Commands;

use App\Console\Commands\Concerns\WithInputValidation;
use App\Enums\Role;
use App\Models\Teacher;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    use WithInputValidation;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create master admin';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->askWithValidation('Masukkan nama', [
            'required',
            'max:45',
        ], 'nama');

        $address = $this->askWithValidation('Masukkan alamat', [
            'required',
            'max:45',
        ], 'alamat');

        $nip = $this->askWithValidation('Masukkan NIP (18 karakter)', [
            'required',
            'numeric',
            'digits:18',
        ], 'nip');

        $password = $this->askWithValidation('Masukkan password', ['required', 'min:8'], 'password', true);
        try {
            $data = [
                'name' => $name,
                'nip' => $nip,
                'address' => $address,
                'role_id' => Role::ADMIN->value,
                'password' => Hash::make($password),
            ];
            Teacher::create($data);
            $this->info('Data admin berhasil dibuat, silahkan login');
        } catch (Exception $e) {
            dd($e);
            $this->error('Terjadi kesalahan saat membuat data admin');
        }
    }
}
