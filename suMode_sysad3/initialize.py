import mysql.connector
mydb = mysql.connector.connect(
    host="db", port="3306", user="root", passwd="password")
mycursor = mydb.cursor()
mycursor.execute("CREATE DATABASE AlphaQMoM")  # Creating database
mydb.commit()
mydb = mysql.connector.connect(
    host="db", port="3306", user="root", passwd="password", database="AlphaQMoM")
mycursor = mydb.cursor()
# Creating table
mycursor.execute(
    "CREATE TABLE MoM (user TEXT NOT NULL,date DATE NOT NULL PRIMARY KEY,MoM LONGTEXT)")
# Creating table for users
mycursor.execute(
    "CREATE TABLE allUsers (user TEXT NOT NULL,password LONGTEXT)")
for i in range(1, 31):
    if len(str(i)) == 1:
        command = "INSERT INTO allUsers (user, password) VALUES (%s, %s)"
        uname = "webDev_0"+str(i)
        val = (uname, "superuserpass")
        mycursor.execute(command, val)
        command1 = "INSERT INTO allUsers (user, password) VALUES (%s, %s)"
        uname = "appDev_0"+str(i)
        val1 = (uname, "superuserpass")
        mycursor.execute(command1, val1)
        command2 = "INSERT INTO allUsers (user, password) VALUES (%s, %s)"
        uname = "sysAd_0"+str(i)
        val2 = (uname, "superuserpass")
        mycursor.execute(command2, val2)
    else:
        command = "INSERT INTO allUsers (user, password) VALUES (%s, %s)"
        uname = "webDev_"+str(i)
        val = (uname, "superuserpass")
        mycursor.execute(command, val)
        command1 = "INSERT INTO allUsers (user, password) VALUES (%s, %s)"
        uname = "appDev_"+str(i)
        val1 = (uname, "superuserpass")
        mycursor.execute(command1, val1)
        command2 = "INSERT INTO allUsers (user, password) VALUES (%s, %s)"
        uname = "sysAd_"+str(i)
        val2 = (uname, "superuserpass")
        mycursor.execute(command2, val2)

command0 = "INSERT INTO allUsers (user, password) VALUES (%s, %s)"
val0 = ("jay_jay", "superuserpass")
mycursor.execute(command0, val0)
        
mydb.commit()
mydb = mysql.connector.connect(
    host="db", port="3306", user="root", passwd="password")
mycursor = mydb.cursor()
# Creating a read-only user for AlphaQMoM database
mycursor.execute("CREATE USER 'jay_jay'@'%' IDENTIFIED BY 'password'")
mycursor.execute("GRANT SELECT, SHOW VIEW ON AlphaQMoM.* TO 'jay_jay'@'%'")
mycursor.execute("FLUSH PRIVILEGES")


mydb.commit()
