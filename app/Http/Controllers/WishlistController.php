<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function add(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng đăng nhập để thêm vào danh sách yêu thích'
            ], 401);
        }

        $request->validate([
            'product_id' => 'required|exists:products,product_id'
        ]);

        $wishlist = Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Đã thêm vào danh sách yêu thích'
        ]);
    }

    public function remove($product_id)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng đăng nhập'
            ], 401);
        }

        Wishlist::where('user_id', Auth::id())
            ->where('product_id', $product_id)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Đã xóa khỏi danh sách yêu thích'
        ]);
    }

    public function check($product_id)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'inWishlist' => false]);
        }

        $exists = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $product_id)
            ->exists();

        return response()->json(['success' => true, 'inWishlist' => $exists]);
    }
}