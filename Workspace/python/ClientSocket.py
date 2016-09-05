import socket
import MySQLdb
import time

#socket connection
def socket_open():
    try:
        sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        sock.connect((ip, port))
        print "Ouverture de la socket"
        return sock
    except Exception as e:
        print "Impossible d'ouvrir la socket: {}".format(e)

#socket reception function
def reception_socket(sock, ip, port):
    try:
        response = sock.recv(4)
        while response != "DONE":
            response = sock.recv(4)

        date_now = "%d-%d-%d" % (time.localtime().tm_year,time.localtime().tm_mon,time.localtime().tm_mday)
        time_now = "%d:%d:%d" % (time.localtime().tm_hour,time.localtime().tm_min,time.localtime().tm_sec)
        print response + " on %s at %s" % (date_now, time_now)
        for i in range(3):
            response = sock.recv(1024)
            print format(response)
            data_array.append(response)
        return data_array, date_now, time_now
    except Exception as e:
        print "Impossible de se connecter au serveur: {}".format(e)
    finally:
        sock.close()

#database initialisation function
def database_open(ip, login, password, database_name):
    return MySQLdb.connect(ip, login, password, database_name)

#database close
def database_close(db):
    db.close()

#database data insertion function
def insert_data(db, temp_int, temp_ext, luminosity, date, time):
    sql_string = "INSERT INTO data(temp_int, temp_ext, luminosity, date, time) VALUES ('%s','%s','%s','%s','%s')" % (temp_int, temp_ext, luminosity, date, time)
    try:
        # prepare a cursor object using cursor() method
        cursor = db.cursor()
        # Execute the SQL command
        cursor.execute(sql_string)
        # Commit your changes in the database
        db.commit()
    except Exception as e:
        print format(e)
    #except:
        # Rollback in case there is any error
        #db.rollback()


data_array = []
date_now = ""
time_now = ""

#principal program
if __name__ == "__main__":

    ip, port = "192.168.32.241", 2000

    while 1:
        sock = socket_open()
        data_array, date_now, time_now = reception_socket(sock, ip, port)
        db = database_open("localhost", "root", "", "smartwindows")
        insert_data(db, data_array[0], data_array[2], data_array[1], date_now, time_now)
        data_array = []
        database_close(db)
