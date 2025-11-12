<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::visible()
            ->with(['themes', 'recipients', 'styles', 'flowerTypes', 'occasions']);

        // Apply search first (affects all records)
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('size')) {
            $query->where('size', $request->size);
        }

        if ($request->filled('wrapping')) {
            $query->where('wrapping', $request->wrapping);
        }

        if ($request->filled('theme')) {
            $themeId = $request->theme;
            $query->whereExists(function ($q) use ($themeId) {
                $q->select(\DB::raw(1))
                  ->from('product_themes')
                  ->whereRaw('product_themes.product_id = products.product_id')
                  ->where('product_themes.theme_id', $themeId);
            });
        }

        if ($request->filled('recipient')) {
            $recipientId = $request->recipient;
            $query->whereExists(function ($q) use ($recipientId) {
                $q->select(\DB::raw(1))
                  ->from('product_recipients')
                  ->whereRaw('product_recipients.product_id = products.product_id')
                  ->where('product_recipients.recipient_id', $recipientId);
            });
        }

        if ($request->filled('style')) {
            $styleId = $request->style;
            $query->whereExists(function ($q) use ($styleId) {
                $q->select(\DB::raw(1))
                  ->from('product_styles')
                  ->whereRaw('product_styles.product_id = products.product_id')
                  ->where('product_styles.style_id', $styleId);
            });
        }

        if ($request->filled('flowerType')) {
            $flowerTypeId = $request->flowerType;
            $query->whereExists(function ($q) use ($flowerTypeId) {
                $q->select(\DB::raw(1))
                  ->from('product_flower_types')
                  ->whereRaw('product_flower_types.product_id = products.product_id')
                  ->where('product_flower_types.flower_type_id', $flowerTypeId);
            });
        }

        if ($request->filled('occasion')) {
            $occasionId = $request->occasion;
            $query->whereExists(function ($q) use ($occasionId) {
                $q->select(\DB::raw(1))
                  ->from('product_occasions')
                  ->whereRaw('product_occasions.product_id = products.product_id')
                  ->where('product_occasions.occasion_id', $occasionId);
            });
        }

        $sortBy = $request->get('sort_by', 'product_id');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // Paginate after all filters applied
        $products = $query->paginate(16)->appends($request->except('page'));

        $products->getCollection()->transform(function ($product) {
            $product->theme = optional($product->themes->first())->theme_name;
            $product->recipient = optional($product->recipients->first())->recipient_name;
            $product->style = optional($product->styles->first())->style_name;
            $product->flower_type = optional($product->flowerTypes->first())->flower_type_name;
            $product->occasion = optional($product->occasions->first())->occasion_name;
            $product->id = $product->product_id;
            
            return $product;
        });

        // Load filter options
        $themes = \DB::table('themes')->orderBy('theme_name')->get();
        $recipients = \DB::table('recipients')->orderBy('recipient_name')->get();
        $styles = \DB::table('styles')->orderBy('style_name')->get();
        $flowerTypes = \DB::table('flower_types')->orderBy('flower_type_name')->get();
        $occasions = \DB::table('occasions')->orderBy('occasion_name')->get();

        return view('products', compact('products', 'themes', 'recipients', 'styles', 'flowerTypes', 'occasions'));
    }

    public function show($id)
    {
        $product = Product::where('product_id', $id)
            ->where('is_visible', true)
            ->with(['themes', 'recipients', 'styles', 'flowerTypes', 'occasions'])
            ->firstOrFail();

        // Transform relationships to single values
        $product->theme = optional($product->themes->first())->theme_name;
        $product->recipient = optional($product->recipients->first())->recipient_name;
        $product->style = optional($product->styles->first())->style_name;
        $product->flower_type = optional($product->flowerTypes->first())->flower_type_name;
        $product->occasion = optional($product->occasions->first())->occasion_name;

        // Get reviews for this product
        $reviews = Review::where('product_id', $id)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculate average rating
        $averageRating = $reviews->count() > 0 ? $reviews->avg('rating') : 0;
        $totalReviews = $reviews->count();

        // Get related products (same theme)
        $relatedProducts = Product::visible()
            ->where('product_id', '!=', $id)
            ->whereHas('themes', function($q) use ($product) {
                if ($product->themes->isNotEmpty()) {
                    $q->where('themes.theme_id', $product->themes->first()->theme_id);
                }
            })
            ->with(['themes'])
            ->limit(3)
            ->get();

        // If not enough related products, get random products
        if ($relatedProducts->count() < 3) {
            $additionalProducts = Product::visible()
                ->where('product_id', '!=', $id)
                ->whereNotIn('product_id', $relatedProducts->pluck('product_id'))
                ->inRandomOrder()
                ->limit(3 - $relatedProducts->count())
                ->get();
            
            $relatedProducts = $relatedProducts->merge($additionalProducts);
        }

        return view('details', compact('product', 'reviews', 'averageRating', 'totalReviews', 'relatedProducts'));
    }
}