<!-- Cart Overlay -->
<div class="cart-overlay" id="cartOverlay"></div>

<!-- Cart Sidebar -->
<div class="cart-sidebar" id="cartSidebar">
    <div class="cart-header">
        <h2>Giỏ Hàng</h2>
        <button class="cart-close" id="cartClose">&times;</button>
    </div>
    <div class="cart-body" id="cartBody">
        <!-- Cart content will be inserted here -->
        <div class="cart-empty">
            <i class="fa-solid fa-shopping-cart"></i>
            <p>Giỏ hàng của bạn đang trống!</p>
        </div>
    </div>
    <div class="cart-footer" id="cartFooter" style="display: none;">
        <div class="cart-total">
            <span>Tổng cộng:</span>
            <span id="cartTotal">0đ</span>
        </div>
        <button class="cart-checkout" onclick="alert('Chức năng thanh toán đang được phát triển')">
    Tiến Hành Thanh Toán
</button>
    </div>
</div>

<style>
.cart-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 999;
    display: none;
}

.cart-overlay.active {
    display: block;
}

.cart-sidebar {
    position: fixed;
    top: 0;
    right: -400px;
    width: 400px;
    height: 100%;
    background: white;
    z-index: 1000;
    transition: right 0.3s ease;
    display: flex;
    flex-direction: column;
    box-shadow: -2px 0 10px rgba(0,0,0,0.1);
}

.cart-sidebar.active {
    right: 0;
}

.cart-header {
    padding: 20px;
    border-bottom: 1px solid #eee;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.cart-header h2 {
    margin: 0;
    font-size: 24px;
    font-family: 'Crimson Pro', serif;
}

.cart-close {
    background: none;
    border: none;
    font-size: 30px;
    cursor: pointer;
    color: #666;
}

.cart-body {
    flex: 1;
    overflow-y: auto;
    padding: 20px;
}

.cart-empty {
    text-align: center;
    padding: 50px 20px;
    color: #999;
}

.cart-empty i {
    font-size: 60px;
    margin-bottom: 20px;
}

.cart-items {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.cart-item {
    display: flex;
    gap: 15px;
    padding: 15px;
    border: 1px solid #eee;
    border-radius: 8px;
}

.cart-item img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 4px;
}

.cart-item-details {
    flex: 1;
}

.cart-item-name {
    font-weight: 600;
    margin-bottom: 5px;
    font-family: 'Crimson Pro', serif;
}

.cart-item-price {
    color: #8b7355;
    margin-bottom: 10px;
}

.cart-item-quantity {
    display: flex;
    align-items: center;
    gap: 10px;
}

.qty-btn {
    width: 25px;
    height: 25px;
    border: 1px solid #ddd;
    background: white;
    cursor: pointer;
    border-radius: 4px;
}

.qty-number {
    min-width: 30px;
    text-align: center;
}

.cart-item-remove {
    background: none;
    border: none;
    color: #dc3545;
    cursor: pointer;
    font-size: 18px;
}

.cart-footer {
    padding: 20px;
    border-top: 1px solid #eee;
}

.cart-total {
    display: flex;
    justify-content: space-between;
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 15px;
    font-family: 'Crimson Pro', serif;
}

.cart-checkout {
    width: 100%;
    padding: 12px;
    background: #8b7355;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 16px;
    font-family: 'Crimson Pro', serif;
    transition: background 0.3s;
}

.cart-checkout:hover {
    background: #6d5a43;
}
</style>
