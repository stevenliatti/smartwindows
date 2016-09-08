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
        ip, port = "192.168.178.241", 2000
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
        ip, port = "192.168.178.241", 2000
        
        while True:
            data_dic = {}
            with verrou:
                sock = socket.socket_open(ip, port)
                data_dic = socket.reception_socket(sock)
                self.data_queue.put(data_dic)
                socket.socket_close(sock)
