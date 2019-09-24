// 定义加载区域
$(document).pjax('[data-pjax] a, a[data-pjax]', '#pjax-container');

// 定义pjax有效时间，超过这个时间会整页刷新
$.pjax.defaults.timeout = 1200;

// 显示加载动画
$(document).on('pjax:click', function () {
    // 开始加载
    NProgress.start();
});

// 隐藏加载动画
$(document).on('pjax:end', function () {
    // 加载完成
    NProgress.done();
});

