<style>
    .user-menu {
        position: relative;
    }

    .user-trigger {
        background: transparent;
        border: none;
        color: inherit;
        cursor: pointer;
        padding: 0;
    }

    .user-dropdown {
        position: absolute;
        top: 110%;
        right: 0;
        display: none;
        padding: 8px 16px;
        background: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        z-index: 20;
    }

    .user-dropdown.show {
        display: block;
    }

    .user-dropdown button {
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
    }
</style>
<nav class="p-3 mb-0">
        <ul class="d-flex justify-content-around align-items-center mb-0">
            <li><a href="{{ route('home')}}" style="font-family: 'Brygada 1918', serif !important;">Trang chủ</a></li>
            <li><a href="{{ route('products')}}" style="font-family: 'Brygada 1918', serif !important;">Sản phẩm</a></li>
<li class="none">
    <h2 class="mb-0" style="font-family: 'Uncial Antiqua', cursive !important;">Florencia</h2>
</li>


            <li><a href="{{ route('about') }}" style="font-family: 'Brygada 1918', serif !important;">Về chúng tôi</a></li>
            <li style="display: flex; align-items: center; gap: 15px;">
                <div class="user-section" id="userSection">
                    @auth
                        <div class="user-menu">
                            <button class="user-trigger d-flex align-items-center gap-2" id="userMenuToggle" type="button">
                                <i class="fa-solid fa-user user-icon" style="font-family: 'Font Awesome 6 Free' !important;"></i>
                                <span style="font-family: 'Brygada 1918', serif !important;">
                                    {{ Auth::user()->full_name ?? Auth::user()->username ?? Auth::user()->email }}
                                </span>
                            </button>
                            <div class="user-dropdown" id="userMenuDropdown">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" style="font-family: 'Brygada 1918', serif !important;">Đăng xuất</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}">
                            <i class="fa-solid fa-user user-icon" style="font-family: 'Font Awesome 6 Free' !important;"></i>
                            <span style="font-family: 'Brygada 1918', serif !important;">Đăng nhập</span>
                        </a>
                    @endauth
                </div>
                <div class="cart-section" id="cartSection">
                    <i class="fa-solid fa-shopping-cart cart-icon" style="font-family: 'Font Awesome 6 Free' !important;"></i>
                    <span class="cart-badge" id="cartBadge">0</span>
                </div>
            </li>
        </ul>
</nav>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggle = document.getElementById('userMenuToggle');
        const dropdown = document.getElementById('userMenuDropdown');

        if (!toggle || !dropdown) {
            return;
        }

        toggle.addEventListener('click', function (event) {
            event.stopPropagation();
            dropdown.classList.toggle('show');
        });

        document.addEventListener('click', function (event) {
            if (!dropdown.contains(event.target)) {
                dropdown.classList.remove('show');
            }
        });
    });
</script>
