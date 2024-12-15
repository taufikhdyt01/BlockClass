<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WebProgrammingChallengeSeeder extends Seeder
{
    public function run()
    {
        $challenges = [
            [
                'title' => 'Validasi Username',
                'description' => 'Buat fungsi untuk memvalidasi username. Username valid jika panjang antara 5-12 karakter dan hanya boleh berisi huruf dan angka.',
                'difficulty' => 'medium',
                'category' => 'Validasi',
                'access_type' => 'private',
                'access_code' => 'WEB101',
                'function_name' => 'validasiUsername',
                'initial_xml' => '<xml xmlns="https://developers.google.com/blockly/xml">
                    <block type="procedures_defreturn" x="20" y="20">
                        <mutation>
                            <arg name="username" varid="123"></arg>
                        </mutation>
                        <field name="NAME">validasiUsername</field>
                        <comment pinned="false" h="80" w="160">Validasi username</comment>
                    </block>
                </xml>',
                'hints' => json_encode([
                    'Gunakan length untuk mengecek panjang username',
                    'Loop setiap karakter untuk memastikan hanya huruf dan angka',
                    'Perhatikan kondisi untuk return true/false'
                ]),
                'constraints' => json_encode([
                    'Username hanya boleh berisi huruf dan angka',
                    'Panjang username antara 5-12 karakter'
                ])
            ],
            [
                'title' => 'Format Harga',
                'description' => 'Buat fungsi untuk memformat angka menjadi format harga dengan separator titik setiap 3 digit. Contoh: 1000000 menjadi 1.000.000',
                'difficulty' => 'medium',
                'category' => 'String',
                'access_type' => 'private',
                'access_code' => 'WEB102',
                'function_name' => 'formatHarga',
                'initial_xml' => '<xml xmlns="https://developers.google.com/blockly/xml">
                    <block type="procedures_defreturn" x="20" y="20">
                        <mutation>
                            <arg name="harga" varid="124"></arg>
                        </mutation>
                        <field name="NAME">formatHarga</field>
                        <comment pinned="false" h="80" w="160">Format harga dengan separator</comment>
                    </block>
                </xml>',
                'hints' => json_encode([
                    'Gunakan modulo dan pembagian untuk mendapatkan setiap digit',
                    'Tambahkan titik setiap 3 digit dari belakang',
                    'Perhatikan kasus khusus untuk angka 0'
                ]),
                'constraints' => json_encode([
                    '0 ≤ harga ≤ 1000000000',
                    'Input akan selalu berupa bilangan bulat non-negatif'
                ])
            ],
            [
                'title' => 'Validasi Email Sederhana',
                'description' => 'Buat fungsi untuk mengecek apakah sebuah string adalah email yang valid (mengandung @ dan minimal satu titik setelah @).',
                'difficulty' => 'easy',
                'category' => 'Validasi',
                'access_type' => 'private',
                'access_code' => 'WEB103',
                'function_name' => 'validasiEmail',
                'initial_xml' => '<xml xmlns="https://developers.google.com/blockly/xml">
                    <block type="procedures_defreturn" x="20" y="20">
                        <mutation>
                            <arg name="email" varid="125"></arg>
                        </mutation>
                        <field name="NAME">validasiEmail</field>
                        <comment pinned="false" h="80" w="160">Validasi format email</comment>
                    </block>
                </xml>',
                'hints' => json_encode([
                    'Cek keberadaan karakter @',
                    'Cek keberadaan titik setelah @',
                    'Pastikan ada karakter sebelum @ dan setelah titik'
                ]),
                'constraints' => json_encode([
                    'Email tidak boleh kosong',
                    'Minimal format: x@y.z'
                ])
            ],
            [
                'title' => 'Generate Slug URL',
                'description' => 'Buat fungsi untuk mengubah judul menjadi slug URL. Contoh: "Hello World" menjadi "hello-world". Ganti spasi dengan dash dan huruf kapital menjadi huruf kecil.',
                'difficulty' => 'medium',
                'category' => 'String',
                'access_type' => 'private',
                'access_code' => 'WEB201',
                'function_name' => 'generateSlug',
                'initial_xml' => '<xml xmlns="https://developers.google.com/blockly/xml">
                    <block type="procedures_defreturn" x="20" y="20">
                        <mutation>
                            <arg name="judul" varid="126"></arg>
                        </mutation>
                        <field name="NAME">generateSlug</field>
                        <comment pinned="false" h="80" w="160">Generate slug dari judul</comment>
                    </block>
                </xml>',
                'hints' => json_encode([
                    'Ganti spasi dengan tanda dash (-)',
                    'Ubah semua huruf menjadi lowercase',
                    'Hapus karakter khusus jika ada'
                ]),
                'constraints' => json_encode([
                    'Input tidak boleh kosong',
                    'Hanya huruf, angka, dan spasi yang diproses'
                ])
            ],
            [
                'title' => 'Parse Query String',
                'description' => 'Buat fungsi untuk menghitung jumlah parameter dalam query string. Contoh: "name=john&age=25" memiliki 2 parameter.',
                'difficulty' => 'medium',
                'category' => 'String',
                'access_type' => 'private',
                'access_code' => 'WEB203',
                'function_name' => 'hitungParameter',
                'initial_xml' => '<xml xmlns="https://developers.google.com/blockly/xml">
                    <block type="procedures_defreturn" x="20" y="20">
                        <mutation>
                            <arg name="query" varid="128"></arg>
                        </mutation>
                        <field name="NAME">hitungParameter</field>
                        <comment pinned="false" h="80" w="160">Hitung parameter query string</comment>
                    </block>
                </xml>',
                'hints' => json_encode([
                    'Parameter dipisahkan dengan tanda &',
                    'Setiap parameter memiliki format key=value',
                    'Hitung jumlah tanda & dan tambahkan 1'
                ]),
                'constraints' => json_encode([
                    'Query string bisa kosong',
                    'Format harus sesuai key=value',
                    'Minimal 0 parameter'
                ])
            ],
            [
                'title' => 'Format Tanggal',
                'description' => 'Ubah format tanggal dari "YYYY-MM-DD" menjadi "DD Month YYYY". Contoh: "2024-03-15" menjadi "15 Maret 2024".',
                'difficulty' => 'medium',
                'category' => 'String',
                'access_type' => 'private',
                'access_code' => 'WEB204',
                'function_name' => 'formatTanggal',
                'initial_xml' => '<xml xmlns="https://developers.google.com/blockly/xml">
                    <block type="procedures_defreturn" x="20" y="20">
                        <mutation>
                            <arg name="tanggal" varid="129"></arg>
                        </mutation>
                        <field name="NAME">formatTanggal</field>
                        <comment pinned="false" h="80" w="160">Format tanggal</comment>
                    </block>
                </xml>',
                'hints' => json_encode([
                    'Pisahkan string menggunakan tanda -',
                    'Gunakan array untuk nama bulan',
                    'Gabungkan dengan format yang diminta'
                ]),
                'constraints' => json_encode([
                    'Format input harus YYYY-MM-DD',
                    'Tahun antara 2000-2099',
                    'Bulan antara 01-12',
                    'Tanggal antara 01-31'
                ])
            ]
        ];

        $challenge_test_cases = [
            'validasiUsername' => [
                [
                    'input' => json_encode(["john123"]),
                    'expected_output' => json_encode(true),
                    'is_sample' => true,
                ],
                [
                    'input' => json_encode(["ab"]),
                    'expected_output' => json_encode(false),
                    'is_sample' => true,
                ],
                [
                    'input' => json_encode(["user@123"]),
                    'expected_output' => json_encode(false),
                    'is_sample' => false,
                ],
                [
                    'input' => json_encode(["verylongusername"]),
                    'expected_output' => json_encode(false),
                    'is_sample' => false,
                ],
                [
                    'input' => json_encode(["admin123"]),
                    'expected_output' => json_encode(true),
                    'is_sample' => false,
                ]
            ],
            'formatHarga' => [
                [
                    'input' => json_encode([1000000]),
                    'expected_output' => json_encode("1.000.000"),
                    'is_sample' => true,
                ],
                [
                    'input' => json_encode([5000]),
                    'expected_output' => json_encode("5.000"),
                    'is_sample' => true,
                ],
                [
                    'input' => json_encode([0]),
                    'expected_output' => json_encode("0"),
                    'is_sample' => false,
                ],
                [
                    'input' => json_encode([999999999]),
                    'expected_output' => json_encode("999.999.999"),
                    'is_sample' => false,
                ],
                [
                    'input' => json_encode([100]),
                    'expected_output' => json_encode("100"),
                    'is_sample' => false,          ]
            ],
            'validasiEmail' => [
                [
                    'input' => json_encode(["test@example.com"]),
                    'expected_output' => json_encode(true),
                    'is_sample' => true,
                ],
                [
                    'input' => json_encode(["invalid.email"]),
                    'expected_output' => json_encode(false),
                    'is_sample' => true,
                ],
                [
                    'input' => json_encode(["test@domain"]),
                    'expected_output' => json_encode(false),
                    'is_sample' => false,
                ],
                [
                    'input' => json_encode(["@example.com"]),
                    'expected_output' => json_encode(false),
                    'is_sample' => false,
                ],
                [
                    'input' => json_encode(["user@sub.domain.com"]),
                    'expected_output' => json_encode(true),
                    'is_sample' => false,
                ]
            ],
            'generateSlug' => [
                [
                    'input' => json_encode(["Hello World"]),
                    'expected_output' => json_encode("hello-world"),
                    'is_sample' => true,
                ],
                [
                    'input' => json_encode(["PHP Programming"]),
                    'expected_output' => json_encode("php-programming"),
                    'is_sample' => true,
                ],
                [
                    'input' => json_encode(["Web Development 101"]),
                    'expected_output' => json_encode("web-development-101"),
                    'is_sample' => false,
                ],
                [
                    'input' => json_encode(["Multiple   Spaces"]),
                    'expected_output' => json_encode("multiple-spaces"),
                    'is_sample' => false,
                ],
                [
                    'input' => json_encode(["Laravel & PHP"]),
                    'expected_output' => json_encode("laravel-php"),
                    'is_sample' => false,
                ]
            ],
            'hitungParameter' => [
                [
                    'input' => json_encode(["name=john&age=25"]),
                    'expected_output' => json_encode(2),
                    'is_sample' => true,
                ],
                [
                    'input' => json_encode(["page=1"]),
                    'expected_output' => json_encode(1),
                    'is_sample' => true,
                ],
                [
                    'input' => json_encode([""]),
                    'expected_output' => json_encode(0),
                    'is_sample' => false,
                ],
                [
                    'input' => json_encode(["id=1&name=john&role=admin&active=true"]),
                    'expected_output' => json_encode(4),
                    'is_sample' => false,
                ],
                [
                    'input' => json_encode(["key="]),
                    'expected_output' => json_encode(1),
                    'is_sample' => false,
                ]
            ],
            'formatTanggal' => [
                [
                    'input' => json_encode(["2024-03-15"]),
                    'expected_output' => json_encode("15 Maret 2024"),
                    'is_sample' => true,
                ],
                [
                    'input' => json_encode(["2024-12-31"]),
                    'expected_output' => json_encode("31 Desember 2024"),
                    'is_sample' => true,
                ],
                [
                    'input' => json_encode(["2024-01-01"]),
                    'expected_output' => json_encode("1 Januari 2024"),
                    'is_sample' => false,
                ],
                [
                    'input' => json_encode(["2024-07-15"]),
                    'expected_output' => json_encode("15 Juli 2024"),
                    'is_sample' => false,
                ],
                [
                    'input' => json_encode(["2024-02-29"]),
                    'expected_output' => json_encode("29 Februari 2024"),
                    'is_sample' => false,
                ]
            ]
        ];

        // Menambahkan challenges
        foreach ($challenges as $challenge) {
            $challenge['slug'] = Str::slug($challenge['title']);
            
            // Cek apakah challenge sudah ada
            $existingChallenge = DB::table('challenges')
                ->where('function_name', $challenge['function_name'])
                ->first();

            if (!$existingChallenge) {
                // Insert challenge baru
                $challengeId = DB::table('challenges')->insertGetId($challenge);

                // Insert test cases
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