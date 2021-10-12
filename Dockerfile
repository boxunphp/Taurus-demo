FROM imarno/taurus-demo:v0.0.1
MAINTAINER Arno.Zheng@gmail.com

# Set basicly runtime
## Set expose and entrypoint
EXPOSE 80
ENTRYPOINT ["/sbin/entrypoint.sh"]

## Make runtime folders
RUN mkdir -p /www/privdata/examples.com/tmp/ /www/privdata/examples.com/logs/ /www/examples.com/ \
     && chmod 777 -R /www/privdata/examples.com

## Copy shell binary
COPY ./assets/docker/script /root/script

## 暂时保留线上matrix的路径
COPY ./assets/docker/script/sh/docker_shutdown.sh /root/sh/docker_shutdown.sh
RUN chmod +x /root/sh/docker_shutdown.sh

## Copy entrypoint
COPY ./assets/docker/script/sh/entrypoint.sh /sbin/entrypoint.sh
RUN chmod +x /sbin/entrypoint.sh

# ********* Copy configs ***********
## nginx配置
COPY ./assets/docker/nginx/conf /usr/local/nginx/conf
RUN mkdir -p /usr/local/nginx/conf/server.bak/
RUN mv /usr/local/nginx/conf/server/* /usr/local/nginx/conf/server.bak/

## php配置
COPY ./assets/docker/php/etc /usr/local/php7/etc

# ********* Copy code ***********
COPY ../ /www/examples.com/
