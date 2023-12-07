FROM node:18.17.1-alpine as dependencies

COPY ./package.json /app/package.json
COPY ./yarn.lock /app/yarn.lock

WORKDIR /app

RUN yarn install

FROM dependencies as run

WORKDIR /app
CMD yarn run dev