$(function(){
    const $cartQuantity = $('#cart-quantity');
    const $addToCart = $('.btn-add-to-cart');
    const $itemQuantities = $('.item-quantity');
    const $orderPay = $('.btn-order-pay');
    const $resetPassword = $('.btn-reset-password');
    const $resetPasswordModal = $('.btn-reset-password-modal');

    $addToCart.click(ev => {
        ev.preventDefault();

        const $this = $(ev.target);
        const id = $this.closest('.product-item').data('key');

        $.ajax({
            method: 'POST',
            url: $this.attr('href'),
            data: {id},
            success: function(result) {
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
            success: function(result) {
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
            success: function(result) {
                if (result) {
                    alert(result);
                } else {
                    alert('付款成功！！');
                    location.reload();
                }
            }
        })
    })

    $resetPasswordModal.click(ev => {
        $('#w0-label').html('重設密碼');
        $('.form-control').eq(1).removeClass('is-invalid');
        $('.form-control').eq(2).removeClass('is-invalid');
        $('.form-control').eq(3).removeClass('is-invalid');
        $('.invalid-feedback').eq(1).text('');
        $('.invalid-feedback').eq(2).text('');
        $('.invalid-feedback').eq(3).text('');
    })

    $resetPassword.click(ev => {
        ev.preventDefault();

        $('#w0-label').html('重設密碼<span style="color: red;">（驗證中請稍候...）</span>');

        const $this = $(ev.target);
        const old_password = $('#resetpasswordform-old_password').val();
        const password = $('#resetpasswordform-password').val();
        const password_repeat = $('#resetpasswordform-password_repeat').val();

        $.ajax({
            method: 'POST',
            url: $this.attr('href'),
            data: {old_password, password, password_repeat},
            success: function(result) {
                $('#w0-label').html('重設密碼');
                if (result['old_password']) {
                    $('#resetpasswordform-password').val('');
                    $('.invalid-feedback').eq(2).text('');
                    $('.form-control').eq(2).removeClass('is-invalid');

                    $('#resetpasswordform-password_repeat').val('');
                    $('.invalid-feedback').eq(3).text('');
                    $('.form-control').eq(3).removeClass('is-invalid');

                    $('.form-control').eq(1).addClass('is-invalid');
                    $('.invalid-feedback').eq(1).text(result['old_password']);
                } else {
                    $('.form-control').eq(1).removeClass('is-invalid');
                    $('.invalid-feedback').eq(1).text('');

                    $('.invalid-feedback').eq(2).text('');
                    $('.form-control').eq(2).addClass('is-invalid');
                    $('.invalid-feedback').eq(2).text(result['password']);

                    $('.invalid-feedback').eq(3).text('');
                    $('.form-control').eq(3).addClass('is-invalid');
                    $('.invalid-feedback').eq(3).text(result['password_repeat']);
                }
            }
        })
    })
});