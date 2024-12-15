<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ChallengeSeeder extends Seeder
{
    public function run()
    {
        $challenges = [
            [
                'title' => 'Penjumlahan Dua Angka',
                'description' => 'Buatlah fungsi untuk menjumlahkan dua angka yang diinputkan. Fungsi ini akan menerima dua parameter (a dan b) dan harus mengembalikan hasil penjumlahan a + b.',
                'difficulty' => 'easy',
                'category' => 'Aritmatika',
                'access_type' => 'public',
                'function_name' => 'jumlahkanAngka',
                'initial_xml' => '<xml xmlns="https://developers.google.com/blockly/xml">
                    <block type="procedures_defreturn" x="20" y="20">
                        <mutation>
                            <arg name="a" varid="123"></arg>
                            <arg name="b" varid="456"></arg>
                        </mutation>
                        <field name="NAME">jumlahkanAngka</field>
                        <comment pinned="false" h="80" w="160">Jumlahkan a dan b</comment>
                        <statement name="STACK">
                            <block type="variables_set">
                                <field name="VAR" id="result">hasil</field>
                                <value name="VALUE">
                                    <block type="math_number">
                                        <field name="NUM">0</field>
                                    </block>
                                </value>
                            </block>
                        </statement>
                        <value name="RETURN">
                            <block type="variables_get">
                                <field name="VAR" id="result">hasil</field>
                            </block>
                        </value>
                    </block>
                </xml>',
                'hints' => json_encode([
                    'Gunakan blok matematika untuk menjumlahkan dua angka.',
                    'Pastikan untuk mengembalikan hasil penjumlahan menggunakan blok "return".',
                    'Jangan lupa untuk menggunakan parameter "a" dan "b" dalam perhitungan Anda.'
                ]),
                'constraints' => json_encode([
                    '-1000 ≤ a, b ≤ 1000',
                    'Input akan selalu berupa bilangan bulat.'
                ])
            ],
            [
                'title' => 'Menghitung Faktorial',
                'description' => 'Buatlah fungsi untuk menghitung faktorial dari sebuah bilangan. Fungsi menerima satu parameter (n) dan mengembalikan hasil faktorial n!.',
                'difficulty' => 'medium',
                'category' => 'Perulangan',
                'access_type' => 'private',
                'access_code' => 'LOOP201',
                'function_name' => 'hitungFaktorial',
                'initial_xml' => '<xml xmlns="https://developers.google.com/blockly/xml">
                    <block type="procedures_defreturn" x="20" y="20">
                        <mutation>
                            <arg name="n" varid="401"></arg>
                        </mutation>
                        <field name="NAME">hitungFaktorial</field>
                    </block>
                </xml>',
                'hints' => json_encode([
                    'Gunakan perulangan untuk mengalikan semua bilangan dari 1 hingga n',
                    'Inisialisasi hasil dengan 1',
                    'Faktorial 0 adalah 1'
                ]),
                'constraints' => json_encode([
                    '0 ≤ n ≤ 10',
                    'Input akan selalu berupa bilangan bulat non-negatif'
                ])
            ],
            [
                'title' => 'FizzBuzz',
                'description' => 'Buatlah fungsi FizzBuzz yang menerima satu parameter (n). Fungsi mengembalikan "Fizz" jika n habis dibagi 3, "Buzz" jika habis dibagi 5, "FizzBuzz" jika habis dibagi keduanya, dan string angka n jika tidak keduanya.',
                'difficulty' => 'medium',
                'category' => 'Logika',
                'access_type' => 'private',
                'access_code' => 'FIZZ202',
                'function_name' => 'fizzBuzz',
                'initial_xml' => '<xml xmlns="https://developers.google.com/blockly/xml">
                    <block type="procedures_defreturn" x="20" y="20">
                        <mutation>
                            <arg name="n" varid="501"></arg>
                        </mutation>
                        <field name="NAME">fizzBuzz</field>
                    </block>
                </xml>',
                'hints' => json_encode([
                    'Gunakan operator modulo (%) untuk mengecek keterbagian',
                    'Gunakan conditional statements untuk mengecek kondisi',
                    'Urutkan pengecekan dari yang paling spesifik'
                ]),
                'constraints' => json_encode([
                    '1 ≤ n ≤ 100',
                    'Input akan selalu berupa bilangan bulat positif'
                ])
            ],
            [
                'title' => 'Mencari Bilangan Terbesar',
                'description' => 'Buatlah fungsi untuk mencari bilangan terbesar dari tiga angka. Fungsi menerima tiga parameter (a, b, c) dan mengembalikan nilai terbesar.',
                'difficulty' => 'medium',
                'category' => 'Logika',
                'access_type' => 'private',
                'access_code' => 'MAX203',
                'function_name' => 'cariTerbesar',
                'initial_xml' => '<xml xmlns="https://developers.google.com/blockly/xml">
                    <block type="procedures_defreturn" x="20" y="20">
                        <mutation>
                            <arg name="a" varid="601"></arg>
                            <arg name="b" varid="602"></arg>
                            <arg name="c" varid="603"></arg>
                        </mutation>
                        <field name="NAME">cariTerbesar</field>
                    </block>
                </xml>',
                'hints' => json_encode([
                    'Gunakan conditional statements untuk membandingkan nilai',
                    'Bandingkan dua angka terlebih dahulu, lalu bandingkan dengan angka ketiga',
                    'Pastikan semua kemungkinan tercover'
                ]),
                'constraints' => json_encode([
                    '-1000 ≤ a, b, c ≤ 1000',
                    'Input akan selalu berupa bilangan bulat'
                ])
            ],
            [
                'title' => 'Deret Fibonacci',
                'description' => 'Buatlah fungsi untuk menghitung angka ke-n dalam deret Fibonacci. Fungsi menerima satu parameter (n) dan mengembalikan nilai Fibonacci ke-n.',
                'difficulty' => 'hard',
                'category' => 'Perulangan',
                'access_type' => 'private',
                'access_code' => 'FIB301',
                'function_name' => 'fibonacci',
                'initial_xml' => '<xml xmlns="https://developers.google.com/blockly/xml">
                    <block type="procedures_defreturn" x="20" y="20">
                        <mutation>
                            <arg name="n" varid="701"></arg>
                        </mutation>
                        <field name="NAME">fibonacci</field>
                    </block>
                </xml>',
                'hints' => json_encode([
                    'Inisialisasi dua variabel untuk menyimpan dua angka sebelumnya',
                    'Gunakan perulangan untuk menghitung angka berikutnya',
                    'Fibonacci(n) = Fibonacci(n-1) + Fibonacci(n-2)'
                ]),
                'constraints' => json_encode([
                    '0 ≤ n ≤ 20',
                    'Input akan selalu berupa bilangan bulat non-negatif'
                ])
            ],
            [
                'title' => 'Palindrom',
                'description' => 'Buatlah fungsi untuk mengecek apakah sebuah angka adalah palindrom. Fungsi menerima satu parameter angka (n) dan mengembalikan true jika palindrom, false jika bukan.',
                'difficulty' => 'hard',
                'category' => 'Logika',
                'access_type' => 'private',
                'access_code' => 'PAL302',
                'function_name' => 'cekPalindrom',
                'initial_xml' => '<xml xmlns="https://developers.google.com/blockly/xml">
                    <block type="procedures_defreturn" x="20" y="20">
                        <mutation>
                            <arg name="n" varid="801"></arg>
                        </mutation>
                        <field name="NAME">cekPalindrom</field>
                    </block>
                </xml>',
                'hints' => json_encode([
                    'Ubah angka menjadi string untuk mempermudah pemeriksaan',
                    'Bandingkan karakter dari depan dan belakang',
                    'Gunakan perulangan untuk mengecek setiap digit'
                ]),
                'constraints' => json_encode([
                    '0 ≤ n ≤ 100000',
                    'Input akan selalu berupa bilangan bulat non-negatif'
                ])
            ],
            [
                'title' => 'Bilangan Prima',
                'description' => 'Buatlah fungsi untuk mengecek apakah sebuah bilangan adalah bilangan prima. Fungsi menerima satu parameter (n) dan mengembalikan true jika prima, false jika bukan.',
                'difficulty' => 'hard',
                'category' => 'Logika',
                'access_type' => 'private',
                'access_code' => 'PRIME303',
                'function_name' => 'cekPrima',
                'initial_xml' => '<xml xmlns="https://developers.google.com/blockly/xml">
                    <block type="procedures_defreturn" x="20" y="20">
                        <mutation>
                            <arg name="n" varid="901"></arg>
                        </mutation>
                        <field name="NAME">cekPrima</field>
                    </block>
                </xml>',
                'hints' => json_encode([
                    'Bilangan prima hanya bisa dibagi oleh 1 dan dirinya sendiri',
                    'Gunakan perulangan untuk mengecek pembagi',
                    'Optimasi: cukup cek sampai akar dari n'
                ]),
                'constraints' => json_encode([
                    '1 ≤ n ≤ 1000',
                    'Input akan selalu berupa bilangan bulat positif'
                ])
            ]
        ];

        foreach ($challenges as $challenge) {
            $challenge['slug'] = Str::slug($challenge['title']);
            $challengeId = DB::table('challenges')->insertGetId($challenge);

            // Insert test cases for each challenge
            $this->insertTestCases($challengeId);
        }
    }

    private function insertTestCases($challengeId)
    {
        $testCases = [
            1 => [ // Penjumlahan Dua Angka
                [
                    'input' => json_encode([5, 3]),
                    'expected_output' => json_encode(8),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode([10, -5]),
                    'expected_output' => json_encode(5),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode([0, 0]),
                    'expected_output' => json_encode(0),
                    'is_sample' => false
                ],
                [
                    'input' => json_encode([100, 200]),
                    'expected_output' => json_encode(300),
                    'is_sample' => false
                ],
                [
                    'input' => json_encode([-50, 50]),
                    'expected_output' => json_encode(0),
                    'is_sample' => false
                ]
            ],
            2 => [ // Luas Persegi
                [
                    'input' => json_encode([4]),
                    'expected_output' => json_encode(16),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode([1]),
                    'expected_output' => json_encode(1),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode([7]),
                    'expected_output' => json_encode(49),
                    'is_sample' => false
                ],
                [
                    'input' => json_encode([10]),
                    'expected_output' => json_encode(100),
                    'is_sample' => false
                ]
            ],
            3 => [ // Cek Bilangan Genap
                [
                    'input' => json_encode([2]),
                    'expected_output' => json_encode(true),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode([3]),
                    'expected_output' => json_encode(false),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode([0]),
                    'expected_output' => json_encode(true),
                    'is_sample' => false
                ],
                [
                    'input' => json_encode([-4]),
                    'expected_output' => json_encode(true),
                    'is_sample' => false
                ],
                [
                    'input' => json_encode([15]),
                    'expected_output' => json_encode(false),
                    'is_sample' => false
                ]
            ],
            4 => [ // Rata-rata
                [
                    'input' => json_encode([3, 4, 5]),
                    'expected_output' => json_encode(4),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode([10, 20, 30]),
                    'expected_output' => json_encode(20),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode([0, 0, 0]),
                    'expected_output' => json_encode(0),
                    'is_sample' => false
                ],
                [
                    'input' => json_encode([1, 2, 3]),
                    'expected_output' => json_encode(2),
                    'is_sample' => false
                ]
            ],
            5 => [ // Konversi Suhu
                [
                    'input' => json_encode([0]),
                    'expected_output' => json_encode(32),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode([100]),
                    'expected_output' => json_encode(212),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode([25]),
                    'expected_output' => json_encode(77),
                    'is_sample' => false
                ],
                [
                    'input' => json_encode([-40]),
                    'expected_output' => json_encode(-40),
                    'is_sample' => false
                ]
            ],
            6 => [ // Faktorial
                [
                    'input' => json_encode([5]),
                    'expected_output' => json_encode(120),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode([0]),
                    'expected_output' => json_encode(1),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode([3]),
                    'expected_output' => json_encode(6),
                    'is_sample' => false
                ],
                [
                    'input' => json_encode([7]),
                    'expected_output' => json_encode(5040),
                    'is_sample' => false
                ]
            ],
            7 => [ // FizzBuzz
                [
                    'input' => json_encode([3]),
                    'expected_output' => json_encode("Fizz"),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode([5]),
                    'expected_output' => json_encode("Buzz"),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode([15]),
                    'expected_output' => json_encode("FizzBuzz"),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode([7]),
                    'expected_output' => json_encode("7"),
                    'is_sample' => false
                ],
                [
                    'input' => json_encode([30]),
                    'expected_output' => json_encode("FizzBuzz"),
                    'is_sample' => false
                ]
            ],
            8 => [ // Bilangan Terbesar
                [
                    'input' => json_encode([1, 2, 3]),
                    'expected_output' => json_encode(3),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode([10, 5, 8]),
                    'expected_output' => json_encode(10),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode([-1, -5, -3]),
                    'expected_output' => json_encode(-1),
                    'is_sample' => false
                ],
                [
                    'input' => json_encode([100, 100, 99]),
                    'expected_output' => json_encode(100),
                    'is_sample' => false
                ]
            ],
            9 => [ // Fibonacci
                [
                    'input' => json_encode([0]),
                    'expected_output' => json_encode(0),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode([1]),
                    'expected_output' => json_encode(1),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode([6]),
                    'expected_output' => json_encode(8),
                    'is_sample' => false
                ],
                [
                    'input' => json_encode([10]),
                    'expected_output' => json_encode(55),
                    'is_sample' => false
                ]
            ],
            10 => [ // Palindrom
                [
                    'input' => json_encode([121]),
                    'expected_output' => json_encode(true),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode([123]),
                    'expected_output' => json_encode(false),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode([1001]),
                    'expected_output' => json_encode(true),
                    'is_sample' => false
                ],
                [
                    'input' => json_encode([1000]),
                    'expected_output' => json_encode(false),
                    'is_sample' => false
                ]
            ],
            11 => [ // Bilangan Prima
                [
                    'input' => json_encode([2]),
                    'expected_output' => json_encode(true),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode([4]),
                    'expected_output' => json_encode(false),
                    'is_sample' => true
                ],
                [
                    'input' => json_encode([17]),
                    'expected_output' => json_encode(true),
                    'is_sample' => false
                ],
                [
                    'input' => json_encode([25]),
                    'expected_output' => json_encode(false),
                    'is_sample' => false
                ],
                [
                    'input' => json_encode([97]),
                    'expected_output' => json_encode(true),
                    'is_sample' => false
                ]
            ]
        ];

        foreach ($testCases[$challengeId] as $testCase) {
            $testCase['challenge_id'] = $challengeId;
            DB::table('test_cases')->insert($testCase);
        }
    }
}