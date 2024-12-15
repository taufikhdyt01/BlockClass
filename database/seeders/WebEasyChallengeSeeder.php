<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WebEasyChallengeSeeder extends Seeder
{
    public function run()
    {
        $challenges = [
            [
                'title' => 'Validasi Umur Pengguna',
                'description' => 'Buat fungsi untuk memvalidasi umur pengguna website. Jika umur < 13, return "Tidak Diizinkan". Jika umur 13-17, return "Remaja". Jika umur >= 18, return "Dewasa".',
                'difficulty' => 'easy',
                'category' => 'Validasi',
                'access_type' => 'private',
                'access_code' => 'WEB101',
                'function_name' => 'validasiUmur',
                'initial_xml' => '<xml xmlns="https://developers.google.com/blockly/xml">
                    <block type="procedures_defreturn" x="20" y="20">
                        <mutation>
                            <arg name="umur" varid="123"></arg>
                        </mutation>
                        <field name="NAME">validasiUmur</field>
                        <comment pinned="false" h="80" w="160">Validasi umur pengguna</comment>
                    </block>
                </xml>',
                'hints' => json_encode([
                    'Gunakan if-else untuk mengecek range umur',
                    'Mulai dari pengecekan umur terkecil',
                    'Pastikan semua kondisi umur ter-handle'
                ]),
                'constraints' => json_encode([
                    '0 ≤ umur ≤ 100',
                    'Input akan selalu berupa bilangan bulat non-negatif'
                ])
            ],
            [
                'title' => 'Status HTTP',
                'description' => 'Buat fungsi yang mengembalikan status response HTTP. Jika kode 200, return "Sukses". Jika kode 404, return "Tidak Ditemukan". Jika kode 500, return "Error Server". Selain itu return "Kode Tidak Dikenal".',
                'difficulty' => 'easy',
                'category' => 'Web',
                'access_type' => 'private',
                'access_code' => 'WEB102',
                'function_name' => 'statusHTTP',
                'initial_xml' => '<xml xmlns="https://developers.google.com/blockly/xml">
                    <block type="procedures_defreturn" x="20" y="20">
                        <mutation>
                            <arg name="kode" varid="124"></arg>
                        </mutation>
                        <field name="NAME">statusHTTP</field>
                        <comment pinned="false" h="80" w="160">Status HTTP Response</comment>
                    </block>
                </xml>',
                'hints' => json_encode([
                    'Gunakan if-else untuk setiap kode status',
                    'Pastikan ada default return value',
                    'Perhatikan penulisan status yang tepat'
                ]),
                'constraints' => json_encode([
                    'Input berupa kode HTTP yang umum',
                    'Return value harus sesuai dengan spesifikasi'
                ])
            ],
            [
                'title' => 'Hitung Diskon',
                'description' => 'Buat fungsi untuk menghitung total harga setelah diskon. Jika total belanja > 500000, diskon 10%. Jika total belanja > 300000, diskon 5%. Jika total belanja <= 300000, tidak ada diskon.',
                'difficulty' => 'easy',
                'category' => 'Aritmatika',
                'access_type' => 'private',
                'access_code' => 'WEB103',
                'function_name' => 'hitungDiskon',
                'initial_xml' => '<xml xmlns="https://developers.google.com/blockly/xml">
                    <block type="procedures_defreturn" x="20" y="20">
                        <mutation>
                            <arg name="total" varid="125"></arg>
                        </mutation>
                        <field name="NAME">hitungDiskon</field>
                        <comment pinned="false" h="80" w="160">Hitung total setelah diskon</comment>
                    </block>
                </xml>',
                'hints' => json_encode([
                    'Mulai dari pengecekan total tertinggi',
                    'Hitung diskon dengan persentase',
                    'Kurangkan diskon dari total awal'
                ]),
                'constraints' => json_encode([
                    '0 ≤ total ≤ 1000000',
                    'Input dan output berupa bilangan bulat'
                ])
            ],
            [
                'title' => 'Validasi Password Sederhana',
                'description' => 'Buat fungsi untuk memvalidasi password. Password valid jika panjang minimal 6 karakter dan mengandung minimal 1 angka.',
                'difficulty' => 'easy',
                'category' => 'Validasi',
                'access_type' => 'private',
                'access_code' => 'WEB104',
                'function_name' => 'validasiPassword',
                'initial_xml' => '<xml xmlns="https://developers.google.com/blockly/xml">
                    <block type="procedures_defreturn" x="20" y="20">
                        <mutation>
                            <arg name="password" varid="126"></arg>
                        </mutation>
                        <field name="NAME">validasiPassword</field>
                        <comment pinned="false" h="80" w="160">Validasi password sederhana</comment>
                    </block>
                </xml>',
                'hints' => json_encode([
                    'Cek panjang password terlebih dahulu',
                    'Gunakan loop untuk mencari angka',
                    'Kombinasikan kedua syarat untuk hasil akhir'
                ]),
                'constraints' => json_encode([
                    'Password tidak boleh kosong',
                    'Hanya cek panjang dan keberadaan angka'
                ])
            ],
            [
                'title' => 'Format Nomor Telepon',
                'description' => 'Ubah format nomor telepon dengan menambahkan kode negara. Contoh: "81234567890" menjadi "+62-812-3456-7890". Jika diawali 0, hapus 0 nya. Jika diawali 62, tambahkan + di depan. Jika tidak diawali keduanya, tambahkan +62.',
                'difficulty' => 'easy',
                'category' => 'String',
                'access_type' => 'private',
                'access_code' => 'WEB105',
                'function_name' => 'formatNomorTelepon',
                'initial_xml' => '<xml xmlns="https://developers.google.com/blockly/xml">
                    <block type="procedures_defreturn" x="20" y="20">
                        <mutation>
                            <arg name="nomor" varid="127"></arg>
                        </mutation>
                        <field name="NAME">formatNomorTelepon</field>
                        <comment pinned="false" h="80" w="160">Format nomor telepon</comment>
                    </block>
                </xml>',
                'hints' => json_encode([
                    'Cek karakter awal nomor',
                    'Gunakan substring untuk memisahkan bagian nomor',
                    'Gabungkan dengan format yang diminta'
                ]),
                'constraints' => json_encode([
                    'Panjang nomor 10-13 digit',
                    'Hanya berisi angka'
                ])
            ],
            [
                'title' => 'Format Username Media Sosial',
                'description' => 'Buat fungsi untuk memformat username media sosial dengan ketentuan: 
                1. Jika username tidak diawali @, tambahkan @ di depan
                2. Semua huruf harus kecil (lowercase)
                3. Contoh: "John123" menjadi "@john123", "@USER" menjadi "@user"',
                'difficulty' => 'easy',
                'category' => 'String',
                'access_type' => 'private',
                'access_code' => 'WEB109',
                'function_name' => 'formatSocialUsername',
                'initial_xml' => '<xml xmlns="https://developers.google.com/blockly/xml">
                    <block type="procedures_defreturn" x="20" y="20">
                        <mutation>
                            <arg name="username" varid="131"></arg>
                        </mutation>
                        <field name="NAME">formatSocialUsername</field>
                        <comment pinned="false" h="80" w="160">Format username media sosial</comment>
                    </block>
                </xml>',
                'hints' => json_encode([
                    'Cek karakter pertama apakah @',
                    'Ubah semua huruf menjadi lowercase',
                    'Gabungkan @ jika belum ada'
                ]),
                'constraints' => json_encode([
                    'Username minimal 1 karakter selain @',
                    'Username hanya boleh berisi huruf, angka, dan @',
                    'Karakter @ hanya boleh di awal'
                ])
            ],
            [
                'title' => 'Hitung Kemunculan Huruf',
                'description' => 'Buat fungsi untuk menghitung berapa kali suatu huruf muncul dalam sebuah teks. Fungsi menerima dua parameter: teks dan huruf yang dicari. Contoh: teks="hello world", huruf="l" akan mengembalikan 3.',
                'difficulty' => 'easy',
                'category' => 'String',
                'access_type' => 'private',
                'access_code' => 'WEB119',
                'function_name' => 'hitungHuruf',
                'initial_xml' => '<xml xmlns="https://developers.google.com/blockly/xml">
                    <block type="procedures_defreturn" x="20" y="20">
                        <mutation>
                            <arg name="teks" varid="155"></arg>
                            <arg name="huruf" varid="156"></arg>
                        </mutation>
                        <field name="NAME">hitungHuruf</field>
                        <comment pinned="false" h="80" w="160">Hitung kemunculan huruf</comment>
                    </block>
                </xml>',
                'hints' => json_encode([
                    'Gunakan controls_for untuk loop setiap karakter',
                    'Gunakan text_charAt untuk mengambil huruf pada posisi tertentu',
                    'Bandingkan setiap huruf dengan huruf yang dicari'
                ]),
                'constraints' => json_encode([
                    'Teks tidak boleh kosong',
                    'Huruf yang dicari harus 1 karakter',
                    'Pencarian bersifat case-sensitive'
                ])
            ],
                
        ];

        $challenge_test_cases = [
            'validasiUmur' => [
                [
                    'input' => json_encode([12]),
                    'expected_output' => json_encode("Tidak Diizinkan"),
                    'is_sample' => true,
                ],
                [
                    'input' => json_encode([15]),
                    'expected_output' => json_encode("Remaja"),
                    'is_sample' => true,
                ],
                [
                    'input' => json_encode([18]),
                    'expected_output' => json_encode("Dewasa"),
                    'is_sample' => false,
                ],
                [
                    'input' => json_encode([25]),
                    'expected_output' => json_encode("Dewasa"),
                    'is_sample' => false,
                ],
                [
                    'input' => json_encode([0]),
                    'expected_output' => json_encode("Tidak Diizinkan"),
                    'is_sample' => false,
                ]
            ],
            'statusHTTP' => [
                [
                    'input' => json_encode([200]),
                    'expected_output' => json_encode("Sukses"),
                    'is_sample' => true,
                ],
                [
                    'input' => json_encode([404]),
                    'expected_output' => json_encode("Tidak Ditemukan"),
                    'is_sample' => true,
                ],
                [
                    'input' => json_encode([500]),
                    'expected_output' => json_encode("Error Server"),
                    'is_sample' => false,
                ],
                [
                    'input' => json_encode([403]),
                    'expected_output' => json_encode("Kode Tidak Dikenal"),
                    'is_sample' => false,
                ],
                [
                    'input' => json_encode([301]),
                    'expected_output' => json_encode("Kode Tidak Dikenal"),
                    'is_sample' => false,
                ]
            ],
            'hitungDiskon' => [
                [
                    'input' => json_encode([600000]),
                    'expected_output' => json_encode(540000),
                    'is_sample' => true,
                ],
                [
                    'input' => json_encode([400000]),
                    'expected_output' => json_encode(380000),
                    'is_sample' => true,
                ],
                [
                    'input' => json_encode([300000]),
                    'expected_output' => json_encode(300000),
                    'is_sample' => false,
                ],
                [
                    'input' => json_encode([1000000]),
                    'expected_output' => json_encode(900000),
                    'is_sample' => false,
                ],
                [
                    'input' => json_encode([0]),
                    'expected_output' => json_encode(0),
                    'is_sample' => false,
                ]
            ],
            'validasiPassword' => [
                [
                    'input' => json_encode(["password123"]),
                    'expected_output' => json_encode(true),
                    'is_sample' => true,
                ],
                [
                    'input' => json_encode(["pass"]),
                    'expected_output' => json_encode(false),
                    'is_sample' => true,
                ],
                [
                    'input' => json_encode(["password"]),
                    'expected_output' => json_encode(false),
                    'is_sample' => false,
                ],
                [
                    'input' => json_encode(["123456"]),
                    'expected_output' => json_encode(true),
                    'is_sample' => false,
                ],
                [
                    'input' => json_encode(["pass1"]),
                    'expected_output' => json_encode(false),
                    'is_sample' => false,
                ]
            ],
            'formatNomorTelepon' => [
                [
                    'input' => json_encode(["081234567890"]),
                    'expected_output' => json_encode("+6281234567890"),
                    'is_sample' => true,
                ],
                [
                    'input' => json_encode(["6281234567890"]),
                    'expected_output' => json_encode("+6281234567890"),
                    'is_sample' => true,
                ],
                [
                    'input' => json_encode(["81234567890"]),
                    'expected_output' => json_encode("+6281234567890"),
                    'is_sample' => false,
                ],
                [
                    'input' => json_encode(["08987654321"]),
                    'expected_output' => json_encode("+628987654321"),
                    'is_sample' => false,
                ],
                [
                    'input' => json_encode(["+6289876543210"]),
                    'expected_output' => json_encode("+6289876543210"),
                    'is_sample' => false,
                ],
            ],
            'formatSocialUsername' => [
                [
                    'input' => json_encode(["John123"]),
                    'expected_output' => json_encode("@john123"),
                    'is_sample' => true,
                ],
                [
                    'input' => json_encode(["@USER"]),
                    'expected_output' => json_encode("@user"),
                    'is_sample' => true,
                ],
                [
                    'input' => json_encode(["developer"]),
                    'expected_output' => json_encode("@developer"),
                    'is_sample' => false,
                ],
                [
                    'input' => json_encode(["@admin123"]),
                    'expected_output' => json_encode("@admin123"),
                    'is_sample' => false,
                ],
                [
                    'input' => json_encode(["WebDev"]),
                    'expected_output' => json_encode("@webdev"),
                    'is_sample' => false,
                ]
                ],
            'hitungHuruf' => [
                [
                    'input' => json_encode(["hello world", "l"]),
                    'expected_output' => json_encode(3),
                    'is_sample' => true,
                ],
                [
                    'input' => json_encode(["programming", "m"]),
                    'expected_output' => json_encode(2),
                    'is_sample' => true,
                ],
                [
                    'input' => json_encode(["test", "x"]),
                    'expected_output' => json_encode(0),
                    'is_sample' => false,
                ],
                [
                    'input' => json_encode(["PHP PHP PHP", "P"]),
                    'expected_output' => json_encode(6),
                    'is_sample' => false,
                ],
                [
                    'input' => json_encode(["aaa", "a"]),
                    'expected_output' => json_encode(3),
                    'is_sample' => false,
                ]
            ],
        ];

        // Menambahkan challenges
        foreach ($challenges as $challenge) {
            $challenge['slug'] = Str::slug($challenge['title']);
            
            $existingChallenge = DB::table('challenges')
                ->where('function_name', $challenge['function_name'])
                ->first();

            if (!$existingChallenge) {
                $challengeId = DB::table('challenges')->insertGetId($challenge);

                if (isset($challenge_test_cases[$challenge['function_name']])) {
                    foreach ($challenge_test_cases[$challenge['function_name']] as $testCase) {
                        $testCase['challenge_id'] = $challengeId;
                        DB::table('test_cases')->insert($testCase);
                    }
                    $this->command->info("Added test cases for challenge: {$challenge['title']}");
                }

                $this->command->info("Added challenge: {$challenge['title']} with ID: {$challengeId}");
            } else {
                $this->command->warn("Skipped duplicate challenge: {$challenge['title']}");
            }
        }
    }
}