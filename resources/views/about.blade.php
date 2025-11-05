@extends('layouts.app')
@section('title', 'About Us - Florencia')

@push('styles')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body.background-color {
        background: #fdfcfa;
        color: #2c2520;
        overflow-x: hidden;
    }

    /* Hero with Image Overlay */
    .hero-cinematic {
        height: 100vh;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #1a1814;
        overflow: hidden;
    }

    .hero-bg {
        position: absolute;
        width: 100%;
        height: 100%;
        background: url('https://images.unsplash.com/photo-1490750967868-88aa4486c946?w=1600&q=80') center/cover;
        filter: grayscale(40%) contrast(1.1);
        opacity: 0.6;
        animation: slowZoom 20s infinite alternate;
    }

    @keyframes slowZoom {
        0% {
            transform: scale(1);
        }

        100% {
            transform: scale(1.1);
        }
    }

    .hero-overlay {
        position: absolute;
        width: 100%;
        height: 100%;
        background: linear-gradient(180deg, rgba(26, 24, 20, 0.4) 0%, rgba(26, 24, 20, 0.7) 100%);
    }

    .hero-text {
        position: relative;
        z-index: 10;
        text-align: center;
        color: #f5f1eb;
    }

    .hero-text h1 {
        font-family: 'Mango Vintage Personal Use Only', sans-serif;
        font-size: clamp(4rem, 12vw, 10rem);
        letter-spacing: -0.02em;
        margin-bottom: 2rem;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    .hero-line {
        width: 80px;
        height: 1px;
        background: #f5f1eb;
        margin: 0 auto 2rem;
        opacity: 0.5;
    }

    .hero-text p {
        font-size: clamp(1rem, 2vw, 1.2rem);
        letter-spacing: 0.25em;
        text-transform: uppercase;
        font-weight: 300;
        opacity: 0.9;
    }

    /* Magazine Style Grid */
    .magazine-section {
        padding: 0;
        background: #fdfcfa;
    }

    .magazine-row {
        display: grid;
        grid-template-columns: 45% 55%;
        min-height: 90vh;
    }

    .magazine-row:nth-child(even) {
        grid-template-columns: 55% 45%;
    }

    .magazine-image {
        position: relative;
        overflow: hidden;
        background: #e8e4dd;
    }

    .magazine-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: sepia(15%) saturate(0.9) contrast(1.05);
        transition: transform 0.6s ease;
    }

    .magazine-image:hover img {
        transform: scale(1.05);
    }

    .image-caption {
        position: absolute;
        bottom: 3rem;
        left: 3rem;
        color: white;
        font-size: 0.75rem;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
    }

    .magazine-content {
        padding: 8rem 6rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;
    }

    .content-number {
        position: absolute;
        top: 3rem;
        left: 6rem;
        font-size: 0.7rem;
        letter-spacing: 0.3em;
        color: #a39a8f;
        text-transform: uppercase;
    }

    .content-label {
        font-size: 0.8rem;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: #a39a8f;
        margin-bottom: 1.5rem;
    }

    .content-title {
        font-family: 'Mango Vintage Personal Use Only', sans-serif;
        font-size: clamp(2.5rem, 4vw, 4.5rem);
        line-height: 1.2;
        color: #2c2520;
        margin-bottom: 2rem;
        font-weight: 300;
    }

    .content-text {
        font-size: clamp(1rem, 1.2vw, 1.15rem);
        line-height: 1.9;
        color: #5a5449;
        margin-bottom: 1.5rem;
        max-width: 500px;
    }

    .content-text:last-child {
        margin-bottom: 0;
    }

    /* Masonry Values Grid */
    .values-masonry {
        padding: 8rem 3rem;
        background: #f5f1eb;
    }

    .values-intro {
        text-align: center;
        max-width: 700px;
        margin: 0 auto 6rem;
    }

    .values-intro h2 {
        font-family: 'Mango Vintage Personal Use Only', sans-serif;
        font-size: clamp(3rem, 6vw, 5rem);
        color: #2c2520;
        margin-bottom: 1.5rem;
        font-weight: 300;
    }

    .values-intro p {
        font-size: 1.1rem;
        color: #5a5449;
        line-height: 1.8;
    }

    .masonry-grid {
        columns: 3;
        column-gap: 2rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    .masonry-item {
        break-inside: avoid;
        margin-bottom: 2rem;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .masonry-item:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(44, 37, 32, 0.12);
    }

    .masonry-item-image {
        width: 100%;
        height: 280px;
        overflow: hidden;
    }

    .masonry-item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: sepia(20%) saturate(0.85) contrast(1.05);
        transition: transform 0.5s ease;
    }

    .masonry-item:hover .masonry-item-image img {
        transform: scale(1.08);
    }

    .masonry-item-content {
        padding: 2.5rem;
    }

    .masonry-item-title {
        font-size: 1.4rem;
        color: #2c2520;
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .masonry-item-text {
        font-size: 0.95rem;
        line-height: 1.7;
        color: #5a5449;
    }

    /* Full Width Quote with Image */
    .quote-banner {
        position: relative;
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: url('https://images.unsplash.com/photo-1455659817273-f96807779a8a?w=1600&q=80') center/cover;
        overflow: hidden;
    }

    .quote-banner::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background: rgba(26, 24, 20, 0.75);
    }

    .quote-wrapper {
        position: relative;
        z-index: 2;
        max-width: 900px;
        padding: 4rem;
        text-align: center;
        color: #f5f1eb;
    }

    .quote-mark {
        font-size: 5rem;
        line-height: 1;
        opacity: 0.3;
        font-family: Georgia, serif;
    }

    .quote-text {
        font-size: clamp(1.8rem, 4vw, 3rem);
        line-height: 1.5;
        font-style: italic;
        margin: 2rem 0;
        font-weight: 300;
    }

    .quote-divider {
        width: 60px;
        height: 1px;
        background: #f5f1eb;
        margin: 2rem auto;
        opacity: 0.4;
    }

    .quote-author {
        font-size: 0.85rem;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        opacity: 0.7;
    }

    /* Timeline/Journey Section */
    .journey-section {
        padding: 8rem 3rem;
        background: white;
    }

    .journey-header {
        text-align: center;
        margin-bottom: 6rem;
    }

    .journey-header h2 {
        font-family: 'Mango Vintage Personal Use Only', sans-serif;
        font-size: clamp(3rem, 6vw, 5rem);
        color: #2c2520;
        margin-bottom: 1rem;
        font-weight: 300;
    }

    .timeline {
        max-width: 1200px;
        margin: 0 auto;
        position: relative;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 0;
        bottom: 0;
        width: 1px;
        background: linear-gradient(180deg, transparent, #d4cfc7, transparent);
    }

    .timeline-item {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        margin-bottom: 6rem;
        position: relative;
    }

    .timeline-item:nth-child(even) .timeline-content {
        order: 2;
    }

    .timeline-item:nth-child(even) .timeline-image {
        order: 1;
    }

    .timeline-dot {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 16px;
        height: 16px;
        background: #2c2520;
        border-radius: 50%;
        border: 4px solid #fdfcfa;
        z-index: 2;
    }

    .timeline-image {
        position: relative;
        height: 400px;
        border-radius: 8px;
        overflow: hidden;
    }

    .timeline-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: sepia(15%) saturate(0.9) contrast(1.05);
    }

    .timeline-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .timeline-year {
        font-size: 0.85rem;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: #a39a8f;
        margin-bottom: 1rem;
    }

    .timeline-title {
        font-size: 2rem;
        color: #2c2520;
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .timeline-text {
        font-size: 1.05rem;
        line-height: 1.8;
        color: #5a5449;
    }

    /* Responsive */
    @media (max-width: 1024px) {

        .magazine-row,
        .magazine-row:nth-child(even) {
            grid-template-columns: 1fr;
        }

        .magazine-content {
            padding: 5rem 3rem;
        }

        .content-number {
            left: 3rem;
        }

        .masonry-grid {
            columns: 2;
        }

        .timeline::before {
            left: 20px;
        }

        .timeline-item {
            grid-template-columns: 1fr;
            padding-left: 60px;
        }

        .timeline-item:nth-child(even) .timeline-content,
        .timeline-item:nth-child(even) .timeline-image {
            order: 0;
        }

        .timeline-dot {
            left: 20px;
        }
    }

    @media (max-width: 640px) {
        .masonry-grid {
            columns: 1;
        }

        .magazine-content {
            padding: 4rem 2rem;
        }

        .content-number {
            left: 2rem;
        }

        .values-masonry,
        .journey-section {
            padding: 5rem 2rem;
        }

        .timeline-item {
            padding-left: 50px;
        }

        .timeline-image {
            height: 280px;
        }
    }
</style>
@endpush

@section('body_class', 'background-color')

@section('content')
<!-- Cinematic Hero -->
<section class="hero-cinematic">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>
    <div class="hero-text">
        <h1 style="font-size: 60px !important; font-weight: 500 !important;">Câu Chuyện Của Chúng Tôi</h1>
        <div class="hero-line"></div>
        <p>Tinh hoa nghệ thuật từ thiên nhiên</p>
    </div>
</section>

<!-- Magazine Layout -->
<section class="magazine-section">
    <div class="magazine-row">
        <div class="magazine-image">
            <img src="https://images.unsplash.com/photo-1487070183336-b863922373d4?w=1200&q=80" alt="Orchid">
            <div class="image-caption">Philosophy</div>
        </div>
        <div class="magazine-content">
            <div class="content-number">01 / 04</div>
            <div class="content-label">Nguồn gốc</div>
            <h2 class="content-title">Nơi vẻ đẹp gặp gỡ sự tinh tế</h2>
            <p class="content-text">Florencia được khơi nguồn từ ước mơ tái định nghĩa những gì một bông hoa có thể truyền tải — không chỉ là trang trí, mà là ngôn ngữ của nghệ thuật, cảm xúc và ký ức.</p>
            <p class="content-text">Chúng tôi kiến tạo những tác phẩm sống, nơi từng cánh hoa kể một câu chuyện, lưu giữ vẻ đẹp và ý nghĩa vượt thời gian.</p>
        </div>
    </div>

    <div class="magazine-row">
        <div class="magazine-content">
            <div class="content-number">02 / 04</div>
            <div class="content-label">Phương châm</div>
            <h2 class="content-title">Hành trình đi tìm sự hoàn hảo</h2>
            <p class="content-text">Mỗi bông hoa được đưa vào cửa hàng đều là kết tinh của sự chọn lựa kỹ lưỡng và tâm huyết. Chúng tôi đề cao sự tinh giản hơn dư thừa, trân quý giá trị hơn số lượng, và tôn vinh nét đẹp vượt thời gian thay vì chạy theo xu hướng.</p>
            <p class="content-text">Qua năm tháng, chúng tôi đã xây dựng mối gắn kết bền chặt với những người trồng hoa – cùng chia sẻ niềm tin vào sự bền vững, tay nghề tinh xảo và đam mê chân thành với nghệ thuật thực vật.</p>
        </div>
        <div class="magazine-image">
            <img src="https://images.unsplash.com/photo-1520763185298-1b434c919102?w=1200&q=80" alt="Flowers">
            <div class="image-caption">Craftsmanship</div>
        </div>
    </div>

    <div class="magazine-row">
        <div class="magazine-image">
            <img src="https://cdn.pixabay.com/photo/2018/04/21/20/23/tulips-3339416_1280.jpg" alt="Garden">
            <div class="image-caption">Sustainability</div>
        </div>
        <div class="magazine-content">
            <div class="content-number">03 / 04</div>
            <div class="content-label">Giá trị cốt lõi</div>
            <h2 class="content-title">Từ trách nhiệm, nuôi dưỡng bền vững.</h2>
            <p class="content-text">Sự bền vững không phải điều chúng tôi chạy theo — mà là điều chúng tôi sống cùng mỗi ngày. Từng vật liệu, từng quy trình đều hướng đến việc giảm thiểu tác động lên môi trường, để thiên nhiên vẫn nguyên vẹn như nguồn cảm hứng ban đầu.</p>
            <p class="content-text">Chúng tôi đồng hành cùng những nông trại tôn trọng đạo đức và sự cân bằng, bởi vẻ đẹp thật sự chỉ có ý nghĩa khi nó không làm tổn thương Trái Đất.</p>
        </div>
    </div>

    <div class="magazine-row">
        <div class="magazine-content">
            <div class="content-number">04 / 04</div>
            <div class="content-label">Sứ mệnh</div>
            <h2 class="content-title">Kiến tạo những khoảnh khắc đáng lưu giữ</h2>
            <p class="content-text">Chúng tôi mong muốn đưa con người trở lại gần hơn với thiên nhiên – nơi cái đẹp được cảm nhận bằng sự tĩnh lặng, bằng trái tim, và được lưu giữ trong ký ức.</p>
            <p class="content-text">Mỗi bó hoa là một lời cam kết về sự tinh tế, tươi mới và yêu thương – những giá trị vượt khỏi giới hạn của một món quà.</p>
        </div>
        <div class="magazine-image">
            <img src="https://images.unsplash.com/photo-1459156212016-c812468e2115?w=1200&q=80" alt="Bouquet">
            <div class="image-caption">Excellence</div>
        </div>
    </div>
</section>

<!-- Values Masonry -->
<section class="values-masonry">
    <div class="values-intro">
        <h2>Điều Làm Nên Bản Sắc Của Chúng Tôi</h2>
        <p>Sáu giá trị cốt lõi dẫn lối cho từng cánh hoa, từng nhành lá, và từng tác phẩm mà chúng tôi tạo ra.</p>
    </div>
    <div class="masonry-grid">
        <div class="masonry-item">
            <div class="masonry-item-image"><img src="https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=800&q=80" alt="Nature"></div>
            <div class="masonry-item-content">
                <h3 class="masonry-item-title">Nguồn gốc được chọn lựa có chủ đích</h3>
                <p class="masonry-item-text">Chúng tôi hợp tác trực tiếp với những nông trại bền vững – nơi con người và thiên nhiên cùng tồn tại hài hòa, cùng sẻ chia niềm đam mê gìn giữ môi trường và nuôi dưỡng vẻ đẹp thuần khiết.</p>
            </div>
        </div>
        <div class="masonry-item">
            <div class="masonry-item-image"><img src="https://images.unsplash.com/photo-1462275646964-a0e3386b89fa?w=800&q=80" alt="Quality"></div>
            <div class="masonry-item-content">
                <h3 class="masonry-item-title">Hoàn hảo không thỏa hiệp</h3>
                <p class="masonry-item-text">Mỗi đóa hoa đều trải qua quy trình chọn lọc nghiêm ngặt. Nếu chưa đạt đến chuẩn mực của chúng tôi – dù chỉ một chút – nó sẽ không bao giờ rời khỏi xưởng.</p>
            </div>
        </div>
        <div class="masonry-item">
            <div class="masonry-item-image"><img src="https://images.unsplash.com/photo-1481833761820-0509d3217039?w=800&q=80" alt="Design"></div>
            <div class="masonry-item-content">
                <h3 class="masonry-item-title">Vẻ đẹp vượt thời gian</h3>
                <p class="masonry-item-text">Chúng tôi không chạy theo trào lưu. Mỗi thiết kế được tạo nên với sự thanh lịch bền vững – vừa mang hơi thở hiện đại, vừa mang dáng dấp của sự vĩnh cửu.</p>
            </div>
        </div>
        <div class="masonry-item">
            <div class="masonry-item-image"><img src="https://cdn.pixabay.com/photo/2022/07/11/10/21/roses-7314623_1280.jpg" alt="Care"></div>
            <div class="masonry-item-content">
                <h3 class="masonry-item-title">Trải nghiệm được cá nhân hóa</h3>
                <p class="masonry-item-text">Đội ngũ chuyên gia thực vật của chúng tôi luôn lắng nghe, thấu hiểu, và đồng hành để mỗi lần bạn ghé Florencia là một hành trình sáng tạo nên điều ý nghĩa.</p>
            </div>
        </div>
        <div class="masonry-item">
            <div class="masonry-item-image"><img src="https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?w=800&q=80" alt="Earth"></div>
            <div class="masonry-item-content">
                <h3 class="masonry-item-title">Thực hành bền vững</h3>
                <p class="masonry-item-text">Từ quy trình không rác thải, bao bì phân hủy sinh học đến giao hàng giảm phát thải – mọi lựa chọn đều hướng đến việc giảm thiểu dấu chân môi trường.</p>
            </div>
        </div>
        <div class="masonry-item">
            <div class="masonry-item-image"><img src="https://cdn.pixabay.com/photo/2021/07/09/06/57/lavender-6398425_1280.jpg" alt="Community"></div>
            <div class="masonry-item-content">
                <h3 class="masonry-item-title">Đặt con người lên trên hết</h3>
                <p class="masonry-item-text">Chúng tôi đồng hành cùng nghệ nhân, người trồng và nhà sáng tạo địa phương – bởi khi cộng đồng phát triển, vẻ đẹp tự nhiên mới thật sự bền vững và dồi dào.</p>
            </div>
        </div>
    </div>
</section>

<!-- Quote Banner -->
<section class="quote-banner">
    <div class="quote-wrapper">
        <div class="quote-mark">"</div>
        <p class="quote-text">Giữa thế giới dư thừa, ta chọn tinh tế. Giữa nhịp sống vội vàng, ta chọn an nhiên. Trong từng tác phẩm, ta chọn vẻ đẹp vĩnh cửu.</p>
        <div class="quote-divider"></div>
        <p class="quote-author">— The Florencia Philosophy</p>
    </div>
</section>

<!-- Journey Timeline -->
<section class="journey-section">
    <div class="journey-header">
        <h2>Hành Trình Của Chúng Tôi</h2>
    </div>
    <div class="timeline">
        <div class="timeline-item">
            <div class="timeline-image"><img src="https://cdn.pixabay.com/photo/2017/06/15/04/17/spring-young-leaves-2404083_1280.jpg" alt="Beginning"></div>
            <div class="timeline-content">
                <div class="timeline-year">2020</div>
                <h3 class="timeline-title">Sự bắt đầu</h3>
                <p class="timeline-text">Được khai sinh với khát vọng nâng tầm nghệ thuật thiết kế thực vật. Từ một dự án cá nhân đầy đam mê, Florencia nhanh chóng nở rộ thành một hành trình mang ý nghĩa sâu sắc hơn – hành trình chạm đến cảm xúc qua từng đóa hoa.</p>
            </div>
            <div class="timeline-dot"></div>
        </div>
        <div class="timeline-item">
            <div class="timeline-image"><img src="https://images.unsplash.com/photo-1518895949257-7621c3c786d7?w=800&q=80" alt="Growth"></div>
            <div class="timeline-content">
                <div class="timeline-year">2021</div>
                <h3 class="timeline-title">Xây dựng mối liên kết</h3>
                <p class="timeline-text">Chúng tôi thiết lập quan hệ hợp tác với mười lăm trang trại địa phương bền vững, hình thành nên một mạng lưới những người trồng hoa tận tâm – cùng chung niềm tin và giá trị.</p>
            </div>
            <div class="timeline-dot"></div>
        </div>
        <div class="timeline-item">
            <div class="timeline-image"><img src="https://cdn.pixabay.com/photo/2021/03/11/06/57/flower-6086288_1280.jpg" alt="Excellence"></div>
            <div class="timeline-content">
                <div class="timeline-year">2023</div>
                <h3 class="timeline-title">Vươn tới sự hoàn hảo</h3>
                <p class="timeline-text">Đạt được 100% nguồn cung ứng bền vững và khởi động sáng kiến bao bì không rác thải – đặt ra tiêu chuẩn mới cho toàn ngành nghệ thuật hoa.</p>
            </div>
            <div class="timeline-dot"></div>
        </div>
        <div class="timeline-item">
            <div class="timeline-image"><img src="https://cdn.pixabay.com/photo/2016/05/28/05/37/sunflower-1421011_1280.jpg" alt="Future"></div>
            <div class="timeline-content">
                <div class="timeline-year">Hiện tại</div>
                <h3 class="timeline-title">Hướng về phía trước</h3>
                <p class="timeline-text">Không ngừng trau chuốt tay nghề và mở rộng ảnh hưởng – từng bước một, qua mỗi tác phẩm được tuyển chọn và gửi gắm tâm huyết.</p>
            </div>
            <div class="timeline-dot"></div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('js/main.js') }}"></script>
@endpush