# evil-plug-weaponizer

This is the server side and client side source code for the "Smart Plug, Evil Plug" hacking demo. 

Affected Device is Kankun/Konke smart plug.

Vulnerability is "Konke Smart Plug K - Authentication Bypass Vulnerability" found here https://www.exploit-db.com/exploits/35103/ 

The scripts in this repository are meant to weaponize the Smart Plug and help you set up the server side dashboard. 
Once set up and plugged in, the smart plug will scan for wireless networks in its vecinity, randomly clone one of them, implement DNS poisoning and fake Facebook captive portal to perform phishing. 
Once credentials are submitted, the plug is supposed to switch from AP to STA mode and connect to an open WiFi network and send stolen credentials over a DNS request, however for the purpose of the demo, I had the plug connect to my phone's hotspot, so the prior needs to be programmed in.

How to set up:

Server:
1. Set up a basic linux server with apache php and mysql (install razor framwork for dashboard creation)
2. Setup mysql DB and schema as per screenshot in server folder
3. Copy server files on the web server and update their DB settings and secret token values

Client:
1. Copy all files to the smart plug 
2. Run setup.sh
3. Configure /etc/config/wireless.sta with your phone's hotspot settings (or feel free to implement the open-wifi scan and dns-request send part)
