FROM nginx:stable-alpine

# Set env timezone
ARG TZ='America/Sao_Paulo'
ENV DEFAULT_TZ ${TZ}

# Install Bash and Nano.
RUN apk update && apk add bash nano

# Set timezone
RUN apk upgrade --update \
    && apk add -U tzdata \
    && cp /usr/share/zoneinfo/${DEFAULT_TZ} /etc/localtime \
    && apk del tzdata \
    && rm -rf \
    /var/cache/apk/*

# Copy nginx conf to container.
ADD ./conf/default.conf /etc/nginx/conf.d/default.conf
