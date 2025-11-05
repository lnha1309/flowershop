@extends('layouts.app')
@section('title', 'Trang chủ')
@section('body_class', 'background-color')

@section('content')
 

<div class="home animation">
    <div class="text-center head-title">
        <li class="none">
            <h2 class="mb-0" style="font-family: 'Uncial Antiqua', cursive !important;">Florencia</h2>
        </li>
        <p class="mb-5">Chúng tôi gửi trao yêu thương qua những đóa hoa</p>
        <a href="{{ route('products') }}">Mua sắm ngay !</a>
    </div>
</div>

<!-- Shop Introduction Section -->
<div class="shop-intro ani text-center" style="padding: 40px 0 20px 0;">
    <div class="container">
        <h2>Cửa Hàng Hoa Được Tin Chọn Tại Việt Nam</h2>
        <div class="divider"></div>
        <p class="intro-text">
            Florevance – nơi nghệ thuật cắm hoa hòa quyện cùng cảm xúc và sự tinh tế.
        </p>
        <p class="intro-text">
            Chúng tôi tạo nên những bó hoa mang đậm dấu ấn riêng, tôn vinh vẻ đẹp và cảm xúc trong từng khoảnh khắc.
        </p>
        <p class="intro-tagline">
            Mỗi đóa hoa là một thông điệp, mỗi bó hoa là một kỷ niệm được gửi trao.
        </p>
    </div>
</div>

<!-- Featured & Latest Products Section -->
<div class="featured-section ani background-color" style="padding: 40px 0;">
    <div class="container">
        <div class="tabs-header text-center mb-5">
            <button class="tab-btn active" onclick="switchTab('featured')">SẢN PHẨM NỔI BẬT</button>
            <button class="tab-btn" onclick="switchTab('latest')">SẢN PHẨM MỚI NHẤT</button>
        </div>

        <!-- Featured Products -->
        <div id="featuredProducts" class="products-grid">
            <div class="row justify-content-center">
                <div class="col-md-4 col-sm-12 mb-4">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="images/p1 (2).jpg" alt="Pure White">
                        </div>
                        <div class="product-info">
                            <h3 class="product-name">Pure White</h3>
                            <p class="product-price">$10</p>
                            <a href="#" class="btn-add-cart add-to-cart" data-name="Pure White" data-price="10" data-image="images/p1 (2).jpg">Add to Cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 mb-4">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="images/p1 (3).jpg" alt="Vibarent Charm">
                        </div>
                        <div class="product-info">
                            <h3 class="product-name">Vibarent Charm</h3>
                            <p class="product-price">$12</p>
                            <a href="#" class="btn-add-cart add-to-cart" data-name="Vibarent Charm" data-price="12" data-image="images/p1 (3).jpg">Add to Cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 mb-4">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="images/p1 (4).jpg" alt="Lilly Bloom">
                        </div>
                        <div class="product-info">
                            <h3 class="product-name">Lilly Bloom</h3>
                            <p class="product-price">$15</p>
                            <a href="#" class="btn-add-cart add-to-cart" data-name="Lilly Bloom" data-price="15" data-image="images/p1 (4).jpg">Add to Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Products (hidden by default) -->
        <div id="latestProducts" class="products-grid" style="display: none;">
            <div class="row justify-content-center">
                <div class="col-md-4 col-sm-12 mb-4">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="images/p1 (2).jpg" alt="Pure White">
                        </div>
                        <div class="product-info">
                            <h3 class="product-name">Pure White</h3>
                            <p class="product-price">$10</p>
                            <a href="#" class="btn-add-cart add-to-cart" data-name="Pure White" data-price="10" data-image="images/p1 (2).jpg">Add to Cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 mb-4">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="images/p1 (3).jpg" alt="Vibarent Charm">
                        </div>
                        <div class="product-info">
                            <h3 class="product-name">Vibarent Charm</h3>
                            <p class="product-price">$12</p>
                            <a href="#" class="btn-add-cart add-to-cart" data-name="Vibarent Charm" data-price="12" data-image="images/p1 (3).jpg">Add to Cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 mb-4">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="images/p1 (4).jpg" alt="Lilly Bloom">
                        </div>
                        <div class="product-info">
                            <h3 class="product-name">Lilly Bloom</h3>
                            <p class="product-price">$15</p>
                            <a href="#" class="btn-add-cart add-to-cart" data-name="Lilly Bloom" data-price="15" data-image="images/p1 (4).jpg">Add to Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- About La Rosa Section -->
