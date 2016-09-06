import time
import sys
from threading import Thread
import socket_functions as socket

class action_manuelle(Thread):

    def __init__(self, type_action):
        Thread.__init__(self)
        self.type_action = type_action

    def run(self):
        socket.
