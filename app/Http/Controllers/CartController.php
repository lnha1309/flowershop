<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        try {
            // Log để debug
            Log::info('Add to cart request:', $request->all());
            
            // Kiểm tra đăng nhập
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng!'
                ], 401);
            }
            
            // Validate - Sửa lại tên column cho đúng
            $validated = $request->validate([
                'product_id' => 'required|integer',
                'quantity' => 'nullable|integer|min:1'
            ]);
            
            $productId = $validated['product_id'];
            $quantity = $validated['quantity'] ?? 1;
            
            // Kiểm tra sản phẩm có tồn tại không
            $product = Product::where('product_id', $productId)->first();
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sản phẩm không tồn tại!'
                ], 404);
            }
            
            $userId = Auth::id();
            
            // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
            $cartItem = CartItem::where('user_id', $userId)
                                ->where('product_id', $productId)
                                ->first();
            
            if ($cartItem) {
                // Cập nhật số lượng
                $cartItem->quantity += $quantity;
                $cartItem->save();
            } else {
                // Tạo mới
                CartItem::create([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'quantity' => $quantity
                ]);
            }
            
            // Lấy tổng số sản phẩm trong giỏ
            $totalItems = CartItem::where('user_id', $userId)->sum('quantity');
            
            return response()->json([
                'success' => true,
                'message' => 'Đã thêm sản phẩm vào giỏ hàng!',
                'totalItems' => $totalItems
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error adding to cart: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    // Return current user's cart items
    public function getCart(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Không đăng nhập'], 401);
        }

        $userId = Auth::id();
        $items = CartItem::where('user_id', $userId)->with('product')->get();

        return response()->json(['success' => true, 'cart' => $items]);
    }

    // Update quantity of a cart item (cart_item_id)
    public function updateQuantity(Request $request, $id)
    {
        try {
            if (!Auth::check()) {
                return response()->json(['success' => false, 'message' => 'Không đăng nhập'], 401);
            }

            $validated = $request->validate(['quantity' => 'required|integer|min:1']);

            $cartItem = CartItem::where('cart_item_id', $id)->where('user_id', Auth::id())->firstOrFail();
            $cartItem->quantity = $validated['quantity'];
            $cartItem->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    // Remove an item from cart
    public function removeItem(Request $request, $id)
    {
        try {
            if (!Auth::check()) {
                return response()->json(['success' => false, 'message' => 'Không đăng nhập'], 401);
            }

            $cartItem = CartItem::where('cart_item_id', $id)->where('user_id', Auth::id())->firstOrFail();
            $cartItem->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
