#

import os

def dirlist(path):
  dirl=os.listdir(path)
  #dirl.sort()
  return dirl

def filelist(path,level=0):
  if level==0:
    print("A mappa kilistázása: ",path)
  dirl=dirlist(path)
  for f in dirl:
    print("{0} - ".format(level)+f)
    fn=os.path.join(path,f)
    if os.path.isdir(fn):
      level+=1
      print("\n"+fn)
      filelist(fn,level)

filelist("/home/peter")

#

