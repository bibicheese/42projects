#!/bin/bash

apt-get update && apt-get upgrade > /var/log/update_script.log

#crontab -e 0 4 * * 1 sh /home/bibi/update.sh
#plus le foutre dans init.d pour le reboot