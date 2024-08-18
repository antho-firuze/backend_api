# backend_api

Using Workerman/Webman, a high-performance PHP Application Container.

## Note

This backend only use pure PHP which has been enhanced. And does not need webserver (nginx, apache etc.) again.

This PHP support for asyncronous process, multi-process, Epool and Non-blocking IO. And also can maintain tens of thousands of concurrent connections.

Because it is resident in memory, thus it has ultra-high performance. Same as golang and event better for speed.

It also support multi communication protocols like TCP, UDP, UNIXSOCKET, long connection, SSE, Websocket, HTTP and HTTPS, WS and WSS, MQTT and other various custom protocols.

Reference: 
https://www.dbestech.com/tutorials/php-websocket-workerman

## Setup

- `git clone https://github.com/antho-firuze/backend_api.git`
- `cd backend_api`
- `docker-compose up -d` for the first using `docker-compose up -d --build`
- `docker-compose down` <== for stop 

## For more info

Please contact me antho.firuze@gmail.com
