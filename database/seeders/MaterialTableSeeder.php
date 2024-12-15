<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MaterialsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('materials')->insert([
            [
                'id' => '1',
                'content' => 'Pendahuluan\n\nPython adalah salah satu bahasa pemrograman yang mudah dipelajari, serbaguna, dan populer. Bahasa ini digunakan di berbagai bidang seperti pengembangan web, analisis data, kecerdasan buatan, dan banyak lagi. Modul ini dirancang untuk membantu siswa memahami dasar-dasar Python, khususnya syntax, variabel dan tipe data.\n\nTujuan Pembelajaran\nSetelah mempelajari modul ini, siswa diharapkan mampu:\n- Memahami konsep dasar syntax dalam Python.\n- Menulis kode Python sederhana dengan format dan struktur yang benar.\n- Mengidentifikasi aturan dan cara kerja variabel dalam Python.\n- Menggunakan variabel untuk menyimpan dan memanipulasi data.\n- Memahami berbagai tipe data dalam Python dan cara penggunaannya.\n\nC. Syntax Dasar\nSyntax adalah aturan atau tata cara penulisan kode dalam sebuah bahasa pemrograman. Dalam python untuk mencetak output cukup menggunakan fungsi print().Jika ingin mencetak data string harus dimasukkan ke dalam tanda kutip terlebih dahulu.\n\nprint("Hello World")\n\nSaat menjalankan syntax di atas ini, Anda akan muncul output text Hello World.Python memiliki syntax yang sederhana dan mudah dipahami. Berikut merupakan karakteristik utama syntax Python:\n- Tidak membutuhkan tanda kurung kurawal\nBerbeda dengan bahasa seperti C++ atau Java, Python tidak menggunakan {} untuk blok kode.\n- Komentar\nKomentar digunakan untuk memberikan penjelasan pada kode dan tidak akan dijalankan. Gunakan tanda # untuk komentar satu baris.\nprint("Hello World")\n\n- Case-Sensitive\nPython membedakan huruf besar dan kecil.\nContoh: variabel nama dan Nama dianggap berbeda.\n\nD. Variable Python\nVariabel adalah tempat untuk menyimpan data. Dalam Python, Anda tidak perlu mendefinisikan tipe data secara eksplisit. Python akan mengenali tipe data berdasarkan nilai yang Anda berikan. Penulisan variabel pada python memiliki aturan sebagai berikut:\n- Nama variabel harus dimulai dengan huruf atau garis bawah _.\n- Tidak boleh diawali dengan angka.\n- Hanya boleh mengandung huruf, angka, dan garis bawah.\n- Peka terhadap huruf besar dan kecil (case-sensitive).\n\nE. Tipe Data\nTipe data adalah jenis data yang dapat disimpan dalam variabel. Python memiliki beberapa tipe data dasar yang sering digunakan, antara lain:\n\nTipe Data\nDeskripsi\nContoh\n\nInteger (int)\nBilangan bulat\n10, -5, 0.\n\nFloat\nBilangan desimal atau pecahan\n3.14, -0.5, 2.0\n\nString (str)\nSekumpulan karakter atau teks\n\'Halo\', "Python"\n\nBoolean (bool)\nNilai logika yang hanya memiliki dua kemungkinan\nTrue atau False',
                'slug' => Str::slug('Materi 1'),
                'post_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '2',
                'content' => '
                <h2>Modul 2: OPERATOR</h2>
                <h3>Pendahuluan</h3>
                <p>Operator adalah simbol atau kata kunci yang digunakan untuk melakukan operasi tertentu pada satu atau lebih operand (nilai atau variabel). Dalam Python, operator dibagi ke dalam beberapa kategori berdasarkan fungsi dan penggunaannya. Modul ini akan membahas tiga kategori utama: operator aritmatika, operator perbandingan, dan operator logika.</p>

                <h3>Tujuan Pembelajaran</h3>
                <p>Setelah mempelajari modul ini, peserta didik diharapkan mampu:</p>
                <ul>
                    <li>Memahami konsep dan fungsi masing-masing jenis operator di Python.</li>
                    <li>Menggunakan operator aritmatika untuk melakukan operasi matematika dasar.</li>
                    <li>Menerapkan operator perbandingan untuk membandingkan nilai dan membuat ekspresi logis.</li>
                    <li>Memahami dan menggunakan operator logika, termasuk operator OR dan NOR, dalam pemrograman Python.</li>
                </ul>

                <h3>Operator Aritmatika</h3>
                <p>Operator aritmatika digunakan untuk melakukan operasi matematika dasar. Berikut adalah daftar operator aritmatika yang tersedia di Python:</p>
                <table border="1" cellpadding="10">
                    <thead>
                        <tr>
                            <th>Operator</th>
                            <th>Deskripsi</th>
                            <th>Contoh</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>+</td>
                            <td>Penjumlahan</td>
                            <td>5 + 3 = 8</td>
                        </tr>
                        <tr>
                            <td>-</td>
                            <td>Pengurangan</td>
                            <td>5 - 3 = 2</td>
                        </tr>
                        <tr>
                            <td>*</td>
                            <td>Perkalian</td>
                            <td>5 * 3 = 15</td>
                        </tr>
                        <tr>
                            <td>/</td>
                            <td>Pembagian</td>
                            <td>6 / 3 = 2</td>
                        </tr>
                        <tr>
                            <td>//</td>
                            <td>Pembagian (integer)</td>
                            <td>5 // 3 = 1</td>
                        </tr>
                        <tr>
                            <td>%</td>
                            <td>Sisa pembagian</td>
                            <td>5 % 3 = 2</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Perpangkatan</td>
                            <td>5 ** 3 = 125</td>
                        </tr>
                    </tbody>
                </table>

                <h3>Operator Perbandingan</h3>
                <p>Operator perbandingan digunakan untuk membandingkan dua nilai. Hasil dari operasi ini adalah boolean (True atau False). Berikut adalah daftar operator perbandingan di Python:</p>
                <table border="1" cellpadding="10">
                    <thead>
                        <tr>
                            <th>Operator</th>
                            <th>Deskripsi</th>
                            <th>Contoh</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>==</td>
                            <td>Sama dengan</td>
                            <td>5 == 3 -> False</td>
                        </tr>
                        <tr>
                            <td>!=</td>
                            <td>Não sama dengan</td>
                            <td>5 != 3 -> True</td>
                        </tr>
                        <tr>
                            <td>&gt;</td>
                            <td>Lebih besar</td>
                            <td>5 &gt; 3 -> True</td>
                        </tr>
                        <tr>
                            <td>&lt;</td>
                            <td>Lebih kecil</td>
                            <td>5 &lt; 3 -> False</td>
                        </tr>
                        <tr>
                            <td>&gt;=</td>
                            <td>Lebih besar atau sama</td>
                            <td>5 &gt;= 3 -> True</td>
                        </tr>
                        <tr>
                            <td>&lt;=</td>
                            <td>Lebih kecil atau sama</td>
                            <td>5 &lt;= 3 -> False</td>
                        </tr>
                    </tbody>
                </table>

                <h3>Operator Logika</h3>
                <p>Operator logika digunakan untuk menggabungkan beberapa ekspresi logika. Berikut adalah penjelasan tentang operator logika OR dan NOR:</p>
                <table border="1" cellpadding="10">
                    <thead>
                        <tr>
                            <th>Operator</th>
                            <th>Nama</th>
                            <th>Hasil</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>a && b</td>
                            <td>And</td>
                            <td>True jika a dan b keduanya true</td>
                        </tr>
                        <tr>
                            <td>a || b</td>
                            <td>Or</td>
                            <td>True jika a dan b salah satu keduanya true</td>
                        </tr>
                        <tr>
                            <td>! a</td>
                            <td>Not</td>
                            <td>True jika a bernilai false</td>
                        </tr>
                    </tbody>
                </table>',
                'slug' => Str::slug('Materi 1'),
                'post_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '3',
                'content' => '
                <h2>Modul 3 SELEKSI KONDISI</h2>
                <h3>Pendahuluan</h3>
                <p>Dalam pemrograman, kita seringkali dihadapkan pada situasi di mana kita harus membuat keputusan berdasarkan kondisi tertentu. Python menyediakan struktur kontrol yang memungkinkan kita untuk menangani berbagai percabangan logika. Dalam subbab ini, kita akan mempelajari konsep dasar percabangan, sintaksnya, dan penerapannya dalam berbagai skenario.</p>

                <h3>Tujuan Pembelajaran</h3>
                <ul>
                    <li>Memahami konsep percabangan dalam Python.</li>
                    <li>Menggunakan struktur if, if-else, dan if-elif-else dengan benar.</li>
                    <li>Menerapkan percabangan untuk memecahkan masalah sederhana dalam pemrograman.</li>
                </ul>

                <h3>Konsep Percabangan</h3>
                <p>Percabangan adalah cara untuk membuat keputusan dalam kode berdasarkan suatu kondisi. Jika kondisi terpenuhi (True), maka blok kode tertentu akan dijalankan. Jika tidak, program dapat menjalankan blok kode lainnya.</p>

                <h3>Struktur Percabangan</h3>
                <p>Python menggunakan kata kunci <code>if</code>, <code>else</code>, dan <code>elif</code> untuk membuat percabangan.</p>

                <h4>Kondisi If</h4>
                <p>Kondisi <code>if</code> digunakan untuk merespons situasi yang muncul selama program berjalan dan menentukan langkah yang akan diambil berdasarkan kondisi tersebut. Berikut merupakan contoh kodenya:</p>
                <pre><code>
                nilai = 85
                if nilai >= 75:
                    print("Selamat, Anda lulus!")
                </code></pre>

                <h4>Kondisi else</h4>
                <p>Kondisi <code>else</code> tidak hanya berfungsi untuk menentukan langkah yang akan diambil berdasarkan kondisi yang ada, tetapi juga untuk menentukan tindakan yang akan dilakukan jika kondisi tersebut tidak terpenuhi. Berikut merupakan contoh kodenya:</p>
                <pre><code>
                nilai = 85
                if nilai >= 75:
                    print("Selamat, Anda lulus!")
                else:
                    print("Maaf, Anda belum lulus.")
                </code></pre>

                <h4>Kondisi elif</h4>
                <p>Kondisi <code>elif</code> adalah pengembangan atau percabangan logika dari "kondisi if". Dengan menggunakan <code>elif</code>, kita dapat membuat kode program yang dapat memilih dari beberapa kemungkinan yang ada. Mirip dengan kondisi <code>else</code>, perbedaannya adalah bahwa kondisi <code>elif</code> dapat memiliki banyak cabang, bukan hanya satu. Berikut merupakan contoh kodenya:</p>
                <pre><code>
                nilai = 85
                if nilai >= 75:
                    print("Nilai Anda A")
                elif nilai >= 60:
                    print("Nilai Anda B")
                else:
                    print("Nilai Anda C")
                </code></pre>',
                'slug' => Str::slug('Materi 3'),
                'post_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data lain sesuai kebutuhan
        ]);
    }
}