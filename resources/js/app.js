document.addEventListener('DOMContentLoaded', () => {
  const token = document.querySelector('meta[name="csrf-token"]').content;

  // Intercept add-to-cart forms
  document.querySelectorAll('.add-to-cart-form').forEach(form => {
    form.addEventListener('submit', async (e) => {
      // If JS is available we prevent the default and do AJAX
      e.preventDefault();
      const productId = form.dataset.productId || form.querySelector('input[name="product_id"]').value;
      const qtyInput = form.querySelector('input[name="quantity"]');
      const qty = qtyInput ? parseInt(qtyInput.value || 1, 10) : 1;

      try {
        const res = await fetch(window.App.routes.addToCart, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
          },
          body: JSON.stringify({ product_id: productId, quantity: qty })
        });
        const data = await res.json();
        if (res.ok) {
          // update cart count bubble
          const cartCountEl = document.getElementById('cart-count');
          cartCountEl.textContent = data.cart_count ?? cartCountEl.textContent;
          // show small toast (simple)
          showToast('Added to cart');
        } else {
          // show error, e.g., out of stock
          showToast(data.message || 'Could not add to cart');
        }
      } catch (err) {
        console.error(err);
        showToast('Network error');
      }
    });
  });

  function showToast(msg) {
    const t = document.createElement('div');
    t.textContent = msg;
    t.className = 'fixed bottom-6 right-6 bg-black text-white px-4 py-2 rounded';
    document.body.appendChild(t);
    setTimeout(()=> t.remove(), 3000);
  }
});
