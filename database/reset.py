import psycopg2


class DBContext:

    def __init__(self): #PG-connection setup
        print("AUTHORS NOTE: If you submit faulty information here, I am not responsible for the consequences.")

        params = {'host':'localhost', 'user':"mkrog", 'database': "mkrog", 'password':"mkrog-xmlpub13"}
        self.conn = psycopg2.connect(**params)

        self.cur = self.conn.cursor()
        self.cur.execute("SELECT * FROM BOOKS;")
        print(self.cur.fetchall())


DBDriver = DBContext()