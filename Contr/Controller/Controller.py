

import socket,random


def main():

sock = socket.socket(socket.AF_INET,socket.SOCK_STREAM)

sock.bind(('localhost',8000))

print('listening....')

sock.listen(5)

while True:

conn,addr = sock.accept()

data = conn.recv(1024)

print(data)

conn.send(str(random.randint(0,180)).encode("utf-8"))

conn.close()



if __name__ =="__main__":

main()
