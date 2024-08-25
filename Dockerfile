FROM alpine:3.14
ENV TZ=Asia/Taipei
RUN apk add --update --no-cache nginx nginx-mod-http-brotli bind-tools bash bash-completion vim htop tzdata composer \
    php php-fpm php-opcache php-curl php-soap php-openssl php-json php-dom php-zip php-bcmath php-gd php-xmlreader php-iconv php-ctype php-fileinfo php-mbstring php-pdo_mysql php-pdo php-pdo_odbc php-cli php-session php-intl php-xml php-tidy php-mysqli php-pdo_dblib php-odbc php-xmlwriter php-tokenizer
WORKDIR /usr/share/nginx/html/
COPY . .
ADD docker-entrypoint.sh /usr/local/bin/
# CMD 指令會成為 ENTRYPOINT 的參數
CMD ["nginx", "-g", "daemon off;"]
ENTRYPOINT ["docker-entrypoint.sh"]
