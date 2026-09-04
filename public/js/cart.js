document.addEventListener('DOMContentLoaded', function() {
    var addCartForm = document.getElementById('addCartForm');
    var cartMessage = document.getElementById('cartMessage');
    
    if(addCartForm) {
        addCartForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            var product_id = document.getElementById('product_id').value;
            var quantity = document.getElementById('quantity').value;
            
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'index.php?action=add_cart', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                var res = xhr.responseText.trim();
                if(res !== '' && res !== 'error') {
                    cartMessage.innerHTML = 'Product added to cart.';
                    var badge = document.getElementById('cartCount');
                    if(badge) {
                        badge.textContent = res;
                        badge.style.display = 'inline-flex';
                    }
                } else {
                    cartMessage.innerHTML = 'Failed to add product.';
                }
            };
            xhr.send('product_id=' + encodeURIComponent(product_id) + '&quantity=' + encodeURIComponent(quantity));
        });
    }
    
    var qtyInputs = document.getElementsByClassName('cartQty');
    for(var i = 0; i < qtyInputs.length; i++) {
        qtyInputs[i].addEventListener('change', function() {
            var product_id = this.getAttribute('data-product');
            var quantity = this.value;
            
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'index.php?action=update_cart', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if(xhr.responseText.trim() == 'success') {
                    location.reload();
                } else {
                    cartMessage.innerHTML = 'Failed to update cart.';
                }
            };
            xhr.send('product_id=' + encodeURIComponent(product_id) + '&quantity=' + encodeURIComponent(quantity));
        });
    }
    
    var removeButtons = document.getElementsByClassName('removeCart');
    for(var j = 0; j < removeButtons.length; j++) {
        removeButtons[j].addEventListener('click', function() {
            var product_id = this.getAttribute('data-product');
            
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'index.php?action=remove_cart', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if(xhr.responseText.trim() == 'success') {
                    location.reload();
                } else {
                    cartMessage.innerHTML = 'Failed to remove item.';
                }
            };
            xhr.send('product_id=' + encodeURIComponent(product_id));
        });
    }
});
