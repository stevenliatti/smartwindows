import random
import time
import sys
from threading import Thread, Lock
import socket_functions as socket
import ClientSocket as main_file
import database_functions as db_conn

verrou = Lock()

## thread pour la reception des donnees de la carte waspmote et les enregistrer l'etat dans la base
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
                else:
                    print "Donnees refusees!!!"

## thread pour la reception des nouvelles configurations venant de l'application web
## et les envoyer a la carte waspmote
class reception_web(Thread):

    def __init__(self, ip, port, ip_web, port_web):
        Thread.__init__(self)
        self.ip = ip
        self.port = port
        self.ip_web = ip_web
        self.port_web = port_web
        
        self.sock_web = socket.socket_web_open(self.ip_web, self.port_web)
    def run(self):

        while 1:
            with verrou:
                self.sock_web.listen(1)
                conn, addr = self.sock_web.accept()

                config = conn.recv(1024)
                print config.decode("utf-8")
                ## spliter le message dans un tableau a 3 cases
                ## 1ere case contient le mode : "a" pour auto et "m" pour manuel
                ## 2eme case l'etat de la fenetre : "o" pour ouvrir et "c" pour fermer
                ## 3eme case l'etat du store : un chiffre de "0", "1", "2", ..., "9", "t" ("t" pour 10)

                if (config != ""):
                    ch = config.split(":")
                    sock = socket.socket_open(self.ip, self.port)
                    sock.send(ch[0])
                    if (ch[0] == "m"):
                        sock.send(ch[1])
                        sock.send(ch[2])

                    socket.socket_close(sock)
                # sock.send("m")
                # sock.send("o")
                # sock.send("t")

                # time.sleep(20)
                # sock.send("c")
                # sock.send("0")

                # time.sleep(20)

        socket.socket_close(self.sock_web)
