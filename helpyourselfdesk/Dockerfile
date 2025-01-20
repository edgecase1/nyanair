FROM node

#RUN apt-get update -y && apt-get install  -y

WORKDIR /app
COPY package*.json ./
RUN npm install
COPY server.js /app/

EXPOSE 3333

CMD [ "node", "server.js" ]

