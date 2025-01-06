FROM python:3.9-slim-buster

WORKDIR /app

RUN apt-get update -y && apt-get install -y gcc openssl libmariadb-dev iputils-ping curl && apt-get clean

#RUN apt-get update -y && apt-get install -y wget zip cmake make gcc python3-dev openssl libmariadb-dev libc-dev && apt-get clean
#COPY install-mariadb.sh ./
#RUN chmod +x ./install-mariadb.sh
#RUN ./install-mariadb.sh

# Install app dependencies
COPY requirements.txt ./
RUN pip3 install --no-cache-dir -r requirements.txt

# Bundle app source
COPY checkin.py /app/

EXPOSE 5000

ENV FLASK_APP=checkin
CMD [ "python3", "-m" , "flask", "run", "--host=0.0.0.0", "--port=5000"]
