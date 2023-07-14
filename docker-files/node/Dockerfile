FROM node:latest

# Set working directory
WORKDIR /var/www/optix

# ENV NODEUSER=optix
# ENV NODEGROUP=optix

# # create custom user
# RUN adduser -g ${NODEGROUP} -s /bin/sh -D ${NODEUSER}

ENTRYPOINT [ "docker-files/node/entrypoint.sh" ]