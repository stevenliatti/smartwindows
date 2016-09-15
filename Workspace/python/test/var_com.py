import time
import Queue

q = Queue.Queue()
q.put(5)

if __name__ == "__main__":
    while 1:
        print "com 1"
        length = q.qsize()
        if (length != 0):
            s = q.get()
            print s
        
        time.sleep(5)
