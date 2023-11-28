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
            },
            error: function (e) {
                console.log(e.message);
                throw e;
            }
        });
    } else {
        var liveSearch = document.getElementById("live-search__result");
        liveSearch.innerHTML = "<div class='p-2'>Vui lòng nhập từ khóa</div>";
    }
});