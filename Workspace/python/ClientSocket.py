import MySQLdb
import time
import socket_functions as socket


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


triple_data = []
data_list = []
date_now = ""
time_now = ""

#principal program
if __name__ == "__main__":

    ip, port = "192.168.32.241", 2000

    while 1:
        
        sock = socket.socket_open(ip, port)
        
        triple_data = socket.reception_socket(sock, ip, port)
        
        
        socket.socket_close(sock)
        
        db = database_open("localhost", "root", "", "smartwindows")
        insert_data(db, data_array[0], data_array[2], data_array[1], date_now, time_now)
        database_close(db)

        data_array = []
