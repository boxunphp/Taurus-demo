#!/bin/bash

for p in `git --no-pager log --name-only -n 20 | grep -E ".php$"`
do
    if [[ -f "$p" ]];then
        php -d display_errors=on -l $p
        if [[ $? -ne 0 ]];then
            echo "php语法检测异常"
            exit 1
        fi
    fi
done
