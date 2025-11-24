(function () {
  const cart = {};
  const cartCountEl = document.getElementById('cartCount');
  const cartListEl = document.getElementById('cartList');
  const cartTotalEl = document.getElementById('cartTotal');
  const openCartBtn = document.getElementById('openCartBtn');
  const closeCartBtn = document.getElementById('closeCartBtn');
  const checkoutBtn = document.getElementById('checkoutBtn');
  const checkoutForm = document.getElementById('cartForm');

  function formatRupiah(num) {
    return 'Rp ' + Number(num).toLocaleString('id-ID');
  }

  function updateCartUI() {
    const items = Object.values(cart);
    cartCountEl.textContent = items.reduce((s, i) => s + i.qty, 0);
    cartListEl.innerHTML = '';

    if (items.length === 0) {
      cartListEl.innerHTML = '<div style="color:var(--muted);padding:12px">Keranjang kosong</div>';
    } else {
      items.forEach((it, index) => {
        const row = document.createElement('div');
        row.className = 'cart-item';
        row.innerHTML = `
        <div style="flex:1">
        <img src="${it.img}" alt="${it.name}" style="width:50px; height:50px; object-fit:cover; border-radius:6px;">
          <div style="font-weight:700">${it.name}</div>
          <div style="color:var(--muted);font-size:13px">
            Rp ${it.price.toLocaleString('id-ID')} x ${it.qty}
          </div>
        </div>
        <div>
          <button type="button" class="icon-btn remove" data-id="${it.id}">Hapus</button>
        </div>
        <!-- input hidden sesuai kolom DB -->
        <input type="hidden" name="items[${index}][kode_menu]" value="${it.id}">
        <input type="hidden" name="items[${index}][harga]" value="${it.price}">
        <input type="hidden" name="items[${index}][qty]" value="${it.qty}">
      `;
        cartListEl.appendChild(row);
      });
    }

    const total = items.reduce((s, i) => s + i.price * i.qty, 0);
    cartTotalEl.textContent = 'Rp ' + total.toLocaleString('id-ID');
    document.getElementById('totalHargaInput').value = total;
  }

  function addToCart(id, name, price, img) {
    if (!cart[id]) cart[id] = { id, name, price: Number(price), qty: 0, img };
    cart[id].qty += 1;
    updateCartUI();
  }

  document.body.addEventListener('click', (e) => {
    if (e.target.matches('.add-btn')) {
      addToCart(e.target.dataset.id, e.target.dataset.name, e.target.dataset.price, e.target.dataset.img);
    }
    if (e.target.matches('.remove')) {
      delete cart[e.target.dataset.id];
      updateCartUI();
    }
  });

  openCartBtn.addEventListener('click', () => {
    document.getElementById('cartSide').classList.remove('hidden');
    document.getElementById('cartSide').setAttribute('aria-hidden', 'false');
  });

  closeCartBtn.addEventListener('click', () => {
    document.getElementById('cartSide').classList.add('hidden');
    document.getElementById('cartSide').setAttribute('aria-hidden', 'true');
  });

  checkoutForm.addEventListener('submit', function (e) {
    if (Object.keys(cart).length === 0) {
      e.preventDefault();
      alert('Keranjang kosong!');
    }
  });

  checkoutBtn.addEventListener('click', function () {
    if (Object.keys(cart).length === 0) {
      alert('Keranjang kosong!');
      return;
    }

    const nama = document.getElementById('nameInput').value.trim();
    const alamat = document.getElementById('addressInput').value.trim();
    const phone = document.getElementById('phoneInput').value.trim();
    if (!nama || !alamat || !phone) {
      alert('Isi data customer terlebih dahulu');
      return;
    }

    let pesan = `*Pesanan MICO.ID*\nNama: ${nama}\nAlamat: ${alamat}\nNo HP: ${phone}\n\n*Detail Pesanan:*\n`;
    let total = 0;
    Object.values(cart).forEach((it, i) => {
      const subtotal = it.price * it.qty;
      total += subtotal;
      pesan += `${i + 1}. ${it.name} x${it.qty} = Rp ${subtotal.toLocaleString('id-ID')}\n`;
    });
    pesan += `\n*Total:* Rp ${total.toLocaleString('id-ID')}`;

    const waNumber = '6281234567890';
    const url = `https://wa.me/${waNumber}?text=${encodeURIComponent(pesan)}`;
    window.open(url, '_blank');
  });

  updateCartUI();

  const menuToggle = document.getElementById('menuToggle');
  const navLinks = document.getElementById('navLinks');
  menuToggle.addEventListener('click', () => {
    if (navLinks.style.display === 'flex') navLinks.style.display = 'none';
    else navLinks.style.display = 'flex';
  });

  // Video toggle
  const bgVideo = document.getElementById('bgVideo');
  const toggleVideoBtn = document.getElementById('toggleVideo');
  let videoEnabled = true;
  toggleVideoBtn.addEventListener('click', () => {
    if (!bgVideo) return;
    try {
      if (videoEnabled) {
        bgVideo.pause();
        bgVideo.style.opacity = 0.6;
        videoEnabled = false;
      } else {
        bgVideo.play();
        bgVideo.style.opacity = 1;
        videoEnabled = true;
      }
    } catch (e) {
      console.warn('Video toggle failed', e);
    }
  });
})();
