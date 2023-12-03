<x-guest-layout>
    <section id="secbody" style="width: 100%; height: 100vh; background-image: url({{config('app.url')}}/img/bandera-pfj-3-compr.gif)">
        {{-- <section id="secbody" style="width: 100%; height: 100vh; background-image: url({{config('app.url')}}/img/bandera-pfj---.gif)"> --}}

    {{-- <x-jet-authentication-card>
        <x-slot name="logo">
            <div id="inicio" class="pt-16">
            </div>
            <div class="text-center">
                <x-jet-authentication-card-logo />
            </div>
            <div class="text-center">
                <img src="{{ config('ap-url') }}/img/lima_norte_2024.png" class="m-auto" width="50%" alt="">
            </div>
            
        </x-slot>

        
    </x-jet-authentication-card> --}}
    <div id="inicio" class="pb-16">
        <div id="contadorr" class="simply-countdown simply-countdown-one"></div>
    </div>

    </section>
    <style>
        .simply-countdown {
            overflow: auto;
        }
        .simply-countdown > .simply-section {
            display: inline-block;
            width: 75px;
            height: 75px;
            background: #E4285F;
            margin: 0 4px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            -ms-border-radius: 50%;
            border-radius: 50%;
            position: relative;
            animation: pulse 1s ease infinite;
            padding: 0
        }
        .simply-section div{
            width: 75px;
            height: 75px;
            color: white;
            font-weight: bold;
            font-size: 15px;
            display: table-cell;
            vertical-align: middle;
        }
        * {
            scroll-behavior: smooth;
        }

        #inicio{
            position: absolute;
            width:100%;
            bottom: 75px;
        }
        #inicio div{
            margin:auto;
        }
        #secbody{
            background-position: center;
            background-size: contain
        }
        @keyframes pulse{
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }   
    </style>
    <script src="{{ config('app.url') }}/css/simplyCountdown/dist/simplyCountdown.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script>
        var temp_image = ''
        let stateCheck = setInterval(() => {
            if (document.readyState === 'complete') {
                clearInterval(stateCheck);
                // document ready
                console.log("ready!");


                simplyCountdown('#contadorr', {
                    year: 2023, // required
                    month: 12, // required
                    day: 03, // required
                    hours: 17, // Default is 0 [0-23] integer
                    minutes: 0, // Default is 0 [0-59] integer
                    seconds: 0, // Default is 0 [0-59] integer
                    words: { //words displayed into the countdown
                        days: {
                            singular: 'day',
                            plural: 'days'
                        },
                        hours: {
                            singular: 'hour',
                            plural: 'hours'
                        },
                        minutes: {
                            singular: 'minute',
                            plural: 'minutes'
                        },
                        seconds: {
                            singular: 'second',
                            plural: 'seconds'
                        }
                    },
                    plural: true, //use plurals
                    inline: false, //set to true to get an inline basic countdown like : 24 days, 4 hours, 2 minutes, 5 seconds
                    inlineClass: 'simply-countdown-inline', //inline css span class in case of inline = true
                    // in case of inline set to false
                    enableUtc: false,
                    onEnd: function() {
                        window.location.href = "https://www.churchofjesuschrist.org/youth/childrenandyouth/fsy/sessions?country=pe&lang=spa";
                        console.log('fiiiin')
                        return;
                    },
                    refresh: 1000, //default refresh every 1s
                    sectionClass: 'simply-section', //section css class
                    amountClass: 'simply-amount', // amount css class
                    wordClass: 'simply-word', // word css class
                    zeroPad: false,
                    countUp: false, // enable count up if set to true
                });

                // Also, you can init with already existing Javascript Object.
                let myElement = document.querySelector('.my-countdown');
                simplyCountdown(myElement, {
                    /* options */ });

                let multipleElements = document.querySelectorAll('.my-countdown');
                simplyCountdown(multipleElements, {
                    /* options */ });

            }
        }, 100);
    </script>
</x-guest-layout>
