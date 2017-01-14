from webdevops/php-nginx:ubuntu-15.04

ENV WEB_DOCUMENT_ROOT /usr/share/nginx/html
ENV WEB_DOCUMENT_INDEX index.php

COPY application /usr/share/nginx/html
