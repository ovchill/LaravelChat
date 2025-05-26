ARG NODE_VERSION=24

FROM node:${NODE_VERSION}-alpine AS webpack

WORKDIR /var/www/html

COPY --link package.json package-lock.json webpack.mix.js ./

RUN npm install

CMD npm run hot
