@extends('layouts.admin')

@php
    use Illuminate\Support\Str;

    $formatCurrency = fn ($amount) => number_format((float) $amount, 0, ',', '.') . ' ₫';
@endphp

@section('title', 'Admin Dashboard')

@section('content')
      <h1>Dashboard</h1>

      <div class="date">
        <form method="GET" action="{{ route('admin.dashboard') }}" class="date-filter">
          <label for="dashboard-date" class="text-muted">Chọn ngày</label>
          <input id="dashboard-date"
                 type="date"
                 name="date"
                 value="{{ $selectedDate }}"
                 onchange="this.form.submit()" />
          @if ($selectedDate)
            <a href="{{ route('admin.dashboard') }}" class="filter-reset">Xóa lọc</a>
          @endif
        </form>
      </div>

@php
@endphp

      <div class="kpi-grid">
        @foreach ($kpiCards as $card)
        <div class="kpi-card {{ $card['theme'] }}">
          <div class="kpi-card__icon">
            <span class="material-icons-sharp">{{ $card['icon'] }}</span>
          </div>
          <div class="kpi-card__content">
            <p class="kpi-card__label">{{ $card['label'] }}</p>
            <div class="kpi-card__value-row">
              <p class="kpi-card__value">{{ $card['value'] }}</p>
              <span class="kpi-card__percent">{{ $card['percent'] }}%</span>
            </div>
            <p class="kpi-card__range">{{ $card['range'] }}</p>
            <p class="kpi-card__note">{{ $card['note'] }}</p>
          </div>
          <div class="kpi-card__arc" style="--arc-delay: {{ $card['arc_delay'] }}ms; --arc-target-offset: {{ $card['arc_offset'] }};">
            <svg viewBox="0 0 80 80">
              <circle class="kpi-card__arc-track" cx="40" cy="40" r="30"></circle>
              <circle class="kpi-card__arc-progress" cx="40" cy="40" r="30"></circle>
            </svg>
          </div>
        </div>
        @endforeach
      </div>

      <div class="recent-orders">
        <div class="recent-orders__header">
          <h2>Đơn hàng gần đây</h2>
          <small class="text-muted">Khoảng hiển thị: {{ $rangeLabel }}</small>
        </div>
        <table id="recent-orders--table">
          <thead>
            <tr>
              <th>Mã đơn</th>
              <th>Khách hàng</th>
              <th>Thanh toán</th>
              <th>Trạng thái</th>
              <th>Ngày tạo</th>
            </tr>
          </thead>
          <tbody>
          @forelse ($recentOrders as $order)
            <tr>
              <td>#{{ str_pad($order->order_id, 5, '0', STR_PAD_LEFT) }}</td>
              <td>
                <p class="primary">{{ $order->customer_name ?? 'Khách lẻ' }}</p>
                <small class="text-muted">{{ $order->payment_method ?? 'Chưa cập nhật' }}</small>
              </td>
              <td>{{ $formatCurrency($order->net_total) }}</td>
              @php
                  $statusSlug = Str::slug($order->status ?? 'pending');
              @endphp
              <td>
                <span class="status-pill status-{{ $statusSlug }}">{{ $order->status ?? 'Pending' }}</span>
              </td>
              <td>
                {{ $order->order_date ? \Illuminate\Support\Carbon::parse($order->order_date)->format('d/m/Y H:i') : '---' }}
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-muted empty-state">Chưa có đơn hàng nào.</td>
            </tr>
          @endforelse
          </tbody>
        </table>
        <a href="#">Xem tất cả</a>
      </div>
@endsection

@section('right-panel')
        <div class="top">
          <button id="menu-btn">
            <span class="material-icons-sharp"> menu </span>
          </button>
          <div class="theme-toggler">
            <span class="material-icons-sharp active"> light_mode </span>
            <span class="material-icons-sharp"> dark_mode </span>
          </div>
          <div class="profile profile-menu">
            <div class="info">
              <p>Hey, <b>{{ session('EmployeeName', 'Admin') }}</b></p>
              <small class="text-muted">Admin</small>
            </div>
            <button type="button"
                    id="profileMenuTrigger"
                    class="profile-photo"
                    aria-haspopup="true"
                    aria-expanded="false">
              <img src="{{ asset('admin-dashboard/images/profile-1.jpg') }}" alt="Profile Picture" />
            </button>
            <div id="profileMenuDropdown" class="profile-dropdown" hidden>
              <form id="admin-logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-action">
                  <span>Đăng xuất</span>
                  <span class="material-icons-sharp"> logout </span>
                </button>
              </form>
            </div>
          </div>
        </div>

        <div class="recent-updates">
          <h2>Recent Updates</h2>
        </div>

        <div class="sales-analytics">
          <h2>Tình trạng đơn hàng</h2>
          <div id="analytics">
            @forelse ($statusBreakdown as $status)
              @php
                  $statusSlug = Str::slug($status->status ?? 'pending');
                  $statusPercentage = $dashboardStats['orders'] > 0
                      ? round(($status->total / $dashboardStats['orders']) * 100)
                      : 0;
                  $statusIcons = [
                      'pending' => 'hourglass_empty',
                      'processing' => 'autorenew',
                      'in-progress' => 'autorenew',
                      'completed' => 'task_alt',
                      'delivered' => 'check_circle',
                      'cancelled' => 'highlight_off',
                      'declined' => 'cancel',
                      'failed' => 'error',
                  ];
                  $statusIcon = $statusIcons[$statusSlug] ?? 'insights';
              @endphp
              <div class="item status-card status-{{ $statusSlug }}">
                <div class="icon">
                  <span class="material-icons-sharp">{{ $statusIcon }}</span>
                </div>
                <div class="right">
                  <div class="info">
                    <h3>{{ $status->status }}</h3>
                    <small class="text-muted">{{ $status->total }} đơn</small>
                  </div>
                  <h5 class="primary">{{ $statusPercentage }}%</h5>
                  <h3>{{ $status->total }}</h3>
                </div>
              </div>
            @empty
              <p class="text-muted empty-state">Chưa có dữ liệu trạng thái đơn hàng.</p>
            @endforelse
          </div>
          <div class="item add-product">
            <div>
              <span class="material-icons-sharp"> add </span>
              <h3>Thêm sản phẩm mới</h3>
            </div>
          </div>
        </div>
@endsection

@push('scripts')
<script>
(() => {
  const trigger = document.getElementById('profileMenuTrigger');
  const dropdown = document.getElementById('profileMenuDropdown');

  if (!trigger || !dropdown) {
    return;
  }

  const setExpanded = (isOpen) => {
    trigger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    if (isOpen) {
      dropdown.removeAttribute('hidden');
    } else {
      dropdown.setAttribute('hidden', 'hidden');
    }
  };

  const toggle = () => setExpanded(dropdown.hasAttribute('hidden'));

  trigger.addEventListener('click', (event) => {
    event.stopPropagation();
    toggle();
  });

  trigger.addEventListener('keydown', (event) => {
    if (event.key === 'Enter' || event.key === ' ') {
      event.preventDefault();
      toggle();
    }
  });

  document.addEventListener('click', (event) => {
    if (!dropdown.contains(event.target) && !trigger.contains(event.target)) {
      setExpanded(false);
    }
  });
})();
</script>
@endpush
