<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\Portfolio;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Data Profile
        Profile::create([
            'name' => 'Nama Kamu Maszeh',
            'role' => 'Mahasiswa & Web Developer',
            'about' => 'Saya adalah mahasiswa yang tertarik dengan pengembangan web dan teknologi AI.',
            'email' => 'emailkamu@mahasiswa.ac.id',
            'github_link' => 'https://github.com/username-kamu',
        ]);

        // Data Portofolio 1
        Portfolio::create([
            'title' => 'Project Website Kampus',
            'image_url' => 'https://via.placeholder.com/400x300', // Gambar dummy
            'description' => 'Membuat website sistem informasi kampus menggunakan Laravel.',
            'project_link' => '#',
        ]);

        // Data Portofolio 2
        Portfolio::create([
            'title' => 'Aplikasi Kasir',
            'image_url' => 'https://via.placeholder.com/400x300',
            'description' => 'Aplikasi kasir sederhana berbasis web dinamis.',
            'project_link' => '#',
        ]);
    }
}
