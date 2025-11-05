@extends('layouts.app')
@section('title', 'Product Details - Florencia')
@section('body_class', 'background-color')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:ital,wght@0,300;0,400;0,600;0,700;1,400;1,700&display=swap" rel="stylesheet">
<style>
  /* Toàn trang mặc định Crimson Pro */
  body {
    font-family: 'Crimson Pro', serif !important;
  }

  /* Giữ font cho header/nav và footer */
  nav,
  nav a,
  nav h2,
  footer,
  footer a,
  footer h3,
  footer li,
  footer ul {
    font-family: 'Alice', serif !important;
  }

  /* Tiêu đề thương hiệu và các heading trang trí dùng Mango */
  nav h2,
  .section-title,
  .product-title {
    font-family: 'Mango Vintage Personal Use Only', cursive !important;
  }

  /* Khu vực nội dung chính (có thể bọc thêm <main>) */
  main {
    font-family: 'Crimson Pro', serif !important;
  }

  .product-detail-section {
    padding: 60px 0;
  }

  .product-image {
    width: 100%;
    height: 500px;
    object-fit: cover;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
  }

  .product-info {
    padding: 20px;
  }

  .product-title {
    font-size: 2.5rem;
    margin-bottom: 20px;
    color: #2c3e50;
  }

  .product-price {
    font-size: 2rem;
    color: #8b7355;
    font-weight: bold;
    margin-bottom: 30px;
  }

  .product-description {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #555;
    margin-bottom: 30px;
  }

  .product-attributes {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 30px;
  }

  .attribute-badge {
    background: #f0ebe5;
    color: #8b7355;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.9rem;
    border: 1px solid #d4c9bb;
  }

  .attribute-badge i {
    margin-right: 5px;
  }

  .quantity-selector {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 30px;
  }

  .quantity-btn {
    width: 40px;
    height: 40px;
    border: 2px solid #8b7355;
    background: #fff;
    color: #8b7355;
    font-size: 1.2rem;
    cursor: pointer;
    border-radius: 5px;
    transition: all 0.3s;
  }

  .quantity-btn:hover {
    background: #8b7355;
    color: #fff;
  }

  .quantity-input {
    width: 60px;
    height: 40px;
    text-align: center;
    border: 2px solid #ddd;
    border-radius: 5px;
    font-size: 1.1rem;
    background: #fff;
    color: #2c3e50;
  }

  .action-buttons {
    display: flex;
    align-items: center;
    gap: 15px;
  }

  .add-to-cart-btn {
    background: #8b7355;
    color: #fff;
    padding: 15px 40px;
    border: none;
    border-radius: 5px;
    font-size: 1.1rem;
    cursor: pointer;
    transition: all 0.3s;
    font-family: 'Crimson Pro', serif !important;
  }

  .add-to-cart-btn:hover {
    background: #6d5a44;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
  }

  .wishlist-btn {
    position: relative;
    width: 50px;
    height: 50px;
    background: #fff;
    border: 2px solid #8b7355;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    justify-content: center;
  }

  .wishlist-btn:hover {
    background: #fff5f5;
    transform: scale(1.1);
  }

  .wishlist-btn.active {
    background: #8b7355;
    border-color: #8b7355;
  }

  .wishlist-btn i {
    font-size: 1.5rem;
    color: #8b7355;
    transition: all 0.3s;
  }

  .wishlist-btn.active i {
    color: #fff;
  }

  .wishlist-btn:active {
    transform: scale(0.95);
  }

  .rating-section {
    margin: 40px 0;
    padding: 30px;
    background: #f9f9f9;
    border-radius: 10px;
  }

  .stars {
    color: #ffd700;
    font-size: 1.5rem;
    margin-bottom: 15px;
  }

  .rating-text {
    color: #666;
  }

  .reviews {
    margin-top: 30px;
  }

  .review-item {
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    margin-bottom: 15px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
  }

  .review-author {
    font-weight: bold;
    color: #2c3e50;
    margin-bottom: 8px;
  }

  .review-stars {
    color: #ffd700;
    font-size: 1rem;
    margin-bottom: 10px;
  }

  .review-text {
    color: #555;
    line-height: 1.6;
  }

  .related-products {
    padding: 60px 0;
    background: #f9f9f9;
  }

  .section-title {
    font-size: 2.5rem;
    text-align: center;
    margin-bottom: 50px;
    color: #2c3e50;
  }

  .related-product-card {
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s;
    margin-bottom: 30px;
  }

  .related-product-card:hover {
    transform: translateY(-5px);
  }

  .related-product-image {
    width: 100%;
    height: 300px;
    object-fit: cover;
  }

  .related-product-info {
    padding: 20px;
    text-align: center;
  }

  .related-product-name {
    font-family: 'Mango Vintage Personal Use Only', cursive !important;
    font-size: 1.5rem;
    margin-bottom: 10px;
    color: #2c3e50;
  }

  .related-product-price {
    font-size: 1.3rem;
    color: #8b7355;
    font-weight: bold;
    margin-bottom: 15px;
  }

  .view-btn {
    background: #fff;
    color: #8b7355;
    border: 2px solid #8b7355;
    padding: 10px 30px;
    border-radius: 5px;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s;
    font-family: 'Crimson Pro', serif !important;
  }

  .view-btn:hover {
    background: #8b7355;
    color: #fff;
  }

  .product-details-list {
    list-style: none;
    padding: 0;
    margin: 30px 0;
  }

  .product-details-list li {
    padding: 10px 0;
    border-bottom: 1px solid #eee;
    color: #555;
  }

  .product-details-list li:last-child {
    border-bottom: none;
  }

  .product-details-list strong {
    color: #2c3e50;
    margin-right: 10px;
  }

  /* Nhãn số lượng */
  .qty-label {
    font-size: 1.1rem;
    color: #2c3e50;
  }
