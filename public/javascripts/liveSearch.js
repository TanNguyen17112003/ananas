$('#live-search').keyup(function() {
    key = $(this).val();
    console.log(key);
    if (key != '') {
        $.ajax({
            url: 'ajax/searchLive.php',
            method: 'POST',
            // dataType: 'json',
            data: {
                key: key
            },
            success: function(data) {
                var liveSearch = document.getElementById("live-search__result");
                liveSearch.innerHTML = data;
                liveSearch.setAttribute("style", "display:block");
            },
            error: function (e) {
                console.log(e.message);
                throw e;
            }
        });
    } else {
        var liveSearch = document.getElementById("live-search__result");
        liveSearch.innerHTML = "<div class='p-2'>Vui lòng nhập từ khóa</div>";
        liveSearch.setAttribute("style", "display:block");
    }
});

$('#live-search').blur(function() {
    setTimeout(function() {
        $('#live-search__result').css('display', 'none');
    }, 100); 
})

$('#live-search').focusin(function() {
    $('#live-search__result').css('display', 'block');
})