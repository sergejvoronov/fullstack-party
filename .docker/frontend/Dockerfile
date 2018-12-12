FROM node:9.10.0

# Install dependencies
RUN apt-get update \
 && apt-get install -y git \
 && rm -rf /var/lib/apt/lists/*

ENV HOME /code

WORKDIR /code
VOLUME /code

CMD '/bin/bash'
