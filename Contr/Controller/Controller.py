import socket,random,threading,time

def m1():
    sock1 = socket.socket(socket.AF_INET,socket.SOCK_STREAM)
    sock1.bind(('0.0.0.0',8001))
    sock1.listen()
    while True:
        intt=random.randint(0,180)
        conn1,addr1 = sock1.accept()
        print(addr1[0]+":1:"+str(intt))
        conn1.send(chr(intt).encode())
        conn1.close()
        time.sleep(1)
def m2():
    sock2 = socket.socket(socket.AF_INET,socket.SOCK_STREAM)
    sock2.bind(('0.0.0.0',8002))
    sock2.listen()
    while True:
        intt=random.randint(0,180)
        conn2,addr2 = sock2.accept()
        print(addr2[0]+":2:"+str(intt))
        conn2.send(chr(intt).encode())
        conn2.close()
        time.sleep(1)

if __name__ =="__main__":
    threading.Thread(target=m1,args=()).start()
    threading.Thread(target=m2,args=()).start()
