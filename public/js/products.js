//Products boxes
let productsContainer = document.querySelector(".products .container");

// Lấy dữ liệu từ database (truyền từ Blade) hoặc dùng dữ liệu mặc định
let productsFromDB = window.productsData || [];
let initialProductsFromDB = JSON.parse(JSON.stringify(productsFromDB)); // Deep copy for reset

let names = [];
let prices = [];
let productData = [];
let imgesArr = [];
let initialNames = [];
let initialPrices = [];
let initialProductData = [];
let initialImgesArr = [];

// Nếu có dữ liệu từ database thì dùng, không thì dùng dữ liệu mặc định
if (productsFromDB && productsFromDB.length > 0) {
    // Sử dụng dữ liệu từ database
    productsFromDB.forEach((product, index) => {
        names.push(product.name);
        prices.push(parseFloat(product.price));
        
        // Map các thuộc tính từ database
        productData.push({
            theme: product.theme || "natural",
            recipient: product.recipient || "friend",
            style: product.style || "bouquet",
            flowerType: product.flower_type || "mixed",
            occasion: product.occasion || "birthday"
        });
        
        // Xử lý đường dẫn hình ảnh
        if (product.image_url_full) {
            imgesArr.push(product.image_url_full);
        } else if (product.image_url) {
            imgesArr.push(product.image_url.startsWith('/') ? product.image_url : '/' + product.image_url);
        } else {
            imgesArr.push(`/images/p1 (${index + 1}).jpg`);
        }
    });
} else {
    // Dữ liệu mặc định (fallback)
    names = ["Blue Dream", "Pure White", "Vibarent Charm", "Lilly Bloom", "Joyful Bouquet", "Pink Gerbera", "Sweet Spring", "Classic Charm", "Garden Party", "Heart Warming", "Summer Cottage", "Wild Beauty"];
    prices = [10, 12, 11, 14, 18, 13, 16, 19, 15, 9, 10, 11];
    
    productData = [
        { theme: "elegant", recipient: "lover", style: "bouquet", flowerType: "mixed", occasion: "anniversary" },
        { theme: "elegant", recipient: "family", style: "bouquet", flowerType: "mixed", occasion: "wedding" },
        { theme: "romantic", recipient: "lover", style: "bouquet", flowerType: "rose", occasion: "birthday" },
        { theme: "elegant", recipient: "friend", style: "bouquet", flowerType: "lily", occasion: "congratulation" },
        { theme: "cheerful", recipient: "friend", style: "bouquet", flowerType: "mixed", occasion: "birthday" },
        { theme: "cheerful", recipient: "friend", style: "vase", flowerType: "gerbera", occasion: "congratulation" },
        { theme: "natural", recipient: "family", style: "basket", flowerType: "mixed", occasion: "birthday" },
        { theme: "romantic", recipient: "lover", style: "bouquet", flowerType: "rose", occasion: "anniversary" },
        { theme: "natural", recipient: "friend", style: "basket", flowerType: "mixed", occasion: "congratulation" },
        { theme: "romantic", recipient: "lover", style: "box", flowerType: "rose", occasion: "apology" },
        { theme: "natural", recipient: "family", style: "basket", flowerType: "mixed", occasion: "birthday" },
        { theme: "natural", recipient: "colleague", style: "bouquet", flowerType: "mixed", occasion: "congratulation" }
    ];
    
    for (let i = 0; i < names.length; i++) {
        imgesArr[i] = `/images/p1 (${i+1}).jpg`;
    }
}

// Save initial state for reset
initialNames = [...names];
initialPrices = [...prices];
initialProductData = JSON.parse(JSON.stringify(productData));
initialImgesArr = [...imgesArr];

// Hàm tạo products
function createProducts(filteredIndices = null) {
    productsContainer.innerHTML = "";
    
    let indicesToShow = filteredIndices !== null ? filteredIndices : Array.from({length: names.length}, (_, i) => i);
    
    if (indicesToShow.length === 0) {
        let noResults = document.createElement("div");
        noResults.className = "no-results";
        noResults.innerHTML = "Không tìm thấy sản phẩm phù hợp. Vui lòng thử lại với bộ lọc khác.";
        productsContainer.appendChild(noResults);
        return;
    }
    
    let currentRow;
    indicesToShow.forEach((index, position) => {
        if (position % 4 === 0) {
            currentRow = document.createElement("div");
            currentRow.className = "row";
            productsContainer.appendChild(currentRow);
        }
        
        let box = document.createElement("div");
        let image = document.createElement("div");
        let text = document.createElement("div");
        box.className = "box col-md-3 col-sm-6";
        image.className = "image";
        text.className = "text mt-2";
        
        let img = document.createElement("img");
        img.className = "img";
        img.src = imgesArr[index];
        img.style.cursor = "pointer";
        
        img.addEventListener("click", function() {
            // Nếu có dữ liệu từ database, dùng ID thật, không thì dùng index + 1
            let productId = productsFromDB.length > 0 ? productsFromDB[index].product_id : (index + 1);
            window.location.href = `/products/${productId}`;
        });
        
        let head2 = document.createElement("h2");
        head2.className = "name";
        head2.innerHTML = names[index];
        
        let para = document.createElement("p");
        para.className = "price";
        // Format giá theo định dạng VNĐ nếu từ database, $ nếu dữ liệu mặc định
        if (productsFromDB.length > 0) {
            para.innerHTML = `${new Intl.NumberFormat('vi-VN').format(prices[index])}₫`;
        } else {
            para.innerHTML = `${prices[index]} $`;
        }
        
        image.appendChild(img);
        text.appendChild(head2);
        text.appendChild(para);
        
        let btn = document.createElement("button");
        btn.className = "mb-3 add-to-cart";
        btn.innerHTML = "Đặt hàng";
        
        // Set data attributes
        let productId = productsFromDB.length > 0 ? productsFromDB[index].product_id : (index + 1);
        btn.setAttribute('data-product-id', productId);
        btn.setAttribute('data-name', names[index]);
        btn.setAttribute('data-price', prices[index]);
        btn.setAttribute('data-image', imgesArr[index]);
        
        btn.addEventListener("click", function(e) {
            e.preventDefault();
            if (typeof addToCart === 'function') {
                addToCart(productId, names[index], prices[index], imgesArr[index]);
            }
        });
        text.appendChild(btn);
        
        box.appendChild(image);
        box.appendChild(text);
        currentRow.appendChild(box);
    });
}

