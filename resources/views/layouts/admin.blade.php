<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title','Admin Dashboard')</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin-dashboard/style.css') }}" />
    @stack('styles')
  </head>
  <body>
    <div class="container">
      <aside>
        <div class="top">
          <div class="logo">
            <img src="{{ asset('images/icon.png') }}" alt="Logo" />
            <h2>FLOREN<span class="danger">CIA</span></h2>
          </div>
          <div class="close" id="close-btn">
            <span class="material-icons-sharp"> close </span>
          </div>
        </div>

        <div class="sidebar">
@php
    $menuGroups = [
        'Tổng quan' => [
            [
                'label' => 'Dashboard',
                'icon' => 'dashboard',
                'href' => route('admin.dashboard'),
                'active' => request()->routeIs('admin.dashboard'),
            ],
        ],
        'Người dùng' => [
            [
                'label' => 'Người dùng',
                'icon' => 'groups',
                'table' => 'users',

            ],
            [
                'label' => 'Vai trò',
                'icon' => 'admin_panel_settings',
                'table' => 'roles',

            ],
        ],
        'Sản phẩm & Danh mục' => [
            [
                'label' => 'Sản phẩm',
                'icon' => 'inventory_2',
                'table' => 'products',

            ],
            [
                'label' => 'Chủ đề',
                'icon' => 'palette',
                'table' => 'themes',

            ],
            [
                'label' => 'Phong cách',
                'icon' => 'style',
                'table' => 'styles',

            ],
            [
                'label' => 'Loài hoa',
                'icon' => 'local_florist',
                'table' => 'flower_types',

            ],
            [
                'label' => 'Đối tượng',
                'icon' => 'diversity_3',
                'table' => 'recipients',

            ],
            [
                'label' => 'Dịp tặng',
                'icon' => 'event',
                'table' => 'occasions',

            ],
        ],
        'Bán hàng & Vận hành' => [
            [
                'label' => 'Đơn hàng',
                'icon' => 'receipt_long',
                'table' => 'orders',

            ],
            [
                'label' => 'Chi tiết đơn',
                'icon' => 'list_alt',
                'table' => 'order_items',

            ],
            [
                'label' => 'Theo dõi vận chuyển',
                'icon' => 'local_shipping',
                'table' => 'order_tracking',

            ],
        ],
        'Tối ưu kinh doanh' => [
            [
                'label' => 'Khuyến mãi',
                'icon' => 'sell',
                'table' => 'promotions',

            ],
            [
                'label' => 'Tồn kho',
                'icon' => 'warehouse',
                'table' => 'inventory',

            ],
            [
                'label' => 'Đánh giá sản phẩm',
                'icon' => 'reviews',
                'table' => 'product_reviews',

            ],
        ],
    ];

    foreach ($menuGroups as &$group) {
        foreach ($group as &$item) {
            if (! empty($item['table']) && \Illuminate\Support\Facades\Schema::hasTable($item['table'])) {
                $item['count'] = \Illuminate\Support\Facades\DB::table($item['table'])->count();
            }
        }
        unset($item);
    }
    unset($group);
@endphp

@foreach ($menuGroups as $groupLabel => $items)
          <p class="menu-group">{{ $groupLabel }}</p>
          @foreach ($items as $item)
          <a href="{{ $item['href'] ?? '#' }}" class="{{ ! empty($item['active']) ? 'active' : '' }}">
            <span class="material-icons-sharp"> {{ $item['icon'] }} </span>
            <div class="menu-copy">
              <h3>{{ $item['label'] }}</h3>
              @if (! empty($item['description']))
                <small class="text-muted">{{ $item['description'] }}</small>
              @endif
            </div>
          </a>
          @endforeach
@endforeach
        </div>
      </aside>

      <main>
        @yield('content')
      </main>

      <div class="right">
        @yield('right-panel')
      </div>
    </div>

    <script src="{{ asset('admin-dashboard/constants/recent-order-data.js') }}"></script>
    <script src="{{ asset('admin-dashboard/constants/update-data.js') }}"></script>
    <script src="{{ asset('admin-dashboard/constants/sales-analytics-data.js') }}"></script>
    <script src="{{ asset('admin-dashboard/index.js') }}"></script>
    @stack('scripts')
  </body>
</html>
