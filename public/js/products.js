//Products boxes
let productsContainer = document.querySelector(".products .container");
let names = ["Blue Dream", "Pure White", "Vibarent Charm", "Lilly Bloom", "Joyful Bouquet", "Pink Gerbera", "Sweet Spring", "Classic Charm", "Garden Party", "Heart Warming", "Summer Cottage", "Wild Beauty"];
let prices = [10, 12, 11, 14, 18, 13, 16, 19, 15, 9, 10, 11];

// Dữ liệu phân loại cho mỗi sản phẩm
let productData = [
    { theme: "elegant", recipient: "lover", style: "bouquet", flowerType: "mixed", occasion: "anniversary" }, // Blue Dream
    { theme: "elegant", recipient: "family", style: "bouquet", flowerType: "mixed", occasion: "wedding" }, // Pure White
    { theme: "romantic", recipient: "lover", style: "bouquet", flowerType: "rose", occasion: "birthday" }, // Vibarent Charm
    { theme: "elegant", recipient: "friend", style: "bouquet", flowerType: "lily", occasion: "congratulation" }, // Lilly Bloom
    { theme: "cheerful", recipient: "friend", style: "bouquet", flowerType: "mixed", occasion: "birthday" }, // Joyful Bouquet
    { theme: "cheerful", recipient: "friend", style: "vase", flowerType: "gerbera", occasion: "congratulation" }, // Pink Gerbera
    { theme: "natural", recipient: "family", style: "basket", flowerType: "mixed", occasion: "birthday" }, // Sweet Spring
    { theme: "romantic", recipient: "lover", style: "bouquet", flowerType: "rose", occasion: "anniversary" }, // Classic Charm
    { theme: "natural", recipient: "friend", style: "basket", flowerType: "mixed", occasion: "congratulation" }, // Garden Party
    { theme: "romantic", recipient: "lover", style: "box", flowerType: "rose", occasion: "apology" }, // Heart Warming
    { theme: "natural", recipient: "family", style: "basket", flowerType: "mixed", occasion: "birthday" }, // Summer Cottage
    { theme: "natural", recipient: "colleague", style: "bouquet", flowerType: "mixed", occasion: "congratulation" } // Wild Beauty
];

let imgesArr = [];
for (let i = 0; i < names.length; i++) {
    imgesArr[i] = `images/p1 (${i+1}).jpg`;
}

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
            window.location.href = `details.html?id=${index + 1}`;
        });
        
        let head2 = document.createElement("h2");
        head2.className = "name";
        head2.innerHTML = names[index];
        
        let para = document.createElement("p");
        para.className = "price";
        para.innerHTML = `${prices[index]} $`;
        
        image.appendChild(img);
        text.appendChild(head2);
        text.appendChild(para);
        
        let btn = document.createElement("button");
        btn.className = "mb-3";
        btn.innerHTML = "Order";
        text.appendChild(btn);
        
        box.appendChild(image);
        box.appendChild(text);
        currentRow.appendChild(box);
    });
}

// Hàm lọc sản phẩm
function filterProducts() {
    let searchTerm = document.getElementById("searchInput").value.toLowerCase();
    let theme = document.getElementById("filterTheme").value;
    let recipient = document.getElementById("filterRecipient").value;
    let style = document.getElementById("filterStyle").value;
    let flowerType = document.getElementById("filterFlowerType").value;
    let occasion = document.getElementById("filterOccasion").value;
    
    let filteredIndices = [];
    
    for (let i = 0; i < names.length; i++) {
        let matchSearch = names[i].toLowerCase().includes(searchTerm);
        let matchTheme = !theme || productData[i].theme === theme;
        let matchRecipient = !recipient || productData[i].recipient === recipient;
        let matchStyle = !style || productData[i].style === style;
        let matchFlowerType = !flowerType || productData[i].flowerType === flowerType;
        let matchOccasion = !occasion || productData[i].occasion === occasion;
        
        if (matchSearch && matchTheme && matchRecipient && matchStyle && matchFlowerType && matchOccasion) {
            filteredIndices.push(i);
        }
    }
    
    createProducts(filteredIndices);
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