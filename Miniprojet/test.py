import os
import requests
from bs4 import BeautifulSoup
import pandas as pd
import bs4
from requests import response

requete = requests.get("https://www.bonnesroutes.com/")
page = requete.content
##soup = BeautifulSoup(page)
soup = bs4.BeautifulSoup(response.text, 'html.parser')


div = soup.find_all("div", {"id":"from_field_parent"})
div1 = soup.find_all("div", {"id":"to_field_parent"})

parameters = ['name','to']
df_f = pd.DataFrame()
for par in parameters:
    l = []
    for el in div:
        j = el[par]
        l.append(j)
    l = pd.DataFrame(l, columns = [par])
    df_f = pd.concat([df_f,l], axis = 1)