</style>
@endpush

@section('content')
<!-- Start Product Detail Section -->
<div class="product-detail-section animation">
  <div class="container">
    <div class="row">
      <!-- Product Image -->
      <div class="col-lg-6 mb-4">
        <img src="images/p1 (1).jpg" alt="Blue Dream" class="product-image" id="productImage">
      </div>

      <!-- Product Information -->
      <div class="col-lg-6">
        <div class="product-info">
          <h1 class="product-title" id="productName">Blue Dream</h1>
          <p class="product-price" id="productPrice">10 $</p>

          <!-- Product Attributes Badges -->
          <div class="product-attributes" id="productAttributes"><!-- dynamic --></div>

          <p class="product-description" id="productDescription">
          </p>

          <ul class="product-details-list" id="productDetailsList">
            <li><strong>Flowers:</strong> Blue Delphiniums, White Roses, Eucalyptus</li>
            <li><strong>Size:</strong> Medium (30-35 cm)</li>
            <li><strong>Wrapping:</strong> Premium white paper with ribbon</li>
            <li><strong>Care:</strong> Change water daily, keep in cool place</li>
          </ul>

          <div class="quantity-selector">
            <label class="qty-label">Quantity:</label>
            <button class="quantity-btn" onclick="decreaseQuantity()">-</button>
            <input type="number" class="quantity-input" id="quantity" value="1" min="1" readonly>
            <button class="quantity-btn" onclick="increaseQuantity()">+</button>
          </div>

          <div class="action-buttons">
            <button class="add-to-cart-btn" onclick="addToCart()">Add to Cart</button>
            <button class="wishlist-btn" id="wishlistBtn" onclick="toggleWishlist()">
              <i class="fa-regular fa-heart" id="wishlistIcon"></i>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Rating and Reviews Section -->
    <div class="row mt-5">
      <div class="col-12">
        <div class="rating-section">
          <h3 style="font-family: 'Mango Vintage Personal Use Only', cursive; margin-bottom: 20px;">Customer Reviews</h3>
          <div class="stars">★★★★★</div>
          <p class="rating-text">4.8 out of 5 stars (24 reviews)</p>

          <div class="reviews">
            <div class="review-item">
              <div class="review-author">Sarah Johnson</div>
              <div class="review-stars">★★★★★</div>
              <p class="review-text">
                Absolutely beautiful bouquet! The blue flowers were so vibrant and fresh.
                The arrangement arrived perfectly packaged and lasted over a week. Highly recommend!
              </p>
            </div>

            <div class="review-item">
              <div class="review-author">Michael Chen</div>
              <div class="review-stars">★★★★★</div>
              <p class="review-text">
                Ordered this for my wife's birthday and she loved it! The color combination
                is stunning and the quality exceeded my expectations. Will definitely order again.
              </p>
            </div>

            <div class="review-item">
              <div class="review-author">Emma Davis</div>
              <div class="review-stars">★★★★☆</div>
              <p class="review-text">
                Very pretty arrangement. The flowers were fresh and the presentation was elegant.
                Only giving 4 stars because I wished there were more blue flowers, but overall very satisfied.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<!-- End Product Detail Section -->

