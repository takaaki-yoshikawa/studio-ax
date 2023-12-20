document.addEventListener('DOMContentLoaded', function(){
    var map = null;
    var map_02 = null;
    var infowindow = new google.maps.InfoWindow();
    var gmarkers = [];
    var i = 0;
    function inicializar() {
        // 初期設定
        var option = {
            // ズームレベル
            zoom: 17,
            // 中心座標
            center: new google.maps.LatLng(34.6742855, 135.4983301),
            // タイプ (ROADMAP・SATELLITE・TERRAIN・HYBRIDから選択)
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map_canvas1"), option);
        google.maps.event.addListener(map, "click", function() {infowindow.close();});
        // ポイントの追加
        var point = new google.maps.LatLng(34.6742855, 135.4983301);
        var marker = create_maker(point, "<a href='#ttl01' class='map__a' target='_top'>フロント,St.3</a>");
        var point = new google.maps.LatLng(34.6741927, 135.4983943);
        var marker = create_maker(point, "<a href='#ttl02' class='map__a' target='_top'>St.1,St.2</a>");
        var point = new google.maps.LatLng(34.6729237, 135.4985751);
        var marker = create_maker(point, "<a href='#ttl03' class='map__a' target='_top'>St.A,St.B,St.C</a>");

        //二つ目の地図
        var latlng2 = new google.maps.LatLng(34.6462756,135.5140946);
        var myOptions = {
            zoom: 17,
            center: latlng2,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map_02 = new google.maps.Map(
            document.getElementById("map_canvas2"),  //二つ目の地図のIDを指定
            myOptions
        );
        var marker = new google.maps.Marker({
            position: latlng2,
            map: map_02,
            // icon: 'img/pin02.png',   //ピンの画像のディレクトリを指定
        });

        //三つ目の地図
        var latlng3 = new google.maps.LatLng(34.7781048,135.4947405);
        var myOptions = {
            zoom: 17,
            center: latlng3,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map_02 = new google.maps.Map(
            document.getElementById("map_canvas3"),  //二つ目の地図のIDを指定
            myOptions
        );
        var marker = new google.maps.Marker({
            position: latlng3,
            map: map_02,
            // icon: 'img/pin02.png',   //ピンの画像のディレクトリを指定
        });
    }
    function create_maker(latlng, html) {
        // マーカーを生成
        var marker = new google.maps.Marker({position: latlng, map: map});
        // マーカーをクリックした時の処理
        google.maps.event.addListener(marker, "click", function() {
            infowindow.setContent(html);
            infowindow.open(map, marker);
        });
        gmarkers[i] = marker;
        i++;
        return marker;
    }
    function map_click(i) {
        google.maps.event.trigger(gmarkers[i], "click");
    }
    google.maps.event.addDomListener(window, "load", inicializar);
});