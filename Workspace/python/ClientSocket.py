import time
import socket_functions as socket
import used_thread as thread
import Queue
import database_functions as db_conn

def average_data():
	returned_list = []
	
	somme_tempext = 0.0
	somme_tempint = 0.0
	somme_lum = 0.0
	somme_vitesse = 0.0
	length = data_queue.qsize()
	for i in range(length):
		ttt = data_queue.get()
		somme_tempint += ttt[0]
		somme_lum += ttt[1]
		somme_tempext += ttt[2]
		somme_vitesse += ttt[3]

	returned_list.append('{:.2f}'.format(somme_tempint / length))
	returned_list.append('{:.2f}'.format(somme_lum / length))
	returned_list.append('{:.2f}'.format(somme_tempext / length))
	returned_list.append('{:.2f}'.format(somme_vitesse / length))

	return returned_list


data_queue = Queue.Queue()

#principal program
if __name__ == "__main__":
	

	ip = "localhost"
	username = "root"
	password = ""
	database_name = "smartwindows"
	
	while 1:
		th_reception = thread.reception(data_queue)
		th_reception.start()

		if not data_queue.empty():
			print "enregistrement bd"
			date_now = "%d-%d-%d" % (time.localtime().tm_year,time.localtime().tm_mon,time.localtime().tm_mday)
			time_now = "%d:%d:%d" % (time.localtime().tm_hour,time.localtime().tm_min,time.localtime().tm_sec)
			to_be_saved = average_data()
			db = db_conn.database_open("localhost", "root", "", "smartwindows")
			db_conn.insert_data(db, to_be_saved[0], to_be_saved[1], to_be_saved[2], to_be_saved[3], date_now, time_now)
			db_conn.database_close(db)

		time.sleep(5)










		
   ##sock = socket.socket_open(ip, port)

##        th_action = thread.action_manuelle()
##        th_reception = thread.reception()

##        th_action.start()
##        th_reception.start()
		
##        triple = th_reception.triple_data
##        print "main : triple : "
##        print triple
		
##        data_list.append(triple_data)
##
##        if (time.clock() - tl >= 30):
##            tl = time.clock()
##            date_now = "%d-%d-%d" % (time.localtime().tm_year,time.localtime().tm_mon,time.localtime().tm_mday)
##            time_now = "%d:%d:%d" % (time.localtime().tm_hour,time.localtime().tm_min,time.localtime().tm_sec)
##            to_be_saved = average_data(data_list)
####            db = database_open("localhost", "root", "", "smartwindows")
####            insert_data(db, to_be_saved[0], to_be_saved[2], to_be_saved[1])
####            database_close(db)
##            data_list = []
##        
##        triple_data = []
##        
		
##        triple_data = socket_m.reception_socket(sock, ip, port)
		
		
	##socket.socket_close(sock)


