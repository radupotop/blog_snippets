# pip install beautifulsoup4 requests

from bs4 import BeautifulSoup
import requests
import itertools
from pprint import pprint

resp = requests.get('http://wooptoo.com/')
page = BeautifulSoup(resp.content)

posts = page.find_all(attrs={'class':'post'})

_titles = [p.select_one('.post-title a') for p in posts]
titles = [t.text for t in _titles]
urls = [u.get('href') for u in _titles]
datetimes = [p.find('time').get('datetime') for p in posts]
tags = [t.select_one('.meta-tags a').text for t in posts]
summaries = [s.find(class_='post-summary').text.strip() for s in posts]

_posts = zip(titles, urls, datetimes, tags, summaries, itertools.count(1))
_keys = ('title', 'url', 'datetime', 'tags', 'summary', 'number')
output = [dict(zip(_keys, p)) for p in _posts]

pprint(output)
