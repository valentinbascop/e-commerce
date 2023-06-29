import axios from 'axios';

const apiToken = document.querySelector('meta[name="api-token"]').getAttribute('content');

axios.defaults.headers.common['Authorization'] = `Bearer ${apiToken}`;


$(document).ready(function() {
    $('.add-to-cart').click(function(event) {
        event.preventDefault();

        var productId = $(this).data('product-id');
        var quantity = $(this).data('quantity');

        $.ajax({
            url: '/cart/add/' + productId,
            method: 'POST',
            data: {
                quantity: quantity
            },
            success: function(response) {
                if (response.totalItems) {
                    $('.cart-items-count').text(response.totalItems);
                }
            }
        });
    });
});