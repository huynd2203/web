var lightButton = document.getElementById('light-button');
var darkButton = document.getElementById('dark-button');

lightButton.addEventListener('click', function() {
    lightButton.classList.add('active');
    darkButton.classList.remove('active');
});

darkButton.addEventListener('click', function() {
    darkButton.classList.add('active');
    lightButton.classList.remove('active');
});



const sliders = document.getElementsByClassName('content-right-slider');
const dotss = document.getElementsByClassName('slider-dot');
let currentSlideIndex = 0;

function showSlide(index) {
    for (let i = 0; i < sliders.length; i++) {
        sliders[i].classList.remove('active');
    }

    sliders[index].classList.add('active');

    for (let i = 0; i < dotss.length; i++) {
        dotss[i].classList.remove('active');
    }
    dotss[index].classList.add('active');

    const sliderCards = sliders[index].getElementsByClassName('slider-card');
    for (let i = 0; i < sliderCards.length; i++) {
        sliderCards[i].classList.add('active');
        sliderCards[i].style.opacity = '1';
        sliderCards[i].style.transform = 'translateX(0)';
    }

    // Tự động xóa lớp active và ẩn phần tử sau 3 giây
    const delay = 3000; // Thời gian hiển thị (3 giây)
    setTimeout(() => {
        for (let i = 0; i < sliderCards.length; i++) {
            sliderCards[i].classList.remove('active');
        }
        setTimeout(() => {
            for (let i = 0; i < sliderCards.length; i++) {
                sliderCards[i].style.opacity = '0';
                sliderCards[i].style.transform = 'translateX(0)';
            }
        }, 500); // Delay 0.5 giây để kết thúc hiệu ứng trước khi ẩn phần tử
    }, delay);
}

function nextSlide() {
    currentSlideIndex++;
    if (currentSlideIndex >= sliders.length) {
        currentSlideIndex = 0;
    }
    showSlide(currentSlideIndex);
}

function startSlider() {
    showSlide(currentSlideIndex);
    setInterval(nextSlide, 4550);
}

startSlider();

// Gắn sự kiện click cho từng nút dots
for (let i = 0; i < dotss.length; i++) {
    dotss[i].addEventListener('click', () => {
        showSlide(i);
    });
}





const tabs = document.querySelectorAll('.tab');
const productsContainer = document.getElementById('products-container');
const products = productsContainer.querySelectorAll('.features-right-product-details');
const fRpdLines = document.querySelectorAll('.f-r-p-d-line');

tabs.forEach(tab => {
    tab.addEventListener('click', function(event) {
        event.preventDefault();

        const category = this.getAttribute('data-category');

        tabs.forEach(tab => {
            tab.classList.remove('active');
        });
        this.classList.add('active');

        products.forEach(product => {
            product.classList.remove('active');
            if (product.classList.contains(`category-${category}`)) {
                product.classList.add('active');
            }
        });

        fRpdLines.forEach(line => {
            line.classList.remove('active');
        });

        let startIndex = 0;
        if (category === '1') {
            startIndex = 0;
        } else if (category === '2') {
            startIndex = 6;
        } else if (category === '3') {
            startIndex = 12;
        }

        const activeLines = Array.from(fRpdLines).slice(startIndex, startIndex + 6);
        activeLines.forEach(line => {
            line.classList.add('active');
        });


    });
});

// Hiển thị mặc định Category 1 khi tải trang
products.forEach(product => {
    if (product.classList.contains('category-1')) {
        product.classList.add('active');
    }
});




const slidesContainer = document.querySelector('.best-sellers-product-all-card');
const slides = slidesContainer.children;
const dots = document.querySelectorAll('.b-s-p-dot');
const slideWidth = slides[0].offsetWidth;

let currentIndex = 0;

function setActiveDot(index) {
    dots.forEach(dot => dot.classList.remove('active'));
    dots[index].classList.add('active');
}

function goToSlide(index) {
    const slideOffset = slideWidth + 100; // Tăng 10px so với giá trị gốc

    slidesContainer.style.transform = `translateX(-${slideOffset * index}px)`;
    currentIndex = index;
    setActiveDot(index);
}


dots.forEach((dot, index) => {
    dot.addEventListener('click', () => {
        goToSlide(index);
    });
});

goToSlide(0);

// Xử lý vuốt trái/phải trên slider
let touchStartX = 0;
let touchEndX = 0;

slidesContainer.addEventListener('touchstart', e => {
    touchStartX = e.touches[0].clientX;
});

slidesContainer.addEventListener('touchend', e => {
    touchEndX = e.changedTouches[0].clientX;
    handleSwipe();
});

function handleSwipe() {
    const swipeDistance = touchEndX - touchStartX;
    if (swipeDistance > 0 && currentIndex > 0) {
        // Swipe sang phải
        goToSlide(currentIndex - 1);
    } else if (swipeDistance < 0 && currentIndex < slides.length - 1) {
        // Swipe sang trái
        goToSlide(currentIndex + 1);
    }
    slidesContainer.style.transition = 'transform 0.3s ease-in-out';
    slidesContainer.style.transform = `translateX(-${slideWidth * currentIndex}px)`;
}




function showMenuAccount() {
    var dropdown = document.getElementById("dropdown-account");
    if (dropdown.style.display === "block") {
      dropdown.style.display = "none";
    } else {
      dropdown.style.display = "block";
    }
}


  