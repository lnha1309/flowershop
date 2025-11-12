@extends('layouts.app')
@section('title', 'Products')
@section('body_class', 'background-color')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:wght@300;400;600&family=Uncial+Antiqua&display=swap" rel="stylesheet">
<style>
    .filter-section {
        background-color: #f8f9fa;
        padding: 30px 0;
        margin-bottom: 30px;
    }
    .search-box {
        max-width: 600px;
        margin: 0 auto 30px;
    }
    .search-box input {
        border: 2px solid #ddd;
        padding: 12px 20px;
        border-radius: 25px;
        font-family: 'Crimson Pro', serif;
        transition: all 0.3s ease;
    }
    .search-box input:focus {
        outline: none;
        border-color: #8b7355;
        box-shadow: 0 0 10px rgba(139, 115, 85, 0.2);
    }
    .filter-group {
        margin-bottom: 20px;
    }
    .filter-group label {
        font-family: 'Crimson Pro', serif;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 10px;
        display: block;
    }
    .filter-group select {
        width: 100%;
        padding: 10px 15px;
        border: 2px solid #ddd;
        border-radius: 8px;
        font-family: 'Crimson Pro', serif;
        background-color: white;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .filter-group select:focus {
        outline: none;
        border-color: #8b7355;
    }
    .filter-group select:hover {
        border-color: #8b7355;
    }
    .reset-btn {
        background-color: #3f515d;
        color: white;
        border: none;
        padding: 10px 30px;
        border-radius: 25px;
        font-family: 'Crimson Pro', serif;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 10px;
    }
    .reset-btn:hover {
        background-color: #2d3d47;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .no-results {
        text-align: center;
        padding: 50px 0;
        font-family: 'Crimson Pro', serif;
        color: #666;
        font-size: 18px;
    }
    
    .products * {
        font-family: 'Crimson Pro', serif !important;
    }
    
    .products .name {
        font-size: 25px !important;
        line-height: 1.3;
        margin-bottom: 5px;
    }

    .products .image {
        height: 370px;
        overflow: hidden;
    }

    .products .image .img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
@endpush

@section('content')
    <div class="background animation">
        <h1 class="head text-start" style="text-align: left !important;">
            <span style="font-family: 'Crimson Pro', serif !important; font-weight: 400 !important; font-size: 64px !important; letter-spacing: 6px !important;">
                Bộ Sưu Tập
            </span><br>
            <span style="font-family: 'Crimson Pro', serif !important; font-weight: 400 !important; font-size: 48px !important;">
                của
            </span>
            <span style="font-family: 'Uncial Antiqua', cursive !important; font-weight: 400 !important; font-size: 48px !important;">
                Florencia
            </span>
        </h1>
    </div>

    <div class="filter-section ani">
        <div class="container">
            <div class="search-box">
                <input type="text" id="searchInput" class="form-control" placeholder="Tìm kiếm theo tên hoa...">
            </div>
            
            <div class="row">
                <div class="col-md-2 col-sm-6">
                    <div class="filter-group">
                        <label>Chủ đề</label>
                        <select id="filterTheme">
                            <option value="">Tất cả</option>
                            <option value="Lãng mạn">Lãng mạn</option>
                            <option value="Thanh lịch">Thanh lịch</option>
                            <option value="Tối giản">Tối giản</option>
                            <option value="Vui vẻ">Vui vẻ</option>
                            <option value="Tự nhiên">Tự nhiên</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6">
                    <div class="filter-group">
                        <label>Đối tượng</label>
                        <select id="filterRecipient">
                            <option value="">Tất cả</option>
                            <option value="Người yêu">Người yêu</option>
                            <option value="Gia đình">Gia đình</option>
                            <option value="Bạn bè">Bạn bè</option>
                            <option value="Đồng nghiệp">Đồng nghiệp</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6">
                    <div class="filter-group">
                        <label>Kiểu dáng</label>
                        <select id="filterStyle">
                            <option value="">Tất cả</option>
                            <option value="Bó hoa">Bó hoa</option>
                            <option value="Hộp hoa">Hộp hoa</option>
                            <option value="Chậu hoa">Chậu hoa</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6">
                    <div class="filter-group">
                        <label>Loại hoa</label>
                        <select id="filterFlowerType">
                            <option value="">Tất cả</option>
                            <option value="Hoa hồng">Hoa hồng</option>
                            <option value="Cẩm tú cầu">Cẩm tú cầu</option>
                            <option value="Lan hồ điệp">Lan hồ điệp</option>
                            <option value="Thược dược">Thược dược</option>
                            <option value="Cát tường">Cát tường</option>
                            <option value="Hoa lily">Hoa lily</option>
                            <option value="Astilbe">Astilbe</option>
                            <option value="Mẫu đơn">Mẫu đơn</option>
                            <option value="Hoa dại">Hoa dại</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6">
                    <div class="filter-group">
                        <label>Dịp lễ</label>
                        <select id="filterOccasion">
                            <option value="">Tất cả</option>
                            <option value="Sinh nhật">Sinh nhật</option>
                            <option value="Kỉ niệm">Kỉ niệm</option>
                            <option value="Đám cưới">Đám cưới</option>
                            <option value="Chúc mừng">Chúc mừng</option>
                            <option value="Khác">Khác</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6">
                    <div class="filter-group">
                        <label>&nbsp;</label>
                        <button class="reset-btn w-100" onclick="resetFilters()">Đặt lại</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="products ani pt-5">
        <div class="container text-center"></div>
    </div>

    <!-- Pagination với inline style -->
    <div class="container mt-4 mb-5">
        <div class="d-flex justify-content-center align-items-center" style="gap: 15px;">
            @if ($products->onFirstPage())
                <span style="color: #ccc; font-family: 'Crimson Pro', serif; font-size: 16px; padding: 8px 16px; border: 2px solid #ddd; border-radius: 8px; background-color: #f8f9fa;">‹ Trước</span>
            @else
                <a href="{{ $products->previousPageUrl() }}" style="color: #8b7355; font-family: 'Crimson Pro', serif; font-size: 16px; padding: 8px 16px; border: 2px solid #ddd; border-radius: 8px; background-color: white; text-decoration: none;">‹ Trước</a>
            @endif

            <span style="color: #2c3e50; font-family: 'Crimson Pro', serif; font-size: 16px; font-weight: 600;">
                Trang {{ $products->currentPage() }} / {{ $products->lastPage() }}
            </span>

            @if ($products->hasMorePages())
                <a href="{{ $products->nextPageUrl() }}" style="color: #8b7355; font-family: 'Crimson Pro', serif; font-size: 16px; padding: 8px 16px; border: 2px solid #ddd; border-radius: 8px; background-color: white; text-decoration: none;">Sau ›</a>
            @else 
                <span style="color: #ccc; font-family: 'Crimson Pro', serif; font-size: 16px; padding: 8px 16px; border: 2px solid #ddd; border-radius: 8px; background-color: #f8f9fa;">Sau ›</span>
            @endif
        </div>
    </div>

    <script>
        window.productsData = @json($products->items());
        console.log('Raw products data:', window.productsData);
        console.log('First product:', window.productsData[0]);
        console.log('Has theme?', window.productsData[0]?.theme);
        console.log('Has flower_type?', window.productsData[0]?.flower_type);
    </script>
@endsection

@push('scripts')
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/checkout/checkout_home.js') }}"></script>
<script src="{{ asset('js/cart.js') }}"></script>
<script src="{{ asset('js/products.js') }}"></script>
@endpush
