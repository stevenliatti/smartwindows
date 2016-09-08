import socket

#socket connection
def socket_open(ip, port):
    try:
        sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        sock.connect((ip, port))
        print "Ouverture du socket"
        return sock
    except Exception as e:
        print "Impossible d'ouvrir le socket: {}".format(e)

#socket reception message function
def reception_socket(sock):
    data_array = []
    try:
        response = sock.recv(4)
        while response != "DONE":
            response = sock.recv(4)

        for i in range(7):
            response = sock.recv(1024)
            print format(response)
            data_array.append(float(response))
        return data_array
    except Exception as e:
        print "Impossible de recevoir de messages: {}".format(e)

#socket send message function
def send_socket(sock, msg):
    try:
        sock.send(msg);
    except Exception as e:
        print "Impossible d'envoyer de messages: {}".format(e)

#socket close
def socket_close(sock):
    sock.close()
