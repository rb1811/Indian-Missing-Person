#This file fetches the all the missingpersons in a particular state
#We dump the State name  in searchstate.json file and the output is stored in searchstateoutput.json file
import json
import requests
from py2neo import neo4j,cypher
headers={'content-type':'application/json'}
url='http://MissingPerson:WefjajoR8aznY26vtkR6@missingperson.sb02.stations.graphenedb.com:24789/db/data/cypher'
g=neo4j.GraphDatabaseService(url)
fp=open('searchstate.json').read()
l=json.loads(fp)
st=str(l['state']);
querry={"query": "match (n:States {name:{n1}})-[r:missing]->(m) return m", "params": {"n1": st}}
d1=requests.post(url,data=json.dumps(querry),headers=headers)
d2=d1.json()
mp=[]
for person in d2['data']:
	mp.append(person[0]['data'])
with open("searchstateoutput.json","w") as outfile:
        json.dump(mp,outfile)
