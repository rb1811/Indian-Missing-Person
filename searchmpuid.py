#This file fetches the missingperson details 
#We dump the MissingPerson's  in searchuid.json file and the output is stored in searchuidoutput.json file
import json
import requests
from py2neo import neo4j,cypher
headers={'content-type':'application/json'}
url='http://MissingPerson:WefjajoR8aznY26vtkR6@missingperson.sb02.stations.graphenedb.com:24789/db/data/cypher'
g=neo4j.GraphDatabaseService(url)
fp=open('searchuid.json').read()
l=json.loads(fp)
idd=str(l['uid'])
querry={"query":"match (n:MissingPerson {uid:{n1}}) return n","params":{"n1":idd}}
d1=requests.post(url,data=json.dumps(querry),headers=headers)
d2=d1.json()
mp=[]
for person in d2['data']:
	mp.append(person[0]['data'])
with open("searchuidoutput.json","w") as outfile:
        json.dump(mp,outfile)
