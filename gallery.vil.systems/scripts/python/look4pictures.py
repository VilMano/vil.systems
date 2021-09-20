import sys
import os 
try:
    import sqlite3
except Exception as e:
    print("Dependencies failed to import: ", e)
    sys.exit(0)

realpath = os.path.abspath("../../resources/images/")
directories = os.listdir(realpath)

dbpath = os.path.abspath("../../db/gallery.db")

try:
    conn = sqlite3.connect(dbpath)
except Exception as ex:
    print("Connection to database failed. Error: ", ex)
    sys.exit(0)

# albums
cur = conn.cursor()
sql = "SELECT name FROM album;"
cur.execute(sql)
rows = cur.fetchall()

dirlist = list()
exists = False
if rows == []:
    for directory in directories:
        dirlist.append(directory)
else:
    for directory in directories:
        for row in rows[0]:
            if row == directory.split("_")[0]:
                exists = True
        if exists == False:
                dirlist.append(directory)    

for dir in dirlist:
    sql = "INSERT INTO album (name, url, date) VALUES (\"" + dir.split("_")[0] + "\"," + "\"" + realpath + "/" + dir + "\", \""+ dir.split("_")[1] +"\");"
    cur.execute(sql)

# pictures
piclist = list()

for directory in directories:
    listpic = os.listdir(realpath + "/" + directory)
    for picture in listpic:
        sql = "SELECT id FROM album WHERE name = \""+ directory.split("_")[0] +"\";"
        cur.execute(sql)
        albumid = cur.fetchone()
        sql = "SELECT picture.name FROM picture LEFT JOIN album ON album.id = picture.album_id WHERE album_id = " + str(albumid[0]) + " AND picture.name = \"" + picture + "\""
        cur.execute(sql)
        if cur.fetchone() == None:
            sql = "INSERT INTO picture (name, url, album_id) VALUES (\"" + picture + "\"," + "\"" + realpath + "/" + directory + "/" + picture + "\"," + str(albumid[0]) + ");"
            cur.execute(sql)

conn.commit()