<!-- Start Related Products Section -->
<div class="related-products ani">
  <div class="container">
    <h2 class="section-title">Related Products</h2>
    <div class="row" id="relatedProductsContainer"><!-- dynamic --></div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  const imageBase = "{{ asset('images') }}";
  const products = {
    1: {
      name: 'Blue Dream',
      price: '10 $',
      image: `${imageBase}/p1 (1).jpg`,
      description: 'Blue Dream is an elegant arrangement featuring soft blue and pristine white flowers. This dreamy bouquet combines delicate blue delphiniums with white roses and seasonal greenery, creating a serene and sophisticated display. Perfect for expressing calm emotions, celebrating new beginnings, or bringing a touch of tranquility to any space.',
      attributes: {
        theme: 'Thanh lịch',
        recipient: 'Người yêu',
        style: 'Bó hoa',
        flowerType: 'Hoa hỗn hợp',
        occasion: 'Kỷ niệm'
      },
      details: {
        flowers: 'Blue Delphiniums, White Roses, Eucalyptus',
        size: 'Medium (30-35 cm)',
        wrapping: 'Premium white paper with ribbon',
        care: 'Change water daily, keep in cool place'
      }
    },
    2: {
      name: 'Pure White',
      price: '12 $',
      image: `${imageBase}/p1 (2).jpg`,
      description: 'Pure White embodies timeless elegance with its stunning collection of pristine white blooms. This sophisticated arrangement features premium white roses and carnations, accented with delicate baby\'s breath. Perfect for weddings, sympathy arrangements, or any occasion that calls for classic beauty and grace.',
      attributes: {
        theme: 'Thanh lịch',
        recipient: 'Gia đình',
        style: 'Bó hoa',
        flowerType: 'Hoa hỗn hợp',
        occasion: 'Đám cưới'
      },
      details: {
        flowers: 'White Roses, White Carnations, Baby\'s Breath',
        size: 'Large (35-40 cm)',
        wrapping: 'Sage green paper with natural twine',
        care: 'Trim stems at an angle, change water every 2 days'
      }
    },
    3: {
      name: 'Vibarent Charm',
      price: '11 $',
      image: `${imageBase}/p1 (3).jpg`,
      description: 'Vibarent Charm captivates with its warm and inviting color palette. Featuring cream roses paired with peach lilies and blush accents, this arrangement radiates warmth and appreciation. Ideal for expressing gratitude, celebrating achievements, or brightening someone\'s day with its cheerful presence.',
      attributes: {
        theme: 'Lãng mạn',
        recipient: 'Người yêu',
        style: 'Bó hoa',
        flowerType: 'Hoa hồng',
        occasion: 'Sinh nhật'
      },
      details: {
        flowers: 'Cream Roses, Peach Lilies, Blush Accents',
        size: 'Medium (30-35 cm)',
        wrapping: 'Kraft paper with ribbon',
        care: 'Keep away from direct sunlight, change water daily'
      }
    },
    4: {
      name: 'Lilly Bloom',
      price: '14 $',
      image: `${imageBase}/p1 (4).jpg`,
      description: 'Lilly Bloom showcases the natural beauty of premium white lilies complemented by pink carnations and lush foliage. This elegant arrangement combines sophistication with romance, making it perfect for special celebrations, anniversaries, or expressing deep admiration and love.',
      attributes: {
        theme: 'Thanh lịch',
        recipient: 'Bạn bè',
        style: 'Bó hoa',
        flowerType: 'Hoa lily',
        occasion: 'Chúc mừng'
      },
      details: {
        flowers: 'White Lilies, Pink Carnations, Premium Foliage',
        size: 'Large (35-40 cm)',
        wrapping: 'Charcoal paper with silk ribbon',
        care: 'Remove lily pollen carefully, keep in cool location'
      }
    },
    5: {
      name: 'Joyful Bouquet',
      price: '18 $',
      image: `${imageBase}/p1 (5).jpg`,
      description: 'Joyful Bouquet brings happiness with its vibrant and cheerful flowers. This colorful arrangement features a delightful mix of seasonal blooms that create an explosion of joy and celebration. Perfect for birthdays, congratulations, or any occasion that calls for pure happiness.',
      attributes: {
        theme: 'Vui vẻ',
        recipient: 'Bạn bè',
        style: 'Bó hoa',
        flowerType: 'Hoa hỗn hợp',
        occasion: 'Sinh nhật'
      },
      details: {
        flowers: 'Mixed Seasonal Flowers',
        size: 'Large (35-40 cm)',
        wrapping: 'Colorful wrapping paper',
        care: 'Change water daily, trim stems regularly'
      }
    },
    6: {
      name: 'Pink Gerbera',
      price: '13 $',
      image: `${imageBase}/p1 (6).jpg`,
      description: 'Pink Gerbera features beautiful pink gerbera daisies that radiate warmth and positivity. These cheerful blooms are known for their vibrant color and long-lasting beauty. Perfect for expressing gratitude, celebrating friendships, or simply brightening someone\'s day.',
      attributes: {
        theme: 'Vui vẻ',
        recipient: 'Bạn bè',
        style: 'Bình hoa',
        flowerType: 'Hoa đồng tiền',
        occasion: 'Chúc mừng'
      },
      details: {
        flowers: 'Pink Gerbera Daisies',
        size: 'Medium (30-35 cm)',
        wrapping: 'Pink paper with ribbon',
        care: 'Keep in cool place, change water daily'
      }
    },
    7: {
      name: 'Sweet Spring',
      price: '16 $',
      image: `${imageBase}/p1 (7).jpg`,
      description: 'Sweet Spring captures the essence of springtime beauty with its delicate mix of pastel blooms. This charming arrangement brings the freshness of spring into any space, featuring soft colors and graceful flowers that evoke feelings of renewal and hope.',
      attributes: {
        theme: 'Tự nhiên',
        recipient: 'Gia đình',
        style: 'Giỏ hoa',
        flowerType: 'Hoa hỗn hợp',
        occasion: 'Sinh nhật'
      },
      details: {
        flowers: 'Spring Mixed Flowers',
        size: 'Large (35-40 cm)',
        wrapping: 'Pastel paper with ribbon',
        care: 'Keep away from direct sunlight'
      }
    },
    8: {
      name: 'Classic Charm',
      price: '19 $',
      image: `${imageBase}/p1 (8).jpg`,
      description: 'Classic Charm offers timeless elegance and sophistication with premium roses and lilies. This luxurious arrangement represents the pinnacle of floral artistry, perfect for weddings, anniversaries, or any occasion that demands nothing less than perfection.',
      attributes: {
        theme: 'Lãng mạn',
        recipient: 'Người yêu',
        style: 'Bó hoa',
        flowerType: 'Hoa hồng',
        occasion: 'Kỷ niệm'
      },
      details: {
        flowers: 'Premium Roses and Lilies',
        size: 'Large (35-40 cm)',
        wrapping: 'Elegant paper with silk ribbon',
        care: 'Trim stems at angle, change water every 2 days'
      }
    },
    9: {
      name: 'Garden Party',
      price: '15 $',
      image: `${imageBase}/p1 (9).jpg`,
      description: 'Garden Party brings the beauty of a garden to your home with its natural and organic arrangement. Featuring a variety of garden-fresh flowers, this bouquet captures the casual elegance and charm of a beautiful garden in full bloom.',
      attributes: {
        theme: 'Tự nhiên',
        recipient: 'Bạn bè',
        style: 'Giỏ hoa',
        flowerType: 'Hoa hỗn hợp',
        occasion: 'Chúc mừng'
      },
      details: {
        flowers: 'Garden Mixed Flowers',
        size: 'Medium (30-35 cm)',
        wrapping: 'Natural paper with twine',
        care: 'Change water daily, keep in cool place'
      }
    },
    10: {
      name: 'Heart Warming',
      price: '9 $',
      image: `${imageBase}/p1 (10).jpg`,
      description: 'Heart Warming expresses warm feelings and affection with its beautiful combination of red and pink roses. This romantic arrangement is perfect for expressing love, appreciation, and heartfelt emotions on Valentine\'s Day or any romantic occasion.',
      attributes: {
        theme: 'Lãng mạn',
        recipient: 'Người yêu',
        style: 'Hộp hoa',
        flowerType: 'Hoa hồng',
        occasion: 'Xin lỗi'
      },
      details: {
        flowers: 'Red and Pink Roses',
        size: 'Small (25-30 cm)',
        wrapping: 'Red paper with ribbon',
        care: 'Keep in cool location, change water daily'
      }
    },
    11: {
      name: 'Summer Cottage',
      price: '10 $',
      image: `${imageBase}/p1 (11).jpg`,
      description: 'Summer Cottage brings summer vibes with bright flowers that capture the essence of warm, sunny days. This cheerful arrangement features vibrant seasonal blooms that celebrate the joy and energy of summertime.',
      attributes: {
        theme: 'Tự nhiên',
        recipient: 'Gia đình',
        style: 'Giỏ hoa',
        flowerType: 'Hoa hỗn hợp',
        occasion: 'Sinh nhật'
      },
      details: {
        flowers: 'Summer Mixed Flowers',
        size: 'Medium (30-35 cm)',
        wrapping: 'Bright paper with ribbon',
        care: 'Change water daily, trim stems'
      }
    },
    12: {
      name: 'Wild Beauty',
      price: '11 $',
      image: `${imageBase}/p1 (12).jpg`,
      description: 'Wild Beauty showcases natural wildflower elegance with its rustic and organic charm. This arrangement celebrates the untamed beauty of nature with a carefully curated mix of wildflowers that bring a touch of countryside charm to any setting.',
      attributes: {
        theme: 'Tự nhiên',
        recipient: 'Đồng nghiệp',
        style: 'Bó hoa',
        flowerType: 'Hoa hỗn hợp',
        occasion: 'Chúc mừng'
      },
      details: {
        flowers: 'Wildflower Mix',
        size: 'Medium (30-35 cm)',
        wrapping: 'Natural kraft paper',
        care: 'Keep in cool place, change water regularly'
      }
    }
  };
  const attributeIcons = {
    theme: '🎨',
    recipient: '👤',
    style: '💐',
    flowerType: '🌸',
    occasion: '🎉'
  };

  function getProductId() {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('id') || '1';
  }

  function loadProductData() {
    const productId = getProductId();
    const product = products[productId];
    if (product) {
      document.getElementById('productName').textContent = product.name;
      document.getElementById('productPrice').textContent = product.price;
      document.getElementById('productImage').src = product.image;
      document.getElementById('productImage').alt = product.name;
      document.getElementById('productDescription').textContent = product.description;
      const attributesContainer = document.getElementById('productAttributes');
      attributesContainer.innerHTML = `
        <div class="attribute-badge">${attributeIcons.theme} ${product.attributes.theme}</div>
        <div class="attribute-badge">${attributeIcons.recipient} ${product.attributes.recipient}</div>
        <div class="attribute-badge">${attributeIcons.style} ${product.attributes.style}</div>
        <div class="attribute-badge">${attributeIcons.occasion} ${product.attributes.occasion}</div>`;
      const detailsList = document.getElementById('productDetailsList');
      detailsList.innerHTML = `
        <li><strong>Flowers:</strong> ${product.details.flowers}</li>
        <li><strong>Size:</strong> ${product.details.size}</li>
        <li><strong>Wrapping:</strong> ${product.details.wrapping}</li>
        <li><strong>Care:</strong> ${product.details.care}</li>`;
    }
  }

  function loadRelatedProducts() {
    const currentId = getProductId();
    const currentProduct = products[currentId];
    const relatedContainer = document.getElementById('relatedProductsContainer');
    relatedContainer.innerHTML = '';
    let relatedIds = [];
    for (let id in products) {
      if (id !== currentId) {
        const product = products[id];
        if (product.attributes.theme === currentProduct.attributes.theme || product.attributes.occasion === currentProduct.attributes.occasion) {
          relatedIds.push(id);
        }
      }
    }
    if (relatedIds.length < 3) {
      for (let id in products) {
        if (id !== currentId && !relatedIds.includes(id)) {
          relatedIds.push(id);
          if (relatedIds.length >= 3) break;
        }
      }
    }
    relatedIds.slice(0, 3).forEach(id => {
      const product = products[id];
      relatedContainer.innerHTML += `
        <div class="col-md-4">
          <div class="related-product-card">
            <img src="${product.image}" alt="${product.name}" class="related-product-image">
            <div class="related-product-info">
              <h3 class="related-product-name">${product.name}</h3>
              <p class="related-product-price">${product.price}</p>
              <a href="/details?id=${id}" class="view-btn">View Details</a>
            </div>
          </div>
        </div>`;
    });
  }

  function increaseQuantity() {
    const quantityInput = document.getElementById('quantity');
    quantityInput.value = parseInt(quantityInput.value) + 1;
  }

  function decreaseQuantity() {
    const quantityInput = document.getElementById('quantity');
    if (parseInt(quantityInput.value) > 1) {
      quantityInput.value = parseInt(quantityInput.value) - 1;
    }
  }

  function addToCart() {
    const productName = document.getElementById('productName').textContent;
    const quantity = document.getElementById('quantity').value;
    alert(`Added ${quantity} x ${productName} to cart!`);
  }

  function toggleWishlist() {
    const wishlistBtn = document.getElementById('wishlistBtn');
    const wishlistIcon = document.getElementById('wishlistIcon');
    const productId = getProductId();
    const product = products[productId];
    let wishlist = JSON.parse(localStorage.getItem('wishlist') || '[]');
    const index = wishlist.findIndex(item => item.id === productId);
    if (index > -1) {
      wishlist.splice(index, 1);
      wishlistBtn.classList.remove('active');
      wishlistIcon.classList.remove('fa-solid');
      wishlistIcon.classList.add('fa-regular');
      alert('Đã xóa khỏi danh sách yêu thích!');
    } else {
      wishlist.push({
        id: productId,
        name: product.name,
        price: product.price,
        image: product.image
      });
      wishlistBtn.classList.add('active');
      wishlistIcon.classList.remove('fa-regular');
      wishlistIcon.classList.add('fa-solid');
      alert('Đã thêm vào danh sách yêu thích!');
    }
    localStorage.setItem('wishlist', JSON.stringify(wishlist));
  }

  function checkWishlistStatus() {
    const productId = getProductId();
    const wishlist = JSON.parse(localStorage.getItem('wishlist') || '[]');
    const wishlistBtn = document.getElementById('wishlistBtn');
    const wishlistIcon = document.getElementById('wishlistIcon');
    if (wishlist.some(item => item.id === productId)) {
      wishlistBtn.classList.add('active');
      wishlistIcon.classList.remove('fa-regular');
      wishlistIcon.classList.add('fa-solid');
    }
  }
  window.addEventListener('DOMContentLoaded', function() {
    loadProductData();
    loadRelatedProducts();
    checkWishlistStatus();
  });
</script>
<script src="{{ asset('js/main.js') }}"></script>
@endpush