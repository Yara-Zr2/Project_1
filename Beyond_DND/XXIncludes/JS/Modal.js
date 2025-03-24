// Show modal with product details
function showModal(productId) {
    $.ajax({
        url: "get_product_details.php",  // Ensure this file fetches product details
        type: "POST",
        data: { id: productId },
        success: function(response) {
            $('#productDetails').html(response);  // Fill modal content with product details
            $('#productModal').show();  // Show the modal
        },
        error: function() {
            alert("Failed to load product details.");
        }
    });
}

// Close the modal
function closeModal() {
    $('#productModal').hide();  // Hide the modal when close button is clicked
}

// Add product to cart
function addToCart(productId) {
    $.ajax({
        url: "add_to_cart.php",  // This file handles adding the product to the cart
        type: "POST",
        data: { product_id: productId },
        success: function(response) {
            alert("Product added to cart!");
            // Optionally update cart UI (like cart count, or cart items preview)
        },
        error: function() {
            alert("Failed to add product to cart.");
        }
    });
}

// Gift to friend button (placeholder function)
function giftToFriend() {
    alert("Coming Soon!");  // Placeholder, can be extended later
}
