import mysql.connector
import sys
details = sys.argv  # Getting the parameters(date,username,MoM) in a list

mydb = mysql.connector.connect(
    host="db", port="3306", user="root", passwd="password", database="AlphaQMoM")
mycursor = mydb.cursor()

# Checking whether MoM is added yet or not and updating in the database accordingly.
if len(details) == 3:
    command = "INSERT INTO MoM (user, date) VALUES (%s, %s)"
    val = (details[1], details[2])
elif len(details) == 4:
    command = "INSERT INTO MoM (user, date) VALUES (%s, %s, %s)"
    val = (details[1], details[2], details[3])
mycursor.execute(command, val)

mydb.commit()
