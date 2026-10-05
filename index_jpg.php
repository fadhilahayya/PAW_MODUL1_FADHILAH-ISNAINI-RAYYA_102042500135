<?php
// array php
$produk = [
    ["nama" => "Laptop Macbook Air",     "kategori" => "Laptop",     "harga" => 12500000, "stok" => 5, "gambar" => "laptop.png"],
    ["nama" => "Iphone 18 pro",        "kategori" => "Smartphone", "harga" => 4800000,  "stok" => 12, "gambar" => "iphone.png"],
    ["nama" => "Headphone Wireless Pro",   "kategori" => "Audio",      "harga" => 1250000,  "stok" => 8, "gambar" => "headphone.png"],

    ["nama" => "Keyboard Mekanikal k85",   "kategori" => "Aksesoris",  "harga" => 650000,   "stok" => 20, "gambar" => "keyboard.png"],
    ["nama" => "Mouse V2 Mini",        "kategori" => "Aksesoris",  "harga" => 275000,   "stok" => 0, "gambar" => "mouse.png"],
    ["nama" => "Apple watch",        "kategori" => "Wearable",   "harga" => 1999000,  "stok" => 0, "gambar" => "smartwatch.png"],
    ["nama" => "Power Bank 20.000 mAh",    "kategori" => "Aksesoris",  "harga" => 350000,   "stok" => 30, "gambar" => "powerbank.png"],
    ["nama" => "Tablet Slite 10",          "kategori" => "Tablet",     "harga" => 3200000,  "stok" => 3, "gambar" => "tablet.png"],
];

function tampilGambar($gambar, $label, $habis) {
    $kelas = $habis ? ' habis-foto' : '';
    echo '<div class="foto' . $kelas . '">';
    echo '<img src="' . htmlspecialchars($gambar) . '" alt="' . htmlspecialchars($label) . '">';
    echo '</div>';
}

function rupiah($angka) {
    return "Rp" . number_format($angka, 0, ",", ".");
}
const BATAS_DISKON = 1000000;
const PERSEN_DISKON = 10;

function hitungDiskon($harga) {
    if ($harga >= BATAS_DISKON) {
        return $harga - ($harga * PERSEN_DISKON / 100);
    }
    return $harga; 
}

