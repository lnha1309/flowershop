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
    /* Apply Crimson Pro to products section */
    .products * {
        font-family: 'Crimson Pro', serif !important;
    }
</style>
@endpush

@section('content')
    <!-- Background section -->
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

    <!-- Filter section -->
    <div class="filter-section ani">
        <div class="container">
            <!-- Search bar -->
            <div class="search-box">
                <input type="text" id="searchInput" class="form-control" placeholder="Tìm kiếm theo tên hoa...">
            </div>
            
            <!-- Filters -->
            <div class="row">
                <div class="col-md-2 col-sm-6">
                    <div class="filter-group">
                        <label>Chủ đề</label>
                        <select id="filterTheme">
                            <option value="">Tất cả</option>
                            <option value="romantic">Lãng mạn</option>
                            <option value="elegant">Thanh lịch</option>
                            <option value="cheerful">Vui vẻ</option>
                            <option value="natural">Tự nhiên</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6">
                    <div class="filter-group">
                        <label>Đối tượng</label>
                        <select id="filterRecipient">
                            <option value="">Tất cả</option>
                            <option value="lover">Người yêu</option>
                            <option value="family">Gia đình</option>
                            <option value="friend">Bạn bè</option>
                            <option value="colleague">Đồng nghiệp</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6">
                    <div class="filter-group">
                        <label>Kiểu dáng</label>
                        <select id="filterStyle">
                            <option value="">Tất cả</option>
                            <option value="bouquet">Bó hoa</option>
                            <option value="basket">Giỏ hoa</option>
                            <option value="vase">Bình hoa</option>
                            <option value="box">Hộp hoa</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6">
                    <div class="filter-group">
                        <label>Loại hoa</label>
                        <select id="filterFlowerType">
                            <option value="">Tất cả</option>
                            <option value="rose">Hoa hồng</option>
                            <option value="lily">Hoa lily</option>
                            <option value="gerbera">Hoa đồng tiền</option>
                            <option value="mixed">Hoa hỗn hợp</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6">
                    <div class="filter-group">
                        <label>Dịp lễ</label>
                        <select id="filterOccasion">
                            <option value="">Tất cả</option>
                            <option value="birthday">Sinh nhật</option>
                            <option value="anniversary">Kỷ niệm</option>
                            <option value="wedding">Đám cưới</option>
                            <option value="congratulation">Chúc mừng</option>
                            <option value="apology">Xin lỗi</option>
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

    <!-- Products section -->
    <div class="products ani pt-5">
        <div class="container text-center"></div>
    </div>
@endsection

@push('scripts')
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/checkout/checkout_home.js') }}"></script>
<script src="{{ asset('js/cart.js') }}"></script>
<script src="{{ asset('js/products.js') }}"></script>
@endpush

