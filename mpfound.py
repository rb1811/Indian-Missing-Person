#This file fetches the missingperson id  
#then we make the person as found person 
import json
import requests
from py2neo import neo4j,cypher
headers={'content-type':'application/json'}
url='http://MissingPerson:WefjajoR8aznY26vtkR6@missingperson.sb02.stations.graphenedb.com:24789/db/data/cypher'
g=neo4j.GraphDatabaseService(url)
fp=open('founduid.json').read()
l=json.loads(fp)
idd=str(l['uid'])
dof=str(l['dof'])
querry={"query":"MATCH (n:States)-[r:missing]->(m:MissingPerson {uid:{n1}}) CREATE (n)-[r2:found]->(m) SET r2 = r WITH r DELETE r","params":{"n1":idd}}
d1=requests.post(url,data=json.dumps(querry),headers=headers)
querry={"query":"MATCH (n:States)-[r:found]->(m:MissingPerson {uid:{n1}}) REMOVE m:MissingPerson SET m:FoundPerson;","params":{"n1":idd}}
d1=requests.post(url,data=json.dumps(querry),headers=headers)
querry={"query":"MATCH (n:States)-[r:found]->(m:FoundPerson {uid:{n1}}) set m.DoF={n2}","params":{"n1":idd,"n2":dof}}
d1=requests.post(url,data=json.dumps(querry),headers=headers)


