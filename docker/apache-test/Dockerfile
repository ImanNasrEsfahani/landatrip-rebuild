FROM httpd:2.4
RUN sed -i \
    -e 's/^#LoadModule socache_shmcb_module /LoadModule socache_shmcb_module /' \
    -e 's/^#LoadModule proxy_module /LoadModule proxy_module /' \
    -e 's/^#LoadModule proxy_http_module /LoadModule proxy_http_module /' \
    -e 's/^#LoadModule ssl_module /LoadModule ssl_module /' \
    /usr/local/apache2/conf/httpd.conf \
    && printf '\nInclude conf/extra/landatrip.conf\n' >> /usr/local/apache2/conf/httpd.conf
