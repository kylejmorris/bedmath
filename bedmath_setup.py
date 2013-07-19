import os
import pwd
import grp

fileowner = 'g0g'
usergroup = 'g0g'
path = '/var/www/bedmath'
uid = pwd.getpwnam(fileowner).pw_uid
gid = grp.getgrnam(fileowner).gr_gid

def set_permissions(path):
    for dirpath, dirnames, filenames in os.walk(path):
        for dirname in dirnames:
            path = os.path.join(dirpath, dirname)
            os.chmod(path, 0o755)
            os.chown(path, uid, gid)
        for filename in filenames:
            path = os.path.join(dirpath, filename)
            os.chmod(path, 0o644) # for example
            os.chown(path, uid, gid)
set_permissions(path)
