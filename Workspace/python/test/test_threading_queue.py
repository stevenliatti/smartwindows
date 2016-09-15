import threading
import Queue
import time

myQueue = Queue.Queue()

class count_stuff(threading.Thread):
    """ 
        A thread class that will count a number, sleep and output that number
    """
    
    def __init__ (self, start_num, end, q):
        self.end = end
        self.num = start_num
        self.q = q
        threading.Thread.__init__ (self)
    
    def run(self):
        while True:
            if self.num != self.end:
                self.num += 1
                self.q.put(self.num)
                time.sleep(10)
            else:
                break
        
        
myThread = count_stuff(1, 5, myQueue)
myThread.start()

while True:
    if not myQueue.empty():
        val = myQueue.get()
        print "Outputting: ", val
    else :
        print "no data"
    time.sleep(2)
