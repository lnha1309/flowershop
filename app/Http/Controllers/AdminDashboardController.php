<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $now = Carbon::now();
        $selectedDateString = $request->input('date');
        $selectedDate = null;

        if ($selectedDateString) {
            try {
                $selectedDate = Carbon::createFromFormat('Y-m-d', $selectedDateString);
            } catch (\Exception $exception) {
                $selectedDate = null;
            }
        }

        if ($selectedDate) {
            $rangeStart = $selectedDate->copy()->startOfMonth();
            $rangeEnd = $selectedDate->copy()->endOfDay();
            $rangeLabel = $rangeStart->format('d/m') . ' - ' . $selectedDate->format('d/m/Y');
        } else {
            $rangeStart = $now->copy()->startOfMonth();
            $rangeEnd = $now;
            $rangeLabel = $rangeStart->format('d/m') . ' - ' . $rangeEnd->format('d/m');
        }

        $ordersAggregate = DB::table('orders')
            ->whereBetween('order_date', [$rangeStart, $rangeEnd])
            ->selectRaw('COALESCE(SUM(total_amount), 0) as gross')
            ->selectRaw('COALESCE(SUM(discount), 0) as discounts')
            ->first();

        $filteredOrdersCount = DB::table('orders')
            ->whereBetween('order_date', [$rangeStart, $rangeEnd])
            ->count();

        $totalRevenue = (float) ($ordersAggregate->gross ?? 0);
        $totalExpenses = (float) ($ordersAggregate->discounts ?? 0);
        $netIncome = max($totalRevenue - $totalExpenses, 0);

        $recentOrders = DB::table('orders as o')
            ->leftJoin('users as u', 'o.user_id', '=', 'u.user_id')
            ->leftJoin('payment_methods as pm', 'o.payment_method_id', '=', 'pm.method_id')
            ->select(
                'o.order_id',
                'o.order_date',
                'o.status',
                'o.total_amount',
                'o.discount',
                DB::raw('(o.total_amount - o.discount) as net_total'),
                DB::raw('COALESCE(u.full_name, u.username) as customer_name'),
                'pm.method_name as payment_method'
            )
            ->whereBetween('o.order_date', [$rangeStart, $rangeEnd])
            ->orderByDesc('o.order_date')
            ->limit(7)
            ->get();

        $statusBreakdown = DB::table('orders')
            ->select('status', DB::raw('COUNT(*) as total'))
            ->whereBetween('order_date', [$rangeStart, $rangeEnd])
            ->groupBy('status')
            ->orderByDesc('total')
            ->get();

        $dashboardStats = [
            'orders' => $filteredOrdersCount,
            'expenses' => $totalExpenses,
            'income' => $netIncome,
        ];

        $targets = config('dashboard.kpi_targets');
        $orderTarget = max((int) ($targets['orders'] ?? 0), 0);
        $expenseBudget = max((float) ($targets['expenses'] ?? 0), 0.0);
        $incomeTarget = max((float) ($targets['income'] ?? 0), 0.0);

        $percentage = function ($value, $target) {
            if ($target <= 0) {
                return 0;
            }

            return round(($value / $target) * 100, 1);
        };

        $ordersPercent = $percentage($dashboardStats['orders'], $orderTarget);
        $expensesPercent = $percentage($dashboardStats['expenses'], $expenseBudget);
        $incomePercent = $percentage($dashboardStats['income'], $incomeTarget);

        $arcLength = 188;
        $arcOffset = function ($percent) use ($arcLength) {
            $clamped = max(min($percent, 100), 0);
            return $arcLength - ($arcLength * $clamped / 100);
        };

        $kpiCards = [
            [
                'label' => 'Tổng đơn hàng',
                'value' => number_format($dashboardStats['orders']),
                'range' => "Khoảng: {$rangeLabel}",
                'note' => $orderTarget > 0
                    ? "{$ordersPercent}% hoàn thành mục tiêu đơn hàng trong khoảng lọc hiện tại."
                    : 'Chưa cấu hình mục tiêu đơn hàng.',
                'icon' => 'shopping_cart',
                'theme' => 'kpi-indigo',
                'percent' => $ordersPercent,
                'arc_offset' => $arcOffset($ordersPercent),
                'arc_delay' => random_int(0, 300),
            ],
            [
                'label' => 'Tổng chi phí',
                'value' => number_format($dashboardStats['expenses'], 0, ',', '.') . ' ₫',
                'range' => "Khoảng: {$rangeLabel}",
                'note' => $expenseBudget > 0
                    ? "{$expensesPercent}% sử dụng ngân sách chi phí trong khoảng lọc."
                    : 'Chưa cấu hình ngân sách chi phí.',
                'icon' => 'account_balance_wallet',
                'theme' => 'kpi-rose',
                'percent' => $expensesPercent,
                'arc_offset' => $arcOffset($expensesPercent),
                'arc_delay' => random_int(0, 300),
            ],
            [
                'label' => 'Tổng thu nhập',
                'value' => number_format($dashboardStats['income'], 0, ',', '.') . ' ₫',
                'range' => "Khoảng: {$rangeLabel}",
                'note' => $incomeTarget > 0
                    ? "{$incomePercent}% hoàn thành mục tiêu lợi nhuận ròng trong khoảng lọc."
                    : 'Chưa cấu hình mục tiêu lợi nhuận.',
                'icon' => 'trending_up',
                'theme' => 'kpi-emerald',
                'percent' => $incomePercent,
                'arc_offset' => $arcOffset($incomePercent),
                'arc_delay' => random_int(0, 300),
            ],
        ];

        return view('admin.dashboard', [
            'dashboardStats' => $dashboardStats,
            'recentOrders' => $recentOrders,
            'statusBreakdown' => $statusBreakdown,
            'rangeLabel' => $rangeLabel,
            'selectedDate' => $selectedDate ? $selectedDate->format('Y-m-d') : null,
            'kpiCards' => $kpiCards,
        ]);
    }
}
