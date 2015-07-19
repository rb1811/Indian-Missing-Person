#This file fetches the sex ratio count in the entire country  
#We dump the [Male,other,female] in this order ONLY in statsindiasexoutput.json file
import json
import requests
from py2neo import neo4j,cypher
headers={'content-type':'application/json'}
url='http://MissingPerson:WefjajoR8aznY26vtkR6@missingperson.sb02.stations.graphenedb.com:24789/db/data/cypher'
g=neo4j.GraphDatabaseService(url)
querry={"query":"MATCH (n:MissingPerson) RETURN CASE n.gender WHEN '{n1}' THEN count(n) WHEN '{n2}' THEN count(n) ELSE count(n) END AS result","params":{"n1":'M',"n2":'F'}}
d1=requests.post(url,data=json.dumps(querry),headers=headers)
mp=[]
cp=['neo4j','Male','other','female']
for i in d1.json()['data']:
	mp.append(i[0])
payload=dict(zip(cp,mp))
with open("statsindiasexoutput.json","w") as outfile:
        json.dump(payload,outfile)

