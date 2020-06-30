var x = 5; //全局变量  
$(function () {
    $.ajax({
        type: "get",
        url: "/api/expand?cmd=user_info",
        dataType: "json",
        success: function (result) {
            if (result.code == 0) {
                // session失效跳转至登录
                window.location.href = result.data.url;
            } else {
                // 其他情况跳转至首页
                $("#se-box").css("display", "block");
                setInterval(function () { go('/'); }, 1000);
            }
        },
        error: function () {
            alert("请求失败");
        }
    });
});
function go(url) {
    x--;
    if (x > 0) {
        document.getElementById("se").innerText = x;
    } else {
        location.href = url;
    }
}  