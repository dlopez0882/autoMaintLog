FROM php:8

RUN echo "<?php\n"\
    "print 'Hello World!';\n"\
    "?>" > /opt/hello.php

CMD ["php", "/opt/hello.php"]