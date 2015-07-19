#This file fetches the MissingPerson's ContactPerson Details
#We dump the Contact Person's UID in searchcname.json file and the output is stored in searchcnameoutput.json file 
import json
import requests
from py2neo import neo4j,cypher
headers={'content-type':'application/json'}
url='http://MissingPerson:WefjajoR8aznY26vtkR6@missingperson.sb02.stations.graphenedb.com:24789/db/data/cypher'
g=neo4j.GraphDatabaseService(url)
fp=open('searchcname.json').read()
l=json.loads(fp)
idd=str(l['uid'])
querry={"query":"match (n:ContactPerson {uid:{n1}}) return n","params":{"n1":idd}}
d1=requests.post(url,data=json.dumps(querry),headers=headers)
d2=d1.json()
mp=[]
for person in d2['data']:
	mp.append(person[0]['data'])
with open("searchcnameoutput.json","w") as outfile:
        json.dump(mp,outfile)
