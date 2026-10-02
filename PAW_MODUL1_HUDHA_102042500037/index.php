
<?php

$produk = [
    ["nama" => "Laptop Ultrabook 14\"", "kategori" => "Laptop", "harga" => 8500000, "stok" => 5],
    ["nama" => "Smartphone Nova X", "kategori" => "Smartphone", "harga" => 3200000, "stok" => 12],
    ["nama" => "Headphone Wireless Bass", "kategori" => "Audio", "harga" => 750000, "stok" => 20],
    ["nama" => "Mechanical Keyboard RGB", "kategori" => "Aksesoris", "harga" => 650000, "stok" => 0],
    ["nama" => "Mouse Gaming Pro", "kategori" => "Aksesoris", "harga" => 320000, "stok" => 30],
    ["nama" => "Smartwatch Fit Plus", "kategori" => "Wearable", "harga" => 1250000, "stok" => 8],
    ["nama" => "Power Bank 20.000 mAh", "kategori" => "Aksesoris", "harga" => 280000, "stok" => 0],
    ["nama" => "Monitor 24\" Full HD", "kategori" => "Monitor", "harga" => 1999000, "stok" => 3]
];

const BATAS_DISKON = 1000000;
const PERSEN_DISKON = 10;

function rupiah($angka) {
    return "Rp" . number_format($angka, 0, ",", ".");
}

function hargaDiskon($harga, $persen) {
    return $harga - ($harga * $persen / 100);
}

$totalProduk = count($produk);
$totalTersedia = 0;

foreach ($produk as $p) {
    if ($p["stok"] > 0) {
        $totalTersedia++;
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cia Store - Katalog Produk</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header class="navbar">
        <div class="container">
            <a href="#" class="logo">Cia<span>Store</span></a>

            <ul class="menu">
                <li><a href="#beranda">Beranda</a></li>
                <li><a href="#katalog">Katalog</a></li>
                <li><a href="#kontak">Kontak</a></li>
            </ul>
        </div>
    </header>

    <section class="hero" id="beranda">
        <div class="container">
            <h1>Perangkat dan Aksesoris Teknologi Untuk Kebutuhan Harianmu</h1>

            <p>
                Cek stok langsung dan dapatkan diskon
                <?= PERSEN_DISKON ?>% untuk produk dengan harga
                <?= rupiah(BATAS_DISKON) ?> atau lebih.
            </p>

            <a href="#katalog" class="btn-hero">Lihat Katalog</a>
        </div>
    </section>

    <section class="info">
        <div class="container">
            <div class="info-box">

                <div class="info-item">
                    <strong><?= $totalProduk ?></strong>
                    <span>Total Produk</span>
                </div>

                <div class="info-item">
                    <strong><?= $totalTersedia ?></strong>
                    <span>Produk Tersedia</span>
                </div>

                <div class="info-item">
                    <strong><?= $totalProduk - $totalTersedia ?></strong>
                    <span>Stok Habis</span>
                </div>

            </div>
        </div>
    </section>

    <main class="katalog" id="katalog">
        <div class="container">

            <h2>Katalog Produk</h2>

            <p class="sub">
                Menampilkan <?= $totalProduk ?> produk Cia Store
            </p>

            <div class="grid">

                <?php foreach ($produk as $item): ?>

                    <?php
                    if ($item["stok"] > 0) {
                        $status = "Tersedia";
                        $kelasStatus = "tersedia";
                    } else {
                        $status = "Stok Habis";
                        $kelasStatus = "habis";
                    }

                    $dapatDiskon = $item["harga"] >= BATAS_DISKON;

                    $hargaAkhir = $dapatDiskon
                        ? hargaDiskon($item["harga"], PERSEN_DISKON)
                        : $item["harga"];

                    $inisial = strtoupper(substr($item["nama"], 0, 1));
                    ?>

                    <article class="card <?= $item["stok"] > 0 ? '' : 'habis' ?>">

                        <?php if ($dapatDiskon): ?>
                            <span class="badge-diskon">
                                -<?= PERSEN_DISKON ?>%
                            </span>
                        <?php endif; ?>

                        <div class="foto">
                            <span class="foto-kosong">
                                <?= htmlspecialchars($inisial) ?>
                            </span>
                        </div>

                        <span class="kategori">
                            <?= htmlspecialchars($item["kategori"]) ?>
                        </span>

                        <h3 class="nama">
                            <?= htmlspecialchars($item["nama"]) ?>
                        </h3>

                        <div class="harga-wrap">

                            <?php if ($dapatDiskon): ?>

                                <div class="harga-normal">
                                    <?= rupiah($item["harga"]) ?>
                                </div>

                                <div class="harga promo">
                                    <?= rupiah($hargaAkhir) ?>
                                </div>

                            <?php else: ?>

                                <div class="harga">
                                    <?= rupiah($item["harga"]) ?>
                                </div>

                            <?php endif; ?>

                        </div>

                        <div class="stok-row">

                            <span>
                                Stok:
                                <b class="stok-angka">
                                    <?= $item["stok"] ?>
                                </b>
                            </span>

                            <span class="status <?= $kelasStatus ?>">
                                <?= $status ?>
                            </span>

                        </div>

                        <?php if ($item["stok"] > 0): ?>

                            <button class="btn-beli" type="button">
                                Beli Sekarang
                            </button>

                        <?php else: ?>

                            <button class="btn-beli" type="button" disabled>
                                Stok Habis
                            </button>

                        <?php endif; ?>

                    </article>

                <?php endforeach; ?>

            </div>
        </div>
    </main>

    <footer class="footer" id="kontak">
        <div class="container">

            <div>
                <strong>Cia Store</strong> –
                Perangkat dan Aksesoris Teknologi
            </div>

            <div>
                &copy; <?= date("Y") ?> Cia Store. Semua hak dilindungi.
            </div>

        </div>
    </footer>

</body>
</html>