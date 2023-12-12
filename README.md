# Image-converter
Image converter application

# Usage
```
<?php

use Devel96\Converter\ImageFacade;

ImageFacade::convertToWebp(__DIR__ . '/images/1.jpg');
```

Change quality

```
<?php

use Devel96\Converter\ImageFacade;

ImageFacade::convertToWebp(__DIR__ . '/images/1.jpg', 60);
```