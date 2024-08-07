




function addToCart(item) {
    var product_id = item.productId;
    var quantity = item.quantity;
    var url_link = item.url;


    if (quantity <= 0) {
        Toastify({
            text: "Please enter a valid quantity.",
            duration: 5000,
            close: true,
            style: {
                background: "linear-gradient(to right, #ff5f6d, #ffc371)",
            },
            offset: {
                x: 50,
                y: 10,
            },
        }).showToast();
        return;
    } else {

        $.ajax({
            url: url_link,  // Replace with your actual endpoint
            type: 'POST',
            data: {
                product_id: product_id,
                quantity: quantity
            },
            dataType: 'json',  // Expected response type
            success: function(response) {
                // Handle success response
                if(response.status == "success") {
                    Toastify({
                        text: response.message,
                        duration: 5000,
                        close: true,
                        style: {
                            background: "linear-gradient(to right, #00b09b, #96c93d)",
                        },
                        offset: {
                            x: 50,
                            y: 10,
                        },
                    }).showToast();
                    updateCartContent(); // Update the cart content
                } else {
                    Toastify({
                        text: response.message,
                        duration: 5000,
                        close: true,
                        style: {
                            background: "linear-gradient(to right, #f1c40f, #f39c12)",
                        },
                        offset: {
                            x: 50,
                            y: 10,
                        },
                    }).showToast();
                }
                
            },
            error: function(xhr, status, error) {
                // Handle error response
                Toastify({
                    text: "Error adding item to cart. Please try again.",
                    duration: 5000,
                    close: true,
                    style: {
                        background: "linear-gradient(to right, #ff5f6d, #ffc371)",
                    },
                    offset: {
                        x: 50,
                        y: 10,
                    },
                }).showToast();
            }
        });
        
    }
    
}



function removeFromCart(product_id, base_url) {
    var url_link = base_url + 'cart/removeFromCart';
    $.ajax({
        url: url_link,  // Replace with your actual endpoint
        type: 'POST',
        data: {
            product_id: product_id
        },
        dataType: 'json',  // Expected response type
        success: function(response) {
            if (response.status == "success") {
                Toastify({
                    text: response.message,
                    duration: 5000,
                    close: true,
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    },
                    offset: {
                        x: 50,
                        y: 10,
                    },
                }).showToast();
                updateCartContent(); // Update the cart content
            } else {
                Toastify({
                    text: response.message,
                    duration: 5000,
                    close: true,
                    style: {
                        background: "linear-gradient(to right, #f1c40f, #f39c12)",
                    },
                    offset: {
                        x: 50,
                        y: 10,
                    },
                }).showToast();
            }
        },
        error: function(xhr, status, error) {
            Toastify({
                text: "Error removing item from cart. Please try again.",
                duration: 5000,
                close: true,
                style: {
                    background: "linear-gradient(to right, #ff5f6d, #ffc371)",
                },
                offset: {
                    x: 50,
                    y: 10,
                },
            }).showToast();
        }
    });
}

function updateCartContent() {
    url_link = 'http://localhost/gkam/cart/getCartContent';
    $.ajax({
        url: url_link,
        type: 'GET',
        dataType: 'json',  // Expected response type
        success: function(response) {
            console.log(response)
            // Update the cart HTML content
            $('.cart__mini').html(response.cart_html);
            // Update the cart total item count and total price
            $('.cart__total-item').text(response.itemNumber);
            $('.cart__total-price').text('$' + response.price.toFixed(2));
        },
        error: function(xhr, status, error) {
            console.error('Error updating cart content:', error);
            Toastify({
                text: "Error updating cart content. Please try again. " + error,
                duration: 5000,
                close: true,
                style: {
                    background: "linear-gradient(to right, #ff5f6d, #ffc371)",
                },
                offset: {
                    x: 50,
                    y: 10,
                },
            }).showToast();
        }
    });
}


function removeFromMainCart(product_id, base_url) {
    var url_link = base_url + 'cart/removeFromCart';
    $.ajax({
        url: url_link,  // Replace with your actual endpoint
        type: 'POST',
        data: {
            product_id: product_id
        },
        dataType: 'json',  // Expected response type
        success: function(response) {
            if (response.status == "success") {
                Toastify({
                    text: response.message,
                    duration: 5000,
                    close: true,
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    },
                    offset: {
                        x: 50,
                        y: 10,
                    },
                }).showToast();
                updateMainCartContent(); // Update the cart content
                updateCartContent();
            } else {
                Toastify({
                    text: response.message,
                    duration: 5000,
                    close: true,
                    style: {
                        background: "linear-gradient(to right, #f1c40f, #f39c12)",
                    },
                    offset: {
                        x: 50,
                        y: 10,
                    },
                }).showToast();
            }
        },
        error: function(xhr, status, error) {
            Toastify({
                text: "Error removing item from cart. Please try again.",
                duration: 5000,
                close: true,
                style: {
                    background: "linear-gradient(to right, #ff5f6d, #ffc371)",
                },
                offset: {
                    x: 50,
                    y: 10,
                },
            }).showToast();
        }
    });
}

function updateMainCartContent() {
    url_link = 'http://localhost/gkam/cart/getMainCartContent';
    $.ajax({
        url: url_link,
        type: 'GET',
        dataType: 'json',  // Expected response type
        success: function(response) {
            // Update the cart HTML content
            $('tbody').html(response.cart_html);
            $('.sub_total').text('$' + response.price.toFixed(2));
            $('.total').text('$' + response.price.toFixed(2));
        },
        error: function(xhr, status, error) {
            console.error('Error updating cart content:', error);
            Toastify({
                text: "Error updating cart content. Please try again. " + error,
                duration: 5000,
                close: true,
                style: {
                    background: "linear-gradient(to right, #ff5f6d, #ffc371)",
                },
                offset: {
                    x: 50,
                    y: 10,
                },
            }).showToast();
        }
    });
}



