FROM node:18 AS builder

WORKDIR /var/www/frontend

COPY package.json yarn.lock ./

RUN yarn install

COPY . .

RUN yarn build

FROM nginx:alpine

COPY --from=builder /var/www/frontend/dist /usr/share/nginx/html

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]
