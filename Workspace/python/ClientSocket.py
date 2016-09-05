import socket
import MySQLdb

ti_array=[]

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
def reception_socket(ip, port):
    try:
        sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        sock.connect((ip, port))

        response = sock.recv(4)
        while response != "DONE":
            response = sock.recv(4)

        print response
        for i in range(15):
            response = sock.recv(1024)
            print format(response)
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
    sql_string = "INSERT INTO user(temp_int, temp_ext, luminosity, date, time) VALUES ('%.2f','%.2f','%.2f','%s','%s')" % (temp_int, temp_ext, luminosity, date, time)
    try:
        # Execute the SQL command
        cursor.execute(sql)
        # Commit your changes in the database
        db.commit()
    except:
        # Rollback in case there is any error
        db.rollback()



#principal program
if __name__ == "__main__":
 
    ip, port = "192.168.32.241", 2000

    while 1:
        reception_socket(ip, port)
