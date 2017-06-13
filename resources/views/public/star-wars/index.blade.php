<!DOCTYPE html>
<html>
<head>
    <title>Use the force, Luke</title>

    <link rel="shortcut icon" href="/img/single-projects/star-wars/vader.ico" type="image/x-icon" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <script type="text/javascript" src="/js/single-projects/star-wars/countdown.min.js"></script>
    <script type="text/javascript" src="/js/single-projects/star-wars/modernizr.min.js"></script>
    
    <script type="text/javascript">
        function update()
        {
            var timer = countdown( new Date(2019,6,1,0,0,0) );
            var content = '';
            if (timer.years > 0)
            {
                content += timer.years + ' years<br />';
            }
            if (timer.months > 0)
            {
                content += timer.months + ' months<br />';
            }
            if (timer.days > 0)
            {
                content += timer.days + ' days<br />';
            }
            if (timer.hours > 0)
            {
                content += timer.hours + ' hours<br />';
            }
            if (timer.minutes > 0)
            {
                content += timer.minutes + ' minutes<br />';
            }
            content += timer.seconds + ' seconds';

            $('#time-remaining').html(content);

            window.requestAnimationFrame(update);
        }

        $(function() {
            $('#time-table').height(window.innerHeight);
            update();

            $(document).on('keypress', playStarWars);

            $('#volume').on('click', playStarWars);
            
            Modernizr.on('videoautoplay', function(result) {
                if ( ! result )
                {
                    $('#time-table').bind('click', playStarWars);
                }
            });
        });

        function playStarWars( event )
        {
            var audio = $('#star-wars-theme')[0];

            if (event.keyCode === 32 || event.type === 'click') 
            {
                $('.volume').toggle();
                if (audio.paused === true)
                {
                    audio.play();
                }
                else
                {
                    audio.pause();
                }
            }
        }
    </script>

    <style>
        * {
            margin: 0;
        }

        h1 {
            text-align: center;
            font-weight: 100;
            font-size: 72px;
            font-family: 'Helvetica Neue';
            color: #AAA;
        }

        #note {
            text-align: center;
            font-weight: 100;
            font-family: 'Helvetica Neue';
            font-size: 36px;
            color: #CCC;
            /*margin-top: -25px;*/
        }

        #volume {
            position: absolute;
            bottom: 1px;
            right: 5px;
            color: #AAA;
        }

        ::selection {
            background: #eee;
        }

        ::-moz-selection {
            background: #eee;
        }
    </style>
</head>
<body>
    <table style="width: 100%;" id="time-table">
        <tbody>
            <tr>
                <td><h1 id="time-remaining"></h1><h2 id="note">until Star Wars Land</h2></td>
            </tr>
        </tbody>
    </table>

    <audio autoplay id="star-wars-theme">
        <source src="/music/single-projects/star-wars/star-wars.mp3" type="audio/mpeg">
    </audio>

    <div id="volume">
        <span id="volume-off" class="glyphicon glyphicon-volume-off volume" aria-hidden="true"></span>
        <span id="volume-on" class="glyphicon glyphicon-volume-up volume" aria-hidden="true" style="display: none;"></span>
    </div>
</body>
</html>