<x-container>
    <div class="slider">
        <div class="slider-track space-x-3">

            <div class="slide">
                <div class="card">
                    <figure>
                        <img class="w-full object-cover" src="{{asset('img/welcome/pi.png')}}" alt="">
                    </figure>
                </div>
            </div>

            <div class="slide">
                <div class="card">
                    <figure>
                        <img class="w-full object-cover" src="{{asset('img/welcome/pi.png')}}" alt="">
                    </figure>
                </div>
            </div>

            <div class="slide">
                <div class="card">
                    <figure>
                        <img class="w-full object-cover" src="{{asset('img/welcome/pi.png')}}" alt="">
                    </figure>
                </div>
            </div>

            <div class="slide">
                <div class="card">
                    <figure>
                        <img class="w-full object-cover" src="{{asset('img/welcome/pi.png')}}" alt="">
                    </figure>
                </div>
            </div>

            <div class="slide">
                <div class="card">
                    <figure>
                        <img class="w-full object-cover" src="{{asset('img/welcome/pi.png')}}" alt="">
                    </figure>
                </div>
            </div>

            <div class="slide">
                <div class="card">
                    <figure>
                        <img class="w-full object-cover" src="{{asset('img/welcome/pi.png')}}" alt="">
                    </figure>
                </div>
            </div>

        </div>
    </div>
</x-container>

<style>
    .slider{
        width: 100%;
        height: auto;
        margin: auto;
        overflow: hidden;
    }

    .slider .slider-track{
        display: flex;
        animation: scroll 10s linear infinite;
        -webkit-animation: scroll 10s linear infinite;
        width: calc(410px * 6)
    }

    .slider .slide{
        width: 410px;
    }

    @keyframes scroll{
        0%{
            -webkit-transform: translatex(0);
            transform: translatex(0);

        }
        100%{
            -webkit-transform: translatex(calc(-410px * 3));
            transform: translatex(calc(-410px * 3));

        }
    }
</style>