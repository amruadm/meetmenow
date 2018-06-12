 ymaps.ready(function () {
            var map = new ymaps.Map('map', {
                center: [55.650625, 37.62708],
                zoom: 10
            });
            var MyBalloonContentLayout = ymaps.templateLayoutFactory.createClass([
                '<div>',
                '<button id="trete"  onclick="myfunction()">gfgdgd</button>',
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

            var placemark = new ymaps.Placemark([55.650625, 37.62708], {
                title: 'Север'

            }, {
                balloonContentLayout: MyBalloonContentLayout,
                hintContentLayout: ymaps.templateLayoutFactory.createClass(33)
                //balloonPanelMaxMapArea: 0
            });

            map.geoObjects.add(placemark);


        });

        $(document).ready(function () {
            $("#bamboho").on('click', 'button.alert', function() {
                alert(1);
            });
        });


        function myfunction() {
            window.open("https://www.instagram.com/explore/tags/Зума/", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
        }