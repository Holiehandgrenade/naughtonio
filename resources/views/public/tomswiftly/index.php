<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Scene Maker - Nerd or Die</title>
    <script src="/js/single-projects/tomswiftly/settings.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
    <script>
        function loadWebFont(fontToLoad) {
            WebFont.load({
                google: {
                    families: [fontToLoad]
                }
            });
        }

        loadWebFont(settings.fonts.primaryFont);
        loadWebFont(settings.fonts.subFont);
    </script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="/css/single-projects/tomswiftly/main.css">

    <link rel="icon" href="http://nerdordie.com/wp-content/uploads/2016/05/cropped-NoDFavicon-32x32.png" sizes="32x32"/>
    <link rel="icon" href="http://nerdordie.com/wp-content/uploads/2016/05/cropped-NoDFavicon-192x192.png" sizes="192x192"/>
    <link rel="apple-touch-icon-precomposed" href="http://nerdordie.com/wp-content/uploads/2016/05/cropped-NoDFavicon-180x180.png"/>
    <meta name="msapplication-TileImage" content="http://nerdordie.com/wp-content/uploads/2016/05/cropped-NoDFavicon-270x270.png"/>
</head>
<body>
<div id="scene">
    <div id="bg">
        <div id="frame" class="bg-accent">
            <div id="image">
                <img src="/img/single-projects/tomswiftly/Background/bg.png" onError="this.style.display='none';">
                <img src="/img/single-projects/tomswiftly/Background/bg.jpg" onError="this.style.display='none';">
            </div>
            <div id="video">
                <video width="100%" height="100%" autoplay loop muted>
                    <source src="/img/single-projects/tomswiftly/Background/bg.mp4" type="video/mp4">
                    <source src="/img/single-projects/tomswiftly/Background/bg.ogg" type="video/ogg">
                </video>
            </div>
            <div id="overlay"></div>
        </div>
    </div>

    <div id="branding">
        <div id="brandImg">
        </div>
        <span id="title" class="primaryFont"></span>
        <span id="subtitle" class="secondaryFont"></span>
    </div>

    <div id="updates">

        <div id="social">
            <div id="tw" class="item">
                <div class="network">
                    <div class="borderTop"></div>
                    <div class="icon"><i class="fa fa-twitter" aria-hidden="true"></i></div>
                    <div class="inner">
                        <div id="twitterHeader" class="socialHead primaryFont">Follow Me On Twitter</div>
                        <div id="twitter" class="socialName primaryFont"></div>
                    </div>
                </div>
            </div>
            <div id="fb" class="item">
                <div class="network">
                    <div class="borderTop"></div>
                    <div class="icon"><i class="fa fa-facebook" aria-hidden="true"></i></div>
                    <div class="inner">
                        <div id="facebookHeader" class="socialHead primaryFont">Find Me On Facebook</div>
                        <div id="facebook" class="socialName primaryFont"></div>
                    </div>
                </div>
            </div>
            <div id="in" class="item">
                <div class="network">
                    <div class="borderTop"></div>
                    <div class="icon"><i class="fa fa-instagram" aria-hidden="true"></i></div>
                    <div class="inner">
                        <div id="instagramHeader" class="socialHead primaryFont">Follow Me On Instagram</div>
                        <div id="instagram" class="socialName primaryFont"></div>
                    </div>
                </div>
            </div>
            <div id="yt" class="item">
                <div class="network">
                    <div class="borderTop"></div>
                    <div class="icon"><i class="fa fa-youtube" aria-hidden="true"></i></div>
                    <div class="inner">
                        <div id="youtubeHeader" class="socialHead primaryFont">Subscribe On YouTube</div>
                        <div id="youtube" class="socialName primaryFont"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div id="scheduleWrapper" style="width: 100%;">
        <div id="schedule">
            <div id="week" class="item2">
                <div class="day">
                    <div class="borderTop"></div>
                    <div class="inner">
                        <div class="scheduleHead primaryFont">Mon</div>
                        <div id="mon" class="scheduleTime primaryFont"></div>
                    </div>
                </div>
                <div class="day">
                    <div class="borderTop"></div>
                    <div class="inner">
                        <div class="scheduleHead primaryFont">Tue</div>
                        <div id="tue" class="scheduleTime primaryFont"></div>
                    </div>
                </div>
                <div class="day">
                    <div class="borderTop"></div>
                    <div class="inner">
                        <div class="scheduleHead primaryFont">Wed</div>
                        <div id="wed" class="scheduleTime primaryFont"></div>
                    </div>
                </div>
                <div class="day">
                    <div class="borderTop"></div>
                    <div class="inner">
                        <div class="scheduleHead primaryFont">Thu</div>
                        <div id="thu" class="scheduleTime primaryFont"></div>
                    </div>
                </div>
                <div class="day">
                    <div class="borderTop"></div>
                    <div class="inner">
                        <div class="scheduleHead primaryFont">Fri</div>
                        <div id="fri" class="scheduleTime primaryFont"></div>
                    </div>
                </div>
                <div class="day">
                    <div class="borderTop"></div>
                    <div class="inner">
                        <div class="scheduleHead primaryFont">Sat</div>
                        <div id="sat" class="scheduleTime primaryFont"></div>
                    </div>
                </div>
                <div class="day">
                    <div class="borderTop"></div>
                    <div class="inner">
                        <div class="scheduleHead primaryFont">Sun</div>
                        <div id="sun" class="scheduleTime primaryFont"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="list">
        <div id="one" class="event">
            <div class="borderLeft"></div>
            <div id="followName" class="name primaryFont">TomSwiftly&nbsp;</div>
            <div id="followLine" class="type secondaryFont"></div>
        </div>

        <div id="two" class="event">
            <div class="borderLeft"></div>
            <div id="tipName" class="name primaryFont">&nbsp;</div>
            <div id="tipLine" class="type secondaryFont"></div>
        </div>

        <div id="three" class="event">
            <div class="borderLeft"></div>
            <div id="bigTipName" class="name primaryFont">&nbsp;</div>
            <div id="bigTipLine" class="type secondaryFont"></div>
        </div>

        <div id="four" class="event">
            <div class="borderLeft"></div>
            <div id="subName" class="name primaryFont">&nbsp;</div>
            <div id="subLine" class="type secondaryFont"></div>
        </div>
    </div>

    <div id="countdown">
        <div id="timer">
            <div id="time" class="primaryFont"></div>
            <div id="message" class="secondaryFont">til’ the stream starts!</div>
            <div id="endMessage" class="primaryFont">Let's Go</div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.0.0.min.js" integrity="sha256-JmvOoLtYsmqlsWxa7mDSLMwa6dZ9rrIdtrrVYRnDRH0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.5/TweenMax.min.js"></script>

<script src="/js/single-projects/tomswiftly/main.js"></script>

<script type="text/javascript">

    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.text(minutes + ":" + seconds);

            if (--timer < 0) {
                timer = 0;
                $('#time').hide();
                $('#message').hide();
                $('#endMessage').html(settings.countdown.countdownOverMessage);
                $('#endMessage').css("display", "block");
            }
        }, 1000);
    }

    jQuery(function ($) {
        var timeOfCountdown = 60 * minutes,
            display = $('#time');
        startTimer(timeOfCountdown, display);
    });

    $("video").attr("loop","loop");
</script>

</body>
</html>