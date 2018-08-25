from __future__ import division
import requests
import time

stream_url = 'http://radionepal.gov.np:40100/stream'

r = requests.get(stream_url, stream=True)

filename = 'bishwa-paribesh_' + str(int(time.time())) + '.mp3'

with open(filename, 'wb') as f:
    try:
        for block in r.iter_content(1024):
            f.write(block)
    except KeyboardInterrupt:
        pass