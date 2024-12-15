<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdditionalChallengeSeeder extends Seeder
{
    public function run()
    {
        $additional_challenges = [
            [
                'title' => 'Menghitung Keliling Persegi',
                'description' => 'Buatlah fungsi untuk menghitung keliling persegi. Fungsi menerima satu parameter sisi (s) dan harus mengembalikan hasil keliling persegi (4 × sisi).',
                'difficulty' => 'easy',
                'category' => 'Geometri',
                'access_type' => 'private',
                'access_code' => 'GEOM102',
                'function_name' => 'hitungKeliling',
                'initial_xml' => '<xml xmlns="https://developers.google.com/blockly/xml">
                    <block type="procedures_defreturn" x="20" y="20">
                        <mutation>
                            <arg name="sisi" varid="101"></arg>
                        </mutation>
                        <field name="NAME">hitungKeliling</field>
                        <comment pinned="false" h="80" w="160">Hitung keliling persegi</comment>
                    </block>
                </xml>',
                'hints' => json_encode([
                    'Keliling persegi adalah 4 × sisi',
                    'Gunakan operasi perkalian sederhana',
                    'Pastikan untuk mengembalikan hasil perhitungan'
                ]),
                'constraints' => json_encode([
                    '1 ≤ sisi ≤ 100',
                    'Input akan selalu berupa bilangan bulat positif'
                ])
            ],
            [
                'title' => 'Mengubah Huruf Menjadi Kapital',
                'description' => 'Buatlah fungsi untuk mengubah string menjadi huruf kapital. Fungsi menerima satu parameter string dan mengembalikan string dalam huruf kapital.',
                'difficulty' => 'easy',
                'category' => 'String',
                'access_type' => 'private',
                'access_code' => 'STR101',
                'function_name' => 'ubahKapital',
                'initial_xml' => '<xml xmlns="https://developers.google.com/blockly/xml">
                    <block type="procedures_defreturn" x="20" y="20">
                        <mutation>
                            <arg name="teks" varid="102"></arg>
                        </mutation>
                        <field name="NAME">ubahKapital</field>
                        <comment pinned="false" h="80" w="160">Ubah teks menjadi kapital</comment>
                    </block>
                </xml>',
                'hints' => json_encode([
                    'Gunakan fungsi untuk mengubah string menjadi kapital',
                    'Perhatikan bahwa input bisa berupa huruf kecil atau campuran'
                ]),
                'constraints' => json_encode([
                    'Panjang string 1 ≤ n ≤ 100',
                    'Input hanya berisi huruf alfabet dan spasi'
                ])
            ],
            [
                'title' => 'Menghitung Jumlah Digit',
                'description' => 'Buatlah fungsi untuk menghitung jumlah digit dalam sebuah bilangan bulat positif. Misalnya angka 123 memiliki 3 digit.',
                'difficulty' => 'easy',
                'category' => 'Logika',
                'access_type' => 'private',
                'access_code' => 'LOG102',
                'function_name' => 'hitungDigit',
                'initial_xml' => '<xml xmlns="https://developers.google.com/blockly/xml">
                    <block type="procedures_defreturn" x="20" y="20">
                        <mutation>
                            <arg name="angka" varid="103"></arg>
                        </mutation>
                        <field name="NAME">hitungDigit</field>
                        <comment pinned="false" h="80" w="160">Hitung jumlah digit</comment>
                    </block>
                </xml>',
                'hints' => json_encode([
                    'Ubah angka menjadi string untuk menghitung panjangnya',
                    'Atau gunakan pembagian berulang dengan 10'
                ]),
                'constraints' => json_encode([
                    '0 ≤ angka ≤ 1000000',
                    'Input akan selalu berupa bilangan bulat non-negatif'
                ])
            ],
            [
                'title' => 'Membalik String',
                'description' => 'Buatlah fungsi untuk membalik urutan karakter dalam string. Contoh: "hello" menjadi "olleh".',
                'difficulty' => 'easy',
                'category' => 'String',
                'access_type' => 'private',
                'access_code' => 'STR102',
                'function_name' => 'balikString',
                'initial_xml' => '<xml xmlns="https://developers.google.com/blockly/xml">
                    <block type="procedures_defreturn" x="20" y="20">
                        <mutation>
                            <arg name="teks" varid="104"></arg>
                        </mutation>
                        <field name="NAME">balikString</field>
                        <comment pinned="false" h="80" w="160">Balik urutan string</comment>
                    </block>
                </xml>',
                'hints' => json_encode([
                    'Gunakan fungsi untuk membalik string',
                    'Atau gunakan loop untuk membaca dari belakang'
                ]),
                'constraints' => json_encode([
                    'Panjang string 1 ≤ n ≤ 100',
                    'Input bisa berisi huruf, angka, dan simbol'
                ])
            ],
            [
                'title' => 'Perkalian Sederhana',
                'description' => 'Buatlah fungsi untuk mengalikan dua bilangan bulat. Fungsi menerima dua parameter dan mengembalikan hasil perkalian.',
                'difficulty' => 'easy',
                'category' => 'Aritmatika',
                'access_type' => 'private',
                'access_code' => 'MATH103',
                'function_name' => 'kalikan',
                'initial_xml' => '<xml xmlns="https://developers.google.com/blockly/xml">
                    <block type="procedures_defreturn" x="20" y="20">
                        <mutation>
                            <arg name="a" varid="105"></arg>
                            <arg name="b" varid="106"></arg>
                        </mutation>
                        <field name="NAME">kalikan</field>
                        <comment pinned="false" h="80" w="160">Kalikan dua bilangan</comment>
                    </block>
                </xml>',
                'hints' => json_encode([
                    'Gunakan operator perkalian (*)',
                    'Perhatikan tanda bilangan negatif'
                ]),
                'constraints' => json_encode([
                    '-100 ≤ a, b ≤ 100',
                    'Input akan selalu berupa bilangan bulat'
                ])
            ],
            [
                'title' => 'Cek Huruf Vokal',
                'description' => 'Buatlah fungsi untuk mengecek apakah sebuah karakter adalah huruf vokal (a, e, i, o, u). Return true jika vokal, false jika bukan.',
                'difficulty' => 'easy',
                'category' => 'String',
                'access_type' => 'private',
                'access_code' => 'STR103',
                'function_name' => 'cekVokal',
                'initial_xml' => '<xml xmlns="https://developers.google.com/blockly/xml">
                    <block type="procedures_defreturn" x="20" y="20">
                        <mutation>
                            <arg name="huruf" varid="107"></arg>
                        </mutation>
                        <field name="NAME">cekVokal</field>
                        <comment pinned="false" h="80" w="160">Cek huruf vokal</comment>
                    </block>
                </xml>',
                'hints' => json_encode([
                    'Gunakan kondisional untuk mengecek huruf',
                    'Perhatikan huruf besar dan kecil',
                    'Vokal: a, e, i, o, u (dan A, E, I, O, U)'
                ]),
                'constraints' => json_encode([
                    'Input berupa single character',
                    'Input hanya berupa huruf alfabet'
                ])
            ],
            [
                'title' => 'Hitung Kata',
                'description' => 'Buatlah fungsi untuk menghitung jumlah kata dalam sebuah kalimat. Kata dipisahkan oleh spasi.',
                'difficulty' => 'medium',
                'category' => 'String',
                'access_type' => 'private',
                'access_code' => 'STR104',
                'function_name' => 'hitungKata',
                'initial_xml' => '<xml xmlns="https://developers.google.com/blockly/xml">
                    <block type="procedures_defreturn" x="20" y="20">
                        <mutation>
                            <arg name="kalimat" varid="108"></arg>
                        </mutation>
                        <field name="NAME">hitungKata</field>
                        <comment pinned="false" h="80" w="160">Hitung jumlah kata</comment>
                    </block>
                </xml>',
                'hints' => json_encode([
                    'Perhatikan spasi sebagai pemisah kata',
                    'Hati-hati dengan spasi berlebih',
                    'Gunakan fungsi untuk memisah string'
                ]),
                'constraints' => json_encode([
                    'Panjang kalimat 1 ≤ n ≤ 1000',
                    'Input hanya berisi huruf alfabet dan spasi',
                    'Minimal terdapat 1 kata'
                ])
            ]
        ];

        $challenge_test_cases = [
            'hitungKeliling' => [
                [
                    'input' => json_encode([4]),
                    'expected_output' => json_encode(16),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode([2]),
                    'expected_output' => json_encode(8),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode([10]),
                    'expected_output' => json_encode(40),
                    'is_sample' => false
                ],
                [
                    'input' => json_encode([7]),
                    'expected_output' => json_encode(28),
                    'is_sample' => false
                ],
                [
                    'input' => json_encode([1]),
                    'expected_output' => json_encode(4),
                    'is_sample' => false
                ]
            ],
            'ubahKapital' => [
                [
                    'input' => json_encode(["hello"]),
                    'expected_output' => json_encode("HELLO"),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode(["World"]),
                    'expected_output' => json_encode("WORLD"),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode(["php programming"]),
                    'expected_output' => json_encode("PHP PROGRAMMING"),
                    'is_sample' => false
                ],
                [
                    'input' => json_encode(["cOdInG"]),
                    'expected_output' => json_encode("CODING"),
                    'is_sample' => false
                ],
                [
                    'input' => json_encode(["a"]),
                    'expected_output' => json_encode("A"),
                    'is_sample' => false
                ]
            ],
            'hitungDigit' => [
                [
                    'input' => json_encode([123]),
                    'expected_output' => json_encode(3),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode([5]),
                    'expected_output' => json_encode(1),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode([10000]),
                    'expected_output' => json_encode(5),
                    'is_sample' => false
                ],
                [
                    'input' => json_encode([0]),
                    'expected_output' => json_encode(1),
                    'is_sample' => false
                ],
                [
                    'input' => json_encode([999999]),
                    'expected_output' => json_encode(6),
                    'is_sample' => false
                ]
            ],
            'balikString' => [
                [
                    'input' => json_encode(["hello"]),
                    'expected_output' => json_encode("olleh"),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode(["php"]),
                    'expected_output' => json_encode("php"),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode(["12345"]),
                    'expected_output' => json_encode("54321"),
                    'is_sample' => false
                ],
                [
                    'input' => json_encode(["a"]),
                    'expected_output' => json_encode("a"),
                    'is_sample' => false
                ],
                [
                    'input' => json_encode(["programming"]),
                    'expected_output' => json_encode("gnimmargorp"),
                    'is_sample' => false
                ]
            ],
            'kalikan' => [
                [
                    'input' => json_encode([2, 3]),
                    'expected_output' => json_encode(6),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode([-4, 5]),
                    'expected_output' => json_encode(-20),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode([0, 100]),
                    'expected_output' => json_encode(0),
                    'is_sample' => false
                ],
                [
                    'input' => json_encode([10, 10]),
                    'expected_output' => json_encode(100),
                    'is_sample' => false
                ],
                [
                    'input' => json_encode([-3, -7]),
                    'expected_output' => json_encode(21),
                    'is_sample' => false
                ]
            ],
            'cekVokal' => [
                [
                    'input' => json_encode(["a"]),
                    'expected_output' => json_encode(true),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode(["b"]),
                    'expected_output' => json_encode(false),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode(["E"]),
                    'expected_output' => json_encode(true),
                    'is_sample' => false
                ],
                [
                    'input' => json_encode(["Z"]),
                    'expected_output' => json_encode(false),
                    'is_sample' => false
                ],
                [
                    'input' => json_encode(["O"]),
                    'expected_output' => json_encode(true),
                    'is_sample' => false
                ]
            ],
            'hitungKata' => [
                [
                    'input' => json_encode(["hello world"]),
                    'expected_output' => json_encode(2),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode(["php"]),
                    'expected_output' => json_encode(1),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode(["belajar pemrograman php dasar"]),
                    'expected_output' => json_encode(4),
                    'is_sample' => false
                ],
                [
                    'input' => json_encode(["saya  suka  coding"]), // double space
                    'expected_output' => json_encode(3),
                    'is_sample' => false
                ],
                [
                    'input' => json_encode(["a b c d e"]),
                    'expected_output' => json_encode(5),
                    'is_sample' => false
                ]
            ]
        ];

        // Menambahkan challenges baru
        foreach ($additional_challenges as $challenge) {
            $challenge['slug'] = Str::slug($challenge['title']);
            
            // Cek apakah challenge dengan function_name yang sama sudah ada
            $existingChallenge = DB::table('challenges')
                ->where('function_name', $challenge['function_name'])
                ->first();

            if (!$existingChallenge) {
                // Insert challenge baru
                $challengeId = DB::table('challenges')->insertGetId($challenge);

                // Insert test cases berdasarkan function_name
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