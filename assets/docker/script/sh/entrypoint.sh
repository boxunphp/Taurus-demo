#!/bin/bash
source /etc/profile
/bin/env > /etc/environment
LOG_STREAM=/dev/mtstdout
mkfifo $LOG_STREAM && chmod 777 $LOG_STREAM

#针对local环境，把容器里的目录 mount到主机的代码目录 方便在主机上改代码实时生效
if [ -d "/code_root" ];then
  rm -rf /www/examples.com
  ln -s /code_root /www/examples.com
fi


#******决定是否启动web服务******
cp /usr/local/nginx/conf/server.bak/www.examples.com.conf /usr/local/nginx/conf/server/
echo "127.0.0.1 www.examples.com" >> /etc/hosts
echo "启动Web";

cp /usr/local/nginx/conf/server.bak/api.examples.com.conf /usr/local/nginx/conf/server/
echo "127.0.0.1 api.examples.com" >> /etc/hosts
echo "启动Api";

cp /usr/local/nginx/conf/server.bak/admin.examples.com.conf /usr/local/nginx/conf/server/
echo "127.0.0.1 admin.examples.com" >> /etc/hosts
echo "启动Admin";

/usr/local/nginx/sbin/nginx -g 'daemon off;' &
echo "启动nginx";

/usr/local/php7/sbin/php-fpm -R -F -y /usr/local/php7/etc/pool.d/www.conf -g /usr/local/php7/var/run/www.pid &
echo "启动php-fpm";

#定时任务
/usr/sbin/crond start > /dev/null
echo "启动crond"

#输出日志给宿主机
tail -f $LOG_STREAM

