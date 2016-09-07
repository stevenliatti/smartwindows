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
    def __init__(self, triple_data):
        Thread.__init__(self)
        self.triple_data = triple_data

    def run(self):
        ip, port = "192.168.32.241", 2000
        with verrou:
            sock = socket.socket_open(ip, port)
            triple_data = []
            triple_data = socket.reception_socket(sock)      
            attente = 3
            attente += random.randint(1, 60) / 100
            time.sleep(attente)
            sys.stdout.flush()
            socket.socket_close(sock)

class save_data(Thread):
    def __init__(self, triple_data):
        Thread.__init__(self)
        self.triple_data = triple_data
