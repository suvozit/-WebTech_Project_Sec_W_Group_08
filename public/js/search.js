document.addEventListener('DOMContentLoaded', function() {
    var searchForm = document.getElementById('searchForm');
    var searchResults = document.getElementById('searchResults');
    
    if(searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            searchProducts();
        });
    }
    
    function searchProducts() {
        var keyword = document.getElementById('keyword').value;
        var gender = document.getElementById('gender').value;
        var category_id = document.getElementById('category_id').value;
        
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'index.php?action=search_products&keyword=' + encodeURIComponent(keyword) + '&gender=' + encodeURIComponent(gender) + '&category_id=' + encodeURIComponent(category_id), true);
        xhr.onload = function() {
            if(xhr.status == 200) {
                searchResults.innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }
});
