@extends('main')

@section('title', '| Homepage')

@section('content')
    <div class="row">
        <div class="col-md-12">
            Фильтра. Места: (категории) / Популярное / Кинотеатры / Бары / Рестораны <br>
            Фильтра. События: категории / Популряное(самое кликабельное) / Митинги / Домашине игры в покер / Путешествия на велосипеде
        </div>
        <div id="googleMap" style="width:100%;height:400px;"></div>
        <div class="col-md-12">
            <div id="map" style="width: 600px; height: 400px"></div>
        </div>
        <div class="col-md-3 col-md-offset-1">
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">

            @foreach($places as $place)
                <div class="main_place">
                    <p class="place_title_{{ $loop->iteration }}">{{ $place->title }}</p>
                    <p class="place_descr_{{ $loop->iteration }}">{!! $place->description !!}</p>
                    <p class="place_lat_{{ $loop->iteration }}">{{ $place->google_latitude }}</p>
                    <p class="place_lng_{{ $loop->iteration }}">{{ $place->google_longitude }}</p>
                </div>
                <hr>
            @endforeach

        </div>
    </div>
    {{--<button onclick="myFunction()">Try it</button>--}}

    {{--<script>--}}
        {{--function myFunction() {--}}
            {{--window.open("https://www.instagram.com/explore/tags/Зума/", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");--}}
        {{--}--}}
    {{--</script>--}}

    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript">
    </script>
    <script src="{{ asset('js/yandexmap.js') }}">
    </script>
    <script src="{{ asset('js/googlemap.js') }}">
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDeF9T6rl9y9rEVFcqRr3pU6CJEaRmqpQ&libraries=places"
            async defer>
    </script>
    {{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDeF9T6rl9y9rEVFcqRr3pU6CJEaRmqpQ&libraries=places&callback=myMap"></script>--}}

@stop