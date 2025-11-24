<?php
require 'admin/proses/panggil.php';
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Mico.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <nav class="nav" role="navigation" aria-label="Main navigation">
      <a class="brand" href="#">
        <div class="logo"><img src="img/logo.png" alt="" srcset="" /></div>
        <div class="brand-text">
          <div class="title">Mico.id</div>
          <div class="tag">MI.3B</div>
        </div>
      </a>

      <div class="nav-links" id="navLinks">
        <a href="#home">Home</a>
        <a href="#about">Tentang</a>
      </div>

      <button class="hamburger" id="menuToggle" aria-label="Toggle menu">
        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 7h16M4 12h16M4 17h16" stroke-linecap="round" stroke-linejoin="round" /></svg>
      </button>
    </nav>

    <header class="hero" id="home">
      <div class="video-wrap" aria-hidden="true">

        <video id="bgVideo" autoplay muted loop playsinline poster="img/buritto.jpg">

        <source src="header.mp4" type="video/mp4" />

        <source src="B.mp4" type="video/mp4" />
        </video>
      </div>
      <div class="hero-overlay"></div>

      <div class="hero-inner fade-in">
        <div class="hero-left">
          <div class="eyebrow">Makanan Segar & Aesthetic</div>
          <h1>Rasakan cita rasa rumahan dengan sentuhan modern</h1>
          <p class="lead">Menu curated setiap hari — bahan lokal, plating cantik, dan pengiriman cepat. Temukan favoritmu dan pesan dengan mudah di mico.id</p>

          <div class="search" role="search">
            <input type="search" id="searchInput" placeholder="Cari: burito, taco, risol..." aria-label="Cari menu" />
            <button id="searchBtn">Cari</button>
          </div>

          <div style="display: flex; gap: 10px; margin-top: 14px; flex-wrap: wrap">
            <button class="btn-primary" id="orderNow">Pesan Sekarang</button>
            <button class="icon-btn" id="toggleVideo" title="Toggle background video">
              <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path d="M3 7v10a2 2 0 0 0 2 2h14"></path>
                <path d="M21 7a2 2 0 0 0-2-2H9"></path>
                <path d="M7 7v10"></path>
              </svg>
              <span style="font-weight: 600; font-size: 13px; color: var(--muted)">Video</span>
            </button>
            <button class="btn-primary" id="openCartBtn" aria-label="Buka Keranjang">Keranjang (<span id="cartCount">0</span>)</button>
          </div>
        </div>

        <div class="hero-right">
          <?php
                                        $no=1;
                                        $hasil = $proses->tampil_data('data_menu');
                                        foreach($hasil as $isi){
                                    ?>
          <div class="card">
            <div class="dish-thumb"><img src="admin/proses/<?= $isi['gambar']; ?>" alt="Burito" /></div>
            <div class="dish-info">
              <div class="dish-title"><?= $isi['nama_menu']; ?></div>
              <div class="dish-desc"><?= $isi['deskripsi']; ?></div>
              <div class="dish-meta">
                <div class="price">Rp <?= $isi['harga']; ?></div>
                <button class="add-btn" data-id="<?= $isi['kode_menu']; ?>" data-name="<?= $isi['nama_menu']; ?>" data-price="<?= $isi['harga']; ?>" data-img="admin/proses/<?= $isi['gambar']; ?>">Tambah</button>
              </div>
            </div>
          </div>
        <?php
                                        $no++;
                                        }
                                    ?>
        </div>
      </div>
    </header>

    <main>
      <section class="section" id="menu" aria-labelledby="menuHeading">
        <div class="section-header">
          <h2 id="menuHeading">Menu Pilihan</h2>

          <div style="display: flex; gap: 8px; align-items: center">
            <span style="color: var(--muted); font-size: 13px">Urutkan</span>
            <select id="sortSelect" style="padding: 8px; border-radius: 8px; background: transparent; border: 1px solid rgba(255, 255, 255, 0.04); color: inherit">
              <option value="popular">Terpopuler</option>
              <option value="low">Harga Terendah</option>
              <option value="high">Harga Tertinggi</option>
            </select>
          </div>
        </div>

        <div class="grid" id="productGrid">
          <?php
                                        $no=1;
                                        $hasil = $proses->tampil_data('data_menu');
                                        foreach($hasil as $isi){
                                    ?>
          <div class="product fade-in">
            <div class="prod-img">
              <img src="admin/proses/<?= $isi['gambar']; ?>" alt="Burrito" />
            </div>

            <div class="prod-title">Burrito</div>

            <div style="color: var(--muted); font-size: 13px; margin-bottom: 10px"><?= $isi['deskripsi']; ?></div>

            <div class="prod-meta">
              <div style="display: flex; align-items: center; gap: 8px">
                <div style="font-weight: 800">Rp <?= $isi['harga']; ?></div>
                <div class="rating">★ 4.7</div>
              </div>

              <div class="cart-actions">
                <button class="add-btn" data-id="<?= $isi['kode_menu']; ?>" data-name="<?= $isi['nama_menu']; ?>" data-price="<?= $isi['harga']; ?>" data-img="admin/proses/<?= $isi['gambar']; ?>">Tambah</button>
              </div>
            </div>
          </div>
        <?php
                                        $no++;
                                        }
                                    ?>
        
        </div>

        <section class="section">
          <div id="disqus_thread"></div>
          <script>
            /**
             *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
             *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
            /*
    var disqus_config = function () {
    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    */
            (function () {
              // DON'T EDIT BELOW THIS LINE
              var d = document,
                s = d.createElement('script');
              s.src = 'https://mico-id.disqus.com/embed.js';
              s.setAttribute('data-timestamp', +new Date());
              (d.head || d.body).appendChild(s);
            })();
          </script>
          <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
        </section>

        <section class="section">
        <div style="display: flex; justify-content:center;">
          <img src="img/cthpost.png" alt="" width="300" height="400">
      </div>
        </section>

        <div style="margin-top: 18px">
          <h3 style="margin-bottom: 8px">Profil Tim</h3>
          <p style="color: var(--muted); margin-top: 0">Tim kecil kami berfokus pada kualitas, estetika, dan pengalaman pengguna. Kenali yang membuat mico.id menjadi hidup.</p>

          <div class="team" id="team" style="margin-top: 12px">
            <div class="member">
              <div class="avatar"><img src="img/rizky.jpg" alt="Member 1" /></div>
              <div style="font-weight: 700">Mhd Rizky</div>
              <div style="color: var(--muted); font-size: 13px; margin-top: 6px">Head Chef — menu & inovasi rasa</div>
              <div style="margin-top: 10px; color: var(--muted); font-size: 13px">"Saya menyukai bahan lokal dan plating yang menyenangkan."</div>
            </div>

            <div class="member">
              <div class="avatar"><img src="img/janro.jpg" alt="Member 2" /></div>
              <div style="font-weight: 700">janro Jannes</div>
              <div style="color: var(--muted); font-size: 13px; margin-top: 6px">Operasional — pengiriman & kualitas</div>
              <div style="margin-top: 10px; color: var(--muted); font-size: 13px">"Pengiriman cepat dan makanan sampai dengan sempurna adalah prioritas."</div>
            </div>

            <div class="member">
              <div class="avatar"><img src="img/irfan.jpg" alt="Member 3" /></div>
              <div style="font-weight: 700">Irfan Bangun</div>
              <div style="color: var(--muted); font-size: 13px; margin-top: 6px">Design & Branding</div>
              <div style="margin-top: 10px; color: var(--muted); font-size: 13px">"Estetika makanan & packaging yang ramah lingkungan."</div>
            </div>
            <div class="member">
              <div class="avatar"><img src="img/musbar.jpg" alt="Member 3" /></div>
              <div style="font-weight: 700">Musbar Muliansyah</div>
              <div style="color: var(--muted); font-size: 13px; margin-top: 6px">Design & Branding</div>
              <div style="margin-top: 10px; color: var(--muted); font-size: 13px">"Estetika makanan & packaging yang ramah lingkungan."</div>
            </div>
            <div class="member">
              <div class="avatar"><img src="img/four.jpg" alt="Member 3" /></div>
              <div style="font-weight: 700">Fourtuna Simamora</div>
              <div style="color: var(--muted); font-size: 13px; margin-top: 6px">Design & Branding</div>
              <div style="margin-top: 10px; color: var(--muted); font-size: 13px">"Estetika makanan & packaging yang ramah lingkungan."</div>
            </div>
          </div>
        </div>
      </section>

      <section class="section" id="about">
        <div style="display: flex; gap: 18px; flex-wrap: wrap; align-items: center; justify-content: space-between">
          <div style="max-width: 640px">
            <h2 style="margin-top: 0; font-family: 'Playfair Display', serif">Tentang mico.id</h2>
            <p style="color: var(--muted)">mico.id adalah dapur kecil dengan mimpi besar — menghadirkan inovasi makanan fusion lintas negara. Kami mengutamakan bahan segar, proses memasak higienis, dan packaging ramah lingkungan.</p>
            <ul style="color: var(--muted); margin-top: 10px; padding-left: 20px">
              <!-- <li>Menu curated setiap hari</li>
              <li>Pengiriman cepat & aman</li>
              <li>Pilihan vegetarian & bebas gluten</li> -->
            </ul>
            <!-- <div style="margin-top: 12px">
              <a href="#menu" class="btn-primary" style="text-decoration: none">Lihat Menu</a>
            </div> -->
          </div>
          <div style="flex: 1; min-width: 260px; max-width: 360px">
            <div style="border-radius: 12px; overflow: hidden; border: 1px solid rgba(255, 255, 255, 0.03); background: linear-gradient(180deg, rgba(255, 255, 255, 0.02), rgba(255, 255, 255, 0.01)); padding: 12px">
              <h4 style="margin: 0 0 8px">Jam Operasional</h4>
              <div style="color: var(--muted)">Senin - Minggu: 09:00 - 21:00</div>
              <div style="margin-top: 8px; color: var(--muted)">Kontak: <a href="mailto:micoid@gmail.com" style="color: var(--accent2)">micoid@gmail.com</a></div>
              <div style="margin-top: 12px"><button class="icon-btn" id="contactBtn">Hubungi Kami</button></div>
            </div>
          </div>
        </div>
      </section>
    </main>

    <aside class="cart-side hidden" id="cartSide" aria-hidden="true">
  <form id="cartForm" method="POST" action="prosesOrder.php?aksi=tambah_order">
    <div style="display: flex; justify-content: space-between; align-items: center">
      <div>
        <div style="font-weight: 800">Keranjangmu</div>
        <div style="font-size: 13px; color: var(--muted)">Cek pesanan sebelum checkout</div>
      </div>
      <button class="icon-btn" id="closeCartBtn" type="button" aria-label="Tutup keranjang">Tutup</button>
    </div>

    <div class="cart-list" id="cartList" aria-live="polite" style="margin-top: 10px">
      
    </div>

    <div class="cart-summary">
      <div style="color: var(--muted)">Total</div>
      <div style="font-size: 18px" id="cartTotal">Rp 0</div>
      <input type="hidden" name="total" id="totalHargaInput" />
    </div>

    <div style="font-weight: 800; margin-top: 10px">Customer Detail (Wajib)</div>
    <input type="text" id="nameInput" name="namacust" placeholder="Nama Pembeli" required />
    <input type="text" id="addressInput" name="address" placeholder="Alamat" required />
    <input type="number" id="phoneInput" name="nohp" placeholder="No Telepon" required />

    <button class="checkout" type="submit">Pesan Web</button>
    <button class="checkout" id="checkoutBtn" type="button">Checkout — Bayar</button>
  </form>
</aside>


    <footer>
      <div style="max-width: var(--max-width); margin: 0 auto; padding: 12px 20px">
        <div style="display: flex; flex-direction: column; gap: 8px; align-items: center">
          <div style="font-weight: 700">mico.id</div>
          <div style="color: var(--muted); font-size: 13px">© <span id="year"></span> mico.id — All Rights Reserved</div>
          <div style="color: var(--muted); font-size: 13px; margin-top: 6px">Ikuti kami: <a href="https://www.instagram.com/micoid15/" target="_blank" style="color: var(--accent2); text-decoration: none; margin-left: 6px">@mico.id</a></div>
        </div>
      </div>
    </footer>
    <script src="script.js"></script>
  </body>
</html>