// Hàm lọc sản phẩm
function filterProducts() {
    let searchTerm = document.getElementById("searchInput").value.toLowerCase().trim();
    let theme = document.getElementById("filterTheme").value;
    let recipient = document.getElementById("filterRecipient").value;
    let style = document.getElementById("filterStyle").value;
    let flowerType = document.getElementById("filterFlowerType").value;
    let occasion = document.getElementById("filterOccasion").value;
    
    // If search is empty, reset to initial data and apply only filter options
    if (searchTerm === "") {
        // Restore initial product data
        names = [...initialNames];
        prices = [...initialPrices];
        productData = JSON.parse(JSON.stringify(initialProductData));
        imgesArr = [...initialImgesArr];
        productsFromDB = JSON.parse(JSON.stringify(initialProductsFromDB));
        
        // Apply filter options only
        let filteredIndices = [];
        
        for (let i = 0; i < names.length; i++) {
            let matchTheme = !theme || productData[i].theme === theme;
            let matchRecipient = !recipient || productData[i].recipient === recipient;
            let matchStyle = !style || productData[i].style === style;
            let matchFlowerType = !flowerType || productData[i].flowerType === flowerType;
            let matchOccasion = !occasion || productData[i].occasion === occasion;
            
            if (matchTheme && matchRecipient && matchStyle && matchFlowerType && matchOccasion) {
                filteredIndices.push(i);
            }
        }
        
        createProducts(filteredIndices);
    } else {
        // If user is searching, do server-side search
        performServerSearch(searchTerm, theme, recipient, style, flowerType, occasion);
    }
}

// Server-side search function
async function performServerSearch(searchTerm, theme, recipient, style, flowerType, occasion) {
    try {
        const params = new URLSearchParams();
        params.append('search', searchTerm);
        if (theme) params.append('theme', theme);
        if (recipient) params.append('recipient', recipient);
        if (style) params.append('style', style);
        if (flowerType) params.append('flower_type', flowerType);
        if (occasion) params.append('occasion', occasion);
        
        const response = await fetch(`/products?${params.toString()}`);
        const html = await response.text();
        
        // Parse the HTML response to extract products data
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        
        // Get the products data from the script tag in the response
        const scriptTags = doc.querySelectorAll('script');
        let newProductsData = [];
        
        scriptTags.forEach(script => {
            if (script.textContent.includes('window.productsData')) {
                try {
                    // More robust extraction: find the line with window.productsData and extract JSON
                    const lines = script.textContent.split('\n');
                    for (let line of lines) {
                        if (line.includes('window.productsData')) {
                            // Extract JSON safely by finding the pattern
                            const jsonStart = line.indexOf('[');
                            const jsonEnd = line.lastIndexOf(']');
                            if (jsonStart !== -1 && jsonEnd !== -1 && jsonEnd > jsonStart) {
                                const jsonStr = line.substring(jsonStart, jsonEnd + 1);
                                newProductsData = JSON.parse(jsonStr);
                                break;
                            }
                        }
                    }
                } catch (e) {
                    console.error('JSON parse error:', e);
                }
            }
        });
        
        // Update local arrays with new data
        if (newProductsData.length > 0) {
            names = [];
            prices = [];
            productData = [];
            imgesArr = [];
            productsFromDB = newProductsData;
            
            newProductsData.forEach((product, index) => {
                names.push(product.name);
                prices.push(parseFloat(product.price));
                
                productData.push({
                    theme: product.theme || "natural",
                    recipient: product.recipient || "friend",
                    style: product.style || "bouquet",
                    flowerType: product.flower_type || "mixed",
                    occasion: product.occasion || "birthday"
                });
                
                if (product.image_url_full) {
                    imgesArr.push(product.image_url_full);
                } else if (product.image_url) {
                    imgesArr.push(product.image_url.startsWith('/') ? product.image_url : '/' + product.image_url);
                } else {
                    imgesArr.push(`/images/p1 (${index + 1}).jpg`);
                }
            });
            
            // Render all search results
            createProducts();
        }
    } catch (error) {
        console.error('Search error:', error);
    }
}

// Hàm reset bộ lọc
function resetFilters() {
    document.getElementById("searchInput").value = "";
    document.getElementById("filterTheme").value = "";
    document.getElementById("filterRecipient").value = "";
    document.getElementById("filterStyle").value = "";
    document.getElementById("filterFlowerType").value = "";
    document.getElementById("filterOccasion").value = "";
    createProducts();
}

// Khởi tạo sản phẩm ban đầu
createProducts();

// Gắn sự kiện cho search và filters
document.getElementById("searchInput").addEventListener("input", filterProducts);
document.getElementById("filterTheme").addEventListener("change", filterProducts);
document.getElementById("filterRecipient").addEventListener("change", filterProducts);
document.getElementById("filterStyle").addEventListener("change", filterProducts);
document.getElementById("filterFlowerType").addEventListener("change", filterProducts);
document.getElementById("filterOccasion").addEventListener("change", filterProducts);