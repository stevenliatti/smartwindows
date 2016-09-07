import time
import socket_functions as socket
import used_thread as thread

def average_data(data_list):
    returned_list = []
    
    somme_tempext = 0
    somme_tempint = 0
    somme_lum = 0
    for i in range(len(data_list)):
        somme_tempext += data_list[i][1]
        somme_tempint += data_list[i][2]
        somme_lum += data_list[i][3]

    returned_list.append(somme_tempext / len(data_list))
    returned_list.append(somme_tempint / len(data_list))
    returned_list.append(somme_lum / len(data_list))

    return returned_list

triple_data = []
data_list = []
date_now = ""
time_now = ""

#principal program
if __name__ == "__main__":

    tl = time.clock()
    
    ip = "localhost"
    username = "root"
    password = ""
    database_name = "smartwindows"
    
    while 1:
   ##sock = socket.socket_open(ip, port)

        th_action = thread.action_manuelle()
        th_reception = thread.reception(triple_data)

        th_action.start()
        th_reception.start()
        
        data_list.append(triple_data)

        if (time.clock() - tl >= 20):
            date_now = "%d-%d-%d" % (time.localtime().tm_year,time.localtime().tm_mon,time.localtime().tm_mday)
            time_now = "%d:%d:%d" % (time.localtime().tm_hour,time.localtime().tm_min,time.localtime().tm_sec)
            to_be_saved = average_data(data_list)
            db = database_open("localhost", "root", "", "smartwindows")
            insert_data(db, to_be_saved[0], to_be_saved[2], to_be_saved[1])
            database_close(db)
            data_list = []
        
        triple_data = []
        
        
##        triple_data = socket_m.reception_socket(sock, ip, port)
        
        



        
        th_reception.join()
        th_action.join()
        
        
    ##socket.socket_close(sock)


