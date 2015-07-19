#This file fetches the  contactperson details through phone no 
#We dump the ContactPerson's Phone in searchmpphone.json file and the output is stored insearchmpphoneoutput.json file
import json
import requests
from py2neo import neo4j,cypher
headers={'content-type':'application/json'}
url='http://MissingPerson:WefjajoR8aznY26vtkR6@missingperson.sb02.stations.graphenedb.com:24789/db/data/cypher'
g=neo4j.GraphDatabaseService(url)
fp=open('searchcphone.json').read()
l=json.loads(fp)
phn=str(l['cphone'])
querry={"query":"match (n:ContactPerson {phone:{n1}}) return n","params":{"n1":phn}}
d1=requests.post(url,data=json.dumps(querry),headers=headers)
d2=d1.json()
mp=[]
for person in d2['data']:
	mp.append(person[0]['data'])
with open("searchcphoneoutput.json","w") as outfile:
        json.dump(mp,outfile)
