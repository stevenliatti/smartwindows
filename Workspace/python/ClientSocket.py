import socket

#reception function
def reception(ip, port):
    
    sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    sock.connect((ip, port))
    try:
        while 1:
            response = sock.recv(1024)
            print format(response)
    except Exception as e:
        print "Impossible de se connecter au serveur: {}".format(e)
    finally:
        sock.close()

#principal program
if __name__ == "__main__":
 
    ip, port = "192.168.32.241", 2000
    
    reception(ip, port)