<div class="about-larosa ani">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5 text-center mb-4 mb-md-0">
                <div class="logo-container">
                    <div style="text-align: center; margin-bottom: 10px;">
                        <img src="https://cdn.pixabay.com/photo/2023/04/24/16/51/bouquet-7948558_1280.jpg"
                            alt="Floverance Vintage Flower"
                            style="width: 400px; height: 400px; object-fit: cover; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                    </div>


                </div>
            </div>
            <div class="col-md-7">
                <h2>Cửa Hàng Hoa Florevance</h2>
                <p style="font-family: 'Alice', serif; color: #666; line-height: 1.8; font-size: 1rem; margin-bottom: 15px;">
                    Florevance là cửa hàng hoa tại Việt Nam, chuyên cung cấp dịch vụ giao hoa tận nơi đến nhiều khu vực trên toàn quốc.
                    Chúng tôi mang đến đa dạng các kiểu dáng hoa – từ hoa chia buồn, hoa chúc mừng, bó hoa cưới, hoa hồng pastel tinh tế, cho đến những thiết kế đặc biệt dành riêng cho từng dịp.
                </p>
                <p style="font-family: 'Alice', serif; color: #666; line-height: 1.8; font-size: 1rem;">
                    Với hơn 20 năm kinh nghiệm trong ngành hoa tươi, Florevance tự hào là một trong những thương hiệu tiên phong tại Việt Nam. Nếu bạn muốn gửi gắm yêu thương đến người thân, Florevance chính là lựa chọn dành cho bạn.
                    Bạn có thể đặt hoa trực tuyến nhanh chóng, hoặc liên hệ trực tiếp với chúng tôi để được tư vấn tận tâm nhất.
                </p>
            </div>
        </div>
    </div>
</div>

<div class="collection ani text-center mt-5">
    <h2>Bộ Sưu Tập Của Chúng Tôi</h2>
    <div class="container">
        <div class="boxex row mt-4 mb-3">
            <div class="image col-sm-12 col-md-4">
                <img src="images/p1 (2).jpg" alt="">
                <div class="text">
                    <h2 class="name">Pure White</h2>
                    <p class="price">10 $</p>
                    <a href="#" class="mb-3 add-to-cart" data-name="Pure White" data-price="10" data-image="images/p1 (2).jpg">Thêm vào Giỏ hàng</a>
                </div>
            </div>
            <div class="image col-sm-12 col-md-4 mb-5 mt-5 m-sm-0">
                <img src="images/p1 (3).jpg" alt="">
                <div class="text">
                    <h2 class="name">Vibarent Charm</h2>
                    <p class="price">12 $</p>
                    <a href="#" class="mb-3 add-to-cart" data-name="Vibarent Charm" data-price="12" data-image="images/p1 (3).jpg">Thêm vào Giỏ hàng</a>
                </div>
            </div>
            <div class="image col-sm-12 col-md-4">
                <img src="images/p1 (4).jpg" alt="">
                <div class="text">
                    <h2 class="name">Lilly Bloom</h2>
                    <p class="price">15 $</p>
                    <a href="#" class="mb-3 add-to-cart" data-name="Lilly Bloom" data-price="15" data-image="images/p1 (4).jpg">Thêm vào Giỏ hàng</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="onsale ani mt-5">
    <div class="text" style="
      text-align: left;
      max-width: 45%;
      margin-left: 20px;
  ">
        <h2 style="font-size: 2rem; margin-bottom: 35px;">Hoa Tươi Giao Mỗi Ngày.</h2>
        <p style="font-size: 20px; line-height: 1.7;">
            Dù là giao tận nơi hay nhận trực tiếp, Floverance luôn mang đến cho bạn những đóa hoa tươi mới và được sắp xếp tinh tế nhất.
            Chúng tôi cung cấp dịch vụ giao hoa trên toàn quốc — đảm bảo mỗi bó hoa đều được gửi đến tay người nhận đúng thời gian, trọn vẹn yêu thương.
            <br>
            Nếu bạn muốn thiết kế một bó hoa đặc biệt theo phong cách riêng, hãy liên hệ với Floverance.
            Chúng tôi luôn sẵn lòng lắng nghe và giúp bạn kết hợp những loài hoa mang trọn cảm xúc bạn muốn gửi gắm.
        </p>
        <a href="{{ route('products') }}">Mua Ngay</a>
    </div>
