//@charset "utf-8"
//********************************************************************
// itunes storeリンクを適当に更新 v1.0
//********************************************************************

jQuery(document).ready(function($) {
    //--------------------------------------------------------------------
    // itunes storeリンクを適当に更新
    //--------------------------------------------------------------------
    $('.its').each(function() {
        var copythis = this;
        var track_id = $(this).data('itsTrackid');
        var api      = 'https://itunes.apple.com/lookup?callback=?';
        var tid      = '&id=' + track_id;
        var country  = '&country=JP';
        var uri      = api + country + tid;
        var today    = new Date();
        var year     = today.getYear();
        if(year < 1000){
            year += 1900;
        }
        var datestr = year + '年' + (today.getMonth()+1) + '月' + today.getDate() + '日';

        $.getJSON(uri, function(json){
            var res = json.results[0];

            // アイコンの差し替え
            if(!!res.artworkUrl512){
                icon = res.artworkUrl512;
            }else if(!!res.artworkUrl100){
                icon = res.artworkUrl100;
            }else if(!!res.artworkUrl60){
                icon = res.artworkUrl60;
            }else{
                icon = '';
            }
            if(icon != ''){
                $('dt img', copythis).replaceWith('<img src="' + icon + '" />');
            }

            // アプリ名の差し替え
            var name = res.trackCensoredName;
            $('dd li:nth-child(1) a', copythis).html(name);

            // 対応機種の差し替え
            var device = '対象機種：';
            res.supportedDevices.sort();
            for(var d in res.supportedDevices){
                device += res.supportedDevices[d] + ', ';
            }
            device = device.slice(0, -2);
            $('dd li:nth-child(2)', copythis).html(device);

            // カテゴリの差し替え
            cate = 'カテゴリ：';
            for(var g in res.genres){
                cate += res.genres[g] + ', ';
            }
            cate = cate.slice(0, -2);
            $('dd li:nth-child(3)', copythis).html(cate);

            // 価格の差し替え
            price = '価格：';
            if(res.price == 0){
                price += '無料';
            }else{
                price += res.price + '円';
            }
            price += ' <span>（' + datestr + '時点）<br>\n※現在の価格は変更されている場合があります</span>';
            $('dd li:nth-child(4)', copythis).html(price);
            $(copythis).attr({
                'data-ad-name' : res.price + '円:' + name,
                'data-ad-kind' : 'its'
                });
        });
    });
});
