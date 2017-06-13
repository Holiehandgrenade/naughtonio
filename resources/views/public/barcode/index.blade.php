<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Facebook share images -->
    <meta property="og:image" content="http://www.legalupcbarcodes.com/wp-content/uploads/wp-checkout/images/1-upc-barcode-1344272683.jpg"/>
    <meta property="og:image:secure_url" content="http://www.legalupcbarcodes.com/wp-content/uploads/wp-checkout/images/1-upc-barcode-1344272683.jpg" />
    <link rel="image_src" href"http://www.legalupcbarcodes.com/wp-content/uploads/wp-checkout/images/1-upc-barcode-1344272683.jpg"/>
    
    <title>Barcode PDF</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Styles -->
    <style>
        body{
            margin-top: 130px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">

        <form name="testForm" action="barcode" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="text" class="col-md-4 control-label">Text</label>
                <div class="col-md-5">
                    <input name="text" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="offsetX" class="col-md-4 control-label">Left Margin</label>
                <div class="col-md-5">
                    <input name="offsetX" value="10" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="offsetY" class="col-md-4 control-label">Top Margin</label>
                <div class="col-md-5">
                    <input name="offsetY" value="10" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="width" class="col-md-4 control-label">Width</label>
                <div class="col-md-5">
                    <input name="width" value="120" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="height" class="col-md-4 control-label">Height</label>
                <div class="col-md-5">
                    <input name="height" value="20" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="gap" class="col-md-4 control-label">Gap</label>
                <div class="col-md-5">
                    <input name="gap" value="5" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="fontSize" class="col-md-4 control-label">Font Size</label>
                <div class="col-md-5">
                    <input name="fontSize" value="10" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="withText" class="col-md-4 control-label">With Text</label>
                <div class="col-md-5">
                    <input name="withText" id="withText" type="checkbox" checked style="margin-top: 10px">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-5 col-md-offset-4">
                    <input type="submit" value="Submit" class="btn btn-default form-control">
                </div>
            </div>
        </form>

    </div>
</div>

</body>
</html>
