# html2pdf-html2image
Transfer html to pdf or image using htmltopdf.

## Requirements

### PHP7

###htmltopdf

```
cd /tmp
wget https://github.com/wkhtmltopdf/wkhtmltopdf/releases/download/0.12.4/wkhtmltox-0.12.4_linux-generic-amd64.tar.xz
tar xf wkhtmltox-0.12.4_linux-generic-amd64.tar.xz && rm wkhtmltox-0.12.4_linux-generic-amd64.tar.xz
ln -s -T /tmp/wkhtmltox/bin/wkhtmltopdf /usr/local/bin/wkhtmltopdf && \
chmod a+x /usr/local/bin/wkhtmltopdf &&  \
ln -s -T /tmp/wkhtmltox/bin/wkhtmltoimage /usr/local/bin/wkhtmltoimage && \
chmod a+x /usr/local/bin/wkhtmltoimage
```
Check and get help by `wkhtmltopdf -h` or `wkhtmltoimage -h`  
More information to see: https://wkhtmltopdf.org/

## Install

`composer require html2pdf/html2pdf-2image`

## Quick Start and Examples

```
require __DIR__ . '/vendor/autoload.php';

use \Html\Html2Pdf;
use \Html\Html2Image;

$html = '<html><head><title>export</title>......';
// or 
// $html = file_get_contents('http://google.com');

// Pdf
$generator = new Html2Pdf('/usr/local/bin/wkhtmltopdf');
$options = ['header'=>'Centered header text','footer'=>'Left aligned footer text'];
$generator->getOutputFromHtml($html, $options)

// Image
$generator = new Html2Image('/usr/local/bin/wkhtmltoimage');
$options = ['format'=>'png','width'=>'300','height'=>'1000'];
$generator->getOutputFromHtml($html, $options)
```
