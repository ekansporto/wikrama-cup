<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\MatchModel;
use App\Models\Player;
use App\Models\Statistic;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Disable FK checks and truncate tables
        Schema::disableForeignKeyConstraints();
        Statistic::truncate();
        Gallery::truncate();
        MatchModel::truncate();
        Player::truncate();
        Team::truncate();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        // 1. Seed Admin
        $admin = User::create([
            'name' => 'Admin Panitia WikCup',
            'email' => 'admin@wikcup.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        $admin2 = User::create([
            'name' => 'Admin Utama',
            'email' => 'adminutama@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // 2. Seed Teams (Boys & Girls Divisions with clear School affiliations)
        $teamsData = [
            ['nama_tim' => 'SMK Wikrama Thunder', 'logo' => null],
            ['nama_tim' => 'SMK Wikrama Hawks', 'logo' => null],
            ['nama_tim' => 'SMK Wikrama Queens', 'logo' => null],
            ['nama_tim' => 'SMAN 1 Bogor Eagles', 'logo' => null],
            ['nama_tim' => 'SMAN 1 Bogor Sirens', 'logo' => null],
            ['nama_tim' => 'SMA Regina Pacis Warriors', 'logo' => null],
            ['nama_tim' => 'SMA Kesatuan Knights', 'logo' => null],
            ['nama_tim' => 'SMA Kesatuan Sparks', 'logo' => null],
        ];

        $teams = [];
        foreach ($teamsData as $data) {
            $team = Team::create($data);
            $teams[$team->nama_tim] = $team;
        }

        // 3. Seed Users & Players (Boys & Girls)
        $playersData = [
            // --- SMK Wikrama Thunder (Boys) ---
            [
                'name' => 'Rizky Pratama',
                'email' => 'rizky@wikcup.id',
                'team' => 'SMK Wikrama Thunder',
                'no_punggung' => 7,
                'posisi' => 'Shooting Guard (SG)',
                'gender' => 'Boys',
                'tinggi' => 178,
                'berat' => 68,
                'kelas' => 'XII PPLG 1',
                'is_captain' => true,
            ],
            [
                'name' => 'Dimas Saputra',
                'email' => 'dimas@wikcup.id',
                'team' => 'SMK Wikrama Thunder',
                'no_punggung' => 11,
                'posisi' => 'Point Guard (PG)',
                'gender' => 'Boys',
                'tinggi' => 172,
                'berat' => 62,
                'kelas' => 'XI PPLG 2',
                'is_captain' => false,
            ],
            [
                'name' => 'Farhan Alfarizi',
                'email' => 'farhan@wikcup.id',
                'team' => 'SMK Wikrama Thunder',
                'no_punggung' => 23,
                'posisi' => 'Small Forward (SF)',
                'gender' => 'Boys',
                'tinggi' => 183,
                'berat' => 74,
                'kelas' => 'XII PPLG 3',
                'is_captain' => false,
            ],
            [
                'name' => 'Kevin Maulana',
                'email' => 'kevin@wikcup.id',
                'team' => 'SMK Wikrama Thunder',
                'no_punggung' => 34,
                'posisi' => 'Power Forward (PF)',
                'gender' => 'Boys',
                'tinggi' => 186,
                'berat' => 80,
                'kelas' => 'XI PPLG 1',
                'is_captain' => false,
            ],
            [
                'name' => 'Bintang Ramadhan',
                'email' => 'bintang@wikcup.id',
                'team' => 'SMK Wikrama Thunder',
                'no_punggung' => 15,
                'posisi' => 'Center (C)',
                'gender' => 'Boys',
                'tinggi' => 191,
                'berat' => 85,
                'kelas' => 'XII PPLG 2',
                'is_captain' => false,
            ],

            // --- SMK Wikrama Hawks (Boys) ---
            [
                'name' => 'Andi Wijaya',
                'email' => 'andi@wikcup.id',
                'team' => 'SMK Wikrama Hawks',
                'no_punggung' => 8,
                'posisi' => 'Point Guard (PG)',
                'gender' => 'Boys',
                'tinggi' => 175,
                'berat' => 65,
                'kelas' => 'XII TJKT 2',
                'is_captain' => true,
            ],
            [
                'name' => 'Fajar Nugraha',
                'email' => 'fajar@wikcup.id',
                'team' => 'SMK Wikrama Hawks',
                'no_punggung' => 24,
                'posisi' => 'Shooting Guard (SG)',
                'gender' => 'Boys',
                'tinggi' => 180,
                'berat' => 70,
                'kelas' => 'XI TJKT 1',
                'is_captain' => false,
            ],
            [
                'name' => 'Bagas Triadi',
                'email' => 'bagas@wikcup.id',
                'team' => 'SMK Wikrama Hawks',
                'no_punggung' => 33,
                'posisi' => 'Center (C)',
                'gender' => 'Boys',
                'tinggi' => 193,
                'berat' => 88,
                'kelas' => 'XII TJKT 1',
                'is_captain' => false,
            ],

            // --- SMAN 1 Bogor Eagles (Boys) ---
            [
                'name' => 'Aldy Reyhan',
                'email' => 'aldy@wikcup.id',
                'team' => 'SMAN 1 Bogor Eagles',
                'no_punggung' => 10,
                'posisi' => 'Small Forward (SF)',
                'gender' => 'Boys',
                'tinggi' => 182,
                'berat' => 72,
                'kelas' => 'XII IPA 1',
                'is_captain' => true,
            ],
            [
                'name' => 'Galih Sanjaya',
                'email' => 'galih@wikcup.id',
                'team' => 'SMAN 1 Bogor Eagles',
                'no_punggung' => 4,
                'posisi' => 'Shooting Guard (SG)',
                'gender' => 'Boys',
                'tinggi' => 179,
                'berat' => 69,
                'kelas' => 'XI IPA 3',
                'is_captain' => false,
            ],

            // --- SMA Regina Pacis Warriors (Boys) ---
            [
                'name' => 'Reza Ardiansyah',
                'email' => 'reza@wikcup.id',
                'team' => 'SMA Regina Pacis Warriors',
                'no_punggung' => 3,
                'posisi' => 'Point Guard (PG)',
                'gender' => 'Boys',
                'tinggi' => 174,
                'berat' => 64,
                'kelas' => 'XI IPS 2',
                'is_captain' => true,
            ],
            [
                'name' => 'Rama Pratama',
                'email' => 'rama@wikcup.id',
                'team' => 'SMA Regina Pacis Warriors',
                'no_punggung' => 9,
                'posisi' => 'Shooting Guard (SG)',
                'gender' => 'Boys',
                'tinggi' => 180,
                'berat' => 71,
                'kelas' => 'XII IPS 1',
                'is_captain' => false,
            ],

            // --- SMA Kesatuan Knights (Boys) ---
            [
                'name' => 'Naufal Hidayat',
                'email' => 'naufal@wikcup.id',
                'team' => 'SMA Kesatuan Knights',
                'no_punggung' => 12,
                'posisi' => 'Power Forward (PF)',
                'gender' => 'Boys',
                'tinggi' => 185,
                'berat' => 78,
                'kelas' => 'XII IPA 2',
                'is_captain' => true,
            ],

            // ================= GIRLS DIVISION =================
            // --- SMK Wikrama Queens (Girls) ---
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti@wikcup.id',
                'team' => 'SMK Wikrama Queens',
                'no_punggung' => 5,
                'posisi' => 'Point Guard (PG)',
                'gender' => 'Girls',
                'tinggi' => 165,
                'berat' => 52,
                'kelas' => 'XI PPLG 1',
                'is_captain' => true,
            ],
            [
                'name' => 'Aisyah Putri',
                'email' => 'aisyah@wikcup.id',
                'team' => 'SMK Wikrama Queens',
                'no_punggung' => 13,
                'posisi' => 'Center (C)',
                'gender' => 'Girls',
                'tinggi' => 178,
                'berat' => 66,
                'kelas' => 'XII PPLG 2',
                'is_captain' => false,
            ],
            [
                'name' => 'Zahra Anindya',
                'email' => 'zahra@wikcup.id',
                'team' => 'SMK Wikrama Queens',
                'no_punggung' => 9,
                'posisi' => 'Shooting Guard (SG)',
                'gender' => 'Girls',
                'tinggi' => 168,
                'berat' => 55,
                'kelas' => 'XI DKV 2',
                'is_captain' => false,
            ],
            [
                'name' => 'Nabila Maharani',
                'email' => 'nabila@wikcup.id',
                'team' => 'SMK Wikrama Queens',
                'no_punggung' => 21,
                'posisi' => 'Small Forward (SF)',
                'gender' => 'Girls',
                'tinggi' => 171,
                'berat' => 58,
                'kelas' => 'XII MPLB 1',
                'is_captain' => false,
            ],
            [
                'name' => 'Tasya Amanda',
                'email' => 'tasya@wikcup.id',
                'team' => 'SMK Wikrama Queens',
                'no_punggung' => 17,
                'posisi' => 'Power Forward (PF)',
                'gender' => 'Girls',
                'tinggi' => 174,
                'berat' => 62,
                'kelas' => 'XI BDP 1',
                'is_captain' => false,
            ],

            // --- SMAN 1 Bogor Sirens (Girls) ---
            [
                'name' => 'Clarissa Aurelia',
                'email' => 'clarissa@wikcup.id',
                'team' => 'SMAN 1 Bogor Sirens',
                'no_punggung' => 8,
                'posisi' => 'Point Guard (PG)',
                'gender' => 'Girls',
                'tinggi' => 167,
                'berat' => 54,
                'kelas' => 'XII IPA 3',
                'is_captain' => true,
            ],
            [
                'name' => 'Keisha Larasati',
                'email' => 'keisha@wikcup.id',
                'team' => 'SMAN 1 Bogor Sirens',
                'no_punggung' => 22,
                'posisi' => 'Center (C)',
                'gender' => 'Girls',
                'tinggi' => 180,
                'berat' => 69,
                'kelas' => 'XI IPA 1',
                'is_captain' => false,
            ],
            [
                'name' => 'Meisya Febriani',
                'email' => 'meisya@wikcup.id',
                'team' => 'SMAN 1 Bogor Sirens',
                'no_punggung' => 14,
                'posisi' => 'Small Forward (SF)',
                'gender' => 'Girls',
                'tinggi' => 172,
                'berat' => 57,
                'kelas' => 'XII IPS 2',
                'is_captain' => false,
            ],

            // --- SMA Kesatuan Sparks (Girls) ---
            [
                'name' => 'Valerie Michelle',
                'email' => 'valerie@wikcup.id',
                'team' => 'SMA Kesatuan Sparks',
                'no_punggung' => 10,
                'posisi' => 'Shooting Guard (SG)',
                'gender' => 'Girls',
                'tinggi' => 170,
                'berat' => 56,
                'kelas' => 'XI IPA 2',
                'is_captain' => true,
            ],
            [
                'name' => 'Nadine Samantha',
                'email' => 'nadine@wikcup.id',
                'team' => 'SMA Kesatuan Sparks',
                'no_punggung' => 15,
                'posisi' => 'Power Forward (PF)',
                'gender' => 'Girls',
                'tinggi' => 175,
                'berat' => 63,
                'kelas' => 'XII IPS 1',
                'is_captain' => false,
            ],
        ];

        $players = [];
        foreach ($playersData as $p) {
            $user = User::create([
                'name' => $p['name'],
                'email' => $p['email'],
                'password' => Hash::make('password'),
                'role' => 'pemain',
            ]);

            $player = Player::create([
                'id_user' => $user->id_user,
                'id_team' => $teams[$p['team']]->id_team,
                'nama' => $p['name'],
                'no_punggung' => $p['no_punggung'],
                'posisi' => $p['posisi'],
                'gender' => $p['gender'],
                'tinggi_badan' => $p['tinggi'],
                'berat_badan' => $p['berat'],
                'kelas_program' => $p['kelas'],
                'is_captain' => $p['is_captain'],
            ]);

            $players[$p['name']] = $player;
        }

        // 4. Seed Matches
        $today = Carbon::today();

        // Match 1: Thunder vs Hawks (Boys)
        $match1 = MatchModel::create([
            'team_a_id' => $teams['SMK Wikrama Thunder']->id_team,
            'team_b_id' => $teams['SMK Wikrama Hawks']->id_team,
            'tanggal' => $today->copy()->subDays(4),
            'jam' => '15:30:00',
            'lokasi' => 'Lapangan Utama SMK Wikrama',
            'skor_tim_a' => 72,
            'skor_tim_b' => 65,
        ]);

        // Match 2: SMAN 1 Bogor Eagles vs SMA Regina Pacis (Boys)
        $match2 = MatchModel::create([
            'team_a_id' => $teams['SMAN 1 Bogor Eagles']->id_team,
            'team_b_id' => $teams['SMA Regina Pacis Warriors']->id_team,
            'tanggal' => $today->copy()->subDays(3),
            'jam' => '16:45:00',
            'lokasi' => 'Lapangan Utama SMK Wikrama',
            'skor_tim_a' => 58,
            'skor_tim_b' => 62,
        ]);

        // Match 3: SMK Wikrama Queens vs SMAN 1 Bogor Sirens (Girls)
        $match3 = MatchModel::create([
            'team_a_id' => $teams['SMK Wikrama Queens']->id_team,
            'team_b_id' => $teams['SMAN 1 Bogor Sirens']->id_team,
            'tanggal' => $today->copy()->subDays(2),
            'jam' => '14:00:00',
            'lokasi' => 'Lapangan Utama SMK Wikrama',
            'skor_tim_a' => 48,
            'skor_tim_b' => 44,
        ]);

        // Match 4: SMA Kesatuan Knights vs SMK Wikrama Thunder (Boys)
        $match4 = MatchModel::create([
            'team_a_id' => $teams['SMA Kesatuan Knights']->id_team,
            'team_b_id' => $teams['SMK Wikrama Thunder']->id_team,
            'tanggal' => $today->copy()->subDay(1),
            'jam' => '15:30:00',
            'lokasi' => 'Lapangan Utama SMK Wikrama',
            'skor_tim_a' => 66,
            'skor_tim_b' => 70,
        ]);

        // Match 5: SMK Wikrama Queens vs SMA Kesatuan Sparks (Girls)
        $match5 = MatchModel::create([
            'team_a_id' => $teams['SMK Wikrama Queens']->id_team,
            'team_b_id' => $teams['SMA Kesatuan Sparks']->id_team,
            'tanggal' => $today->copy()->subDay(1),
            'jam' => '17:00:00',
            'lokasi' => 'Lapangan Utama SMK Wikrama',
            'skor_tim_a' => 52,
            'skor_tim_b' => 50,
        ]);

        // Upcoming Matches
        $match6 = MatchModel::create([
            'team_a_id' => $teams['SMK Wikrama Hawks']->id_team,
            'team_b_id' => $teams['SMA Regina Pacis Warriors']->id_team,
            'tanggal' => $today->copy()->addDays(2),
            'jam' => '15:30:00',
            'lokasi' => 'Lapangan Utama SMK Wikrama',
            'skor_tim_a' => null,
            'skor_tim_b' => null,
        ]);

        // 5. Seed Box Score Statistics
        // === Match 1: Thunder vs Hawks (Boys) ===
        Statistic::create([
            'id_player' => $players['Rizky Pratama']->id_player,
            'id_match' => $match1->id_match,
            'minutes' => '32:15',
            'poin' => 28,
            'rebound' => 6,
            'assist' => 5,
            'steal' => 3,
            'block' => 1,
            'turnover' => 2,
            'fgm' => 10,
            'fga' => 18,
            'three_point_made' => 4,
            'three_point_attempted' => 7,
            'two_point_made' => 6,
            'two_point_attempted' => 11,
            'free_throw_made' => 4,
            'free_throw_attempted' => 5,
            'defensive_rebound' => 5,
            'foul' => 2,
            'plus_minus' => 12,
        ]);

        Statistic::create([
            'id_player' => $players['Dimas Saputra']->id_player,
            'id_match' => $match1->id_match,
            'minutes' => '28:40',
            'poin' => 14,
            'rebound' => 4,
            'assist' => 9,
            'steal' => 2,
            'block' => 0,
            'turnover' => 3,
            'fgm' => 5,
            'fga' => 11,
            'three_point_made' => 2,
            'three_point_attempted' => 4,
            'two_point_made' => 3,
            'two_point_attempted' => 7,
            'free_throw_made' => 2,
            'free_throw_attempted' => 2,
            'defensive_rebound' => 3,
            'foul' => 1,
            'plus_minus' => 8,
        ]);

        Statistic::create([
            'id_player' => $players['Farhan Alfarizi']->id_player,
            'id_match' => $match1->id_match,
            'minutes' => '25:10',
            'poin' => 12,
            'rebound' => 7,
            'assist' => 3,
            'steal' => 1,
            'block' => 1,
            'turnover' => 1,
            'fgm' => 5,
            'fga' => 9,
            'three_point_made' => 1,
            'three_point_attempted' => 3,
            'two_point_made' => 4,
            'two_point_attempted' => 6,
            'free_throw_made' => 1,
            'free_throw_attempted' => 2,
            'defensive_rebound' => 5,
            'foul' => 3,
            'plus_minus' => 6,
        ]);

        Statistic::create([
            'id_player' => $players['Kevin Maulana']->id_player,
            'id_match' => $match1->id_match,
            'minutes' => '22:30',
            'poin' => 8,
            'rebound' => 9,
            'assist' => 2,
            'steal' => 0,
            'block' => 2,
            'turnover' => 2,
            'fgm' => 4,
            'fga' => 8,
            'three_point_made' => 0,
            'three_point_attempted' => 0,
            'two_point_made' => 4,
            'two_point_attempted' => 8,
            'free_throw_made' => 0,
            'free_throw_attempted' => 2,
            'defensive_rebound' => 6,
            'foul' => 4,
            'plus_minus' => 4,
        ]);

        Statistic::create([
            'id_player' => $players['Bintang Ramadhan']->id_player,
            'id_match' => $match1->id_match,
            'minutes' => '26:00',
            'poin' => 10,
            'rebound' => 14,
            'assist' => 1,
            'steal' => 1,
            'block' => 4,
            'turnover' => 1,
            'fgm' => 4,
            'fga' => 7,
            'three_point_made' => 0,
            'three_point_attempted' => 0,
            'two_point_made' => 4,
            'two_point_attempted' => 7,
            'free_throw_made' => 2,
            'free_throw_attempted' => 4,
            'defensive_rebound' => 10,
            'foul' => 3,
            'plus_minus' => 5,
        ]);

        Statistic::create([
            'id_player' => $players['Andi Wijaya']->id_player,
            'id_match' => $match1->id_match,
            'minutes' => '34:00',
            'poin' => 24,
            'rebound' => 5,
            'assist' => 8,
            'steal' => 3,
            'block' => 0,
            'turnover' => 4,
            'fgm' => 9,
            'fga' => 17,
            'three_point_made' => 3,
            'three_point_attempted' => 6,
            'two_point_made' => 6,
            'two_point_attempted' => 11,
            'free_throw_made' => 3,
            'free_throw_attempted' => 4,
            'defensive_rebound' => 4,
            'foul' => 2,
            'plus_minus' => -7,
        ]);

        Statistic::create([
            'id_player' => $players['Fajar Nugraha']->id_player,
            'id_match' => $match1->id_match,
            'minutes' => '30:15',
            'poin' => 22,
            'rebound' => 4,
            'assist' => 3,
            'steal' => 2,
            'block' => 0,
            'turnover' => 2,
            'fgm' => 8,
            'fga' => 16,
            'three_point_made' => 4,
            'three_point_attempted' => 8,
            'two_point_made' => 4,
            'two_point_attempted' => 8,
            'free_throw_made' => 2,
            'free_throw_attempted' => 2,
            'defensive_rebound' => 3,
            'foul' => 1,
            'plus_minus' => -5,
        ]);

        Statistic::create([
            'id_player' => $players['Bagas Triadi']->id_player,
            'id_match' => $match1->id_match,
            'minutes' => '31:20',
            'poin' => 19,
            'rebound' => 16,
            'assist' => 2,
            'steal' => 1,
            'block' => 3,
            'turnover' => 1,
            'fgm' => 8,
            'fga' => 12,
            'three_point_made' => 0,
            'three_point_attempted' => 0,
            'two_point_made' => 8,
            'two_point_attempted' => 12,
            'free_throw_made' => 3,
            'free_throw_attempted' => 5,
            'defensive_rebound' => 11,
            'foul' => 4,
            'plus_minus' => -3,
        ]);

        // === Match 2: Eagles vs Warriors (Boys) ===
        Statistic::create([
            'id_player' => $players['Aldy Reyhan']->id_player,
            'id_match' => $match2->id_match,
            'minutes' => '35:00',
            'poin' => 31,
            'rebound' => 8,
            'assist' => 4,
            'steal' => 4,
            'block' => 2,
            'turnover' => 3,
            'fgm' => 11,
            'fga' => 21,
            'three_point_made' => 5,
            'three_point_attempted' => 9,
            'two_point_made' => 6,
            'two_point_attempted' => 12,
            'free_throw_made' => 4,
            'free_throw_attempted' => 6,
            'defensive_rebound' => 6,
            'foul' => 2,
            'plus_minus' => -4,
        ]);

        Statistic::create([
            'id_player' => $players['Galih Sanjaya']->id_player,
            'id_match' => $match2->id_match,
            'minutes' => '29:00',
            'poin' => 15,
            'rebound' => 5,
            'assist' => 3,
            'steal' => 2,
            'block' => 0,
            'turnover' => 2,
            'fgm' => 6,
            'fga' => 13,
            'three_point_made' => 2,
            'three_point_attempted' => 5,
            'two_point_made' => 4,
            'two_point_attempted' => 8,
            'free_throw_made' => 1,
            'free_throw_attempted' => 2,
            'defensive_rebound' => 4,
            'foul' => 3,
            'plus_minus' => -2,
        ]);

        Statistic::create([
            'id_player' => $players['Reza Ardiansyah']->id_player,
            'id_match' => $match2->id_match,
            'minutes' => '33:10',
            'poin' => 26,
            'rebound' => 6,
            'assist' => 10,
            'steal' => 5,
            'block' => 1,
            'turnover' => 2,
            'fgm' => 9,
            'fga' => 15,
            'three_point_made' => 3,
            'three_point_attempted' => 5,
            'two_point_made' => 6,
            'two_point_attempted' => 10,
            'free_throw_made' => 5,
            'free_throw_attempted' => 5,
            'defensive_rebound' => 5,
            'foul' => 1,
            'plus_minus' => 4,
        ]);

        Statistic::create([
            'id_player' => $players['Rama Pratama']->id_player,
            'id_match' => $match2->id_match,
            'minutes' => '34:45',
            'poin' => 20,
            'rebound' => 5,
            'assist' => 4,
            'steal' => 2,
            'block' => 0,
            'turnover' => 1,
            'fgm' => 7,
            'fga' => 14,
            'three_point_made' => 3,
            'three_point_attempted' => 6,
            'two_point_made' => 4,
            'two_point_attempted' => 8,
            'free_throw_made' => 3,
            'free_throw_attempted' => 4,
            'defensive_rebound' => 4,
            'foul' => 2,
            'plus_minus' => 4,
        ]);

        // === Match 3: Queens vs Sirens (Girls) ===
        Statistic::create([
            'id_player' => $players['Siti Nurhaliza']->id_player,
            'id_match' => $match3->id_match,
            'minutes' => '32:00',
            'poin' => 18,
            'rebound' => 5,
            'assist' => 8,
            'steal' => 4,
            'block' => 1,
            'turnover' => 2,
            'fgm' => 6,
            'fga' => 12,
            'three_point_made' => 2,
            'three_point_attempted' => 4,
            'two_point_made' => 4,
            'two_point_attempted' => 8,
            'free_throw_made' => 4,
            'free_throw_attempted' => 4,
            'defensive_rebound' => 4,
            'foul' => 2,
            'plus_minus' => 4,
        ]);

        Statistic::create([
            'id_player' => $players['Aisyah Putri']->id_player,
            'id_match' => $match3->id_match,
            'minutes' => '30:00',
            'poin' => 14,
            'rebound' => 15,
            'assist' => 2,
            'steal' => 2,
            'block' => 4,
            'turnover' => 1,
            'fgm' => 6,
            'fga' => 10,
            'three_point_made' => 0,
            'three_point_attempted' => 0,
            'two_point_made' => 6,
            'two_point_attempted' => 10,
            'free_throw_made' => 2,
            'free_throw_attempted' => 4,
            'defensive_rebound' => 11,
            'foul' => 3,
            'plus_minus' => 6,
        ]);

        Statistic::create([
            'id_player' => $players['Zahra Anindya']->id_player,
            'id_match' => $match3->id_match,
            'minutes' => '28:15',
            'poin' => 12,
            'rebound' => 4,
            'assist' => 3,
            'steal' => 3,
            'block' => 0,
            'turnover' => 2,
            'fgm' => 4,
            'fga' => 9,
            'three_point_made' => 2,
            'three_point_attempted' => 5,
            'two_point_made' => 2,
            'two_point_attempted' => 4,
            'free_throw_made' => 2,
            'free_throw_attempted' => 2,
            'defensive_rebound' => 3,
            'foul' => 1,
            'plus_minus' => 4,
        ]);

        Statistic::create([
            'id_player' => $players['Clarissa Aurelia']->id_player,
            'id_match' => $match3->id_match,
            'minutes' => '34:00',
            'poin' => 22,
            'rebound' => 6,
            'assist' => 6,
            'steal' => 3,
            'block' => 1,
            'turnover' => 3,
            'fgm' => 8,
            'fga' => 16,
            'three_point_made' => 3,
            'three_point_attempted' => 6,
            'two_point_made' => 5,
            'two_point_attempted' => 10,
            'free_throw_made' => 3,
            'free_throw_attempted' => 4,
            'defensive_rebound' => 5,
            'foul' => 2,
            'plus_minus' => -4,
        ]);

        Statistic::create([
            'id_player' => $players['Keisha Larasati']->id_player,
            'id_match' => $match3->id_match,
            'minutes' => '31:00',
            'poin' => 12,
            'rebound' => 13,
            'assist' => 1,
            'steal' => 1,
            'block' => 3,
            'turnover' => 2,
            'fgm' => 5,
            'fga' => 11,
            'three_point_made' => 0,
            'three_point_attempted' => 0,
            'two_point_made' => 5,
            'two_point_attempted' => 11,
            'free_throw_made' => 2,
            'free_throw_attempted' => 3,
            'defensive_rebound' => 9,
            'foul' => 3,
            'plus_minus' => -2,
        ]);

        // === Match 4: Knights vs Thunder (Boys) ===
        Statistic::create([
            'id_player' => $players['Naufal Hidayat']->id_player,
            'id_match' => $match4->id_match,
            'minutes' => '34:00',
            'poin' => 25,
            'rebound' => 12,
            'assist' => 3,
            'steal' => 2,
            'block' => 3,
            'turnover' => 2,
            'fgm' => 10,
            'fga' => 17,
            'three_point_made' => 1,
            'three_point_attempted' => 2,
            'two_point_made' => 9,
            'two_point_attempted' => 15,
            'free_throw_made' => 4,
            'free_throw_attempted' => 6,
            'defensive_rebound' => 9,
            'foul' => 3,
            'plus_minus' => -4,
        ]);

        Statistic::create([
            'id_player' => $players['Rizky Pratama']->id_player,
            'id_match' => $match4->id_match,
            'minutes' => '33:00',
            'poin' => 24,
            'rebound' => 7,
            'assist' => 6,
            'steal' => 2,
            'block' => 1,
            'turnover' => 1,
            'fgm' => 9,
            'fga' => 16,
            'three_point_made' => 3,
            'three_point_attempted' => 6,
            'two_point_made' => 6,
            'two_point_attempted' => 10,
            'free_throw_made' => 3,
            'free_throw_attempted' => 4,
            'defensive_rebound' => 5,
            'foul' => 2,
            'plus_minus' => 4,
        ]);

        Statistic::create([
            'id_player' => $players['Dimas Saputra']->id_player,
            'id_match' => $match4->id_match,
            'minutes' => '29:00',
            'poin' => 16,
            'rebound' => 5,
            'assist' => 8,
            'steal' => 3,
            'block' => 0,
            'turnover' => 2,
            'fgm' => 6,
            'fga' => 12,
            'three_point_made' => 2,
            'three_point_attempted' => 5,
            'two_point_made' => 4,
            'two_point_attempted' => 7,
            'free_throw_made' => 2,
            'free_throw_attempted' => 2,
            'defensive_rebound' => 4,
            'foul' => 2,
            'plus_minus' => 5,
        ]);

        // === Match 5: Queens vs Sparks (Girls) ===
        Statistic::create([
            'id_player' => $players['Siti Nurhaliza']->id_player,
            'id_match' => $match5->id_match,
            'minutes' => '31:30',
            'poin' => 20,
            'rebound' => 6,
            'assist' => 7,
            'steal' => 3,
            'block' => 0,
            'turnover' => 2,
            'fgm' => 7,
            'fga' => 13,
            'three_point_made' => 2,
            'three_point_attempted' => 4,
            'two_point_made' => 5,
            'two_point_attempted' => 9,
            'free_throw_made' => 4,
            'free_throw_attempted' => 5,
            'defensive_rebound' => 4,
            'foul' => 2,
            'plus_minus' => 2,
        ]);

        Statistic::create([
            'id_player' => $players['Valerie Michelle']->id_player,
            'id_match' => $match5->id_match,
            'minutes' => '33:00',
            'poin' => 21,
            'rebound' => 4,
            'assist' => 4,
            'steal' => 3,
            'block' => 1,
            'turnover' => 3,
            'fgm' => 8,
            'fga' => 15,
            'three_point_made' => 3,
            'three_point_attempted' => 7,
            'two_point_made' => 5,
            'two_point_attempted' => 8,
            'free_throw_made' => 2,
            'free_throw_attempted' => 3,
            'defensive_rebound' => 3,
            'foul' => 3,
            'plus_minus' => -2,
        ]);

        Statistic::create([
            'id_player' => $players['Nadine Samantha']->id_player,
            'id_match' => $match5->id_match,
            'minutes' => '30:00',
            'poin' => 15,
            'rebound' => 14,
            'assist' => 2,
            'steal' => 1,
            'block' => 2,
            'turnover' => 2,
            'fgm' => 6,
            'fga' => 11,
            'three_point_made' => 0,
            'three_point_attempted' => 0,
            'two_point_made' => 6,
            'two_point_attempted' => 11,
            'free_throw_made' => 3,
            'free_throw_attempted' => 4,
            'defensive_rebound' => 10,
            'foul' => 2,
            'plus_minus' => -1,
        ]);

        // 6. Seed Galleries
        $galleries = [
            [
                'id_match' => $match1->id_match,
                'foto' => 'https://images.unsplash.com/photo-1546519638-68e109498ffc?q=80&w=1200&auto=format&fit=crop',
                'caption' => 'Aksi shooting buzzer beater menegangkan di kuarter ke-4 antara SMK Wikrama Thunder vs SMK Wikrama Hawks.',
                'tanggal' => $today->copy()->subDays(4)->format('Y-m-d'),
            ],
            [
                'id_match' => $match1->id_match,
                'foto' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=1200&auto=format&fit=crop',
                'caption' => 'Defense ketat dan rebound agresif di bawah ring pada laga pembuka turnamen WikCup.',
                'tanggal' => $today->copy()->subDays(4)->format('Y-m-d'),
            ],
            [
                'id_match' => $match2->id_match,
                'foto' => 'https://images.unsplash.com/photo-1519766304817-4f37bda74a29?q=80&w=1200&auto=format&fit=crop',
                'caption' => 'Fastbreak kilat dan selebrasi kemenangan dramatis SMA Regina Pacis Warriors.',
                'tanggal' => $today->copy()->subDays(3)->format('Y-m-d'),
            ],
            [
                'id_match' => $match3->id_match,
                'foto' => 'https://images.unsplash.com/photo-1518063319789-7217e6706b04?q=80&w=1200&auto=format&fit=crop',
                'caption' => 'Duel sengit divisi putri antara SMK Wikrama Queens vs SMAN 1 Bogor Sirens.',
                'tanggal' => $today->copy()->subDays(2)->format('Y-m-d'),
            ],
            [
                'id_match' => null,
                'foto' => 'https://images.unsplash.com/photo-1504450758481-7338eba7524a?q=80&w=1200&auto=format&fit=crop',
                'caption' => 'Suasana meriah upacara pembukaan Wikrama Cup Basketball di Lapangan Utama SMK Wikrama Bogor.',
                'tanggal' => $today->copy()->subDays(5)->format('Y-m-d'),
            ],
            [
                'id_match' => null,
                'foto' => 'https://images.unsplash.com/photo-1579952363873-27f3bade9f55?q=80&w=1200&auto=format&fit=crop',
                'caption' => 'Trofi bergengsi Juara WikCup Basketball Tournament siap diperebutkan oleh tim-tim terbaik.',
                'tanggal' => $today->copy()->subDays(5)->format('Y-m-d'),
            ],
        ];

        foreach ($galleries as $g) {
            Gallery::create($g);
        }
    }
}
