<html>
<head>
    <title>
        Tiny Tables
    </title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="icon" href="/img/single-projects/tiny-tables/tiny_table_orange.png" type="image/gif" sizes="16x16">
    <style>
        body{
            display: table;
            height: 100%;
            width: 100%;
            background: #f39c12;
        }
        div{
            display: table-cell;
            width: 100%;
            height: 100%;
            vertical-align: middle;
            text-align: center;
        }
        .form-control{
            display: inline;
            width: 50%;
            text-align: center;
            background-color: #f39c12;
            border: 1px solid white;
            height: 100%;
        }
        div, .form-control{
            font-size: 128px;
            color: white;
        }
        .form-control:focus{
            border-color: white;
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            box-shadow: none;
        }
        img{
            margin-top: -.2em;
            height: .75em;
        }
    </style>
</head>

<body>

    <div id="tinyTables"></div>

</body>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.2.6/vue.min.js"></script>

<script>
    var vm = new Vue({
        el: '#tinyTables',

        template: "<div>" +
        "<input @keyup='calcTinyTables(input)' v-model='input' class='form-control'> ft" +
        "<p> @{{ output }} </p> " +
        "<img src='/img/single-projects/tiny-tables/tiny_table.png'>" +
        "<span v-show='output>1'>'s</span></p>" +
        "<p>@{{ output/1000*9 | currency }}</p>" +
        "</div>",

        data: {
            input: '',
            output: 0,
        },

        methods: {
            calcTinyTables: function (input) {
                var inches = input * 12;
                var tinyTables = Math.floor(inches/1.625);

                var output = 0;

                for(var i = tinyTables; i >=1; i--) {
                    output += i*i;
                }

                this.output = output;
            },
        }
    });

    Vue.filter('currency', function (val) {
        return "$" + val.toFixed(2);
    });


</script>
</html>
