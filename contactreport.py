#/usr/bin/env python
import json
import requests
from py2neo import neo4j,cypher
headers={'content-type':'application/json'}
url='http://MissingPerson:WefjajoR8aznY26vtkR6@missingperson.sb02.stations.graphenedb.com:24789/db/data/cypher'
g=neo4j.GraphDatabaseService(url)
querry={"query": "match (n:ContactPerson) return n","params": {}}
d1=requests.post(url,data=json.dumps(querry),headers=headers)
mp=[]
for i in range(0,len(d1.json()['data'])):
	mp.append(d1.json()['data'][i][0]['data'])
with open ("contactreportoutput.json","w") as outfile:
	json.dump(mp,outfile)
