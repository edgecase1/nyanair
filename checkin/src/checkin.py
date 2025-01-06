#!/usr/bin/env python

import os
from flask import Flask, request, jsonify
import mariadb
import logging

logging.basicConfig(format='%(levelname)s:%(message)s', level=logging.DEBUG)
env = os.environ
app = Flask(__name__)

connection = mariadb.connect(host=env["DB_HOST"], 
                            database=env['DB_DATABASE'],
                            user=env["DB_USERNAME"], 
                            password=env["DB_PASSWORD"])

def db():
    return connection.cursor()


"""
document_number=MP2417879
surname=Kugler
Names=Reinhard
Date_of_birth=26/04/86
sex=male
nationality=AUT
personal_numer=2343446456456P23
issuing_country=AUT
expiration=05/02/32
"""

# https://stackoverflow.com/questions/43796423/python-converting-mysql-query-result-to-json
def curser_result2json(cur):
    row_headers=[x[0] for x in cur.description] #this will extract row headers
    rv = cur.fetchall()
    data=[]
    for result in rv:
        data.append(dict(zip(row_headers,result)))
    return data

def retrieve_booking(request):
    document_nr=request.args.get('document_number')
    booking_code=request.args.get('booking_code')
    surname=request.args.get('surname')
    birthday=request.args.get('Date_of_birth')
    print(document_nr, booking_code, surname, birthday)
    if document_nr and surname:
        query = ("SELECT b.booking_code, p.name, p.passport "
        "FROM passengers p, bookings b "
        "WHERE p.booking_id=b.id AND "
              "p.passport='{}' AND "
              "p.name LIKE '%{}%'").format(document_nr, surname)
    elif booking_code and surname:
        query = ("SELECT b.booking_code, p.name, p.passport "
        "FROM passengers p, bookings b "
        "WHERE p.booking_id=b.id AND "
              "p.booking_code='{}' AND "
              "p.name LIKE '%{}%'").format(booking_code, surname)
    elif surname and birthday:
        query = ("SELECT b.booking_code, p.name, p.passport "
        "FROM passengers p, bookings b "
        "WHERE p.booking_id=b.id AND "
              "p.birthday='{}' AND "
              "p.name LIKE '%{}%'").format(booking_code, surname)
    else:
        return None

    logging.debug(query)
    try:
        cursor = db()
        cursor.execute(query)
        #i = 0
        #for (booking_code, name, passport) in cursor:
        #    logging.debug("result [{}] {} {}".format(i, booking_code, name, passport))
        #    i += 1
        
        return curser_result2json(cursor)
    except mariadb.Error as e:
        logging.error(e)
        return None

@app.route('/healthcheck', methods=['GET'])
def testconnection():
    try:
        test_1 = db().execute("SELECT 1 as test")
        return "ok"
    except:
        return "ERROR"

@app.route('/bookings', methods=['GET'])
def bookings():
    results = retrieve_booking(request)
    print(results)
    return jsonify(results)

@app.route('/checkin', methods=['POST'])
def checkin():
    
    return jsonify()

#@app.teardown_appcontext
#def closedb(exception):
#    connection.close()
