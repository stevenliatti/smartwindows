import MySQLdb

#database initialisation function
def database_open(ip, login, password, database_name):
    return MySQLdb.connect(ip, login, password, database_name)

#database close
def database_close(db):
    db.close()

#database data insertion function
def insert_data(db, temp_int, luminosity, temp_ext, wind, date, time):
    sql_string = "INSERT INTO data(temp_int, temp_ext, luminosity, wind_speed, date, time) VALUES ('%s','%s','%s','%s','%s', '%s')" % (temp_int, temp_ext, luminosity, wind, date, time)
    try:
        # prepare a cursor object using cursor() method
        cursor = db.cursor()
        # Execute the SQL command
        cursor.execute(sql_string)
        # Commit your changes in the database
        db.commit()
        print "Insertion donnees => OK"
    except Exception as e:
        print "Impossible d'inserrer les donnees : {}".format(e)

#insertion des etats dans la base de donnees
def insert_state(db, config_mode, window, blind, date, time, users_id):
    sql_string = "INSERT INTO state(config_mode, window, blind, date, time, users_id) VALUES ('%s','%s','%s','%s','%s', '%s')" % (config_mode, window, blind, date, time, users_id)
    try:
        # prepare a cursor object using cursor() method
        cursor = db.cursor()
        # Execute the SQL command
        cursor.execute(sql_string)
        # Commit your changes in the database
        db.commit()
        print "Insertion etat => OK"
    except Exception as e:
        print "Impossible d'inserrer les etat : {}".format(e)
        
#selection du dernier etat
def get_last_state(db):
    sql_string = "SELECT * FROM state ORDER BY id DESC LIMIT 0, 1"
    try:
        # prepare a cursor object using cursor() method
        cursor = db.cursor()
        # Execute the SQL command
        cursor.execute(sql_string)
        print "----------------------------"
        dd = cursor.fetchone()
        print dd
        return dd
    except Exception as e:
        print "Impossible de recuperer l'etat : {}".format(e)
