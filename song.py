import time
from threading import Thread, Lock
import sys

lock = Lock()

def animate_text(text, delay=0.1):
    with lock:
        for char in text:
            sys.stdout.write(char)
            sys.stdout.flush()
            time.sleep(delay)
        print()

def sing_lyric(lyric, delay, speed):
    time.sleep(delay)
    animate_text(lyric, speed)

def sing_song():
    lyrics = [
        ("We're looking back", 0.07),
        ("We messed around", 0.07),
        ("But that was then", 0.07),
        ("And this is now", 0.07),
        ("All we needs enough love", 0.07),
        ("To hold us", 0.07),
        ("Where we are...", 0.07),
    ]
    delays = [0.5, 2.2, 4.2, 6.2, 8.2, 10.7, 13.0]

    threads = []
    for i in range(len(lyrics)):
        lyric, speed = lyrics[i]
        t = Thread(target=sing_lyric, args=(lyric, delays[i], speed))
        threads.append(t)
        t.start()

    for thread in threads:
        thread.join()

if __name__ == "__main__":
    sing_song()