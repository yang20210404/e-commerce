$(function(){
    const $orderRefund = $('.btn-order-refund');
    const $userActive = $('.btn-user-active');
    const $userBlock = $('.btn-user-block');
    const $productActive = $('.btn-product-active');
    const $productBlock = $('.btn-product-block');

    $orderRefund.click(ev => {
        ev.preventDefault();

        const $this = $(ev.target);
        const id = $this.closest('tr').data('key');

        $.ajax({
            method: 'POST',
            url: $this.attr('href'),
            data: {id},
            success: function() {
                alert('退款成功！！');
                $this.parent().html('<span class="badge badge-secondary">已退款</span>');
            }
        })
    })

    $userActive.click(ev => {
        ev.preventDefault();

        const $this = $(ev.target);
        const id = $this.closest('tr').data('key');

        $.ajax({
            method: 'POST',
            url: $this.attr('href'),
            data: {id},
            success: function() {
                alert('用戶激活成功！！');
                location.reload();
            }
        })
    })

    $userBlock.click(ev => {
        ev.preventDefault();

        const $this = $(ev.target);
        const id = $this.closest('tr').data('key');

        $.ajax({
            method: 'POST',
            url: $this.attr('href'),
            data: {id},
            success: function() {
                alert('用戶凍結成功！！');
                location.reload();
            }
        })
    })

    $productActive.click(ev => {
        ev.preventDefault();

        const $this = $(ev.target);
        const id = $this.closest('tr').data('key');

        $.ajax({
            method: 'POST',
            url: $this.attr('href'),
            data: {id},
            success: function() {
                alert('商品上架成功！！');
                location.reload();
            }
        })
    })

    $productBlock.click(ev => {
        ev.preventDefault();

        const $this = $(ev.target);
        const id = $this.closest('tr').data('key');

        $.ajax({
            method: 'POST',
            url: $this.attr('href'),
            data: {id},
            success: function() {
                alert('商品下架成功！！');
                location.reload();
            }
        })
    })
});