#!/bin/bash

apt-get update && apt-get upgrade > /var/log/update_script.log

#crontab -e (root) 0 4 * * 1 sh /root/update.sh
#plus le foutre dans init.d pour le reboot