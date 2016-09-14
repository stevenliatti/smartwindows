import socket

s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

host = '192.168.32.241'
port = int(2000)
s.bind((host, port))
while 1:
	s.listen(1)

	conn, addr = s.accept()

	data = conn.recv(100000)
	data = data.decode("utf-8")

	print data

s.close
