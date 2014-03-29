$('#loading-example-btn').click(function () {
    var btn = $(this);
    btn.button('loading');
    setTimeout(function() {
        btn.button('reset');
    }, 1500);
    sleep(1000);
    btn.button('loading');
    sleep(1000);
    btn.button('reset');
});
