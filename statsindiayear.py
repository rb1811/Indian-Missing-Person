#This file fetches the missingperson and their year of missing details 
#We dump the MissingPerson and their YOM  in statsindiayear.json file
import json
import requests
from py2neo import neo4j,cypher
headers={'content-type':'application/json'}
url='http://MissingPerson:WefjajoR8aznY26vtkR6@missingperson.sb02.stations.graphenedb.com:24789/db/data/cypher'
g=neo4j.GraphDatabaseService(url)
querry={"query":"match (n:MissingPerson) return n.name,n.DoM","params":{}}
d1=requests.post(url,data=json.dumps(querry),headers=headers)
with open("statsindiayear.json","w") as outfile:
        json.dump(d1.json()['data'],outfile)