</div>


<!-- Important Announcement Section -->
<div class="announcement-section ani" style="background-color: #fafafa; padding: 80px 0;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5 text-center mb-4 mb-md-0">
                <div style="border: 3px solid #7a7a7a; padding: 30px; background-color: white; max-width: 400px; margin: 0 auto;">
                    <img src="https://cdn.pixabay.com/photo/2025/10/11/18/41/boho-9888486_1280.jpg"
                        alt="Flower arrangement announcement"
                        width="250"
                        height="300"
                        style="max-width: 250px; border: 1px solid #ccc; border-radius: 12px; object-fit: cover;">

                </div>
            </div>
            <div class="col-md-7">
                <h2 style="font-family: 'Mango Vintage Personal Use Only', sans-serif; color: #2c2c2c; font-size: 2.5rem; margin-bottom: 20px;">
                    Thông Báo<br>Quan Trọng
                </h2>
                <p style="font-family: 'Alice', serif; color: #666; line-height: 1.8; font-size: 1rem;">
                    Từ nay, Floverance sẽ sử dụng 100% khuôn bó hoa chuyên dụng trong tất cả các mẫu hoa.
                    Điều này nhằm đảm bảo độ an toàn và vững chắc cho bó hoa trong quá trình vận chuyển, đồng thời giữ được vẻ tươi mới và chất lượng cao khi giao hoặc nhận tại cửa hàng. Mục tiêu của chúng tôi là mang đến cho bạn những bó hoa được thiết kế tinh tế, luôn ở trạng thái hoàn hảo nhất khi đến tay người nhận.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Payment Options Section -->
<div class="payment-section ani text-center" style="background-color: white; padding: 60px 0;">
    <div class="container">
        <h2 style="font-family: 'Mango Vintage Personal Use Only', sans-serif; color: #2c2c2c; font-size: 2.5rem; margin-bottom: 20px;">Phương Thức Thanh Toán</h2>
        <p style="font-family: 'Alice', serif; color: #666; font-size: 1rem; margin-bottom: 15px;">
            Chúng tôi chấp nhận thanh toán thông qua ví điện tử (như Momo, ZaloPay, ShopeePay), chuyển khoản ngân hàng, và thanh toán khi nhận hàng (COD)
        </p>
        <p style="font-family: 'Alice', serif; color: #666; font-size: 0.95rem; margin-bottom: 30px;">
            Các khoản thanh toán qua ngân hàng có thể được thực hiện tại các ngân hàng đối tác như Vietcombank, VietinBank, BIDV, ACB, hoặc các ngân hàng nội địa khác được hỗ trợ
        </p>
        <p style="font-family: 'Alice', serif; color: #777; font-size: 0.9rem; margin-bottom: 40px; max-width: 900px; margin-left: auto; margin-right: auto;">
        <p>
            Chúng tôi không liên kết, ủy quyền hoặc hợp tác chính thức với bất kỳ cửa hàng hoa hoặc website bán hoa trực tuyến nào khác.
            Website chính thức của Florencia là
            <a href="https://www.florencia.com" style="color: #666; text-decoration: underline;">https://www.florencia.com</a>.
        </p>

        </p>
        <div class="payment-logos" style="display: flex; justify-content: center; align-items: center; gap: 40px; flex-wrap: wrap;">
            <img src="https://images.seeklogo.com/logo-png/48/2/napas-logo-png_seeklogo-480634.png" alt="Napas" style="height: 40px;">
            <img src="https://images.seeklogo.com/logo-png/42/2/momo-logo-png_seeklogo-425716.png" alt="MoMo" style="height: 40px;">
            <img src="https://images.seeklogo.com/logo-png/42/2/vnpay-logo-png_seeklogo-428006.png" alt="VNPAY" style="height: 40px;">
            <img src="https://images.seeklogo.com/logo-png/39/2/zalopay-logo-png_seeklogo-391409.png" alt="ZaloPay" style="height: 40px;">
            <img src="https://images.seeklogo.com/logo-png/28/2/construction-house-logo-png_seeklogo-282950.png" alt="COD" style="height: 40px;">
        </div>
    </div>
