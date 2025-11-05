
    let cart = [];

    // Load cart from memory on page load
    function loadCart() {
        const savedCart = sessionStorage.getItem('cart');
        if (savedCart) {
            cart = JSON.parse(savedCart);
            updateCartBadge();
        }
    }

    // Save cart to memory
    function saveCart() {
        sessionStorage.setItem('cart', JSON.stringify(cart));
    }

    // Update cart badge
    function updateCartBadge() {
        const badge = document.getElementById('cartBadge');
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        badge.textContent = totalItems;
        badge.style.display = totalItems > 0 ? 'flex' : 'none';
    }

    // Add to cart
    function addToCart(name, price, image) {
        const existingItem = cart.find(item => item.name === name);

        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push({
                name: name,
                price: parseFloat(price),
                image: image,
                quantity: 1
            });
        }

        saveCart();
        updateCartBadge();
        showCartSidebar();
    }

    // Update quantity
    function updateQuantity(index, change) {
        if (cart[index]) {
            cart[index].quantity += change;

            if (cart[index].quantity <= 0) {
                cart.splice(index, 1);
            }

            saveCart();
            updateCartBadge();
            renderCart();
        }
    }

    // Remove from cart
    function removeFromCart(index) {
        cart.splice(index, 1);
        saveCart();
        updateCartBadge();
        renderCart();
    }

    // Render cart content
    function renderCart() {
        const cartBody = document.getElementById('cartBody');
        const cartFooter = document.getElementById('cartFooter');

        if (cart.length === 0) {
            cartBody.innerHTML = `
                        <div class="cart-empty">
                            <i class="fa-solid fa-shopping-cart"></i>
                            <p>Your shopping cart is empty!</p>
                        </div>
                    `;
            cartFooter.style.display = 'none';
            return;
        }

        let total = 0;
        let itemsHTML = '<div class="cart-items">';

        cart.forEach((item, index) => {
            const itemTotal = item.price * item.quantity;
            total += itemTotal;

            itemsHTML += `
                        <div class="cart-item">
                            <img src="${item.image}" alt="${item.name}">
                            <div class="cart-item-details">
                                <div class="cart-item-name">${item.name}</div>
                                <div class="cart-item-price">$${item.price}</div>
                                <div class="cart-item-quantity">
                                    <button class="qty-btn" onclick="updateQuantity(${index}, -1)">−</button>
                                    <span class="qty-number">${item.quantity}</span>
                                    <button class="qty-btn" onclick="updateQuantity(${index}, 1)">+</button>
                                </div>
                            </div>
                            <div class="cart-item-actions">
                                <button class="cart-item-remove" onclick="removeFromCart(${index})">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    `;
        });

        itemsHTML += '</div>';
        cartBody.innerHTML = itemsHTML;

        document.getElementById('cartTotal').textContent = '$' + total.toFixed(2);
        cartFooter.style.display = 'block';
    }

    // Show cart sidebar
    function showCartSidebar() {
        const overlay = document.getElementById('cartOverlay');
        const sidebar = document.getElementById('cartSidebar');

        overlay.classList.add('active');
        sidebar.classList.add('active');
        document.body.style.overflow = 'hidden';

        renderCart();
    }

    // Hide cart sidebar
    function hideCartSidebar() {
        const overlay = document.getElementById('cartOverlay');
        const sidebar = document.getElementById('cartSidebar');

        overlay.classList.remove('active');
        sidebar.classList.remove('active');
        document.body.style.overflow = '';
    }

    // Event listeners
    document.getElementById('cartSection').addEventListener('click', showCartSidebar);
    document.getElementById('cartClose').addEventListener('click', hideCartSidebar);
    document.getElementById('cartOverlay').addEventListener('click', hideCartSidebar);

    // Add to cart buttons
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const name = this.getAttribute('data-name');
            const price = this.getAttribute('data-price');
            const image = this.getAttribute('data-image');
            addToCart(name, price, image);
        });
    });

    // User section update
    function updateUserSection() {
        const userSection = document.getElementById('userSection');
        const isLoggedIn = sessionStorage.getItem('isLoggedIn') === 'true';

        if (isLoggedIn) {
            userSection.innerHTML = '<a href="account.html"><i class="fa-solid fa-user user-icon"></i></a>';
        } else {
            userSection.innerHTML = '<a href="/login"><i class="fa-solid fa-user user-icon"></i><span style="font-family: \'Brygada 1918\', serif !important;">Đăng nhập</span></a>';

        }
    }

    // Tab switching function
    function switchTab(tab) {
        const featuredProducts = document.getElementById('featuredProducts');
        const latestProducts = document.getElementById('latestProducts');
        const tabButtons = document.querySelectorAll('.tab-btn');

        if (tab === 'featured') {
            featuredProducts.style.display = 'block';
            latestProducts.style.display = 'none';
            tabButtons[0].classList.add('active');
            tabButtons[1].classList.remove('active');
        } else {
            featuredProducts.style.display = 'none';
            latestProducts.style.display = 'block';
            tabButtons[0].classList.remove('active');
            tabButtons[1].classList.add('active');
        }

        // Re-attach event listeners to new add-to-cart buttons
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const name = this.getAttribute('data-name');
                const price = this.getAttribute('data-price');
                const image = this.getAttribute('data-image');
                addToCart(name, price, image);
            });
        });
    }

    // Initialize on page load
    window.addEventListener('DOMContentLoaded', function () {
        loadCart();
        updateUserSection();
    });
