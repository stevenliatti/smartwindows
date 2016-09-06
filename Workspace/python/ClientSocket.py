import MySQLdb
import time
import socket_functions as socket
import used_thread as thread 

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

    
    while 1:
   ##sock = socket.socket_open(ip, port)

        
        th_action = thread.action_manuelle()
        th_reception = thread.reception(triple_data)

        data_list.append(triple_data)
        triple_data = []
        
        th_action.start()
        th_reception.start()
        
##        triple_data = socket_m.reception_socket(sock, ip, port)
        
        

##        date_now = "%d-%d-%d" % (time.localtime().tm_year,time.localtime().tm_mon,time.localtime().tm_mday)
##        time_now = "%d:%d:%d" % (time.localtime().tm_hour,time.localtime().tm_min,time.localtime().tm_sec)
##        db = database_open("localhost", "root", "", "smartwindows")
##        insert_data(db, triple_data[0], triple_data[2], triple_data[1])
##        database_close(db)

        
        th_reception.join()
        th_action.join()
        
        
    ##socket.socket_close(sock)
