// Hàm thực hiện đăng xuất người dùng
function dangXuat() {
      // Gọi đến trang logout.php để xóa session
      window.location.href = "logout.php";
}

// Hàm hiển thị div xác nhận
function showDeleteConfirmation() {
  document.getElementById('confirmDelete').style.display = 'block';
}

// Hàm ẩn div xác nhận
function hideDeleteConfirmation() {
  document.getElementById('confirmDelete').style.display = 'none';
}

// Hàm ẩn div xác nhận khi người dùng nhấn nút "Không"
function cancelDelete() {
  hideDeleteConfirmation();
}


function deleteCategory(id) {
      // Hiển thị div xác nhận
  showDeleteConfirmation();

  // Lưu id của danh mục để xóa
  var categoryId = id;

  // Hàm xử lý khi người dùng xác nhận xóa danh mục
  window.deleteCategoryConfirmed = function() {
    // Tạo đối tượng XMLHttpRequest để gửi yêu cầu tới file PHP xử lý xóa danh mục
    var xhttp = new XMLHttpRequest();
        
        // Định nghĩa hàm xử lý kết quả trả về
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            // Hiển thị thông báo về kết quả trả về từ file PHP xử lý
            console.log(this.responseText);
    
            // Reload trang web để cập nhật danh sách danh mục
            location.reload();
          }
        };
    
        // Gửi yêu cầu tới file PHP xử lý xóa danh mục
        xhttp.open("GET", "delete_category.php?id=" + id, true);
        xhttp.send();
      }
    }
    


    function showAddCategory() {
      document.getElementById("form-add-category").style.display = "block";
    }

    function showAddProduct1() {
      document.getElementById("form-add-product").style.display = "block";
    }

    function cancelAddCategory() {
      window.location.href = "quanlydanhmuc.php";
    }

    function cancelAddProduct() {
      window.location.href = "quanlysanpham.php";
    }

    function cancelEditCategory() {
      window.location.href = "quanlydanhmuc.php";
    }

    function cancelEditProducts() {
      window.location.href = "quanlysanpham.php";
    }
    

    function previewImageProduct(event) {
      const imageInput = event.target;
      const imagePreviewContainer = document.getElementById('imagePreviewContainer');
      imagePreviewContainer.innerHTML = '';
      
      for (let i = 0; i < imageInput.files.length; i++) {
        const file = imageInput.files[i];
        const reader = new FileReader();
        reader.onload = function() {
          const img = document.createElement('img');
          img.setAttribute('src', reader.result);
          imagePreviewContainer.appendChild(img);
        }
        reader.readAsDataURL(file);
      }
    }

    function previewImageQLDMAdd(event) {
      const imageInput = event.target;
      const imagePreviewContainer = document.getElementById('imagePreviewContainer-qldm');
      imagePreviewContainer.innerHTML = '';
      
      for (let i = 0; i < imageInput.files.length; i++) {
        const file = imageInput.files[i];
        const reader = new FileReader();
        reader.onload = function() {
          const img = document.createElement('img');
          img.setAttribute('src', reader.result);
          imagePreviewContainer.appendChild(img);
        }
        reader.readAsDataURL(file);
      }
    }
    

    function previewImageQLDMEdit(event) {
      const imageInput = event.target;
      const imagePreviewContainer = document.getElementById('imagePreviewContainer-qldm-edit');
      imagePreviewContainer.innerHTML = '';
      
      for (let i = 0; i < imageInput.files.length; i++) {
        const file = imageInput.files[i];
        const reader = new FileReader();
        reader.onload = function() {
          const img = document.createElement('img');
          img.setAttribute('src', reader.result);
          imagePreviewContainer.appendChild(img);
        }
        reader.readAsDataURL(file);
      }
    }

    function previewImageQLSPEdit(event) {
      const imageInput = event.target;
      const imagePreviewContainer = document.getElementById('imagePreviewContainer-qlsp-edit');
      imagePreviewContainer.innerHTML = '';
      
      for (let i = 0; i < imageInput.files.length; i++) {
        const file = imageInput.files[i];
        const reader = new FileReader();
        reader.onload = function() {
          const img = document.createElement('img');
          img.setAttribute('src', reader.result);
          imagePreviewContainer.appendChild(img);
        }
        reader.readAsDataURL(file);
      }
    }






        // Hàm hiển thị div xác nhận
function showDeleteConfirmation() {
  document.getElementById('confirmDelete').style.display = 'block';
}

// Hàm ẩn div xác nhận
function hideDeleteConfirmation() {
  document.getElementById('confirmDelete').style.display = 'none';
}

// Hàm ẩn div xác nhận khi người dùng nhấn nút "Không"
function cancelDelete() {
  hideDeleteConfirmation();
}
    

function deleteProduct(id) {
  // Lưu id của sản phẩm để xóa
  var productId = id;

  // Hiển thị div xác nhận
  showDeleteConfirmation();

  // Gán hàm xác nhận xóa sản phẩm cho biến window.deleteProductConfirmed
  window.deleteProductConfirmed = function() {
    // Tạo đối tượng XMLHttpRequest để gửi yêu cầu tới file PHP xử lý xóa sản phẩm
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        location.reload();
      }
    };
    xhttp.open("POST", "delete_product.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + productId);
  };
}


function showDiscountInput(bookID) {
  var discountInput = document.getElementById('discountInput' + bookID);
  discountInput.style.display = 'inline-block';
}

function applyDiscount(bookID) {
  var discountInput = document.getElementById('discountInput' + bookID);
  var discountValue = discountInput.value;

  // Thực hiện các xử lý của bạn với giá giảm được nhập vào
  console.log('Sách ID:', bookID);
  console.log('Giá giảm:', discountValue);

  // Xóa giá trị trong input và ẩn nút nhập giá giảm
  discountInput.value = '';
  discountInput.style.display = 'none';
}
