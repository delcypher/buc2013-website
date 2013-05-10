#!/usr/bin/env python2.7

import urllib2
import json
import sh
import time

username='delcypher'
repository='buc2013-website'
localmirror="/data/other/buc2013-poll"

def getRemoteHeadSHA(**kargs):
    url='https://api.github.com/repos/{0}/{1}/commits/HEAD'.format(kargs['user'],kargs['repo'])
    responce=urllib2.urlopen(url,None,20)
    structuredData=json.loads(responce.read())
    return structuredData['sha']

def getLocalHeadSHA(path):
    sha=sh.git("rev-parse","HEAD",_cwd=path)
    sha.wait()
    result=str(sha).strip()
    return result

def updateRepo(path):
    try:
        c=sh.git("pull","origin","--force",_cwd=path)
        c.wait()
        print(c)
    except:
        print("Something broke!")
        raise

def ftpUpload(path):
    try:
        c=sh.Command("git-ftp")
        d=c(_cwd=path)
        d.wait()
        print(d)
    except:
        print("ftp upload failed")
        raise

if __name__ == "__main__":
    first=True
    while True:
        if not first:
            print("Sleeping")
            time.sleep(60)
        first=False

        print(time.ctime())
        print("Checking repositories...")
        try:
           rSHA=getRemoteHeadSHA(user=username,repo=repository)
           lSHA=getLocalHeadSHA(localmirror)
        except Exception as e:
            print(str(e))
            continue

        if rSHA!=lSHA :
            print("SHA1 mismtach: Local \"{0}\", Remote \"{1}\"".format(lSHA,rSHA))
            print("Git pull..")
            try:
                updateRepo(localmirror)
                print("ftp upload")
                ftpUpload(localmirror)
                print("Done")
            except Exception as e:
                print(str(e))
                print("Upload failed!")
                continue;
        else:
            print("SHA1 match. Doing nothing")


    

