FROM nginx:stable-alpine

RUN mkdir -p /var/www/optix/public

# Set working directory
WORKDIR /var/www/optix

ADD docker-files/nginx/conf.d/app.conf /etc/nginx/conf.d/default.conf

ENV NGINXUSER=optix
ENV NGINXGROUP=optix

RUN sed -i "s/user www-data/user ${NGINXUSER}/g" /etc/nginx/nginx.conf

RUN adduser -g ${NGINXGROUP} -s /bin/sh -D ${NGINXUSER}


# add user ubuntu, add group ubuntu
# RUN useradd -rm -d /home/ubuntu -s /bin/bash -g root -G sudo,www-data -u 1000 ubuntu
# RUN groupadd ubuntu