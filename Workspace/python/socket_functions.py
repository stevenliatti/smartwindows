import socket

## socket connection
def socket_open(ip, port):
	print "Ouverture du socket..."
	try:
		sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
		sock.connect((ip, port))
		print "Socket ==> ouvert"
		return sock
	except Exception as e:
		print "Impossible d'ouvrir le socket: {}".format(e)

## socket reception message function
def reception_socket(sock):
	## declaration du dictionnaire
	data_dic = {}
	try:
		##pour recevoir *HELLO*
		response = sock.recv(7)
		##pour recevoir le DONE
		print "Wifly : Donnees inutiles :"
		response = sock.recv(4)
		while response != "DONE":
			response = sock.recv(4)
			print response

		print "Wifly : Debut de la reception..."
		## le message va etre sous la forme "param:valeur"
		for i in range(4):
			response = sock.recv(1024)
			print format(response)
			## spliter le message dans un tableau a deux cases
			## 1ere case contient le nom du parametre, 2eme case sa valeur
			ch = response.split(":")
			## enregistrement dans le dictionnaire
			if (len(ch) == 2):
				data_dic[ch[0]] = float(ch[1])
		## les messages pour les etats
		for i in range(3):
			response = sock.recv(1024)
			print format(response)
			## spliter le message dans un tableau a deux case
			## 1ere case contient le nom du parametre, 2eme case sa valeur
			ch = response.split(":")
			## enregistrement dans le dictionnaire
			if (len(ch) == 2):
				data_dic[ch[0]] = ch[1]
		print "Wifly : donnees pretes a enregistrer :"
		print data_dic
		return data_dic
	except Exception as e:
		print "Wifly : Impossible de recevoir de messages: {}".format(e)

## socket close
def socket_close(sock):
	sock.close()
