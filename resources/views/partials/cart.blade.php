<!-- Cart Overlay -->
<div class="cart-overlay" id="cartOverlay"></div>

<!-- Cart Sidebar -->
<div class="cart-sidebar" id="cartSidebar">
    <div class="cart-header">
        <h2>Your Cart</h2>
        <button class="cart-close" id="cartClose">&times;</button>
    </div>
    <div class="cart-body" id="cartBody">
        <!-- Cart content will be inserted here -->
    </div>
    <div class="cart-footer" id="cartFooter" style="display: none;">
        <div class="cart-total">
            <span>Total:</span>
            <span id="cartTotal">$0.00</span>
        </div>
        <button class="cart-checkout" onclick="window.location.href='checkout.html'">
            Proceed to Checkout
        </button>
    </div>
    
</div>

