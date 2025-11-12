let cart = [];

// Load cart from database
async function loadCart() {
    if (!isUserLoggedIn()) {
        cart = [];
        updateCartBadge();
        return;
    }
    
    try {
        const response = await fetch('/cart/get');
        const data = await response.json();
        
        if (data.success) {
            cart = data.cart.map(item => {
                // Xử lý image URL - tránh lỗi relative path
                let imageUrl = item.product.image_url || '/images/placeholder.png';
                if (imageUrl && !imageUrl.startsWith('http') && !imageUrl.startsWith('/')) {
                    imageUrl = '/' + imageUrl;
                }
                
                return {
                    id: item.cart_item_id,
                    name: item.product.name,
                    price: parseFloat(item.product.price),
                    image: imageUrl,
                    quantity: item.quantity,
                    productId: item.product_id
                };
            });
            updateCartBadge();
            renderCart();
        }
    } catch (error) {
        console.error('Error loading cart:', error);
    }
}

// Check if user is logged in
// Kiểm tra đăng nhập
function isUserLoggedIn() {
    // Kiểm tra nhiều cách
    const hasUserId = document.querySelector('meta[name="user-id"]') !== null;
    const hasLoginMeta = document.querySelector('meta[name="user-logged-in"]') !== null;
    
    console.log('Check login:', hasUserId, hasLoginMeta); // Debug
    
    return hasUserId || hasLoginMeta;
}

// Sửa hàm showLoginAlert để chỉ hiện thông báo
function showLoginAlert() {
    // Chỉ hiển thị thông báo, KHÔNG chuyển trang
    alert('Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng!');
    // XÓA dòng này: window.location.href = '/login';
}

// Cập nhật hàm addToCart với console.log để debug
async function addToCart(productId, name, price, image) {
    console.log('addToCart called:', {productId, name, price, image}); // Debug
    
    if (!isUserLoggedIn()) {
        console.log('User not logged in'); // Debug
        showLoginAlert();
        return;
    }
    
    console.log('User is logged in, proceeding...'); // Debug
    
    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (!csrfToken) {
            console.error('CSRF token not found');
            showErrorMessage('Lỗi: Không tìm thấy CSRF token');
            return;
        }
        
        const response = await fetch('/cart/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken.content
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: 1
            })
        });
        
        const data = await response.json();
        console.log('Response:', data); // Debug
        
        if (data.success) {
            await loadCart();
            showCartSidebar();
            showSuccessMessage(data.message);
        } else {
            showErrorMessage(data.message);
        }
    } catch (error) {
        console.error('Error adding to cart:', error);
        showErrorMessage('Có lỗi xảy ra khi thêm sản phẩm!');
    }
}

// Thêm hàm helper
function showSuccessMessage(message) {
    // Bạn có thể dùng thư viện toast hoặc alert đơn giản
    const alertDiv = document.createElement('div');
    alertDiv.style.cssText = 'position:fixed;top:20px;right:20px;background:#28a745;color:white;padding:15px 20px;border-radius:8px;z-index:9999;';
    alertDiv.textContent = message;
    document.body.appendChild(alertDiv);
    
    setTimeout(() => alertDiv.remove(), 3000);
}

function showErrorMessage(message) {
    alert(message);
}


// Update quantity
async function updateQuantity(cartItemId, change) {
    const item = cart.find(i => i.id === cartItemId);
    if (!item) return;
    
    const newQuantity = item.quantity + change;
    
    if (newQuantity <= 0) {
        await removeFromCart(cartItemId);
        return;
    }
    
    try {
        const response = await fetch(`/cart/update/${cartItemId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ quantity: newQuantity })
        });
        
        if (response.ok) {
            await loadCart();
            renderCart();
        }
    } catch (error) {
        console.error('Error updating quantity:', error);
    }
}

// Remove from cart
async function removeFromCart(cartItemId) {
    try {
        const response = await fetch(`/cart/remove/${cartItemId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });
        
        if (response.ok) {
            await loadCart();
            renderCart();
        }
    } catch (error) {
        console.error('Error removing item:', error);
    }
}

// Update cart badge
function updateCartBadge() {
    const badge = document.getElementById('cartBadge');
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    badge.textContent = totalItems;
    badge.style.display = totalItems > 0 ? 'flex' : 'none';
}

// Render cart
function renderCart() {
    const cartBody = document.getElementById('cartBody');
    const cartFooter = document.getElementById('cartFooter');
    
    if (cart.length === 0) {
        cartBody.innerHTML = `
            <div class="cart-empty">
                <i class="fa-solid fa-shopping-cart"></i>
                <p>Giỏ hàng của bạn đang trống!</p>
            </div>
        `;
        cartFooter.style.display = 'none';
        return;
    }
    
    let total = 0;
    let itemsHTML = '<div class="cart-items">';
    
    cart.forEach((item) => {
        const itemTotal = item.price * item.quantity;
        total += itemTotal;
        
        itemsHTML += `
            <div class="cart-item">
                <img src="${item.image}" alt="${item.name}">
                <div class="cart-item-details">
                    <div class="cart-item-name">${item.name}</div>
                    <div class="cart-item-price">${item.price.toLocaleString('vi-VN')}đ</div>
                    <div class="cart-item-quantity">
                        <button class="qty-btn" onclick="updateQuantity(${item.id}, -1)">−</button>
                        <span class="qty-number">${item.quantity}</span>
                        <button class="qty-btn" onclick="updateQuantity(${item.id}, 1)">+</button>
                    </div>
                </div>
                <div class="cart-item-actions">
                    <button class="cart-item-remove" onclick="removeFromCart(${item.id})">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>
        `;
    });
    
    itemsHTML += '</div>';
    cartBody.innerHTML = itemsHTML;
    
    document.getElementById('cartTotal').textContent = total.toLocaleString('vi-VN') + 'đ';
    cartFooter.style.display = 'block';
}

// Show/Hide cart sidebar
function showCartSidebar() {
    document.getElementById('cartOverlay').classList.add('active');
    document.getElementById('cartSidebar').classList.add('active');
    document.body.style.overflow = 'hidden';
    renderCart();
}

function hideCartSidebar() {
    document.getElementById('cartOverlay').classList.remove('active');
    document.getElementById('cartSidebar').classList.remove('active');
    document.body.style.overflow = '';
}

// Event listeners
document.getElementById('cartSection')?.addEventListener('click', showCartSidebar);
document.getElementById('cartClose')?.addEventListener('click', hideCartSidebar);
document.getElementById('cartOverlay')?.addEventListener('click', hideCartSidebar);

// Initialize
window.addEventListener('DOMContentLoaded', loadCart);

// Helper functions
function showSuccessMessage(message) {
    // Có thể dùng toast notification library
    console.log('Success:', message);
}

function showErrorMessage(message) {
    alert(message);
}
