#Image Resizer Class for PHP

**Example**

```php

// include resizer class
include './resizer.php';

// create new instance of resizer
$image = new Resizer('/path/to/original/image.jpg');

// call resize method with desired width and height
$image->resize(640, 360);

// save resized image
$image->save('/path/to/resized/image.jpg', 100);


```
