$(function(){
    const $cartQuantity = $('#cart-quantity');
    const $addToCart = $('.btn-add-to-cart');
    const $itemQuantities = $('.item-quantity');
    const $orderPay = $('.btn-order-pay');

    $addToCart.click(ev => {
        ev.preventDefault();

        const $this = $(ev.target);
        const id = $this.closest('.product-item').data('key');

        $.ajax({
            method: 'POST',
            url: $this.attr('href'),
            data: {id},
            success: function(result){
                if (result.success) {
                    $cartQuantity.text(parseInt($cartQuantity.text() || 0) + 1);
                    alert('商品已加入購物車！！');
                } else {
                    alert('請先登入');
                }
            }
        })
    })

    $itemQuantities.change(ev => {
        const $this = $(ev.target);
        const id = $this.closest('tr').data('id');
        const quantity = $this.val();
        const url = $this.closest('tr').data('url');
        const $td = $this.closest('td');
        const $totalPrice = $('.total-price');

        $.ajax({
            method: 'POST',
            url: url,
            data: {id, quantity},
            success: function(result){
                $cartQuantity.text(result.quantity);
                $td.next().text(result.totalPriceFromItem);
                $totalPrice.text('總計：' + result.totalPriceFromUser);
            }
        })
    })

    $orderPay.click(ev => {
        ev.preventDefault();

        const $this = $(ev.target);
        const id = $this.closest('tr').data('key');

        $.ajax({
            method: 'POST',
            url: $this.attr('href'),
            data: {id},
            success: function(){
                alert('付款成功！！');
                $this.parent().html('<span class="badge badge-success">已付款</span>');
            }
        })
    })
});