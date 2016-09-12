import time
import socket_functions as socket
import used_thread as thread
import Queue
import database_functions as db_conn

## recuperation de la date et du temps
def get_date_time():
        date_now = "%d-%d-%d" % (time.localtime().tm_year,time.localtime().tm_mon,time.localtime().tm_mday)
        time_now = "%d:%d:%d" % (time.localtime().tm_hour,time.localtime().tm_min,time.localtime().tm_sec)
        return date_now, time_now

############################################
## fonctions utilisees                    ##
############################################

def average_data():
        returned_dic = {}
        somme_tempext = 0.0
        somme_tempint = 0.0
        somme_lum = 0.0
        somme_vitesse = 0.0
        length = data_queue.qsize()
        if (length != 0):
                for i in range(length):
                        data_dic = data_queue.get()
                        somme_tempint += data_dic["TI"]
                        somme_lum += data_dic["L"]
                        somme_tempext += data_dic["TE"]
                        somme_vitesse += data_dic["WIND"]

        returned_dic["TI"] = ('{:.2f}'.format(somme_tempint / length))
        returned_dic["L"] = ('{:.2f}'.format(somme_lum / length))
        returned_dic["TE"] = ('{:.2f}'.format(somme_tempext / length))
        returned_dic["WIND"] = ('{:.2f}'.format(somme_vitesse / length))

        return returned_dic

############################################
## initialisation des variables globales  ##
############################################

data_queue = Queue.Queue()

database_ip = "localhost"
mysql_username = "root"
mysql_password = ""
database_name = "smartwindows"

socket_ip = "192.168.32.241"
socket_port = 2000

## pour le mode : 0 => automatique, 1 => manuel
## current_M => mode en cours
current_M = "0"  
## pour la fenetre : 0 => fermee, 1 => ouverte
## current_WS => etat courant de la fenetre
current_WS = "0" 
## pour le niveau de store : une valeur de 0 a 10 (0 pour ferme totalement, 10 pour ouvert totalement)
## current_BL => etat courant du store
current_BL = "0"

############################################
## programme principal                    ##
############################################

if __name__ == "__main__":

        while 1:

                ## lancement des threads
                th_reception = thread.reception(socket_ip, socket_port, data_queue)
                th = thread.reception_web(socket_ip, socket_port)
                th_reception.start()
                # th.start()

                if not data_queue.empty():
                        date_now, time_now = get_date_time()
                        ## calcul de la moyenne des donnees
                        to_be_saved = average_data()
                        ## connection a la base de donnees
                        db = db_conn.database_open(database_ip, mysql_username, mysql_password, database_name)
                        ## insertion des donnees dans la base
                        db_conn.insert_data(db, to_be_saved["TI"], to_be_saved["L"], to_be_saved["TE"], to_be_saved["WIND"], date_now, time_now)
                        ## fermeture de la connexion a la base de donnees
                        db_conn.database_close(db)
                time.sleep(15)



