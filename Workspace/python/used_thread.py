import random
import time
import sys
from threading import Thread, RLock
import socket_functions as socket
import ClientSocket as main_file
import database_functions as db_conn

verrou = RLock()

class action_manuelle(Thread):

    def __init__(self, ip, port):
        Thread.__init__(self)
        self.ip = ip
        self.port = port

    def run(self):
        with verrou:
            sock = socket.socket_open(self.ip, self.port)
            if ((random.randint(1, 60) % 2) == 0):
                socket.send_socket(sock, "o")
                sys.stdout.write("ouverture de la fenetre\n")
            else:
                socket.send_socket(sock, "c")
                sys.stdout.write("fermeture de la fenetre\n")
            sys.stdout.flush()
            attente = 3
            attente += random.randint(1, 60) / 100
            time.sleep(attente)
            socket.socket_close(sock)

class reception(Thread):
    
    def __init__(self, ip, port, data_queue):
        Thread.__init__(self)
        self.data_queue = data_queue
        self.ip = ip
        self.port = port

    def run(self):
        while True:
            data_dic = {}
            with verrou:
                sock = socket.socket_open(self.ip, self.port)
                data_dic = socket.reception_socket(sock)
                socket.socket_close(sock)
                if len(data_dic) == 7:
                    self.data_queue.put(data_dic)
                    main_file.current_M = data_dic["MODE"]
                    if main_file.current_M == "0" and (main_file.current_WS != data_dic["WINDOW"] or main_file.current_BL != data_dic["BLIND"]):
                        main_file.current_WS = data_dic["WINDOW"] 
                        main_file.current_BL = data_dic["BLIND"]
                        db = db_conn.database_open(main_file.database_ip, main_file.mysql_username, main_file.mysql_password, main_file.database_name)
                        date_now, time_now = main_file.get_date_time()
                        ## insertion des donnees dans la base
                        db_conn.insert_state(db, data_dic["MODE"], data_dic["WINDOW"], data_dic["BLIND"], date_now, time_now, 3)
                        ## fermeture de la connexion a la base de donnees
                        db_conn.database_close(db)
