import MySQLdb

#database initialisation function
def database_open(ip, login, password, database_name):
    return MySQLdb.connect(ip, login, password, database_name)

#database close
def database_close(db):
    db.close()

#database data insertion function
def insert_data(db, temp_int, temp_ext, luminosity, date, time):
    sql_string = "INSERT INTO data(temp_int, temp_ext, luminosity, date, time) VALUES ('%s','%s','%s','%s','%s')" % (temp_int, temp_ext, luminosity, date, time)
    try:
        # prepare a cursor object using cursor() method
        cursor = db.cursor()
        # Execute the SQL command
        cursor.execute(sql_string)
        # Commit your changes in the database
        db.commit()
    except Exception as e:
        print format(e)
