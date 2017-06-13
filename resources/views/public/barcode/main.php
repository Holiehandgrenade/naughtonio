<?php
require 'PDF_Code128.php';

$text = $_POST['text'];
$offsetX = $_POST['offsetX'];
$offsetY = $_POST['offsetY'];
$width = $_POST['width'];
$height = $_POST['height'];
$gap = $_POST['gap'];
$fontSize = $_POST['fontSize'];

if(isset($_POST['withText'])) {
    $withText = true;
}else{
    $withText = false;
}

$config = [
    'text' => $text,
    'offsetX' => $offsetX,
    'offsetY' => $offsetY,
    'width' => $width,
    'height' => $height,
    'gap' => $gap,
    'fontSize' => $fontSize,
    'withText' => $withText
];

barcodeize($config);


function barcodeize($config)
{
    $text = removeApostrophes($config['text']);
    $initialX = $config['offsetX'];
    $initialY = $config['offsetY'];
    $width = $config['width'];
    $height = $config['height'];
    $gap = $config['gap'];
    $wordsPerPage = 297 / ($height + $gap);
    $fontSize = $config['fontSize'];
    $withText = $config['withText'];
    $date = date_create('UTC');
    $fileName = 'pdfs/' . date_timestamp_get($date) . ".pdf";

    $pdf=new PDF_Code128();
    $pdf->SetFont('Arial', '', $fontSize);

    $words = buildArray($text);

    drawBarcodes($words, $pdf, $withText, $wordsPerPage, $gap, $initialX, $initialY, $width, $height);

    // F = file
    $pdf->Output('F', $fileName);

    header("Location: ".$fileName);
}



// helpers
function buildArray($text)
{
    return explode(" ", $text);
}

function writeBarcode($pdf, $withText, $x, $y, $word, $width, $height)
{
    // thank you source guy
    $pdf->Code128($x, $y, $word, $width, $height);

    if($withText) {
        $pdf->SetXY($x + $width + 15, $y+($height/2));
        $pdf->Write(5, $word);
    }
}

function drawBarcodes($words, $pdf, $withText, $wordsPerPage, $gap, $initialX, $initialY, $width, $height)
{
    $counter = 0;
    foreach ($words as $word) {
        if($counter % $wordsPerPage == 0){
            $x = $initialX; $y = $initialY;
            $pdf->AddPage();
        }

        writeBarcode($pdf, $withText, $x, $y, $word, $width, $height);

        $y = ($y + $height + $gap); $counter++;
    }
}

function removeApostrophes($text)
{
    // different apostrophe codes? and other bad codes
    $text = str_replace("'", "", $text);
    $text = str_replace("…", ".", $text);
    $text = str_replace("’", "", $text);
    return $text;
}