import mysql.connector
mydb = mysql.connector.connect(host="db",port="3306",user="root",passwd="password")
mycursor = mydb.cursor()
mycursor.execute("CREATE DATABASE AlphaQMoM") #Creating database
mydb.commit()
mydb = mysql.connector.connect(host="db",port="3306",user="root",passwd="password",database="AlphaQMoM")
mycursor = mydb.cursor()
mycursor.execute("CREATE TABLE MoM (user TEXT NOT NULL,date DATE NOT NULL PRIMARY KEY,MoM LONGTEXT)") #Creating table
mydb.commit()
mydb = mysql.connector.connect(host="db",port="3306",user="root",passwd="password")
mycursor = mydb.cursor()
mycursor.execute("CREATE USER 'jay_jay'@'%' IDENTIFIED BY 'password'") #Creating a read-only user for AlphaQMoM database
mycursor.execute("GRANT SELECT, SHOW VIEW ON AlphaQMoM.* TO 'jay_jay'@'%'")
mycursor.execute("FLUSH PRIVILEGES")
mydb.commit()