</div>

<!-- Blog Posts Section -->
<div class="blog-section ani text-center" style="background-color: #fafafa; padding: 60px 0;">
    <div class="container">
        <p style="font-family: 'Alice', serif; color: #999; font-size: 0.95rem; margin-bottom: 10px;">Khám Phá Thế Giới Hoa Cùng Florencia</p>
        <h2 style="font-family: 'Mango Vintage Personal Use Only', sans-serif; color: #2c2c2c; font-size: 2.5rem; margin-bottom: 15px;">Bài Viết Mới Nhất</h2>
        <div style="width: 100px; height: 2px; background-color: #ccc; margin: 0 auto 50px;"></div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <a href="blog-post-1.html" style="text-decoration: none; color: inherit;">
                    <div class="blog-card" style="background: white; overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                        <img src="https://images.unsplash.com/photo-1490750967868-88aa4486c946?w=500&q=80" alt="Hoa Hồng" style="width: 100%; height: 250px; object-fit: cover;">
                        <div style="padding: 25px; text-align: left;">
                            <h3 style="font-family: 'Mango Vintage Personal Use Only', sans-serif; color: #2c2c2c; font-size: 1.3rem; margin-bottom: 10px;">Bí Quyết Chăm Sóc Hoa Hồng Tươi Lâu</h3>
                            <p style="font-family: 'Alice', serif; color: #999; font-size: 0.9rem; margin-bottom: 15px;">15/10/2025 | Florencia</p>
                            <p style="font-family: 'Alice', serif; color: #666; font-size: 0.95rem; line-height: 1.6;">
                                Khám phá những bí quyết đơn giản nhưng hiệu quả để giữ cho hoa hồng của bạn luôn tươi đẹp và thơm ngát trong nhiều ngày. Từ cách cắt tỉa đến bảo quản nước, mọi chi tiết đều quan trọng.
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="blog-post-2.html" style="text-decoration: none; color: inherit;">
                    <div class="blog-card" style="background: white; overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                        <img src="https://images.unsplash.com/photo-1525310072745-f49212b5ac6d?w=500&q=80" alt="Ý Nghĩa Hoa" style="width: 100%; height: 250px; object-fit: cover;">
                        <div style="padding: 25px; text-align: left;">
                            <h3 style="font-family: 'Mango Vintage Personal Use Only', sans-serif; color: #2c2c2c; font-size: 1.3rem; margin-bottom: 10px;">Ý Nghĩa Màu Sắc Hoa Trong Tình Yêu</h3>
                            <p style="font-family: 'Alice', serif; color: #999; font-size: 0.9rem; margin-bottom: 15px;">12/10/2025 | Florencia</p>
                            <p style="font-family: 'Alice', serif; color: #666; font-size: 0.95rem; line-height: 1.6;">
                                Mỗi màu sắc của hoa đều mang một thông điệp riêng trong tình yêu. Tìm hiểu ý nghĩa của từng loại hoa để chọn món quà hoàn hảo cho người thương yêu của bạn.
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="blog-post-3.html" style="text-decoration: none; color: inherit;">
                    <div class="blog-card" style="background: white; overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                        <img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?w=500&q=80" alt="Cắm Hoa" style="width: 100%; height: 250px; object-fit: cover;">
                        <div style="padding: 25px; text-align: left;">
                            <h3 style="font-family: 'Mango Vintage Personal Use Only', sans-serif; color: #2c2c2c; font-size: 1.3rem; margin-bottom: 10px;">5 Xu Hướng Cắm Hoa Hot Nhất 2025</h3>
                            <p style="font-family: 'Alice', serif; color: #999; font-size: 0.9rem; margin-bottom: 15px;">08/10/2025 | Florencia</p>
                            <p style="font-family: 'Alice', serif; color: #666; font-size: 0.95rem; line-height: 1.6;">
                                Cập nhật ngay 5 xu hướng cắm hoa đang "làm mưa làm gió" trong năm 2025. Từ phong cách tối giản đến nghệ thuật hoa khô, tất cả đều ở đây.
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .blog-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1) !important;
    }
</style>
@push('scripts')
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/checkout/checkout_home.js') }}"></script>
@endpush
@endsection
