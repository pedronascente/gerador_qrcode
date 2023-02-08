<?php
/**
 * @created      24.12.2017
 * @author       Smiley <smiley@chillerlan.net>
 * @copyright    2017 Smiley
 * @license      MIT
 */

namespace chillerlan\QRCodeExamples;

use chillerlan\QRCode\{QRCode, QROptions};
use chillerlan\QRCode\Data\QRMatrix;
use chillerlan\QRCode\Common\EccLevel;
use Throwable;

require_once './vendor/autoload.php';

$data = isset($_GET['msg'])? $_GET['msg'] : '?msg=digite sua mensagem aqui';

$options = new QROptions([
	'version'             => 7,
	'outputType'          => QRCode::OUTPUT_IMAGE_PNG,
	'eccLevel'            => EccLevel::L,
	'scale'               => 10,
	'imageBase64'         => false,
	'imageTransparent'    => true,
	//'drawCircularModules' => true,
	//'circleRadius'        => 0.4,
	'keepAsSquare'        => [QRMatrix::M_FINDER|QRMatrix::IS_DARK, QRMatrix::M_FINDER_DOT, QRMatrix::M_ALIGNMENT|QRMatrix::IS_DARK],

	
]);

try{
	$im = (new QRCode($options))->render($data);
}
catch(Throwable $e){
	exit($e->getMessage());
}

header('Content-type: image/png');

echo $im;

