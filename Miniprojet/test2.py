import os
import csv
import requests
from bs4 import BeautifulSoup

requete = requests.get("https://www.bonnesroutes.com/distance/?from=Lyon%20(Auvergne-Rh%C3%B4ne-Alpes,%20France)&to=Marseille%20(Provence-Alpes-C%C3%B4te%20d%27Azur)&v=&sm=130&so=90&fc=8.00&fp=1.50&far=&rtp=0")
page = requete.content
soup = BeautifulSoup(page)