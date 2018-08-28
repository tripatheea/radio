from __future__ import division
import requests
import time
import datetime
import pytz

program_start_time = (9, 15)
program_end_time = (9, 45)

def get_current_time():
    date_object = datetime.datetime.now(tz=pytz.timezone('Asia/Kathmandu'))

    hour = date_object.hour
    minute = date_object.minute

    return hour, minute

def save_radio_stream():
    stream_url = 'http://radionepal.gov.np:40100/stream'

    r = requests.get(stream_url, stream=True)

    filename = 'bishwa-paribesh_' + str(int(time.time())) + '.mp3'

    with open(filename, 'wb') as f:
        
        h, m = get_current_time()

        while (h == program_start_time[0]) and m >= program_start_time[1] and m <= program_end_time[1]:

            for block in r.iter_content(1024):
                f.write(block)
        

        

# The program runs 9:20 am to 9:40 am. 
# Record from 9:15 am to 9:45 am for extra-buffer.

save_radio_stream()



