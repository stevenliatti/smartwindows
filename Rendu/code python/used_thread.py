import random
import time
import sys
from threading import Thread, RLock
import socket_functions as socket
import ClientSocket as main_file
import database_functions as db_conn

verrou = RLock()

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
				# 7 = nombre de donnees utiles recues depuis le wifly
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

	def __init__(self, ip, port):
		Thread.__init__(self)
		self.ip = ip
		self.port = port
	
	def run(self):
		while 1:
			with verrou:
				print "connexion base de donnee au niveau du thread"
				#self.sock_web.listen(1)
				#conn, addr = self.sock_web.accept()

				#config = conn.recv(1024)
				#print config.decode("utf-8")
				## spliter le message dans un tableau a 3 cases
				## 1ere case contient le mode : "a" pour auto et "m" pour manuel
				## 2eme case l'etat de la fenetre : "o" pour ouvrir et "c" pour fermer
				## 3eme case l'etat du store : un chiffre de "0", "1", "2", ..., "9", "t" ("t" pour 10)
				db = db_conn.database_open(main_file.database_ip, main_file.mysql_username, main_file.mysql_password, main_file.database_name)
				last_state = db_conn.get_last_state(db)
			
				print "last_state[1] : " + last_state[1]
				print "main_file.current_M : " + main_file.current_M
				print "last_state[2] : " + last_state[2]
				print "main_file.current_WS : " + main_file.current_WS
				print "last_state[3] : " + last_state[3]
				print "main_file.current_BL : " + main_file.current_BL
				if main_file.current_M != last_state[1] or main_file.current_WS != last_state[2] or main_file.current_BL != last_state[3]:
					mode = "m" if last_state[1] == "1" else "a"
				
					win = "c" if last_state[2] == "0" else "o"
				
					blind = last_state[3] if last_state[3] != "10" else "t"
					
					print "mode : " + mode + " -  win : " + win + " - blind : " + blind
				
					sock = socket.socket_open(self.ip, self.port)
					sock.send(mode)
					print "******* envoie du mode"
				
					sock.send(win)
					sock.send(blind)
					print "envoie etat termine*********************************************************"

					socket.socket_close(sock)
			
				db_conn.database_close(db)
			time.sleep(10)
