import random
import time
import sys
from threading import Thread, RLock
import socket_functions as socket

verrou = RLock()

class action_manuelle(Thread):

    def __init__(self):
        Thread.__init__(self)

    def run(self):
        ip, port = "192.168.32.241", 2000
        with verrou:
            sock = socket.socket_open(ip, port)
            if ((random.randint(1, 60) % 2) == 0):
                socket.send_socket(sock, "o")
                sys.stdout.write("ouverture\n")
            else:
                socket.send_socket(sock, "c")
                sys.stdout.write("fermeture\n")
            sys.stdout.flush()
            attente = 3
            attente += random.randint(1, 60) / 100
            time.sleep(attente)
            socket.socket_close(sock)

class reception(Thread):
    
    def __init__(self, data_queue):
        Thread.__init__(self)
        self.data_queue = data_queue

    def run(self):
        ip, port = "192.168.32.241", 2000
        
        while True:
            triple_data = []
            with verrou:
                sock = socket.socket_open(ip, port)
                triple_data = socket.reception_socket(sock)
                self.data_queue.put(triple_data)
                print "data_queue"
                print self.data_queue
                socket.socket_close(sock)

#         if (time.clock() - tl >= 30):
#             tl = time.clock()
#             date_now = "%d-%d-%d" % (time.localtime().tm_year,time.localtime().tm_mon,time.localtime().tm_mday)
#             time_now = "%d:%d:%d" % (time.localtime().tm_hour,time.localtime().tm_min,time.localtime().tm_sec)
#             to_be_saved = average_data(data_list)
# ##            db = database_open("localhost", "root", "", "smartwindows")
# ##            insert_data(db, to_be_saved[0], to_be_saved[2], to_be_saved[1])
# ##            database_close(db)
#             data_list = []
        
#             attente = 3
#             attente += random.randint(1, 60) / 100
#             time.sleep(attente)
#             sys.stdout.flush()
