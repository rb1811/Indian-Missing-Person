#this file is for ticker
import json
import requests
from py2neo import neo4j,cypher
headers={'content-type':'application/json'}
url='http://MissingPerson:WefjajoR8aznY26vtkR6@missingperson.sb02.stations.graphenedb.com:24789/db/data/cypher'
g=neo4j.GraphDatabaseService(url)
querry={"query": "match (n:MissingPerson) return n.uid, n.name,n.DoM,n.gender,n.age,n.city,n.state,n.height,n.address order by n.DoM desc limit 10","params": {}}
d1=requests.post(url,data=json.dumps(querry),headers=headers)
with open("tickeroutput.json","w") as outfile:
        json.dump(d1.json()['data'],outfile)
