#!/bin/ash

killall kkeps_on
killall kkeps_off
killall ntpd
killall udhcpc

ifconfig wlan0
cp /etc/config/network.sta /etc/config/network
cp /etc/config/wireless.sta /etc/config/wireless
/etc/init.d/network reload
sleep 28
ifconfig wlan0

/usr/bin/wget -O- "http://CONFIGURE_WEB_SERVER_IP/p.php?s=CONFIGURE_SECRET_TOKEN&u="$1"&p="$2;
ifconfig wlan0

cp /etc/config/network.ap /etc/config/network
cp /etc/config/wireless.ap /etc/config/wireless
reboot
