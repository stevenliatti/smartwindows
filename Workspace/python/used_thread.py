import random
import time
import sys
from threading import Thread, RLock
import socket_functions as socket

verrou = RLock()

class action_manuelle(Thread):

    def __init__(self, ip, port):
        Thread.__init__(self)
        self.ip = ip
        self.port = port

    def run(self):
        print "Lancement du thread d'envoie..."
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
        print "Lancement du thread de reception..."
        while True:
            data_dic = {}
            with verrou:
                sock = socket.socket_open(self.ip, self.port)
                data_dic = socket.reception_socket(sock)
                self.data_queue.put(data_dic)
                socket.socket_close(sock)
