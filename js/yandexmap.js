ymaps.ready(function () {
            var map = new ymaps.Map('map', {
                center: [55.650625, 37.62708],
                zoom: 10
            });
            var MyBalloonContentLayout = ymaps.templateLayoutFactory.createClass([
                '<div>',
                '<a target="_blank" onclick="openInstagram()">' + 'Instagram' + '</a><br/> ' +
                '<a target="_blank" onclick="openYandexPhoto()">' + 'Yandex photo' + '</a><br/> ' +
                '<a target="_blank" onclick="openGooglePhoto()">' + 'Google photo' + '</a><br/> ' +
                'WhatsApp: ' + '89147773355' + '<br/> '
                + 'Telegram: ' + 'liberty' + '<br/> ',
                '</div>'
            ].join(''), {
                build: function () {
                    MyBalloonContentLayout.superclass.build.call(this);

                    this._$element = $('div', this.getParentElement());
                    this._map = this.getData().geoObject.getMap();

                    this._setupListeners();
                },
                clear: function () {
                    this._clearListeners();

                    MyBalloonContentLayout.superclass.clear.call(this);
                },
                _setupListeners: function () {
                    this._$element.on('click', 'a', $.proxy(this._onTypeClick, this));
                },
                _clearListeners: function() {
                    this._$element.off('click');
                },
                _onTypeClick: function (e) {
                    e.preventDefault();
                    this._map.setType(e.target.id);
                }
            });

            // var placemark = new ymaps.Placemark([55.650625, 37.62708], {
            //     title: 'Север'
            //
            // }, {
            //     balloonContentLayout: MyBalloonContentLayout,
            //     hintContentLayout: ymaps.templateLayoutFactory.createClass(33)
            //     //balloonPanelMaxMapArea: 0
            // });
            //
            // map.geoObjects.add(placemark);
             var lat = $('.place_lat_1').text();
             var lng = $('.place_lng_1').text();
             /*получение всех кооридинат из php списка places со страницы с картой/
             recieive all coordinates from php places list from page with map*/
             $(".main_place").get().forEach(function(entry, index, array) {
                 console.log("INDEX" + (index + 1));
                 var lat = $('.place_lat_' + (index + 1)).text();
                 var lng = $('.place_lng_' + (index + 1)).text();
                 var placemark = new ymaps.Placemark([parseFloat(lat), parseFloat(lng)], {
                     title: 'Север'

                 }, {
                     balloonContentLayout: MyBalloonContentLayout,
                     hintContentLayout: ymaps.templateLayoutFactory.createClass(33)
                     //balloonPanelMaxMapArea: 0
                 });

                 map.geoObjects.add(placemark);
             });


             // var placemark = new ymaps.Placemark([parseFloat(lat), parseFloat(lng)], {
             //     title: 'Север'
             //
             // }, {
             //     balloonContentLayout: MyBalloonContentLayout,
             //     hintContentLayout: ymaps.templateLayoutFactory.createClass(33)
             //     //balloonPanelMaxMapArea: 0
             // });
             //
             // map.geoObjects.add(placemark);


        });

$(document).ready(function () {
    $("#bamboho").on('click', 'button.alert', function() {
        alert(1);
    });
});

 function openInstagram() {
     window.open("https://www.instagram.com/explore/tags/Зума/", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
 }

 function openYandexPhoto() {
     window.open("https://yandex.ru/images/search?text=Зума+Владивосток", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
 }

 function openGooglePhoto() {
     window.open("https://www.google.ru/search?q=russia&tbm=isch", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
 }