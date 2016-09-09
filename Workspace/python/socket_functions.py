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
            print response
            response = sock.recv(4)

        print "Wifly : Debut de la reception..."
        ## le message va etre sous la forme "param:valeur"
        for i in range(7):
            response = sock.recv(1024)
            print format(response)
            ## spliter le message dans un tableau a deux case
            ## 1ere case contient le nom du parametre, 2eme case sa valeur
            ch = response.split(":")
            ## enregistrement dans le dictionnaire
            data_dic[ch[0]] = float(ch[1])
        print "Wifly : donnees pretes a enregistrer :"
        print data_dic
        return data_dic
    except Exception as e:
        print "Wifly : Impossible de recevoir de messages: {}".format(e)

## socket send message function
def send_socket(sock, msg):
    print "Wifly : Envoie des donnees :\n" + msg
    try:
        sock.send(msg);
    except Exception as e:
        print "Wifly : Impossible d'envoyer de messages: {}".format(e)

## socket close
def socket_close(sock):
    sock.close()