$totalProduk = count($produk);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ayya Store - Katalog Produk</title>
    <style>
        :root {
            --biru-muda: #dff1fb;
            --biru-sedang: #8fd0f2;
            --navy: #14213d;
            --oranye: #ff7a3d;
            --putih: #ffffff;
            --abu: #5b6b82;
            --merah: #d93a4a;
            --hijau: #1f9d6b;
            --radius: 14px;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: "Trebuchet MS", "Segoe UI", sans-serif;
            background: var(--biru-muda);
            color: var(--navy);
            line-height: 1.5;
        }   
        .wadah { width: min(1100px, 92%); margin: 0 auto; }

        /* ---------- HEADER (logo tengah, menu di bawah) ---------- */
        header { background: var(--navy); color: var(--putih); padding: 18px 0 0; text-align: center; }
        .logo { font-size: 1.9rem; font-weight: 800; letter-spacing: 1px; }
        .logo span { color: var(--oranye); }
        nav { margin-top: 12px; display: flex; justify-content: center; gap: 8px; flex-wrap: wrap; }
        nav a {
            color: var(--biru-sedang); text-decoration: none; padding: 10px 22px;
            border-radius: 10px 10px 0 0; font-weight: 600;
        }
        nav a:hover, nav a.aktif { background: var(--biru-muda); color: var(--navy); }
        nav a:focus-visible { outline: 3px solid var(--oranye); }

        /* ---------- HERO (2 kolom: teks kiri, panel info kanan) ---------- */
        .hero { padding: 56px 0; }
        .hero .wadah { display: grid; grid-template-columns: 1.4fr 1fr; gap: 32px; align-items: center; }
        .hero h1 { font-size: clamp(2rem, 5vw, 3.2rem); line-height: 1.1; margin-bottom: 14px; }
        .hero p { color: var(--abu); max-width: 46ch; margin-bottom: 24px; }
        .tombol-hero {
            display: inline-block; background: var(--oranye); color: var(--putih);
            padding: 13px 28px; border-radius: 999px; text-decoration: none; font-weight: 700;
        }
        .tombol-hero:hover { background: var(--navy); }
        .panel {
            background: var(--biru-sedang); border: 3px solid var(--navy);
            border-radius: var(--radius); padding: 28px; box-shadow: 8px 8px 0 var(--navy);
        }
        .panel strong { display: block; font-size: 3.4rem; line-height: 1; }
        .panel small { font-size: 1rem; }

        /* ---------- KATALOG ---------- */
        .katalog { padding: 24px 0 64px; }
        .judul-katalog {
            display: flex; justify-content: space-between; align-items: center;
            flex-wrap: wrap; gap: 12px; margin-bottom: 24px;
            border-bottom: 3px solid var(--navy); padding-bottom: 12px;
        }
        .judul-katalog h2 { font-size: 1.7rem; }
        .info-jumlah {
            background: var(--navy); color: var(--putih);
            padding: 8px 18px; border-radius: 999px; font-weight: 700;
        }
        .grid {
            display: grid; gap: 22px;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        }

        /* ---------- CARD ---------- */
        .card {
            background: var(--putih); border: 2px solid var(--navy);
            border-radius: var(--radius); overflow: hidden;
            display: flex; flex-direction: column;
        }
        .card-atas {
            background: var(--biru-sedang); padding: 14px 16px;
            display: flex; justify-content: space-between; align-items: center;
            border-bottom: 2px solid var(--navy);
        }
        .kategori { font-size: .85rem; font-weight: 700; }
        .status { font-size: .8rem; font-weight: 700; padding: 4px 12px; border-radius: 999px; color: var(--putih); }
        .tersedia { background: var(--hijau); }
        .habis { background: var(--merah); }
        .foto { width: 100%; aspect-ratio: 4 / 3; display: block; background: var(--biru-muda); border-bottom: 2px solid var(--navy); overflow: hidden; }
        .foto img { width: 100%; height: 100%; display: block; object-fit: cover; }
        .habis-foto { filter: grayscale(1); opacity: .6; }
        .card-isi { padding: 18px 16px; flex: 1; display: flex; flex-direction: column; gap: 6px; }
        .card-isi h3 { font-size: 1.1rem; }
        .stok { color: var(--abu); font-size: .9rem; }
        .harga-normal { color: var(--abu); text-decoration: line-through; font-size: .9rem; }
        .badge-diskon {
            display: inline-block; background: var(--oranye); color: var(--putih);
            font-size: .8rem; font-weight: 700; padding: 2px 10px; border-radius: 6px; margin-left: 6px;
            text-decoration: none;
        }
        .harga-akhir { font-size: 1.35rem; font-weight: 800; margin-top: auto; padding-top: 8px; }
        .btn-beli {
            width: 100%; border: 0; padding: 13px; font-size: 1rem; font-weight: 700;
            background: var(--navy); color: var(--putih); cursor: pointer;
        }
        .btn-beli:hover:not(:disabled) { background: var(--oranye); }
        .btn-beli:focus-visible { outline: 3px solid var(--oranye); outline-offset: -3px; }
        .btn-beli:disabled { background: #c3ccd8; color: #6b7686; cursor: not-allowed; }

        /* ---------- FOOTER ---------- */
        footer { background: var(--navy); color: var(--biru-sedang); text-align: center; padding: 28px 0; }
        footer b { color: var(--putih); }

        /* ---------- RESPONSIVE ---------- */
        @media (max-width: 760px) {
            .hero .wadah { grid-template-columns: 1fr; }
            .hero { padding: 36px 0; }
        }
    </style>
</head>
<body>

<!-- NAVBAR / HEADER -->
<header>
    <div class="wadah">
        <div class="logo">Ayya<span>Store</span></div>
        <nav aria-label="Menu utama">
            <a href="#beranda" class="aktif">Beranda</a>
            <a href="#katalog">Katalog</a>
            <a href="#kontak">Kontak</a>
        </nav>
    </div>
</header>

<!-- HERO -->
<section class="hero" id="beranda">
    <div class="wadah">
        <div>
            <h1>Gadget pilihan, harga jelas, stok terlihat.</h1>
            <p>Ayya Store menjual perangkat dan aksesoris teknologi. Cek ketersediaan dan harga tiap produk langsung di katalog.</p>
            <a class="tombol-hero" href="#katalog">Lihat katalog</a>
        </div>
        <!-- Informasi jumlah produk (otomatis dari PHP) -->
        <div class="panel">
            <strong><?= $totalProduk; ?></strong>
            <small>produk tersedia di katalog kami</small>
        </div>
    </div>
</section>

<!-- KATALOG PRODUK -->
<main class="katalog" id="katalog">
    <div class="wadah">
        <div class="judul-katalog">
            <h2>Katalog Produk</h2>
            <span class="info-jumlah">Total produk: <?= $totalProduk; ?></span>
        </div>

        <div class="grid">
            <?php foreach ($produk as $item): ?>
                <?php
                    // Perbandingan (if/else): tentukan status berdasarkan stok
                    if ($item["stok"] > 0) {
                        $statusTeks = "Tersedia";
                        $statusKelas = "tersedia";
                    } else {
                        $statusTeks = "Stok Habis";
                        $statusKelas = "habis";
                    }

                    $hargaAkhir = hitungDiskon($item["harga"]);
                    $dapatDiskon = $item["harga"] >= BATAS_DISKON;
                ?>
                <article class="card">
                    <div class="card-atas">
                        <span class="kategori"><?= htmlspecialchars($item["kategori"]); ?></span>
                        <span class="status <?= $statusKelas; ?>"><?= $statusTeks; ?></span>
                    </div>

                    <?php tampilGambar($item["gambar"], $item["nama"], $item["stok"] <= 0); ?>

                    <div class="card-isi">
                        <h3><?= htmlspecialchars($item["nama"]); ?></h3>
                        <span class="stok">Stok: <?= $item["stok"]; ?> unit</span>

                        <?php if ($dapatDiskon): ?>
                            <div>
                                <span class="harga-normal"><?= rupiah($item["harga"]); ?></span>
                                <span class="badge-diskon">Diskon <?= PERSEN_DISKON; ?>%</span>
                            </div>
                        <?php endif; ?>

                        <div class="harga-akhir"><?= rupiah($hargaAkhir); ?></div>
                    </div>
                            +
                    <?php if ($item["stok"] > 0): ?>
                        <button class="btn-beli" type="button">Beli Sekarang</button>
                    <?php else: ?>
                        <button class="btn-beli" type="button" disabled>Stok Habis</button>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<!-- FOOTER -->
<footer id="kontak">
    <div class="wadah">
        <p><b>Ayya Store</b> - Toko perangkat dan aksesoris teknologi</p>
        <p>&copy; <?= date("Y"); ?> Ayya Store. Semua hak dilindungi.</p>
    </div>
</footer>

</body>
</html>
