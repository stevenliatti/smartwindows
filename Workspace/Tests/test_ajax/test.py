import socket

s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

host = '127.0.0.1'
port = int(2001)
s.bind((host, port))
while 1:
	s.listen(1)

	conn, addr = s.accept()

	print (conn, addr)

	data = conn.recv(100000)
	data = data.decode("utf-8")

	print data

s.close
