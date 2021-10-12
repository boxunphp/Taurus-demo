#!/bin/bash
mtstdout=`ps aux|grep "/dev/mtstdout"|grep -v 'grep'|awk '{print $2}'`
touch /tmp/docker_shutdown.switch
sleep 20
/usr/local/nginx/sbin/nginx  -s stop
while true; do
	V_NGINX_NUM=`ps aux|grep 'nginx'|grep -v 'grep' |wc -l`
	if [ $V_NGINX_NUM -gt 0 ]; then
		echo "NGINX还有流量,请稍后"
		sleep 1
		continue
	else

		echo "NGINX已经没有流量,shutdown now"
	   	/usr/local/php7/sbin/www-fpm stop
	   	while true; do
	   		V_PHP_NUM=`ps aux|grep '\.php'|grep -v 'grep' |wc -l`
	   		if [ $V_PHP_NUM -gt 0 ];then
	   			echo "PHP还有流量,请稍后"
	   			sleep 1
	   			continue
	   		else
	   			echo "PHP已经没有流量,退出 now"
				kill  $mtstdout
			       sleep 3	
	   			exit
	   		fi
	   	done
    fi
done
